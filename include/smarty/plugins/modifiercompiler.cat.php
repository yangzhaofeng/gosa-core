<?php
/**
 * Smarty plugin
 *
 * @package Smarty
 * @subpackage PluginsModifierCompiler
 */
<<<<<<< HEAD

/**
 * Smarty cat modifier plugin
 *
 * Type:     modifier<br>
 * Name:     cat<br>
 * Date:     Feb 24, 2003<br>
 * Purpose:  catenate a value to a variable<br>
 * Input:    string to catenate<br>
=======
/**
 * Smarty cat modifier plugin
 * Type:     modifier
 * Name:     cat
 * Date:     Feb 24, 2003
 * Purpose:  catenate a value to a variable
 * Input:    string to catenate
>>>>>>> gosa-core_v2.8
 * Example:  {$var|cat:"foo"}
 *
 * @link http://smarty.php.net/manual/en/language.modifier.cat.php cat
 *          (Smarty online manual)
 * @author   Uwe Tews
<<<<<<< HEAD
 * @param array $params parameters
 * @return string with compiled code
 */
function smarty_modifiercompiler_cat($params, $compiler)
{
    return '('.implode(').(', $params).')';
}

?>
=======
 *
 * @param array $params parameters
 *
 * @return string with compiled code
 */
function smarty_modifiercompiler_cat($params)
{
    return '(' . implode(').(', $params) . ')';
}
>>>>>>> gosa-core_v2.8
