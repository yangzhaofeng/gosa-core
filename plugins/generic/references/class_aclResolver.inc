<?php

class aclResolver 
{
    private $classMapping = array();
    private $aclTypes = array();
    private $affectingACLs = array();

    private $renderedList = "";

    // The users 'dn' and 'uid' used to verify the collected acls
    private $validateDn;
    private $validateUid;
    private $acl_category;
    private $parent;

    // Used for the autocompleter
    private $userMap;

<<<<<<< HEAD
    function __construct($config, $dn, $parent)
=======
    public function __construct($config, $dn, $parent)
>>>>>>> gosa-core_v2.8
    {
        $this->config = &$config;
        $this->dn = $dn;
        $this->parent = $parent;

        // Replace this with a user defined one later.
        $ui = get_userinfo();
        $this->validateUid = $ui->uid;
        $this->validateDn = $ui->dn;

        // Build class mapping - only once, will not change during session.
        if(!session::is_set('aclConverter::classMapping')){
            $tmp= session::global_get('plist');
            $plist= $tmp->info;
            $map = array();
            foreach($plist as $class => $plInfo){
                if(isset($plInfo['plCategory']) && is_array($plInfo['plCategory'])){
                    foreach($plInfo['plCategory'] as $category => $desc){
                        if(!is_numeric($category)){
                            $map[$category] = $desc['description'];
                        }
                    }
                }
            }
            foreach($plist as $class => $plInfo){
                if(isset($plInfo['plCategory']) && is_array($plInfo['plCategory'])){
                    foreach($plInfo['plCategory'] as $category => $desc){
<<<<<<< HEAD
                        if(!isset($map[$category])) continue;
=======
                        if (!isset($map[$category])) {
                            continue;
                        }
>>>>>>> gosa-core_v2.8
                        if(!is_numeric($category)){
                            $map[$category."/".$class] = $map[$category]." - ".$plInfo['plDescription'];
                        }else{
                            $map[$desc."/".$class] = $map[$desc]." - ".$plInfo['plDescription'];
                        }
                    }
<<<<<<< HEAD

=======
>>>>>>> gosa-core_v2.8
                }
            }
            session::set('aclConverter::classMapping', $map);
        }
        $this->classMapping = session::get('aclConverter::classMapping');

        // Define ACL type translations
        $this->aclTypes= array("reset" => _("Reset ACLs"),
                "one" => _("One level"),
                "base" => _("Current object"),
                "sub" => _("Complete subtree"),
                "psub" => _("Complete subtree (permanent)"),
                "role" => _("Use ACL defined in role"));
    
        // Enforce to reload acl result 
        $this->renderedList = "";
    }

    
<<<<<<< HEAD
    function reload()
=======
    public function reload()
>>>>>>> gosa-core_v2.8
    {
        // Go through all ACLs and get those matching the objects dn.
        $ui = get_userinfo();
        $ui->reset_acl_cache();
        $ui->loadACL();

        // Get ACL category for the current object.
        if(isset($this->parent->acl_category) && !empty($this->parent->acl_category)){
            $this->acl_category = preg_replace("/\/$/","",$this->parent->acl_category);
        }

        foreach($ui->allACLs as $dn => $acls){
            if(preg_match("/".preg_quote($dn,'/')."$/i", $this->dn)){

                // Foreach dn there is a collection of ACLs indexed by their priority
                foreach($acls as $prio => $acl){
                    if($acl['type'] == "reset"){
                        $this->affectingACLs[$dn][$prio] = $acl;
                        continue;
                    }else{

                        // Only get those entries with a relevant acl-category
                        foreach($acl['acl'] as $category => $attributes){
                            if(preg_match("/^all($|\/)/", $category) || 
                                    preg_match("/^".$this->acl_category."($|\/)/", $category)){
                                $this->affectingACLs[$dn][$prio] = $acl;
                                continue;
                            }
                        }
                    }
                }
            }
        }
    }
    


    /*! \brief   Create a human readable HTML result 
     */    
<<<<<<< HEAD
    function getReadableACL() 
=======
    public function getReadableACL()
>>>>>>> gosa-core_v2.8
    {
        if(isset($_POST['aclTarget'])){
            $d = get_post('aclTarget');
            if(isset($this->userMap[$d])){
                $this->validateDn = $this->userMap[$d]['dn'];
                $this->validateUid = $this->userMap[$d]['uid'][0];
                $this->renderedList = "";
            }else{
<<<<<<< HEAD

=======
>>>>>>> gosa-core_v2.8
                foreach($this->userMap as $string => $data){
                    if($data['uid'][0] == $d){
                        $this->validateDn = $data['dn'];
                        $this->validateUid = $data['uid'][0];
                        $this->renderedList = "";
<<<<<<< HEAD

=======
>>>>>>> gosa-core_v2.8
                    }
                }
            }
        }

 
        if(empty($this->renderedList)){
<<<<<<< HEAD

            $this->reload();

            // Autocompleter template 
            $autocompleter ="
                <input class='filter_textfield' placeholder='"._("Enter another user name")."...' 
                id='aclTarget' name='aclTarget' type='text' value='' 
                onChange=\"\$('aclTargetSubmit').focus();\">

=======
            $this->reload();

            $ldap = $this->config->get_ldap_link();
            $ldap->cd($this->config->current['BASE']);
            $ui = get_userinfo();
            $theme = getThemeName();

            switch ($theme) {
                case 'classic':
                    // Autocompleter template
                    $autocompleter = "  <input class='filter_textfield' placeholder='"._("Enter another user name")."...'
                                            id='aclTarget' name='aclTarget' type='text' value=''
                                            onChange=\"\$('aclTargetSubmit').focus();\">
>>>>>>> gosa-core_v2.8
                <div id='autocomplete' class='autocomplete'></div>
                <script type='text/javascript'>
                new Ajax.Autocompleter(
                        'aclTarget', 
                        'autocomplete', 
                        'autocomplete.php', 
                        { minChars: 3, frequency: 0.5 });
            </script>
            ".image("images/lists/submit.png","aclTargetSubmit");

            // Base template - each entry start with this 
            $tpl = 
                "\n <tr class='acl-viewer-head %s'>".
                "\n  <td style='width:20px'>%s</td>".
                "\n  <td colspan=2><b>%s</b><div class='right'>%s</div></td>".
                "\n </tr>".
                "\n %s";

            // If the acl consists of a user-object-filter then this template is used.        
            $filter_tpl = 
                "\n <tr class='%s'>".
                "\n  <td></td>".
                "\n  <td><b>"._("Filter")."</b></td>".
                "\n  <td><ul class='acl-viewer-items'><li>%s</li></ul></td>".
                "\n </tr>";

            // Used to display ACL owner of type "group"
            $gmem_tpl = 
                "\n <tr class='%s'>".
                "\n  <td></td>".
                "\n  <td><b>"._("Groups")."</b></td>".
                "\n  <td><ul class='acl-viewer-items'>%s</ul></td>".
                "\n </tr>";

            // Used to display ACL owner of type "user"
            $umem_tpl = 
                "\n <tr class='%s'>".
                "\n  <td></td>".
                "\n  <td><b>"._("Users")."</b></td>".
                "\n  <td><ul class='acl-viewer-items'>%s</ul></td>".
                "\n </tr>";

            // Used to display the acl contents, except 'reset' and 'role'
            $acl_tpl = 
                "\n <tr class='%s'>".
                "\n  <td></td>".
                "\n  <td><b>"._("ACLs")."</b></td>".
                "\n  <td><ul class='acl-viewer-items'>%s</ul></td>".
                "\n </tr>";

<<<<<<< HEAD

=======
>>>>>>> gosa-core_v2.8
            $user = "<h3>".sprintf(_("List of effective ACLs for '%s'"), $this->validateUid)."</h3>";
            $str  = "<table summary='"._("Object permissions")."'>";
            $str .= " <tr><td>".$user."</td><td>".$autocompleter."</td></tr>";
            $str .= "</table>";
            $str .= "<div class='acl-viewer-container'>";
            $str .= "<table summary='"._("Object permissions")."' cellpadding='0' cellspacing='0' class='acl-viewer'>";
<<<<<<< HEAD
            $ldap = $this->config->get_ldap_link();
            $ldap->cd($this->config->current['BASE']);
            $ui = get_userinfo();
=======

>>>>>>> gosa-core_v2.8
            foreach($this->affectingACLs as $dn => $acls){
                foreach($acls as $acl){

                    // Prepare entry icon (department or element?)
                    $image = (isset($this->config->idepartments[$dn]))? "images/select_department.png":"images/lists/element.png";

                    // The acl type (sub,psub,reset...)
                    $aclType = $this->aclTypes[$acl['type']];

                    // Does the filter match for current object? 
                    $filter ="";
<<<<<<< HEAD
                    $match = TRUE;
=======
                            $match = true;
>>>>>>> gosa-core_v2.8
                    if(!empty($acl['filter'])){
                        $match = $ldap->object_match_filter($this->dn,$acl['filter']);
                        $filter= $acl['filter'];
                        if(!$match){
                            $filter= "<span>".$filter."</span>";
                        }
                    }

                    // Check membership 
                    $gmem = $umem = "";
                    $users = $groups = array();
<<<<<<< HEAD
                    $found = FALSE;
=======
                            $found = false;
>>>>>>> gosa-core_v2.8
                    foreach($acl['members'] as $type => $name){

                        // Check if we're part of the members 
                        if(preg_match("/^U:/", $type)){
                            if(preg_match("/^U:".preg_quote($this->validateDn,'/')."/", $type)){
                                $users[] = $name;
<<<<<<< HEAD
                                $found = TRUE;
=======
                                        $found = true;
>>>>>>> gosa-core_v2.8
                                continue;
                            }
                            $users[] = "<span>".$name."</span>";
                        }

                        // Check if we're part of the group members 
                        if(preg_match("/^G/", $type)){
                            if($type == "G:*"){
<<<<<<< HEAD
                                $found = TRUE;
=======
                                        $found = true;
>>>>>>> gosa-core_v2.8
                                $groups[] = $name;
                                continue;
                            }
                            if(preg_match("/^G:/", $type)){
                                $gdn = preg_replace("/^G:/","",$type);
                                $ldap->cat($gdn,array('memberUid'));
                                if($ldap->count()){
                                    $attrs = $ldap->fetch();
                                    if(isset($attrs['memberUid']) && in_array_strict($this->validateUid, $attrs['memberUid'])){
<<<<<<< HEAD
                                        $found = TRUE;
=======
                                                $found = true;
>>>>>>> gosa-core_v2.8
                                        $groups[] = $name;
                                        continue;
                                    }
                                }
                            }

                            // Mark groups that doesn't match 
                            $groups[] = "<span>".$name."</span>";
                        }
                    }

                    // Build up ACL definition list 
                    $defs ="";
                    if($acl['type']!='reset'){
                        foreach($acl['acl'] as $type => $acl){
                            if(isset($this->classMapping[$type])){
                                $defs .= "<li>".$this->classMapping[$type].": ".$this->aclToString($acl)."</li>";
                            }else{
                                $defs .= "<li>".$type.": ".$this->aclToString($acl)."</li>";
                            }
                        }
                    }
                   
                    // Display the acl block in a special color if its not matching 
                    $class="";
                    if(!$found || !$match){
                        $class = "acl-viewer-blocked";
                    }                    
<<<<<<< HEAD
                    if(!empty($filter)) $filter =sprintf($filter_tpl,$class,$filter);
                    if(!empty($defs)) $defs = sprintf($acl_tpl,$class,$defs);
                    if(count($users))  $umem = sprintf($umem_tpl,$class,"<li>".implode($users,'</li><li>')."</li>");
                    if(count($groups)) $gmem = sprintf($gmem_tpl,$class,"<li>".implode($groups,'</li><li>')."</li>");
                    $str.= sprintf($tpl,$class, image($image), $dn, $aclType, $filter.$gmem.$umem.$defs);
                }
            }
            $str .= "</table>"; 
            $str .= "</div>"; 
=======
                            if (!empty($filter)) {
                                $filter =sprintf($filter_tpl, $class, $filter);
                            }
                            if (!empty($defs)) {
                                $defs = sprintf($acl_tpl, $class, $defs);
                            }
                            if (count($users)) {
                                $umem = sprintf($umem_tpl, $class, "<li>".implode('</li><li>', $users)."</li>");
                            }
                            if (count($groups)) {
                                $gmem = sprintf($gmem_tpl, $class, "<li>".implode('</li><li>', $groups)."</li>");
                            }
                            $str.= sprintf($tpl, $class, image($image), $dn, $aclType, $filter.$gmem.$umem.$defs);
                        }
                    }
                    $str .= "</table><div>";
                    break;

                default:
                    $autocompleter = "  <div class='acl-name'>
                                            <div class='search-field input-field'>
                                                <input id='aclTarget' name='aclTarget' type='text' value='' onChange=\"\$('aclTargetSubmit').focus();\">
                                                <label for='aclTarget'>"._("Enter another user name")."...</label>
                                            </div>
                                            <div class='submit'>
                                                ".image("<i class='material-icons input-icons'>keyboard_return</i>", "aclTargetSubmit")."
                                            </div>
                                        </div>
                                        <div id='autocomplete' class='autocomplete'></div>
                                        <script type='text/javascript'>
                                            new Ajax.Autocompleter(
                                                    'aclTarget',
                                                    'autocomplete',
                                                    'autocomplete.php',
                                                    { minChars: 3, frequency: 0.5 });
                                        </script>";

                    $user = "<h2>".sprintf(_("List of effective ACLs for '%s'"), $this->validateUid)."</h2>";

                    $str = "<div class='acl-reference'>";

                    $str.= "<div class='acl-reference-header'>
                                ".$user."
                                ".$autocompleter."
                            </div>";

                    $str.= "<div class='row'>
                                <div class='col s12'>";


                    foreach ($this->affectingACLs as $dn => $acls) {

                    // Prepare entry icon (department or element?)
                    $image = (isset($this->config->idepartments[$dn])) ? "<i class='material-icons'>domain</i>" : "<i class='material-icons'>web_asset</i>";

                    $str.= "<ul class='collapsible acl-viewer'>
                                <li>
                                    <div class='collapsible-header top-level'>
                                        ".$image."
                                        <h3>".$dn."</h3>
                                    </div>
                                    <div class='collapsible-body'>
                                        <ul class='collapsible'>";

                        foreach ($acls as $acl) {
                            // The acl type (sub,psub,reset...)
                            $aclType = $this->aclTypes[$acl['type']];

                            // Does the filter match for current object?
                            $filter ="";
                            $match = true;
                            if (!empty($acl['filter'])) {
                                $match = $ldap->object_match_filter($this->dn, $acl['filter']);
                                $filter= $acl['filter'];
                                if (!$match) {
                                    $filter= "<span>".$filter."</span>";
                                }
                            }

                            // Check membership
                            $gmem = $umem = "";
                            $users = $groups = array();
                            $found = false;
                            foreach ($acl['members'] as $type => $name) {

                                // Check if we're part of the members
                                if (preg_match("/^U:/", $type)) {
                                    if (preg_match("/^U:".preg_quote($this->validateDn, '/')."/", $type)) {
                                        $users[] = $name;
                                        $found = true;
                                        continue;
                                    }
                                    $users[] = "<span>".$name."</span>";
                                }

                                // Check if we're part of the group members
                                if (preg_match("/^G/", $type)) {
                                    if ($type == "G:*") {
                                        $found = true;
                                        $groups[] = $name;
                                        continue;
                                    }
                                    if (preg_match("/^G:/", $type)) {
                                        $gdn = preg_replace("/^G:/", "", $type);
                                        $ldap->cat($gdn, array('memberUid'));
                                        if ($ldap->count()) {
                                            $attrs = $ldap->fetch();
                                            if (isset($attrs['memberUid']) && in_array_strict($this->validateUid, $attrs['memberUid'])) {
                                                $found = true;
                                                $groups[] = $name;
                                                continue;
                                            }
                                        }
                                    }

                                    // Mark groups that doesn't match
                                    $groups[] = "<span>".$name."</span>";
                                }
                            }

                            // Build up ACL definition list
                            $defs ="";
                            if ($acl['type']!='reset') {
                                if (!empty($filter)) {
                                    $innerColSize = "s12 xl6";
                                    $colsPerRow = 2;
                                } else {
                                    if (screen.width < 1200) {
                                        $innerColSize = "s6 xl3";
                                        $colsPerRow = 2;
                                    } else {
                                        $innerColSize = "s6 xl3";
                                        $colsPerRow = 4;
                                    }
                                }

                                $col = 0;
                                $maxCount = count($acl['acl']);
                                foreach ($acl['acl'] as $type => $acl) {
                                    // Add a seperating row
                                    if (($col % $colsPerRow) == 0) {
                                        $defs .= "<div class='row'>";
                                    }

                                    if (isset($this->classMapping[$type])) {
                                        $defs .= "  <div class='col ".$innerColSize."'>
                                                <div class='card'>
                                                    <div class='card-content'>
                                                        <p class='collection-item headline'>".$this->classMapping[$type].":</p>
                                                        <hr class='divider'>".$this->aclToString($acl)."
                                                    </div>
                                                </div>
                                            </div>";
                                    } else {
                                        $defs .= "  <div class='col ".$innerColSize."'>
                                                <div class='card'>
                                                    <div class='card-content'>
                                                        <p class='collection-item headline'>".$type.":</p>
                                                        <hr class='divider'>".$this->aclToString($acl)."
                                                    </div>
                                                </div>
                                            </div>";
                                    }
                                    ++$col;

                                    if (($col % $colsPerRow) == 0 && $col != 0) {
                                        $defs .= "</div>";
                                    }
                                }
                            }

                            $str.= "<li>
                                <div class='collapsible-header'>";
                            if (!empty($users)) {
                                $str.= "<h4>".implode(' - ', $users)."</h4>";
                            }

                            if (!empty($groups) && empty($users)) {
                                $str.= "<h4>".implode(' - ', $groups)."</h4>";
                            } elseif (!empty($groups) && !empty($users)) {
                                $str.= "<p>".implode(' - ', $groups)."</p>";
                            }

                            if (!empty($aclType) && empty($users) && empty($groups)) {
                                $str.= "<p></p>";
                                $str.= "<p>".$aclType."</p>";
                            } elseif (!empty($aclType)) {
                                $str.= "<p>".$aclType."</p>";
                            }
                            $str.= "    </div>
                                <div class='collapsible-body'>";

                            // Display the acl block in a special color if its not matching
                            $class="";
                            if (!$found || !$match) {
                                $class = "acl-viewer-blocked";
                            }

                            if (!empty($filter) && !empty($defs)) {
                                $colSize = "s6";
                            } else {
                                $colSize = "s12";
                            }

                            $str.= "<div class='row'>";

                            if (!empty($defs)) {
                                $str.= "<div class='col ".$colSize."'>
                                    <h5>"._("ACLs")."</h5>
                                    ".$defs."
                                </div>";
                            }

                            if (!empty($filter)) {
                                $str.= "<div class='col ".$colSize."'>
                                    <h5>"._("Filter")."</h5>
                                    ".$filter."
                                </div>";
                            }

                            $str.= "</div>";
                            $str.= "</div></li>";
                        }
                        $str.= "</ul></div></li></ul>";
                    }
                    $str.= "</div></div></div>";
                    break;
            }
>>>>>>> gosa-core_v2.8
            $this->renderedList = $str;
        }
        return($this->renderedList);
    }

<<<<<<< HEAD
    function aclToString($acls)
    {
        $str ="<ul class='acl-category-list'>";
        foreach($acls as $name => $acl){
            if($name == "0") $name = _("All");
            $str .= "<li><i>".$name.":</i> ";
=======
    public function aclToString($acls)
    {
        $theme = getThemeName();

        switch ($theme) {
            case 'classic':
                $str ="<ul class='acl-category-list'>";
                foreach ($acls as $name => $acl) {
                    if ($name == "0") {
                        $name = _("All");
                    }
                    $str .= "<li><b>".$name.":</b> ";
>>>>>>> gosa-core_v2.8
            $str .= "<ul class='acl-list'>";
            if(preg_match("/s/", $acl)){
                $str.="<li><u>"._("Restrict changes to user's own object").'</u></li>'; 
            }
<<<<<<< HEAD
            if(preg_match("/r/", $acl)) $str.="<li>"._("read").'</li>'; 
            if(preg_match("/w/", $acl)) $str.="<li>"._("write").'</li>'; 
            if(preg_match("/c/", $acl)) $str.="<li>"._("create").'</li>'; 
            if(preg_match("/d/", $acl)) $str.="<li>"._("remove").'</li>'; 
            if(preg_match("/m/", $acl)) $str.="<li>"._("move").'</li>'; 
            $str.= "</ul>";
        }
        return($str."</ul>");
    }

    function processAutocomplete()
    {
            $ldap = $this->config->get_ldap_link();
            $ldap->cd($this->config->current['BASE']);
            $ldap->search("(&(objectClass=gosaAccount)(|(sn=*".get_post('aclTarget')."*)".
                    "(uid=*".get_post('aclTarget')."*)(givenName=*".get_post('aclTarget')."*)))",
                    array('uid','dn','sn','givenName'));
=======
                    if (preg_match("/r/", $acl)) {
                        $str.="<li>"._("read").'</li>';
                    }
                    if (preg_match("/w/", $acl)) {
                        $str.="<li>"._("write").'</li>';
                    }
                    if (preg_match("/c/", $acl)) {
                        $str.="<li>"._("create").'</li>';
                    }
                    if (preg_match("/d/", $acl)) {
                        $str.="<li>"._("remove").'</li>';
                    }
                    if (preg_match("/m/", $acl)) {
                        $str.="<li>"._("move").'</li>';
                    }
                    $str.= "</ul>";
                }
                return($str."</ul>");

            default:
                $str = "";
                foreach ($acls as $name => $acl) {
                    if ($name == "0") {
                        $name = _("All");
                    }
                    $str .= "<p>".$name.":</p>";
                    $str .= "<ul class='acl-list'>";
                    if (preg_match("/s/", $acl)) {
                        $str.="<li>"._("Restrict changes to user's own object").'</li>';
                    }
                    if (preg_match("/r/", $acl)) {
                        $str.="<li>"._("read").'</li>';
                    }
                    if (preg_match("/w/", $acl)) {
                        $str.="<li>"._("write").'</li>';
                    }
                    if (preg_match("/c/", $acl)) {
                        $str.="<li>"._("create").'</li>';
                    }
                    if (preg_match("/d/", $acl)) {
                        $str.="<li>"._("remove").'</li>';
                    }
                    if (preg_match("/m/", $acl)) {
                        $str.="<li>"._("move").'</li>';
                    }
                    $str."</ul>";
                }
                return $str;
        }
    }

    public function processAutocomplete()
    {
        $ldap = $this->config->get_ldap_link();
        $ldap->cd($this->config->current['BASE']);
        $ldap->search(
            "(&(objectClass=gosaAccount)(|(sn=*".get_post('aclTarget')."*)".
                    "(uid=*".get_post('aclTarget')."*)(givenName=*".get_post('aclTarget')."*)))",
            array('uid','dn','sn','givenName')
        );
>>>>>>> gosa-core_v2.8
            echo "<ul>";
            while($attrs = $ldap->fetch()){
                $display = $attrs['givenName'][0]." ".$attrs['sn'][0]." [".$attrs['uid'][0]."]";
                echo "<li>{$display}</li>";
                $this->userMap[$display] = $attrs;
            }
            echo "</ul>";
    }
}
<<<<<<< HEAD

?>
=======
>>>>>>> gosa-core_v2.8
