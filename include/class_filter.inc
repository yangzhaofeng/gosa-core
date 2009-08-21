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

class filter {

  var $xmlData;
  var $elements= array();
  var $elementValues= array();
  var $alphabetElements= array();
  var $autocompleter= array();
  var $category= "";
  var $objectStorage= array();
  var $objectBase= "";
  var $base= "";
  var $scope= "";
  var $query;
  var $initial= false;
  var $scopeMode= "auto";
  var $alphabet= null;


  function filter($filename)
  {
    global $config;

    // Load eventually passed filename
    if (!$this->load($filename)) {
      die("Cannot parse $filename!");
    }
  }


  function load($filename)
  {
    $contents = file_get_contents($filename);
    $this->xmlData= xml::xml2array($contents, 1);

    if (!isset($this->xmlData['filter'])) {
      return false;
    }

    $this->xmlData= $this->xmlData["filter"];

    // Load filter
    if (isset($this->xmlData['search'])) {
      if (!isset($this->xmlData['search']['query'][0])){
        $this->xmlData['search']['query']= array($this->xmlData['search']['query']);
      }

      // Move information
      $entry= $this->xmlData['search'];
      $this->scopeMode= $entry['scope'];
      if ($entry['scope'] == "auto") {
        $this->scope= "one";
      } else {
        $this->scope= $entry['scope'];
      }
      $this->query= $entry['query'];
    } else {
      return false;
    }

    // Transfer initial value
    if (isset($this->xmlData['definition']['initial']) && $this->xmlData['definition']['initial'] == "true"){
      $this->initial= true;
    }

    // Transfer category
    if (isset($this->xmlData['definition']['category'])){
      $this->category= $this->xmlData['definition']['category'];
    }

    // Generate formular data
    if (isset($this->xmlData['element'])) {
      if (!isset($this->xmlData['element'][0])){
        $this->xmlData['element']= array($this->xmlData['element']);
      }
      foreach ($this->xmlData['element'] as $element) {

        // Ignore elements without type
        if (!isset($element['type']) || !isset($element['tag'])) {
          next;
        }

        $tag= $element['tag'];

        // Fix arrays
        if (isset($element['value']) && !isset($element['value'][0])) {
          $element['value']= array($element['value']);
        }

        // Store element for quick access
        $this->elements[$tag] = $element;

        // Preset elementValues with default values if exist
        if (isset($element['default']) && !is_array($element['default'])) {
          $this->elementValues[$tag] = $element['default'];
        } else {
          $this->elementValues[$tag] = "";
        }

        // Does this element react on alphabet links?
        if (isset($element['alphabet']) && $element['alphabet'] == "true") {
          $this->alphabetElements[]= $tag;
        }
      }

      // Sort elements for element length to allow proper replacing later on
      function strlenSort($a, $b) {
        if (strlen($a['tag']) == strlen($b['tag'])) {
          return 0;
        }
       return (strlen($a['tag']) < strlen($b['tag']) ? -1 : 1);
      } 
      uasort($this->elements, 'strlenSort');
      $this->elements= array_reverse($this->elements);

    }

    return true;  
  }


  function getTextfield($element)
  {
    $tag= $element['tag'];
    $size= 30;
    if (isset($element['size'])){
      $size= $element['size'];
    }
    $maxlength= 30;
    if (isset($element['maxlength'])){
      $maxlength= $element['maxlength'];
    }
    $result= "<input class='filter_textfield' id='$tag' name='$tag' type='text' size='$size' maxlength='maxlength' value='".$this->elementValues[$tag]."'>";
    if (isset($element['autocomplete'])) {
      $frequency= "0.5";
      $characters= "1";
      if (isset($element['autocomplete']['frequency'])) {
        $frequency= $element['autocomplete']['frequency'];
      }
      if (isset($element['autocomplete']['characters'])) {
        $characters= $element['autocomplete']['characters'];
      }
      $result.= "<div id='autocomplete$tag' class='autocomplete'></div>".
                "<script type='text/javascript'>".
                "new Ajax.Autocompleter('$tag', 'autocomplete$tag', 'autocomplete.php', { minChars: $characters, frequency: $frequency });".
                "</script>";

       $this->autocompleters[$tag]= $element['autocomplete'];
    }
    return $result;
  }


  function getCheckbox($element)
  {
    $tag= $element['tag'];
    $checked= "";
    if ($this->elementValues[$tag] == "true") {
      $checked= " checked";
    }

    $result= "<input class='filter_checkbox' name='$tag' type='checkbox' onClick='document.mainform.submit();' value='true'$checked>";
    return $result;
  }


  function getCombobox($element)
  {
    $result= "<select name='".$element['tag']."' size='1' onClick='document.mainform.submit();'>";

    // Fill with presets
    foreach ($element['value'] as $value) {
      $selected= "";
      if ($this->elementValues[$element['tag']] == $value['key']) {
        $selected= " selected";
      }

      // Handle translations
      $result.= "<option value='".$value['key']."'$selected>"._($value['label'])."</option>";
    }

    // Use autocompleter for additional data
    if (isset($element['autocomplete'])) {
      $list= $this->getCompletitionList($element['autocomplete'], $element['tag']);
      foreach ($list as $value) {
        $selected= "";
        if ($this->elementValues[$element['tag']] == $value) {
          $selected= " selected";
        }
        $result.= "<option value='$value'$selected>$value</option>";
      }
    }

    $result.= "</select>";

    return $result;
  }


  function getCurrentBase()
  {
    if (isset($this->search->base) && (string)$this->search->scope != "auto") {
      return false;
    }

    return $this->base;
  }


  function getCurrentScope()
  {
    if (isset($this->search->scope) && (string)$this->search->scope != "auto") {
      return (string)$this->search->scope;
    }

    return $this->scope;
  }


  function setObjectStorage($storage) {
    $this->objectStorage= $storage;    
  }


  function setObjectBase($base) {
    $this->objectBase= $base;    
  }


  function setBase($base) {
    $this->base= $base;
  }


  function setCurrentScope($scope) {
    $this->scope= $scope;
  }


  function renderAlphabet($columns= 10)
  {
    // Return pre-rendered alphabet if available
    if ($this->alphabet) {
      return ($this->alphabet);
    }

    $characters= _("*ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789");
    $alphabet= "";
    $c= 0;

    /* Fill cells with charaters */
    for ($i= 0, $l= mb_strlen($characters, 'UTF8'); $i<$l; $i++){
      if ($c == 0){
        $alphabet.= "<tr>";
      }

      $ch = mb_substr($characters, $i, 1, "UTF8");
      $alphabet.= "<td><a class=\"alphaselect\" href=\"main.php?plug=".
        validate($_GET['plug'])."&amp;filter=".$ch."\">&nbsp;".$ch."&nbsp;</a></td>";

      if ($c++ == $columns){
        $alphabet.= "</tr>";
        $c= 0;
      }
    }

    /* Fill remaining cells */
    while ($c++ <= $columns){
      $alphabet.= "<td>&nbsp;</td>";
    }

    /* Save alphabet */
    $this->alphabet= "<table width='100%'>$alphabet</table>";

    return ($this->alphabet);
  }


  function renderApply()
  {
    return ("<input type='submit' name='apply' value='"._("Apply filter")."'>");
  }


  function renderScope()
  {
    $checked= $this->scope == "sub"?" checked":"";
    return "<input type='checkbox' name='SCOPE' value='1' onClick='document.mainform.submit();'$checked>&nbsp;"._("Search in subtrees");
  }


  function render()
  {
    $smarty= get_smarty();
    $smarty->assign("ALPHABET", $this->renderAlphabet());
    $smarty->assign("APPLY", $this->renderApply());
    $smarty->assign("SCOPE", $this->renderScope());

    // Load template and replace elementsHtml[]
    foreach ($this->elements as $tag => $element) {
      $htmlCode= "";
      switch ($element['type']) {
        case "textfield":
          $htmlCode = $this->getTextfield($element);
          break;

        case "checkbox":
          $htmlCode = $this->getCheckbox($element);
          break;

        case "combobox":
          $htmlCode = $this->getCombobox($element);
          break;

        default:
          die ("Unknown element type specified!");
      }
      $smarty->assign("$tag", $htmlCode);
    }

    // Load template
    return ("<input type='hidden' name='FILTER_LOADED' value='1'>".$smarty->fetch(get_template_path($this->xmlData['definition']['template'], true)));
  }


  function query()
  {
    global $class_mapping;
    $result= array();

    // Go thru all queries and merge results
    foreach ($this->query as $query) {
      if (!isset($query['backend']) || !isset($query['filter']) || !isset($query['attribute'])) {
        die("No backend specified in search config.");
      }

      // Is backend available?
      $backend= "filter".$query['backend'];
      if (!isset($class_mapping["$backend"])) {
        die("Invalid backend specified in search config.");
      }

      // Load filter and attributes
      $filter= $query['filter'];
      $attributes= $query['attribute'];

      // Generate final filter
      foreach ($this->elements as $tag => $element) {
        if (!isset($element['set']) || !isset($element['unset'])) {
          continue;
        }
        $e_set= is_array($element['set'])?"":$element['set'];
        $e_unset= is_array($element['unset'])?"":$element['unset'];

        if ($this->elementValues[$tag] == "") {
          $e_unset= preg_replace('/\$/', normalizeLdap($this->elementValues[$tag]), $e_unset);
          $filter= preg_replace("/\\$$tag/", $e_unset, $filter);
        } else {
          $e_set= preg_replace('/\$/', normalizeLdap($this->elementValues[$tag]), $e_set);
          $filter= preg_replace("/\\$$tag/", $e_set, $filter);
        }
      }

      $result= array_merge($result, call_user_func(array($backend, 'query'), $this->base, $this->scope, $filter, $attributes,
                               $this->category, $this->objectStorage, $this->objectBase));
    }
    

    return ($result);
  }


  function isValid()
  {
    foreach ($this->elements as $tag => $element) {
      if (isset($element->regex)){
        if (!preg_match('/'.(string)$element->regex.'/', $this->elementValues[$tag])){
          return false;
        }
      }
    }
    return true;
  }


  function update()
  {

    /* React on alphabet links if needed */
    if (isset($_GET['filter'])){
      $s= mb_substr(validate($_GET['filter']), 0, 1, "UTF8")."*";
      if ($s == "**"){
        $s= "*";
      }
      foreach ($this->alphabetElements as $tag) {
        $this->elementValues[$tag]= $s;
      }
    }

    if (isset($_POST['FILTER_LOADED'])) {
      // Load post values and adapt filter, base and scope accordingly - but
      // only if we didn't get a _GET
      foreach ($this->elements as $tag => $element) {
        if (isset($_POST[$tag])){
          $this->elementValues[$tag]= validate($_POST[$tag]);
        } else {
          $this->elementValues[$tag]= "";
        }
      }

      // Save scope if needed
      if ($this->scopeMode == "auto") {
        $this->scope= isset($_POST['SCOPE'])?"sub":"one";
      }
    }

  }


  function getCompletitionList($config, $tag, $value="*")
  {
    global $class_mapping;
    $res= array();

    // Is backend available?
    $backend= "filter".$config['backend'];
    if (!isset($class_mapping["$backend"])) {
      die("Invalid backend specified in search config.");
    }

    // Load filter and attributes
    $filter= $config['filter'];
    $attributes= $config['attribute'];
    if (!is_array($attributes)) {
      $attributes= array($attributes);
    }

    // Make filter
    $filter= preg_replace("/\\$$tag/", normalizeLDAP($value), $filter);
    if (isset($config['base']) && isset($config['scope'])
        && isset($config['category']) && isset($config['objectbase']) ) {
      $result= call_user_func(array($backend, 'query'), $config['base'], $config['scope'], $filter, $attributes,
                           $config["category"], $config["objectbase"]);
    } else {
      $result= call_user_func(array($backend, 'query'), $this->base, $this->scope, $filter, $attributes,
                           $this->category, $this->objectStorage, $this->objectBase);
    }

    foreach ($result as $entry) {
      foreach ($attributes as $attribute) {
        if (is_array($entry[$attribute])) {
          for ($i= 0; $i<$entry[$attribute]['count']; $i++) {
            $res[]= $entry[$attribute][$i];
          }
        } else {
          $res[]= $entry[$attribute];
        }
      }
    }

    return $res;
  }


  function processAutocomplete()
  {
    global $class_mapping;
    $result= array();

    foreach ($this->autocompleters as $tag => $config) {
      if(isset($_POST[$tag])){
        $result= $this->getCompletitionList($config, $tag, $_POST[$tag]);

        echo '<ul>';
        foreach ($result as $entry) {
          echo '<li>'.$entry.'</li>';
        }

        echo '</ul>';
      }

    }
  }


}

?>