<?php
class proxyAccount extends plugin
{
  /* Definitions */
  var $plHeadline= "Proxy";
  var $plDescription= "This does something";

  /* Proxy attributes */
  var $gosaProxyAcctFlags= "[N    ]";
  var $gosaProxyID= "";
  var $gosaProxyWorkingStart= 420;
  var $gosaProxyWorkingStop= 1020;
  var $gosaProxyQuota= "5g";
  var $gosaProxyQuotaPeriod= "m";

  /* attribute list for save action */
  var $attributes= array(   "gosaProxyID", "gosaProxyAcctFlags", "gosaProxyWorkingStart",
                            "gosaProxyWorkingStop", "gosaProxyQuota", "gosaProxyQuotaPeriod");
  var $objectclasses= array("gosaProxyAccount");

  var $uid = "";

  function proxyAccount ($config, $dn= NULL, $parent= NULL)
  {
    plugin::plugin ($config, $dn, $parent);
    
    /* Setting uid to default */
    if(isset($this->attrs['uid'][0])){
      $this->uid = $this->attrs['uid'][0];
    }

  }

  function execute()
  {
    /* Call parent execute */
    plugin::execute();

    $display= "";

    /* Prepare templating */
    $smarty= get_smarty();

    /* Allow account status toogle?  */
    $smarty->assign("proxyAccountACL", "disabled");
    if(!$this->is_account && chkacl($this->acl,"create") == ""){
      $smarty->assign("proxyAccountACL", "");
    }elseif($this->is_account && $this->acl == "#all#" ){
      $smarty->assign("proxyAccountACL", "");
    }

    $smarty->assign("gosaProxyAcctFlagsACL",    chkacl($this->acl, "gosaProxyAcctFlags"));
    $smarty->assign("gosaProxyWorkingStartACL", chkacl($this->acl, "gosaProxyWorkingStart"));
    $smarty->assign("gosaProxyWorkingStopACL",  chkacl($this->acl, "gosaProxyWorkingStop"));
    $smarty->assign("gosaProxyQuotaACL",        chkacl($this->acl, "gosaProxyQuota"));

    /* Assign radio boxes */
    foreach (array("F", "T", "B", "N") as $val){
      if (is_integer(strpos($this->gosaProxyAcctFlags, "$val"))) {
        $smarty->assign("filter$val", "checked");

        /* Add state variables for on-the-fly state-changing of checkboxes */
        $smarty->assign($val."state", "");
        
      } else {
        $smarty->assign("filter$val", "");

        /* Same as above */
        if($_SESSION['js']==1){
          $smarty->assign($val."state", "disabled");
        }else{
          $smarty->assign($val."state", "");
        }
      }
    }

    /* Assign working time */
    $smarty->assign("starthour", (int)($this->gosaProxyWorkingStart / 60));
    $smarty->assign("startminute", (int)($this->gosaProxyWorkingStart % 60));
    $smarty->assign("stophour", (int)($this->gosaProxyWorkingStop / 60));
    $smarty->assign("stopminute", (int)($this->gosaProxyWorkingStop % 60));
    $hours= array();
    for($i=0; $i<24; $i++){
      $hours[]= sprintf("%02d",$i);
    }
    $smarty->assign("hours", $hours);
    $smarty->assign("minutes", array("00","15","30","45"));

    /* Assign quota values */
    $smarty->assign("quota_unit", array("k" => _("KB"), "m" => _("MB"), "g" => _("GB")));
    $smarty->assign("quota_time", array("h" => _("hour"), "d" => _("day"), "w" => _("week"), "m" => _("month")));
    $smarty->assign("gosaProxyQuotaPeriod", $this->gosaProxyQuotaPeriod);
    $smarty->assign("quota_size", preg_replace("/[a-z]$/i", "", $this->gosaProxyQuota));
    $smarty->assign("quota_u", preg_replace("/^[0-9]+/", "", $this->gosaProxyQuota));
    if ($this->is_account){
      $smarty->assign("proxyState", "checked");
    } else {
      $smarty->assign("proxyState", "");
    }

    /* Prepare correct state */
    if (!$this->is_account){
      $smarty->assign("pstate", "disabled");
    } else {
      $smarty->assign("pstate", "");
    }

    $changeA = "";
  
    if(chkacl($this->acl,"gosaProxyAcctFlags")==""){
      $changeA .="changeState('filterF');\n";
    }
    $smarty->assign("Working_allowedACL","disabled");
    if((chkacl($this->acl,"gosaProxyWorkingStart")=="")||(chkacl($this->acl,"gosaProxyWorkingStop")=="")){
      $smarty->assign("Working_allowedACL","");
      $changeA .= "changeState('filterT');\n";
    }

    $ProxyWorkingStateChange ="";
    if(chkacl($this->acl,"gosaProxyWorkingStart")==""){
      $ProxyWorkingStateChange.=  "changeState('startHour');\n";
      $ProxyWorkingStateChange.=  "changeState('startMinute');\n";
    }

    if(chkacl($this->acl,"gosaProxyWorkingStop")=="")  {
      $ProxyWorkingStateChange.=  "changeState('stopHour');\n";
      $ProxyWorkingStateChange.=  "changeState('stopMinute');\n";
    }
    
    $changeA .= $ProxyWorkingStateChange;
  
    $smarty->assign("ProxyWorkingStateChange",$ProxyWorkingStateChange);

    $changeB = "";
    if(chkacl($this->acl,"gosaProxyQuota")==""){
      $changeA .= "changeState('filterB');";
      $changeB = 
        "changeSubselectState('filterB', 'quota_size');
         changeSubselectState('filterB', 'quota_unit');
         changeSubselectState('filterB', 'gosaProxyQuotaPeriod');";
    }

    $smarty->assign("changeB",$changeB);
    $smarty->assign("changeA",$changeA);

    /* Show main page */
    $display.= $smarty->fetch(get_template_path('proxy.tpl', TRUE, dirname(__FILE__)));
    return($display);
  }

  function remove_from_parent()
  {
    /* Cancel if there's nothing to do here */
    if (!$this->initially_was_account){
      return;
    }
    
    plugin::remove_from_parent();

    $ldap= $this->config->get_ldap_link();
    @DEBUG (DEBUG_LDAP, __LINE__, __FUNCTION__, __FILE__,
        $this->attributes, "Save");
    $ldap->cd($this->dn);
    $this->cleanup();
    $ldap->modify ($this->attrs); 

    show_ldap_error($ldap->get_error(), _("Removing proxy account failed"));

    /* Optionally execute a command after we're done */
    $this->handle_post_events("remove",array("uid" => $this->uid));
  }

  /* Check values */
  function check()
  {
    /* Call common method to give check the hook */
    $message= plugin::check();
    
    /* We've got only one value to check for positive integer or emtpy field */
    if ($this->is_account){
      if (isset($_POST["quota_size"])){
        if ($_POST["quota_size"] == ""){
          $message[]= _("Numerical value for Quota Setting is empty.");
        }
        else if ($_POST["quota_size"] <= 0){
          $message[]= _("Numerical value for Quota Setting is not valid.");
        }
      }
    }

    return $message;
  }

  /* Save data to object */
  function save_object()
  {
    /* Do we need to flip is_account state? */
    if ($this->parent != NULL){
      if (isset($_POST['connectivityTab'])){

        /* Change state if needed */
        if(!$this->is_account && isset($_POST["proxy"]) && chkacl($this->acl,"create") == ""){
          $this->is_account = true;
        }elseif($this->is_account && !isset($_POST["proxy"]) && $this->acl == "#all#"){
          $this->is_account = false;
        }
      }
    }

    /* Save flag value */
    if ($this->is_account){
      if (chkacl ($this->acl, "gosaProxyAcctFlags") == ""){
        $flags= "";
        foreach(array("F", "T", "B") as $key){
          if (isset($_POST["filter$key"])){
            $flags.= $key;
          }
        }
        if ("[$flags]" != $this->gosaProxyAcctFlags){
          $this->is_modified= TRUE;
        }
        $this->gosaProxyAcctFlags= "[$flags]";
      }

      /* Save time values */
      if ((chkacl ($this->acl, "gosaProxyWorkingStart") == "")&&(isset($_POST['startMinute']))){
        $old= $this->gosaProxyWorkingStart;
        $this->gosaProxyWorkingStart= $_POST["startHour"] * 60 + $_POST["startMinute"];
        $this->is_modified= ($old != $this->gosaProxyWorkingStart)?TRUE:$this->is_modified;
      }
      
      if ((chkacl ($this->acl, "gosaProxyWorkingStop") == "")&&(isset($_POST['stopMinute']))){
        $old= $this->gosaProxyWorkingStop;
        $this->gosaProxyWorkingStop = $_POST["stopHour"]  * 60 + $_POST["stopMinute"];
        $this->is_modified= ($old != $this->gosaProxyWorkingStop)?TRUE:$this->is_modified;
      }

      /* Save quota values */
      if (chkacl ($this->acl, "gosaProxyQuota") == ""){
        $old= $this->gosaProxyQuota;
        if(isset($_POST["quota_size"]) && isset($_POST["quota_unit"])){
          $this->gosaProxyQuota= $_POST["quota_size"].$_POST["quota_unit"];
        }
        $this->is_modified= ($old != $this->gosaProxyQuota)?TRUE:$this->is_modified;
        $old= $this->gosaProxyQuotaPeriod;
        if(isset($_POST["gosaProxyQuotaPeriod"])){
          $this->gosaProxyQuotaPeriod = $_POST["gosaProxyQuotaPeriod"];
        }
        $this->is_modified= ($old != $this->gosaProxyQuotaPeriod)?TRUE:$this->is_modified;
      }
    }

  }


  /* Save to LDAP */
  function save()
  {
    plugin::save();

    /* Write back to ldap */
    $ldap= $this->config->get_ldap_link();
    $ldap->cd($this->dn);
    $this->cleanup();
    $ldap->modify ($this->attrs); 

    show_ldap_error($ldap->get_error(), _("Saving proxy account failed"));

    /* Optionally execute a command after we're done */
    if ($this->initially_was_account == $this->is_account){
      if ($this->is_modified){
        $this->handle_post_events("modify",array("uid" => $this->uid));
      }
    } else {
      $this->handle_post_events("add",array("uid" => $this->uid));
    }

  }

}

// vim:tabstop=2:expandtab:shiftwidth=2:filetype=php:syntax:ruler:
?>