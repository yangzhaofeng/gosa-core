<?php
/*
   This code is part of GOsa (https://gosa.gonicus.de)
   Copyright (C) 2005  Benoit Mortier

   This program is free software; you can redistribute it and/or modify
   it under the terms of the GNU General Public License as published by
   the Free Software Foundation; either version 2 of the License, or
   (at your option) any later version.

   This program is distributed in the hope that it will be useful,
   but WITHOUT ANY WARRANTY; without even the implied warranty of
   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   GNU General Public License for more details.

   You should have received a copy of the GNU General Public License
   along with this program; if not, write to the Free Software
   Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */

if (!$remove_lock){
  /* Reset requested? */
  if (isset($_POST['edit_cancel']) || 
      (isset($_GET['reset']) && $_GET['reset'] == 1)){
    del_lock ($ui->dn);
    sess_del ('edit');
    sess_del ('nagiosAccount');
  }

  /* Create mail object on demand */
  if (!isset($_SESSION['nagiosAccount']) || (isset($_GET['reset']) && $_GET['reset'] == 1)){
    $_SESSION['nagiosAccount']= new nagiosAccount ($config, $ui->dn);
  }
  $nagiosAccount= $_SESSION['nagiosAccount'];

  /* save changes back to object */
  if (isset ($_SESSION['edit'])){
    $nagiosAccount->save_object ();
  }

  /* Enter edit mode? */
  if (isset($_POST['edit'])){

    /* Check locking */
    if (($username= get_lock($ui->dn)) != ""){
      $_SESSION['back_plugin']= $plug;
      gen_locked_message ($username, $ui->dn);
      exit ();
    }

    /* Lock the current entry */
    add_lock ($ui->dn, $ui->dn);
    $_SESSION['dn']= $ui->dn;
    $_SESSION['edit']= TRUE;
  }

  /* Adjust acl's to mode */
  if (isset($_SESSION['edit'])){
    $acl= get_permissions ($ui->dn, $ui->subtreeACL);
    $nagiosAccount->acl= get_module_permission($acl, "nagiosAccount", $ui->dn);
  } else {
    $acl= get_permissions ($ui->dn, $ui->subtreeACL);
    $editacl= get_module_permission($acl, "nagiosAccount", $ui->dn);
    $nagiosAccount->acl= "#none#";
  }

  /* save changes to LDAP and disable edit mode */
  if (isset($_POST['edit_finish'])){

    /* Perform checks */
    $message= $nagiosAccount->check ();

    /* No errors, save object */
    if (count ($message) == 0){
      $nagiosAccount->save ();
      gosa_log ("User/nagios object'".$ui->dn."' has been saved");
      $nagiosAccount->acl= "#none#";
      $editacl= get_module_permission($acl, "nagiosAccount", $ui->dn);
      del_lock ($ui->dn);
      sess_del ('edit');

      /* Remove object */
      sess_del ('nagiosAccount');
    } else {
      /* Errors found, show message */
      show_errors ($message);
    }
  }

  /* Execute formular */
  $display= $nagiosAccount->execute ();

  /* Store changes  in session */
  if (isset ($_SESSION['edit'])){
    $_SESSION['nagiosAccount']= $nagiosAccount;
  }

  $info= "";
  /* Show page footer depending on the mode */
  if ($nagiosAccount->is_account){
    $display.= "<p class=\"plugbottom\">";

    /* Are we in edit mode? */
    if (isset($_SESSION['edit'])){
      $display.= "<input type=submit name=\"edit_finish\" value=\""._("Save")."\">\n";
      $display.= "&nbsp;";
      $display.= "<input type=submit name=\"edit_cancel\" value=\""._("Cancel")."\">\n";
      $info= "<img alt=\"\" align=\"middle\" src=\"".get_template_path('images/closedlock.png').
             "\"> ".$ui->dn."&nbsp;";
    } else {
      $info= "<img alt=\"\" align=\"middle\" src=\"".get_template_path('images/openlock.png').
             "\"> ".$ui->dn."&nbsp;";
      if (isset($editacl) && $editacl != "#none#"){
        $info.= "<img alt=\"\" align=\"middle\" src=\"".get_template_path('images/lamp.png').
            "\"> "._("Click the 'Edit' button below to change informations in this dialog");
        $display.= "<input type=submit name=\"edit\" value=\""._("Edit")."\">\n";
      }

      $display.= "<input type=\"hidden\" name=\"ignore\">\n";
    }
    $display.= "</p>\n";
  }

  /* Page header*/
  $display= print_header(get_template_path('images/monitoring.png'), _("Nagios settings"), $info).$display;

}

// vim:tabstop=2:expandtab:shiftwidth=2:filetype=php:syntax:ruler:
?>