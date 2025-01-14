<?php
/**
 * Smarty plugin
<<<<<<< HEAD
 *
 * This plugin is only for Smarty2 BC
 * @package Smarty
 * @subpackage PluginsFunction
 */

/**
 * Smarty {math} function plugin
 *
 * Type:     function<br>
 * Name:     math<br>
=======
 * This plugin is only for Smarty2 BC
 *
 * @package    Smarty
 * @subpackage PluginsFunction
 */
/**
 * Smarty {math} function plugin
 * Type:     function
 * Name:     math
>>>>>>> gosa-core_v2.8
 * Purpose:  handle math computations in template
 *
 * @link http://www.smarty.net/manual/en/language.function.math.php {math}
 *          (Smarty online manual)
 * @author   Monte Ohrt <monte at ohrt dot com>
<<<<<<< HEAD
 * @param array                    $params   parameters
 * @param Smarty_Internal_Template $template template object
=======
 *
 * @param array                    $params   parameters
 * @param Smarty_Internal_Template $template template object
 *
>>>>>>> gosa-core_v2.8
 * @return string|null
 */
function smarty_function_math($params, $template)
{
<<<<<<< HEAD
    static $_allowed_funcs = array(
        'int' => true, 'abs' => true, 'ceil' => true, 'cos' => true, 'exp' => true, 'floor' => true,
        'log' => true, 'log10' => true, 'max' => true, 'min' => true, 'pi' => true, 'pow' => true,
        'rand' => true, 'round' => true, 'sin' => true, 'sqrt' => true, 'srand' => true ,'tan' => true
=======
    static $_allowed_funcs =
        array(
            'int'   => true,
            'abs'   => true,
            'ceil'  => true,
            'cos'   => true,
            'exp'   => true,
            'floor' => true,
            'log'   => true,
            'log10' => true,
            'max'   => true,
            'min'   => true,
            'pi'    => true,
            'pow'   => true,
            'rand'  => true,
            'round' => true,
            'sin'   => true,
            'sqrt'  => true,
            'srand' => true,
            'tan'   => true
>>>>>>> gosa-core_v2.8
    );
    // be sure equation parameter is present
    if (empty($params['equation'])) {
        trigger_error("math: missing equation parameter",E_USER_WARNING);
        return;
    }
<<<<<<< HEAD

    $equation = $params['equation'];

    // make sure parenthesis are balanced
    if (substr_count($equation,"(") != substr_count($equation,")")) {
        trigger_error("math: unbalanced parenthesis",E_USER_WARNING);
        return;
    }

    // match all vars in equation, make sure all are passed
    preg_match_all("!(?:0x[a-fA-F0-9]+)|([a-zA-Z][a-zA-Z0-9_]*)!",$equation, $match);

    foreach($match[1] as $curr_var) {
        if ($curr_var && !isset($params[$curr_var]) && !isset($_allowed_funcs[$curr_var])) {
            trigger_error("math: function call $curr_var not allowed",E_USER_WARNING);
            return;
        }
    }

    foreach($params as $key => $val) {
        if ($key != "equation" && $key != "format" && $key != "assign") {
            // make sure value is not empty
            if (strlen($val)==0) {
                trigger_error("math: parameter $key is empty",E_USER_WARNING);
                return;
            }
            if (!is_numeric($val)) {
                trigger_error("math: parameter $key: is not numeric",E_USER_WARNING);
                return;
            }
=======
    $equation = $params[ 'equation' ];
    // make sure parenthesis are balanced
    if (substr_count($equation, '(') !== substr_count($equation, ')')) {
        trigger_error("math: unbalanced parenthesis", E_USER_WARNING);
        return;
    }
    // disallow backticks
    if (strpos($equation, '`') !== false) {
        trigger_error("math: backtick character not allowed in equation", E_USER_WARNING);
        return;
    }
    // also disallow dollar signs
    if (strpos($equation, '$') !== false) {
        trigger_error("math: dollar signs not allowed in equation", E_USER_WARNING);
        return;
    }
    foreach ($params as $key => $val) {
        if ($key !== 'equation' && $key !== 'format' && $key !== 'assign') {
            // make sure value is not empty
            if (strlen($val) === 0) {
                trigger_error("math: parameter '{$key}' is empty", E_USER_WARNING);
                return;
            }
            if (!is_numeric($val)) {
                trigger_error("math: parameter '{$key}' is not numeric", E_USER_WARNING);
                return;
            }
        }
    }
    // match all vars in equation, make sure all are passed
    preg_match_all('!(?:0x[a-fA-F0-9]+)|([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)!', $equation, $match);
    foreach ($match[ 1 ] as $curr_var) {
        if ($curr_var && !isset($params[ $curr_var ]) && !isset($_allowed_funcs[ $curr_var ])) {
            trigger_error(
                "math: function call '{$curr_var}' not allowed, or missing parameter '{$curr_var}'",
                E_USER_WARNING
            );
            return;
        }
    }
    foreach ($params as $key => $val) {
        if ($key !== 'equation' && $key !== 'format' && $key !== 'assign') {
>>>>>>> gosa-core_v2.8
            $equation = preg_replace("/\b$key\b/", " \$params['$key'] ", $equation);
        }
    }
    $smarty_math_result = null;
    eval("\$smarty_math_result = ".$equation.";");
<<<<<<< HEAD

=======
>>>>>>> gosa-core_v2.8
    if (empty($params['format'])) {
        if (empty($params['assign'])) {
            return $smarty_math_result;
        } else {
            $template->assign($params['assign'],$smarty_math_result);
        }
    } else {
        if (empty($params['assign'])){
            printf($params['format'],$smarty_math_result);
        } else {
            $template->assign($params['assign'],sprintf($params['format'],$smarty_math_result));
        }
    }
}
<<<<<<< HEAD

?>
=======
>>>>>>> gosa-core_v2.8
