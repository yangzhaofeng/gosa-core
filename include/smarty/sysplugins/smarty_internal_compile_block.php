<?php
<<<<<<< HEAD

/**
 * Smarty Internal Plugin Compile Block
 *
 * Compiles the {block}{/block} tags
 *
 * @package Smarty
 * @subpackage Compiler
 * @author Uwe Tews
=======
/**
 * This file is part of Smarty.
 *
 * (c) 2015 Uwe Tews
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
>>>>>>> gosa-core_v2.8
 */

/**
 * Smarty Internal Plugin Compile Block Class
 *
<<<<<<< HEAD
 * @package Smarty
 * @subpackage Compiler
 */
class Smarty_Internal_Compile_Block extends Smarty_Internal_CompileBase {

=======
 * @author Uwe Tews <uwe.tews@googlemail.com>
 */
class Smarty_Internal_Compile_Block extends Smarty_Internal_Compile_Shared_Inheritance
{
>>>>>>> gosa-core_v2.8
    /**
     * Attribute definition: Overwrites base class.
     *
     * @var array
     * @see Smarty_Internal_CompileBase
     */
    public $required_attributes = array('name');

    /**
     * Attribute definition: Overwrites base class.
     *
     * @var array
     * @see Smarty_Internal_CompileBase
     */
<<<<<<< HEAD
    public $shorttag_order = array('name', 'hide');
=======
    public $shorttag_order = array('name');
>>>>>>> gosa-core_v2.8

    /**
     * Attribute definition: Overwrites base class.
     *
     * @var array
     * @see Smarty_Internal_CompileBase
     */
<<<<<<< HEAD
    public $optional_attributes = array('hide');

    /**
     * Compiles code for the {block} tag
     *
     * @param array  $args     array with attributes from parser
     * @param object $compiler compiler object
     * @return boolean true
     */
    public function compile($args, $compiler) {
        // check and get attributes
        $_attr = $this->getAttributes($compiler, $args);
        $save = array($_attr, $compiler->parser->current_buffer, $compiler->nocache, $compiler->smarty->merge_compiled_includes, $compiler->merged_templates, $compiler->smarty->merged_templates_func, $compiler->template->properties, $compiler->template->has_nocache_code);
        $this->openTag($compiler, 'block', $save);
        if ($_attr['nocache'] == true) {
            $compiler->nocache = true;
        }
        // set flag for {block} tag
        $compiler->inheritance = true;
        // must merge includes
        $compiler->smarty->merge_compiled_includes = true;

        $compiler->parser->current_buffer = new _smarty_template_buffer($compiler->parser);
        $compiler->has_code = false;
        return true;
    }

    /**
     * Save or replace child block source by block name during parsing
     *
     * @param string $block_content     block source content
     * @param string $block_tag         opening block tag
     * @param object $template          template object
     * @param string $filepath          filepath of template source
     */
    public static function saveBlockData($block_content, $block_tag, $template, $filepath) {
        $_rdl = preg_quote($template->smarty->right_delimiter);
        $_ldl = preg_quote($template->smarty->left_delimiter);
        if (!$template->smarty->auto_literal) {
            $al = '\s*';
        } else {
            $al = '';
        }
        if (0 == preg_match("!({$_ldl}{$al}block\s+)(name=)?(\w+|'.*'|\".*\")(\s*?)?((append|prepend|nocache)?(\s*)?(hide)?)?(\s*{$_rdl})!", $block_tag, $_match)) {
            $error_text = 'Syntax Error in template "' . $template->source->filepath . '"   "' . $block_tag . '" illegal options';
            throw new SmartyCompilerException($error_text);
        } else {
            $_name = trim($_match[3], '\'"');
            if ($_match[8] != 'hide' || isset($template->block_data[$_name])) {        // replace {$smarty.block.child}
                // get nested block tags
                if (0 != preg_match_all("!({$_ldl}{$al}block\s+)(name=)?(\w+|'.*'|\".*\")([\s\S]*?)(hide)?(\s*{$_rdl})([\s\S]*?)(.*)?({$_ldl}{$al}/block\s*{$_rdl})!", $block_content, $_match2)) {
                    foreach ($_match2[3] as $key => $name) {
                        // get it's replacement
                        $_name2 = trim($name, '\'"');
                        if ($_match2[5][$key] != 'hide' || isset($template->block_data[$_name2])) {
                            if (isset($template->block_data[$_name2])) {
                                $replacement = $template->block_data[$_name2]['source'];
                            } else {
                                $replacement = '';
                            }
                            // replace {$smarty.block.child} tag
                            if (preg_match("!{$_ldl}{$al}\\\$smarty\.block\.child\s*{$_rdl}!",$_match2[7][$key])) {
                                 $replacement =  preg_replace("!({$_ldl}{$al}\\\$smarty\.block\.child\s*{$_rdl})!", $replacement, $_match2[7][$key]);
                                 $block_content = preg_replace("!(({$_ldl}{$al}block)(.*)?{$name}(.*)?({$_rdl}[\s\S]*?{$_ldl}{$al}/block\s*{$_rdl}))!", $replacement, $block_content);
                           }
                             if (preg_match("!{$_ldl}{$al}\\\$smarty\.block\.child\s*{$_rdl}!",$_match2[8][$key])) {
                                 $replacement =  preg_replace("!{$_ldl}{$al}\\\$smarty\.block\.child\s*{$_rdl}!", $replacement, $_match2[8][$key]);
                                 $block_content = preg_replace("!(({$_ldl}{$al}block)(.*)?{$name}(.*)?({$_rdl})(.*)?({$_ldl}{$al}/block\s*{$_rdl}))!", $replacement, $block_content);
                             }
                        } else {
                            // remove hidden blocks
                            $block_content = preg_replace("!(({$_ldl}{$al}block)(.*)?{$name}(.*)?({$_rdl}[\s\S]*?{$_ldl}{$al}/block\s*{$_rdl}))!", '', $block_content);
                        }
                    }
                }
                // do we have not nested {$smart.block.child}
                if (0 != preg_match("!({$_ldl}{$al}\\\$smarty\.block\.child\s*{$_rdl})!", $block_content, $_match2)) {
                    // get child replacement for this block
                    if (isset($template->block_data[$_name])) {
                        $replacement = $template->block_data[$_name]['source'];
                        unset($template->block_data[$_name]);
                    } else {
                        $replacement = '';
                    }
                    $block_content = preg_replace("!({$_ldl}{$al}\\\$smarty\.block\.child\s*{$_rdl})!", $replacement, $block_content);
                }
                if (isset($template->block_data[$_name])) {
                    if (strpos($template->block_data[$_name]['source'], '%%%%SMARTY_PARENT%%%%') !== false) {
                        $template->block_data[$_name]['source'] =
                                str_replace('%%%%SMARTY_PARENT%%%%', $block_content, $template->block_data[$_name]['source']);
                    } elseif ($template->block_data[$_name]['mode'] == 'prepend') {
                        $template->block_data[$_name]['source'] .= $block_content;
                    } elseif ($template->block_data[$_name]['mode'] == 'append') {
                        $template->block_data[$_name]['source'] = $block_content . $template->block_data[$_name]['source'];
                    }
                } else {
                    $template->block_data[$_name]['source'] = $block_content;
                    $template->block_data[$_name]['file'] = $filepath;
                }
                if ($_match[6] == 'append') {
                    $template->block_data[$_name]['mode'] = 'append';
                } elseif ($_match[6] == 'prepend') {
                    $template->block_data[$_name]['mode'] = 'prepend';
                } else {
                    $template->block_data[$_name]['mode'] = 'replace';
                }
            }
        }
    }

    /**
     * Compile saved child block source
     *
     * @param object $compiler  compiler object
     * @param string $_name     optional name of child block
     * @return string   compiled code of schild block
     */
    public static function compileChildBlock($compiler, $_name = null) {
        $_output = '';
        // if called by {$smarty.block.child} we must search the name of enclosing {block}
        if ($_name == null) {
            $stack_count = count($compiler->_tag_stack);
            while (--$stack_count >= 0) {
                if ($compiler->_tag_stack[$stack_count][0] == 'block') {
                    $_name = trim($compiler->_tag_stack[$stack_count][1][0]['name'], "'\"");
                    break;
                }
            }
            // flag that child is already compile by {$smarty.block.child} inclusion
            $compiler->template->block_data[$_name]['compiled'] = true;
        }
        if ($_name == null) {
            $compiler->trigger_template_error('{$smarty.block.child} used out of context', $compiler->lex->taglineno);
        }
        // undefined child?
        if (!isset($compiler->template->block_data[$_name]['source'])) {
            return '';
        }
        $_tpl = new Smarty_Internal_template('string:' . $compiler->template->block_data[$_name]['source'], $compiler->smarty, $compiler->template, $compiler->template->cache_id,
                        $compiler->template->compile_id, $compiler->template->caching, $compiler->template->cache_lifetime);
        $_tpl->variable_filters = $compiler->template->variable_filters;
        $_tpl->properties['nocache_hash'] = $compiler->template->properties['nocache_hash'];
        $_tpl->source->filepath = $compiler->template->block_data[$_name]['file'];
        $_tpl->allow_relative_path = true;
        if ($compiler->nocache) {
            $_tpl->compiler->forceNocache = 2;
        } else {
            $_tpl->compiler->forceNocache = 1;
        }
        $_tpl->compiler->suppressHeader = true;
        $_tpl->compiler->suppressFilter = true;
        $_tpl->compiler->suppressTemplatePropertyHeader = true;
        $_tpl->compiler->suppressMergedTemplates = true;
        if (strpos($compiler->template->block_data[$_name]['source'], '%%%%SMARTY_PARENT%%%%') !== false) {
            $_output = str_replace('%%%%SMARTY_PARENT%%%%', $compiler->parser->current_buffer->to_smarty_php(), $_tpl->compiler->compileTemplate($_tpl));
        } elseif ($compiler->template->block_data[$_name]['mode'] == 'prepend') {
            $_output = $_tpl->compiler->compileTemplate($_tpl) . $compiler->parser->current_buffer->to_smarty_php();
        } elseif ($compiler->template->block_data[$_name]['mode'] == 'append') {
            $_output = $compiler->parser->current_buffer->to_smarty_php() . $_tpl->compiler->compileTemplate($_tpl);
        } elseif (!empty($compiler->template->block_data[$_name])) {
            $_output = $_tpl->compiler->compileTemplate($_tpl);
        }
        $compiler->template->properties['file_dependency'] = array_merge($compiler->template->properties['file_dependency'], $_tpl->properties['file_dependency']);
        $compiler->template->properties['function'] = array_merge($compiler->template->properties['function'], $_tpl->properties['function']);
        $compiler->merged_templates = array_merge($compiler->merged_templates, $_tpl->compiler->merged_templates);
        $compiler->template->variable_filters = $_tpl->variable_filters;
        if ($_tpl->has_nocache_code) {
            $compiler->template->has_nocache_code = true;
        }
        foreach ($_tpl->required_plugins as $key => $tmp1) {
            if ($compiler->nocache && $compiler->template->caching) {
                $code = 'nocache';
            } else {
                $code = $key;
            }
            foreach ($tmp1 as $name => $tmp) {
                foreach ($tmp as $type => $data) {
                    $compiler->template->required_plugins[$code][$name][$type] = $data;
                }
            }
        }
        unset($_tpl);
        return $_output;
    }

}

/**
 * Smarty Internal Plugin Compile BlockClose Class
 *
 * @package Smarty
 * @subpackage Compiler
 */
class Smarty_Internal_Compile_Blockclose extends Smarty_Internal_CompileBase {

=======
    public $option_flags = array('hide', 'nocache');

    /**
     * Attribute definition: Overwrites base class.
     *
     * @var array
     * @see Smarty_Internal_CompileBase
     */
    public $optional_attributes = array('assign');

    /**
     * Compiles code for the {block} tag
     *
     * @param array                                 $args      array with attributes from parser
     * @param \Smarty_Internal_TemplateCompilerBase $compiler  compiler object
     * @param array                                 $parameter array with compilation parameter
     */
    public function compile($args, Smarty_Internal_TemplateCompilerBase $compiler, $parameter)
    {
        if (!isset($compiler->_cache[ 'blockNesting' ])) {
            $compiler->_cache[ 'blockNesting' ] = 0;
        }
        if ($compiler->_cache[ 'blockNesting' ] === 0) {
            // make sure that inheritance gets initialized in template code
            $this->registerInit($compiler);
            $this->option_flags = array('hide', 'nocache', 'append', 'prepend');
        } else {
            $this->option_flags = array('hide', 'nocache');
        }
        // check and get attributes
        $_attr = $this->getAttributes($compiler, $args);
        ++$compiler->_cache[ 'blockNesting' ];
        $_className = 'Block_' . preg_replace('![^\w]+!', '_', uniqid(mt_rand(), true));
        $compiler->_cache[ 'blockName' ][ $compiler->_cache[ 'blockNesting' ] ] = $_attr[ 'name' ];
        $compiler->_cache[ 'blockClass' ][ $compiler->_cache[ 'blockNesting' ] ] = $_className;
        $compiler->_cache[ 'blockParams' ][ $compiler->_cache[ 'blockNesting' ] ] = array();
        $compiler->_cache[ 'blockParams' ][ 1 ][ 'subBlocks' ][ trim($_attr[ 'name' ], '"\'') ][] = $_className;
        $this->openTag(
            $compiler,
            'block',
            array(
                $_attr, $compiler->nocache, $compiler->parser->current_buffer,
                $compiler->template->compiled->has_nocache_code,
                $compiler->template->caching
            )
        );
        $compiler->saveRequiredPlugins(true);
        $compiler->nocache = $compiler->nocache | $compiler->tag_nocache;
        $compiler->parser->current_buffer = new Smarty_Internal_ParseTree_Template();
        $compiler->template->compiled->has_nocache_code = false;
        $compiler->suppressNocacheProcessing = true;
    }
}

/**
 * Smarty Internal Plugin Compile BlockClose Class
 */
class Smarty_Internal_Compile_Blockclose extends Smarty_Internal_Compile_Shared_Inheritance
{
>>>>>>> gosa-core_v2.8
    /**
     * Compiles code for the {/block} tag
     *
     * @param array  $args     array with attributes from parser
<<<<<<< HEAD
     * @param object $compiler compiler object
     * @return string compiled code
     */
    public function compile($args, $compiler) {
        $compiler->has_code = true;
        // check and get attributes
        $_attr = $this->getAttributes($compiler, $args);
        $saved_data = $this->closeTag($compiler, array('block'));
        $_name = trim($saved_data[0]['name'], "\"'");
        if (isset($compiler->template->block_data[$_name]) && !isset($compiler->template->block_data[$_name]['compiled'])) {
            // restore to status before {block} tag as new subtemplate code of parent {block} is not needed
            // TODO: Below code was disabled in 3.1.8 because of problems with {include} in nested {block} tags in child templates
            //       combined with append/prepend or $smarty.block.parent
            //       For later versions it should be checked under which conditions it could run for optimisation
            //
            //$compiler->merged_templates = $saved_data[4];
            //$compiler->smarty->merged_templates_func = $saved_data[5];
            //$compiler->template->properties = $saved_data[6];
            //$compiler->template->has_nocache_code = $saved_data[7];
            $_output = Smarty_Internal_Compile_Block::compileChildBlock($compiler, $_name);
        } else {
            if (isset($saved_data[0]['hide']) && !isset($compiler->template->block_data[$_name]['source'])) {
                $_output = '';
            } else {
                $_output = $compiler->parser->current_buffer->to_smarty_php();
            }
            unset($compiler->template->block_data[$_name]['compiled']);
        }
        // reset flags
        $compiler->parser->current_buffer = $saved_data[1];
        $compiler->nocache = $saved_data[2];
        $compiler->smarty->merge_compiled_includes = $saved_data[3];
        // reset flag for {block} tag
        $compiler->inheritance = false;
        // $_output content has already nocache code processed
        $compiler->suppressNocacheProcessing = true;
        return $_output;
    }

}

?>
=======
     * @param \Smarty_Internal_TemplateCompilerBase $compiler  compiler object
     * @param array                                 $parameter array with compilation parameter
     *
     * @return bool true
     */
    public function compile($args, Smarty_Internal_TemplateCompilerBase $compiler, $parameter)
    {
        list($_attr, $_nocache, $_buffer, $_has_nocache_code, $_caching) = $this->closeTag($compiler, array('block'));
        // init block parameter
        $_block = $compiler->_cache[ 'blockParams' ][ $compiler->_cache[ 'blockNesting' ] ];
        unset($compiler->_cache[ 'blockParams' ][ $compiler->_cache[ 'blockNesting' ] ]);
        $_name = $_attr[ 'name' ];
        $_assign = isset($_attr[ 'assign' ]) ? $_attr[ 'assign' ] : null;
        unset($_attr[ 'assign' ], $_attr[ 'name' ]);
        foreach ($_attr as $name => $stat) {
            if ((is_bool($stat) && $stat !== false) || (!is_bool($stat) && $stat !== 'false')) {
                $_block[ $name ] = 'true';
            }
        }
        $_className = $compiler->_cache[ 'blockClass' ][ $compiler->_cache[ 'blockNesting' ] ];
        // get compiled block code
        $_functionCode = $compiler->parser->current_buffer;
        // setup buffer for template function code
        $compiler->parser->current_buffer = new Smarty_Internal_ParseTree_Template();
        $output = "<?php\n";
        $output .= "/* {block {$_name}} */\n";
        $output .= "class {$_className} extends Smarty_Internal_Block\n";
        $output .= "{\n";
        foreach ($_block as $property => $value) {
            $output .= "public \${$property} = " . var_export($value, true) . ";\n";
        }
        $output .= "public function callBlock(Smarty_Internal_Template \$_smarty_tpl) {\n";
        $output .= $compiler->compileRequiredPlugins();
        $compiler->restoreRequiredPlugins();
        if ($compiler->template->compiled->has_nocache_code) {
            $output .= "\$_smarty_tpl->cached->hashes['{$compiler->template->compiled->nocache_hash}'] = true;\n";
        }
        if (isset($_assign)) {
            $output .= "ob_start();\n";
        }
        $output .= "?>\n";
        $compiler->parser->current_buffer->append_subtree(
            $compiler->parser,
            new Smarty_Internal_ParseTree_Tag(
                $compiler->parser,
                $output
            )
        );
        $compiler->parser->current_buffer->append_subtree($compiler->parser, $_functionCode);
        $output = "<?php\n";
        if (isset($_assign)) {
            $output .= "\$_smarty_tpl->assign({$_assign}, ob_get_clean());\n";
        }
        $output .= "}\n";
        $output .= "}\n";
        $output .= "/* {/block {$_name}} */\n\n";
        $output .= "?>\n";
        $compiler->parser->current_buffer->append_subtree(
            $compiler->parser,
            new Smarty_Internal_ParseTree_Tag(
                $compiler->parser,
                $output
            )
        );
        $compiler->blockOrFunctionCode .= $compiler->parser->current_buffer->to_smarty_php($compiler->parser);
        $compiler->parser->current_buffer = new Smarty_Internal_ParseTree_Template();
        // restore old status
        $compiler->template->compiled->has_nocache_code = $_has_nocache_code;
        $compiler->tag_nocache = $compiler->nocache;
        $compiler->nocache = $_nocache;
        $compiler->parser->current_buffer = $_buffer;
        $output = "<?php \n";
        if ($compiler->_cache[ 'blockNesting' ] === 1) {
            $output .= "\$_smarty_tpl->inheritance->instanceBlock(\$_smarty_tpl, '$_className', $_name);\n";
        } else {
            $output .= "\$_smarty_tpl->inheritance->instanceBlock(\$_smarty_tpl, '$_className', $_name, \$this->tplIndex);\n";
        }
        $output .= "?>\n";
        --$compiler->_cache[ 'blockNesting' ];
        if ($compiler->_cache[ 'blockNesting' ] === 0) {
            unset($compiler->_cache[ 'blockNesting' ]);
        }
        $compiler->has_code = true;
        $compiler->suppressNocacheProcessing = true;
        return $output;
    }
}
>>>>>>> gosa-core_v2.8
