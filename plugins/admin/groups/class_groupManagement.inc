<?php
/*
 * This code is part of GOsa (http://www.gosa-project.org)
 * Copyright (C) 2003-2008 GONICUS GmbH
 *
 * ID: $$Id$$
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */

class groupManagement extends management
{
<<<<<<< HEAD
    var $plHeadline     = "Groups";
    var $plDescription  = "Manage aspects of groups like members, POSIX, desktop, samba and mail settings";
    var $plIcon  = "plugins/groups/images/plugin.png";
=======
    public $plHeadline     = "Groups";
    public $plDescription  = "Manage aspects of groups like members, POSIX, desktop, samba and mail settings";
    public $plIcon         = "plugins/groups/images/plugin.png";
    public $matIcon        = "groups";
>>>>>>> gosa-core_v2.8

    // Tab definition 
    protected $tabClass = "grouptabs";
    protected $tabType = "GROUPTABS";
    protected $aclCategory = "groups";
    protected $aclPlugin   = "group";
    protected $objectName   = "group";

<<<<<<< HEAD
    function __construct($config,$ui)
=======
    public function __construct($config, $ui)
>>>>>>> gosa-core_v2.8
    {
        $this->config = $config;
        $this->ui = $ui;

        $this->storagePoints = array(get_ou("core", "groupRDN"));

        // Build filter
        if (session::global_is_set(get_class($this)."_filter")){
            $filter= session::global_get(get_class($this)."_filter");
        } else {
            $filter = new filter(get_template_path("group-filter.xml", true));
            $filter->setObjectStorage($this->storagePoints);
        }
        $this->setFilter($filter);

        // Build headpage
        $headpage = new listing(get_template_path("group-list.xml", true));
        $headpage->registerElementFilter("filterProperties", "groupManagement::filterProperties");
        $headpage->setFilter($filter);

        // Add copy&paste and snapshot handler.
        if ($this->config->boolValueIsTrue("core", "copyPaste")){
            $this->cpHandler = new CopyPasteHandler($this->config);
        }
        if($this->config->get_cfg_value("core","enableSnapshots") == "true"){
            $this->snapHandler = new SnapshotHandler($this->config);
        }
        parent::__construct($config, $ui, "groups", $headpage);

        $this->registerAction("edit_group","editEntry");
        $this->registerAction("edit_group_","editEntry");
        $this->registerAction("edit_group__","editEntry");
        $this->registerAction("edit_environment","editEntry");
        $this->registerAction("edit_appgroup","editEntry");
        $this->registerAction("edit_mailgroup","editEntry");
        $this->registerAction("edit_zarafagroup", "editEntry");

        $this->registerAction("sendMessage", "sendMessage");
        $this->registerAction("saveEventDialog", "saveEventDialog");
        $this->registerAction("abortEventDialog", "closeDialogs");
    }

    // Inject user actions
<<<<<<< HEAD
    function detectPostActions()
    {
        $action = management::detectPostActions();
        if(isset($_POST['save_event_dialog'])) $action['action'] = "saveEventDialog";
        if(isset($_POST['abort_event_dialog'])) $action['action'] = "abortEventDialog";
=======
    public function detectPostActions()
    {
        $action = management::detectPostActions();
        if (isset($_POST['save_event_dialog'])) {
            $action['action'] = "saveEventDialog";
        }
        if (isset($_POST['abort_event_dialog'])) {
            $action['action'] = "abortEventDialog";
        }
>>>>>>> gosa-core_v2.8
        return($action);
    }


    /*! \brief  Sends a message to a set of users using gosa-si events.
     */
<<<<<<< HEAD
    function saveEventDialog()
=======
    public function saveEventDialog()
>>>>>>> gosa-core_v2.8
    {
        $this->dialogObject->save_object();
        $msgs = $this->dialogObject->check();
        if(count($msgs)){
            msg_dialog::displayChecks($msgs);
        }
    }


    /*! \brief  Sends a message to a set of users using gosa-si events.
     */
<<<<<<< HEAD
    function sendMessage($action="",$target=array(),$all=array())
=======
    public function sendMessage($action="", $target=array(), $all=array())
>>>>>>> gosa-core_v2.8
    {
        $uids = array();
        $ldap = $this->config->get_ldap_link();
        $ldap->cd($this->config->current['BASE']);
        foreach($target as $dn){
            $ldap->cat($dn,array('cn'));
            if($ldap->count()){
                $attrs = $ldap->fetch();
                $uids[] = $attrs['cn'][0];
            }
        }
    }


<<<<<<< HEAD
    function editEntry($action="",$target=array(),$all=array(), $altTabClass ="", $altTabType = "", $altAclCategory="")
=======
    public function editEntry($action="", $target=array(), $all=array(), $altTabClass ="", $altTabType = "", $altAclCategory="")
>>>>>>> gosa-core_v2.8
    {
        $str = management::editEntry($action,$target);
        if(preg_match("/^edit_/",$action)){
            $tab = preg_replace("/^edit_([^_]*).*$/","\\1",$action);
            if(isset($this->tabObject->by_object[$tab])){
                $this->tabObject->current = $tab;
            }else{
                trigger_error("Unknown tab: ".$tab);
            }
        }
<<<<<<< HEAD
        if(!empty($str)) return($str);
    }

    static function filterProperties($row, $classes)
    {
        $result= "";

        $map = array(
                "posixGroup" => 
                array(
=======
        if (!empty($str)) {
            return($str);
        }
    }

    public static function filterProperties($row, $classes)
    {
        $theme = getThemeName();

        $result= "";

        switch ($theme) {
            case 'classic':
                $map = array(
                    "posixGroup" => array(
>>>>>>> gosa-core_v2.8
                    "image" => "plugins/groups/images/select_group.png",
                    "plugin" => "group",
                    "alt" => _("POSIX"),
                    "title" => _("Edit POSIX properties")
                    ),
<<<<<<< HEAD

                "gosaMailAccount" => 
                array(
=======
                    "gosaMailAccount" => array(
>>>>>>> gosa-core_v2.8
                    "image" => "plugins/groups/images/mail.png",
                    "plugin" => "mailgroup",
                    "alt" => _("Mail"),
                    "title" => _("Edit mail properties")
                    ),
<<<<<<< HEAD

                "sambaGroupMapping" => 
                array(
=======
                    "sambaGroupMapping" => array(
>>>>>>> gosa-core_v2.8
                    "image" => "plugins/groups/images/samba.png",
                    "plugin" => "group_",
                    "alt" => _("Samba"),
                    "title" => _("Edit samba properties")
                    ),
<<<<<<< HEAD

                "goFonPickupGroup" => 
                    array(
=======
                    "goFonPickupGroup" => array(
>>>>>>> gosa-core_v2.8
                            "image" => "plugins/groups/images/asterisk.png",
                            "plugin" => "group__",
                            "alt" => _("Phone"),
                            "title" => _("Edit phone properties")
                         ),
<<<<<<< HEAD

                "gotoMenuGroup" => 
                    array(
=======
                    "gotoMenuGroup" => array(
>>>>>>> gosa-core_v2.8
                            "image" => "plugins/groups/images/menu.png",
                            "plugin" => "appgroup",
                            "alt" => _("Menu"),
                            "title" => _("Edit start menu properties")
                         ),
<<<<<<< HEAD

                "zarafa-group" => 
                    array(
=======
                    "zarafa-group" => array(
>>>>>>> gosa-core_v2.8
                            "image" => "plugins/zarafa/images/zarafa_user_small.png",
                            "plugin" => "zarafagroup",
                            "alt" => _("Zarafa"),
                            "title" => _("Edit Zarafa properties")
                         ),
<<<<<<< HEAD


                "gotoEnvironment" => 
                    array(
=======
                    "gotoEnvironment" => array(
>>>>>>> gosa-core_v2.8
                            "image" => "plugins/groups/images/environment.png",
                            "plugin" => "environment",
                            "alt" => _("Environment"),
                            "title" => _("Edit environment properties")
                         )
                    );

<<<<<<< HEAD

=======
>>>>>>> gosa-core_v2.8
        // Walk thru map
        foreach ($map as $oc => $properties) {
            if (in_array_ics($oc, $classes)) {
                $result.= image($properties['image'], 'listing_edit_'.$properties['plugin'].'_'.$row, $properties['title']);
            } else {
                $result.= image('images/empty.png');
            }
        }
<<<<<<< HEAD
=======
                break;
            
            default:
            $map = array(
                    "posixGroup" => array(
                        "image" => "group",
                        "plugin" => "group",
                        "alt" => _("POSIX"),
                        "title" => _("Edit POSIX properties")
                    ),
                    "gosaMailAccount" => array(
                        "image" => "mail",
                        "plugin" => "mailgroup",
                        "alt" => _("Mail"),
                        "title" => _("Edit mail properties")
                    ),
                    "sambaGroupMapping" => array(
                        "image" => "window",
                        "plugin" => "group_",
                        "alt" => _("Samba"),
                        "title" => _("Edit samba properties")
                    ),
                    "goFonPickupGroup" => array(
                        "image" => "phone",
                        "plugin" => "group__",
                        "alt" => _("Phone"),
                        "title" => _("Edit phone properties")
                    ),
                    "gotoMenuGroup" => array(
                        "image" => "menu",
                        "plugin" => "appgroup",
                        "alt" => _("Menu"),
                        "title" => _("Edit start menu properties")
                    ),
                    "zarafa-group" => array(
                        "image" => "portrait",
                        "plugin" => "zarafagroup",
                        "alt" => _("Zarafa"),
                        "title" => _("Edit Zarafa properties")
                    ),
                    "gotoEnvironment" => array(
                        "image" => "smart_display",
                        "plugin" => "environment",
                        "alt" => _("Environment"),
                        "title" => _("Edit environment properties")
                    )
                );
                // Walk thru map
                foreach ($map as $oc => $properties) {
                    if (in_array_ics($oc, $classes)) {
                        $result.= image("<i class='material-icons'>".$properties['image']."</i>", 'listing_edit_'.$properties['plugin'].'_'.$row, $properties['title']);
                    } else {
                        $result.= image("");
                    }
                }
                break;
        }
        
>>>>>>> gosa-core_v2.8
        return $result;
    }
} 
// vim:tabstop=2:expandtab:shiftwidth=2:filetype=php:syntax:ruler:
<<<<<<< HEAD
?>
=======
>>>>>>> gosa-core_v2.8
