<?php
<<<<<<< HEAD
/**
* Smarty Internal Plugin Configfileparser
*
* This is the config file parser.
* It is generated from the internal.configfileparser.y file
* @package Smarty
* @subpackage Compiler
* @author Uwe Tews
*/

class TPC_yyToken implements ArrayAccess
{
    public $string = '';
    public $metadata = array();

    function __construct($s, $m = array())
    {
        if ($s instanceof TPC_yyToken) {
            $this->string = $s->string;
            $this->metadata = $s->metadata;
        } else {
            $this->string = (string) $s;
            if ($m instanceof TPC_yyToken) {
                $this->metadata = $m->metadata;
            } elseif (is_array($m)) {
                $this->metadata = $m;
            }
        }
    }

    function __toString()
    {
        return $this->_string;
    }

    function offsetExists($offset)
    {
        return isset($this->metadata[$offset]);
    }

    function offsetGet($offset)
    {
        return $this->metadata[$offset];
    }

    function offsetSet($offset, $value)
    {
        if ($offset === null) {
            if (isset($value[0])) {
                $x = ($value instanceof TPC_yyToken) ?
                    $value->metadata : $value;
                $this->metadata = array_merge($this->metadata, $x);
                return;
            }
            $offset = count($this->metadata);
        }
        if ($value === null) {
            return;
        }
        if ($value instanceof TPC_yyToken) {
            if ($value->metadata) {
                $this->metadata[$offset] = $value->metadata;
            }
        } elseif ($value) {
            $this->metadata[$offset] = $value;
        }
    }

    function offsetUnset($offset)
    {
        unset($this->metadata[$offset]);
    }
}
=======
>>>>>>> gosa-core_v2.8

class TPC_yyStackEntry
{
    public $stateno;       /* The state-number */
    public $major;         /* The major token value.  This is the code
                     ** number for the token at this stack level */
    public $minor; /* The user-supplied minor token value.  This
                     ** is the value of the token  */
<<<<<<< HEAD
};


#line 12 "smarty_internal_configfileparser.y"
class Smarty_Internal_Configfileparser#line 79 "smarty_internal_configfileparser.php"
{
#line 14 "smarty_internal_configfileparser.y"

    // states whether the parse was successful or not
    public $successful = true;
    public $retvalue = 0;
    private $lex;
    private $internalError = false;

    function __construct($lex, $compiler) {
        // set instance object
        self::instance($this);
        $this->lex = $lex;
        $this->smarty = $compiler->smarty;
        $this->compiler = $compiler;
    }
    public static function &instance($new_instance = null)
    {
        static $instance = null;
        if (isset($new_instance) && is_object($new_instance))
            $instance = $new_instance;
        return $instance;
    }

    private function parse_bool($str) {
        if (in_array(strtolower($str) ,array('on','yes','true'))) {
            $res = true;
        } else {
            $res = false;
        }
        return $res;
    }

    private static $escapes_single = Array('\\' => '\\',
                                          '\'' => '\'');
    private static function parse_single_quoted_string($qstr) {
        $escaped_string = substr($qstr, 1, strlen($qstr)-2); //remove outer quotes

        $ss = preg_split('/(\\\\.)/', $escaped_string, -1, PREG_SPLIT_DELIM_CAPTURE);

        $str = "";
        foreach ($ss as $s) {
            if (strlen($s) === 2 && $s[0] === '\\') {
                if (isset(self::$escapes_single[$s[1]])) {
                    $s = self::$escapes_single[$s[1]];
                }
             }

             $str .= $s;
        }

        return $str;
    }

    private static function parse_double_quoted_string($qstr) {
        $inner_str = substr($qstr, 1, strlen($qstr)-2);
        return stripcslashes($inner_str);
    }

    private static function parse_tripple_double_quoted_string($qstr) {
        return stripcslashes($qstr);
    }

    private function set_var(Array $var, Array &$target_array) {
        $key = $var["key"];
        $value = $var["value"];

        if ($this->smarty->config_overwrite || !isset($target_array['vars'][$key])) {
            $target_array['vars'][$key] = $value;
        } else {
            settype($target_array['vars'][$key], 'array');
            $target_array['vars'][$key][] = $value;
        }
    }

    private function add_global_vars(Array $vars) {
        if (!isset($this->compiler->config_data['vars'])) {
      $this->compiler->config_data['vars'] = Array();
        }
        foreach ($vars as $var) {
            $this->set_var($var, $this->compiler->config_data);
        }
    }

    private function add_section_vars($section_name, Array $vars) {
        if (!isset($this->compiler->config_data['sections'][$section_name]['vars'])) {
            $this->compiler->config_data['sections'][$section_name]['vars'] = Array();
        }
        foreach ($vars as $var) {
            $this->set_var($var, $this->compiler->config_data['sections'][$section_name]);
        }
    }
#line 173 "smarty_internal_configfileparser.php"

=======
}

// line 12 "../smarty/lexer/smarty_internal_configfileparser.y"

/**
 * Smarty Internal Plugin Configfileparse
 *
 * This is the config file parser.
 * It is generated from the smarty_internal_configfileparser.y file
 *
 * @package    Smarty
 * @subpackage Compiler
 * @author     Uwe Tews
 */
class Smarty_Internal_Configfileparser
{
    // line 25 "../smarty/lexer/smarty_internal_configfileparser.y"
>>>>>>> gosa-core_v2.8
    const TPC_OPENB                          =  1;
    const TPC_SECTION                        =  2;
    const TPC_CLOSEB                         =  3;
    const TPC_DOT                            =  4;
    const TPC_ID                             =  5;
    const TPC_EQUAL                          =  6;
    const TPC_FLOAT                          =  7;
    const TPC_INT                            =  8;
    const TPC_BOOL                           =  9;
    const TPC_SINGLE_QUOTED_STRING           = 10;
    const TPC_DOUBLE_QUOTED_STRING           = 11;
    const TPC_TRIPPLE_QUOTES                 = 12;
    const TPC_TRIPPLE_TEXT                   = 13;
    const TPC_TRIPPLE_QUOTES_END             = 14;
    const TPC_NAKED_STRING                   = 15;
    const TPC_OTHER                          = 16;
    const TPC_NEWLINE                        = 17;
    const TPC_COMMENTSTART                   = 18;
    const YY_NO_ACTION = 60;
    const YY_ACCEPT_ACTION = 59;
    const YY_ERROR_ACTION = 58;
<<<<<<< HEAD

    const YY_SZ_ACTTAB = 38;
static public $yy_action = array(
 /*     0 */    29,   30,   34,   33,   24,   13,   19,   25,   35,   21,
 /*    10 */    59,    8,    3,    1,   20,   12,   14,   31,   20,   12,
 /*    20 */    15,   17,   23,   18,   27,   26,    4,    5,    6,   32,
 /*    30 */     2,   11,   28,   22,   16,    9,    7,   10,
    );
    static public $yy_lookahead = array(
 /*     0 */     7,    8,    9,   10,   11,   12,    5,   27,   15,   16,
 /*    10 */    20,   21,   23,   23,   17,   18,   13,   14,   17,   18,
 /*    20 */    15,    2,   17,    4,   25,   26,    6,    3,    3,   14,
 /*    30 */    23,    1,   24,   17,    2,   25,   22,   25,
);
    const YY_SHIFT_USE_DFLT = -8;
    const YY_SHIFT_MAX = 19;
    static public $yy_shift_ofst = array(
 /*     0 */    -8,    1,    1,    1,   -7,   -3,   -3,   30,   -8,   -8,
 /*    10 */    -8,   19,    5,    3,   15,   16,   24,   25,   32,   20,
);
    const YY_REDUCE_USE_DFLT = -21;
    const YY_REDUCE_MAX = 10;
    static public $yy_reduce_ofst = array(
 /*     0 */   -10,   -1,   -1,   -1,  -20,   10,   12,    8,   14,    7,
 /*    10 */   -11,
);
    static public $yyExpectedTokens = array(
        /* 0 */ array(),
        /* 1 */ array(5, 17, 18, ),
        /* 2 */ array(5, 17, 18, ),
        /* 3 */ array(5, 17, 18, ),
        /* 4 */ array(7, 8, 9, 10, 11, 12, 15, 16, ),
        /* 5 */ array(17, 18, ),
        /* 6 */ array(17, 18, ),
        /* 7 */ array(1, ),
        /* 8 */ array(),
        /* 9 */ array(),
        /* 10 */ array(),
        /* 11 */ array(2, 4, ),
        /* 12 */ array(15, 17, ),
        /* 13 */ array(13, 14, ),
        /* 14 */ array(14, ),
        /* 15 */ array(17, ),
        /* 16 */ array(3, ),
        /* 17 */ array(3, ),
        /* 18 */ array(2, ),
        /* 19 */ array(6, ),
        /* 20 */ array(),
        /* 21 */ array(),
        /* 22 */ array(),
        /* 23 */ array(),
        /* 24 */ array(),
        /* 25 */ array(),
        /* 26 */ array(),
        /* 27 */ array(),
        /* 28 */ array(),
        /* 29 */ array(),
        /* 30 */ array(),
        /* 31 */ array(),
        /* 32 */ array(),
        /* 33 */ array(),
        /* 34 */ array(),
        /* 35 */ array(),
);
    static public $yy_default = array(
 /*     0 */    44,   37,   41,   40,   58,   58,   58,   36,   39,   44,
 /*    10 */    44,   58,   58,   58,   58,   58,   58,   58,   58,   58,
 /*    20 */    55,   54,   57,   56,   50,   45,   43,   42,   38,   46,
 /*    30 */    47,   52,   51,   49,   48,   53,
);
=======
    const YY_SZ_ACTTAB             = 38;
    const YY_SHIFT_USE_DFLT        = -8;
    const YY_SHIFT_MAX             = 19;
    const YY_REDUCE_USE_DFLT       = -17;
    const YY_REDUCE_MAX            = 10;
>>>>>>> gosa-core_v2.8
    const YYNOCODE = 29;
    const YYSTACKDEPTH = 100;
    const YYNSTATE = 36;
    const YYNRULE = 22;
    const YYERRORSYMBOL = 19;
    const YYERRSYMDT = 'yy0';
    const YYFALLBACK = 0;
<<<<<<< HEAD
    static public $yyFallback = array(
    );
    static function Trace($TraceFILE, $zTracePrompt)
    {
        if (!$TraceFILE) {
            $zTracePrompt = 0;
        } elseif (!$zTracePrompt) {
            $TraceFILE = 0;
        }
        self::$yyTraceFILE = $TraceFILE;
        self::$yyTracePrompt = $zTracePrompt;
    }

    static function PrintTrace()
    {
        self::$yyTraceFILE = fopen('php://output', 'w');
        self::$yyTracePrompt = '<br>';
    }

    static public $yyTraceFILE;
    static public $yyTracePrompt;
    public $yyidx;                    /* Index of top element in stack */
    public $yyerrcnt;                 /* Shifts left before out of the error */
    public $yystack = array();  /* The parser's stack */
=======

    public static $yy_action        = array(
        32, 31, 30, 29, 35, 13, 19, 3, 24, 26,
        59, 9, 14, 1, 16, 25, 11, 28, 25, 11,
        17, 27, 34, 20, 18, 15, 23, 5, 6, 22,
        10, 8, 4, 12, 2, 33, 7, 21,
    );

    public static $yy_lookahead     = array(
        7, 8, 9, 10, 11, 12, 5, 23, 15, 16,
        20, 21, 2, 23, 4, 17, 18, 14, 17, 18,
        13, 14, 25, 26, 15, 2, 17, 3, 3, 17,
        25, 25, 6, 1, 23, 27, 22, 24,
    );

    public static $yy_shift_ofst    = array(
        -8, 1, 1, 1, -7, -2, -2, 32, -8, -8,
        -8, 9, 10, 7, 25, 24, 23, 3, 12, 26,
    );

    public static $yy_reduce_ofst   = array(
        -10, -3, -3, -3, 8, 6, 5, 13, 11, 14,
        -16,
    );

    public static $yyExpectedTokens = array(
        array(),
        array(5, 17, 18,),
        array(5, 17, 18,),
        array(5, 17, 18,),
        array(7, 8, 9, 10, 11, 12, 15, 16,),
        array(17, 18,),
        array(17, 18,),
        array(1,),
        array(),
        array(),
        array(),
        array(15, 17,),
        array(2, 4,),
        array(13, 14,),
        array(3,),
        array(3,),
        array(2,),
        array(14,),
        array(17,),
        array(6,),
        array(),
        array(),
        array(),
        array(),
        array(),
        array(),
        array(),
        array(),
        array(),
        array(),
        array(),
        array(),
        array(),
        array(),
        array(),
        array(),
    );

    public static $yy_default       = array(
        44, 37, 41, 40, 58, 58, 58, 36, 44, 39,
        44, 58, 58, 58, 58, 58, 58, 58, 58, 58,
        43, 38, 57, 56, 53, 55, 54, 52, 51, 49,
        48, 47, 46, 45, 42, 50,
    );

    public static $yyFallback       = array();

    public static $yyRuleName       = array(
        'start ::= global_vars sections',
        'global_vars ::= var_list',
        'sections ::= sections section',
        'sections ::=',
        'section ::= OPENB SECTION CLOSEB newline var_list',
        'section ::= OPENB DOT SECTION CLOSEB newline var_list',
        'var_list ::= var_list newline',
        'var_list ::= var_list var',
        'var_list ::=',
        'var ::= ID EQUAL value',
        'value ::= FLOAT',
        'value ::= INT',
        'value ::= BOOL',
        'value ::= SINGLE_QUOTED_STRING',
        'value ::= DOUBLE_QUOTED_STRING',
        'value ::= TRIPPLE_QUOTES TRIPPLE_TEXT TRIPPLE_QUOTES_END',
        'value ::= TRIPPLE_QUOTES TRIPPLE_QUOTES_END',
        'value ::= NAKED_STRING',
        'value ::= OTHER',
        'newline ::= NEWLINE',
        'newline ::= COMMENTSTART NEWLINE',
        'newline ::= COMMENTSTART NAKED_STRING NEWLINE',
    );

    public static $yyRuleInfo       = array(
        array(0 => 20, 1 => 2),
        array(0 => 21, 1 => 1),
        array(0 => 22, 1 => 2),
        array(0 => 22, 1 => 0),
        array(0 => 24, 1 => 5),
        array(0 => 24, 1 => 6),
        array(0 => 23, 1 => 2),
        array(0 => 23, 1 => 2),
        array(0 => 23, 1 => 0),
        array(0 => 26, 1 => 3),
        array(0 => 27, 1 => 1),
        array(0 => 27, 1 => 1),
        array(0 => 27, 1 => 1),
        array(0 => 27, 1 => 1),
        array(0 => 27, 1 => 1),
        array(0 => 27, 1 => 3),
        array(0 => 27, 1 => 2),
        array(0 => 27, 1 => 1),
        array(0 => 27, 1 => 1),
        array(0 => 25, 1 => 1),
        array(0 => 25, 1 => 2),
        array(0 => 25, 1 => 3),
    );

    public static $yyReduceMap      = array(
        0  => 0,
        2  => 0,
        3  => 0,
        19 => 0,
        20 => 0,
        21 => 0,
        1  => 1,
        4  => 4,
        5  => 5,
        6  => 6,
        7  => 7,
        8  => 8,
        9  => 9,
        10 => 10,
        11 => 11,
        12 => 12,
        13 => 13,
        14 => 14,
        15 => 15,
        16 => 16,
        17 => 17,
        18 => 17,
    );

    /**
     * helper map
     *
     * @var array
     */
    private static $escapes_single = array(
        '\\' => '\\',
        '\'' => '\''
    );

    /**
     * result status
     *
     * @var bool
     */
    public $successful = true;

    /**
     * return value
     *
     * @var mixed
     */
    public $retvalue = 0;

    /**
     * @var
     */
    public $yymajor;

    /**
     * compiler object
     *
     * @var Smarty_Internal_Config_File_Compiler
     */
    public $compiler = null;

    /**
     * smarty object
     *
     * @var Smarty
     */
    public $smarty      = null;

    public $yyTraceFILE;

    public $yyTracePrompt;

    public $yyidx;

    public $yyerrcnt;

    public $yystack     = array();
>>>>>>> gosa-core_v2.8

    public $yyTokenName = array(
  '$',             'OPENB',         'SECTION',       'CLOSEB',
  'DOT',           'ID',            'EQUAL',         'FLOAT',
  'INT',           'BOOL',          'SINGLE_QUOTED_STRING',  'DOUBLE_QUOTED_STRING',
  'TRIPPLE_QUOTES',  'TRIPPLE_TEXT',  'TRIPPLE_QUOTES_END',  'NAKED_STRING',
  'OTHER',         'NEWLINE',       'COMMENTSTART',  'error',
  'start',         'global_vars',   'sections',      'var_list',
  'section',       'newline',       'var',           'value',
    );

<<<<<<< HEAD
    static public $yyRuleName = array(
 /*   0 */ "start ::= global_vars sections",
 /*   1 */ "global_vars ::= var_list",
 /*   2 */ "sections ::= sections section",
 /*   3 */ "sections ::=",
 /*   4 */ "section ::= OPENB SECTION CLOSEB newline var_list",
 /*   5 */ "section ::= OPENB DOT SECTION CLOSEB newline var_list",
 /*   6 */ "var_list ::= var_list newline",
 /*   7 */ "var_list ::= var_list var",
 /*   8 */ "var_list ::=",
 /*   9 */ "var ::= ID EQUAL value",
 /*  10 */ "value ::= FLOAT",
 /*  11 */ "value ::= INT",
 /*  12 */ "value ::= BOOL",
 /*  13 */ "value ::= SINGLE_QUOTED_STRING",
 /*  14 */ "value ::= DOUBLE_QUOTED_STRING",
 /*  15 */ "value ::= TRIPPLE_QUOTES TRIPPLE_TEXT TRIPPLE_QUOTES_END",
 /*  16 */ "value ::= TRIPPLE_QUOTES TRIPPLE_QUOTES_END",
 /*  17 */ "value ::= NAKED_STRING",
 /*  18 */ "value ::= OTHER",
 /*  19 */ "newline ::= NEWLINE",
 /*  20 */ "newline ::= COMMENTSTART NEWLINE",
 /*  21 */ "newline ::= COMMENTSTART NAKED_STRING NEWLINE",
    );

    function tokenName($tokenType)
=======
    /**
     * lexer object
     *
     * @var Smarty_Internal_Configfilelexer
     */
    private $lex;

    /**
     * internal error flag
     *
     * @var bool
     */
    private $internalError = false;

    /**
     * copy of config_overwrite property
     *
     * @var bool
     */
    private $configOverwrite = false;

    /**
     * copy of config_read_hidden property
     *
     * @var bool
     */
    private $configReadHidden = false;

    private $_retvalue;

    /**
     * constructor
     *
     * @param Smarty_Internal_Configfilelexer      $lex
     * @param Smarty_Internal_Config_File_Compiler $compiler
     */
    public function __construct(Smarty_Internal_Configfilelexer $lex, Smarty_Internal_Config_File_Compiler $compiler)
    {
        $this->lex = $lex;
        $this->smarty = $compiler->smarty;
        $this->compiler = $compiler;
        $this->configOverwrite = $this->smarty->config_overwrite;
        $this->configReadHidden = $this->smarty->config_read_hidden;
    }

    public static function yy_destructor($yymajor, $yypminor)
    {
        switch ($yymajor) {
            default:
                break;   /* If no destructor action specified: do nothing */
        }
    }

    /**
     * parse single quoted string
     *  remove outer quotes
     *  unescape inner quotes
     *
     * @param string $qstr
     *
     * @return string
     */
    private static function parse_single_quoted_string($qstr)
    {
        $escaped_string = substr($qstr, 1, strlen($qstr) - 2); //remove outer quotes
        $ss = preg_split('/(\\\\.)/', $escaped_string, -1, PREG_SPLIT_DELIM_CAPTURE);
        $str = '';
        foreach ($ss as $s) {
            if (strlen($s) === 2 && $s[ 0 ] === '\\') {
                if (isset(self::$escapes_single[ $s[ 1 ] ])) {
                    $s = self::$escapes_single[ $s[ 1 ] ];
                }
            }
            $str .= $s;
        }
        return $str;
    }                    /* Index of top element in stack */
    /**
     * parse double quoted string
     *
     * @param string $qstr
     *
     * @return string
     */
    private static function parse_double_quoted_string($qstr)
    {
        $inner_str = substr($qstr, 1, strlen($qstr) - 2);
        return stripcslashes($inner_str);
    }                 /* Shifts left before out of the error */
    /**
     * parse triple quoted string
     *
     * @param string $qstr
     *
     * @return string
     */
    private static function parse_tripple_double_quoted_string($qstr)
    {
        return stripcslashes($qstr);
    }  /* The parser's stack */
    public function Trace($TraceFILE, $zTracePrompt)
    {
        if (!$TraceFILE) {
            $zTracePrompt = 0;
        } elseif (!$zTracePrompt) {
            $TraceFILE = 0;
        }
        $this->yyTraceFILE = $TraceFILE;
        $this->yyTracePrompt = $zTracePrompt;
    }

    public function PrintTrace()
    {
        $this->yyTraceFILE = fopen('php://output', 'w');
        $this->yyTracePrompt = '<br>';
    }

    public function tokenName($tokenType)
>>>>>>> gosa-core_v2.8
    {
        if ($tokenType === 0) {
            return 'End of Input';
        }
        if ($tokenType > 0 && $tokenType < count($this->yyTokenName)) {
            return $this->yyTokenName[$tokenType];
        } else {
<<<<<<< HEAD
            return "Unknown";
        }
    }

    static function yy_destructor($yymajor, $yypminor)
    {
        switch ($yymajor) {
            default:  break;   /* If no destructor action specified: do nothing */
        }
    }

    function yy_pop_parser_stack()
    {
        if (!count($this->yystack)) {
            return;
        }
        $yytos = array_pop($this->yystack);
        if (self::$yyTraceFILE && $this->yyidx >= 0) {
            fwrite(self::$yyTraceFILE,
                self::$yyTracePrompt . 'Popping ' . $this->yyTokenName[$yytos->major] .
                    "\n");
=======
            return 'Unknown';
        }
    }

    public function yy_pop_parser_stack()
    {
        if (empty($this->yystack)) {
            return;
        }
        $yytos = array_pop($this->yystack);
        if ($this->yyTraceFILE && $this->yyidx >= 0) {
            fwrite(
                $this->yyTraceFILE,
                $this->yyTracePrompt . 'Popping ' . $this->yyTokenName[ $yytos->major ] .
                "\n"
            );
>>>>>>> gosa-core_v2.8
        }
        $yymajor = $yytos->major;
        self::yy_destructor($yymajor, $yytos->minor);
        $this->yyidx--;
        return $yymajor;
    }

<<<<<<< HEAD
    function __destruct()
    {
        while ($this->yystack !== Array()) {
            $this->yy_pop_parser_stack();
        }
        if (is_resource(self::$yyTraceFILE)) {
            fclose(self::$yyTraceFILE);
        }
    }

    function yy_get_expected_tokens($token)
    {
        $state = $this->yystack[$this->yyidx]->stateno;
        $expected = self::$yyExpectedTokens[$state];
        if (in_array($token, self::$yyExpectedTokens[$state], true)) {
            return $expected;
        }
=======
    public function __destruct()
    {
        while ($this->yystack !== array()) {
            $this->yy_pop_parser_stack();
        }
        if (is_resource($this->yyTraceFILE)) {
            fclose($this->yyTraceFILE);
        }
    }

    public function yy_get_expected_tokens($token)
    {
        static $res3 = array();
        static $res4 = array();
        $state = $this->yystack[ $this->yyidx ]->stateno;
        $expected = self::$yyExpectedTokens[ $state ];
        if (isset($res3[ $state ][ $token ])) {
            if ($res3[ $state ][ $token ]) {
                return $expected;
            }
        } else {
            if ($res3[ $state ][ $token ] = in_array($token, self::$yyExpectedTokens[ $state ], true)) {
                return $expected;
            }
        }
>>>>>>> gosa-core_v2.8
        $stack = $this->yystack;
        $yyidx = $this->yyidx;
        do {
            $yyact = $this->yy_find_shift_action($token);
            if ($yyact >= self::YYNSTATE && $yyact < self::YYNSTATE + self::YYNRULE) {
                // reduce action
                $done = 0;
                do {
<<<<<<< HEAD
                    if ($done++ == 100) {
=======
                    if ($done++ === 100) {
>>>>>>> gosa-core_v2.8
                        $this->yyidx = $yyidx;
                        $this->yystack = $stack;
                        // too much recursion prevents proper detection
                        // so give up
                        return array_unique($expected);
                    }
                    $yyruleno = $yyact - self::YYNSTATE;
<<<<<<< HEAD
                    $this->yyidx -= self::$yyRuleInfo[$yyruleno]['rhs'];
                    $nextstate = $this->yy_find_reduce_action(
                        $this->yystack[$this->yyidx]->stateno,
                        self::$yyRuleInfo[$yyruleno]['lhs']);
                    if (isset(self::$yyExpectedTokens[$nextstate])) {
		        $expected = array_merge($expected, self::$yyExpectedTokens[$nextstate]);
                            if (in_array($token,
                                  self::$yyExpectedTokens[$nextstate], true)) {
=======
                    $this->yyidx -= self::$yyRuleInfo[ $yyruleno ][ 1 ];
                    $nextstate = $this->yy_find_reduce_action(
                        $this->yystack[ $this->yyidx ]->stateno,
                        self::$yyRuleInfo[ $yyruleno ][ 0 ]
                    );
                    if (isset(self::$yyExpectedTokens[ $nextstate ])) {
                        $expected = array_merge($expected, self::$yyExpectedTokens[ $nextstate ]);
                        if (isset($res4[ $nextstate ][ $token ])) {
                            if ($res4[ $nextstate ][ $token ]) {
>>>>>>> gosa-core_v2.8
                            $this->yyidx = $yyidx;
                            $this->yystack = $stack;
                            return array_unique($expected);
                        }
<<<<<<< HEAD
=======
                        } else {
                            if ($res4[ $nextstate ][ $token ] =
                                in_array($token, self::$yyExpectedTokens[ $nextstate ], true)) {
                                $this->yyidx = $yyidx;
                                $this->yystack = $stack;
                                return array_unique($expected);
                            }
                        }
>>>>>>> gosa-core_v2.8
                    }
                    if ($nextstate < self::YYNSTATE) {
                        // we need to shift a non-terminal
                        $this->yyidx++;
                        $x = new TPC_yyStackEntry;
                        $x->stateno = $nextstate;
<<<<<<< HEAD
                        $x->major = self::$yyRuleInfo[$yyruleno]['lhs'];
                        $this->yystack[$this->yyidx] = $x;
                        continue 2;
                    } elseif ($nextstate == self::YYNSTATE + self::YYNRULE + 1) {
=======
                        $x->major = self::$yyRuleInfo[ $yyruleno ][ 0 ];
                        $this->yystack[ $this->yyidx ] = $x;
                        continue 2;
                    } elseif ($nextstate === self::YYNSTATE + self::YYNRULE + 1) {
>>>>>>> gosa-core_v2.8
                        $this->yyidx = $yyidx;
                        $this->yystack = $stack;
                        // the last token was just ignored, we can't accept
                        // by ignoring input, this is in essence ignoring a
                        // syntax error!
                        return array_unique($expected);
                    } elseif ($nextstate === self::YY_NO_ACTION) {
                        $this->yyidx = $yyidx;
                        $this->yystack = $stack;
                        // input accepted, but not shifted (I guess)
                        return $expected;
                    } else {
                        $yyact = $nextstate;
                    }
                } while (true);
            }
            break;
        } while (true);
	$this->yyidx = $yyidx;
	$this->yystack = $stack;
        return array_unique($expected);
    }

<<<<<<< HEAD
    function yy_is_expected_token($token)
    {
=======
    public function yy_is_expected_token($token)
    {
        static $res = array();
        static $res2 = array();
>>>>>>> gosa-core_v2.8
        if ($token === 0) {
            return true; // 0 is not part of this
        }
        $state = $this->yystack[$this->yyidx]->stateno;
<<<<<<< HEAD
        if (in_array($token, self::$yyExpectedTokens[$state], true)) {
            return true;
        }
=======
        if (isset($res[ $state ][ $token ])) {
            if ($res[ $state ][ $token ]) {
                return true;
            }
        } else {
            if ($res[ $state ][ $token ] = in_array($token, self::$yyExpectedTokens[ $state ], true)) {
                return true;
            }
        }
>>>>>>> gosa-core_v2.8
        $stack = $this->yystack;
        $yyidx = $this->yyidx;
        do {
            $yyact = $this->yy_find_shift_action($token);
            if ($yyact >= self::YYNSTATE && $yyact < self::YYNSTATE + self::YYNRULE) {
                // reduce action
                $done = 0;
                do {
<<<<<<< HEAD
                    if ($done++ == 100) {
=======
                    if ($done++ === 100) {
>>>>>>> gosa-core_v2.8
                        $this->yyidx = $yyidx;
                        $this->yystack = $stack;
                        // too much recursion prevents proper detection
                        // so give up
                        return true;
                    }
                    $yyruleno = $yyact - self::YYNSTATE;
<<<<<<< HEAD
                    $this->yyidx -= self::$yyRuleInfo[$yyruleno]['rhs'];
                    $nextstate = $this->yy_find_reduce_action(
                        $this->yystack[$this->yyidx]->stateno,
                        self::$yyRuleInfo[$yyruleno]['lhs']);
                    if (isset(self::$yyExpectedTokens[$nextstate]) &&
                          in_array($token, self::$yyExpectedTokens[$nextstate], true)) {
=======
                    $this->yyidx -= self::$yyRuleInfo[ $yyruleno ][ 1 ];
                    $nextstate = $this->yy_find_reduce_action(
                        $this->yystack[ $this->yyidx ]->stateno,
                        self::$yyRuleInfo[ $yyruleno ][ 0 ]
                    );
                    if (isset($res2[ $nextstate ][ $token ])) {
                        if ($res2[ $nextstate ][ $token ]) {
>>>>>>> gosa-core_v2.8
                        $this->yyidx = $yyidx;
                        $this->yystack = $stack;
                        return true;
                    }
<<<<<<< HEAD
=======
                    } else {
                        if ($res2[ $nextstate ][ $token ] =
                            (isset(self::$yyExpectedTokens[ $nextstate ]) &&
                             in_array($token, self::$yyExpectedTokens[ $nextstate ], true))) {
                            $this->yyidx = $yyidx;
                            $this->yystack = $stack;
                            return true;
                        }
                    }
>>>>>>> gosa-core_v2.8
                    if ($nextstate < self::YYNSTATE) {
                        // we need to shift a non-terminal
                        $this->yyidx++;
                        $x = new TPC_yyStackEntry;
                        $x->stateno = $nextstate;
<<<<<<< HEAD
                        $x->major = self::$yyRuleInfo[$yyruleno]['lhs'];
                        $this->yystack[$this->yyidx] = $x;
                        continue 2;
                    } elseif ($nextstate == self::YYNSTATE + self::YYNRULE + 1) {
=======
                        $x->major = self::$yyRuleInfo[ $yyruleno ][ 0 ];
                        $this->yystack[ $this->yyidx ] = $x;
                        continue 2;
                    } elseif ($nextstate === self::YYNSTATE + self::YYNRULE + 1) {
>>>>>>> gosa-core_v2.8
                        $this->yyidx = $yyidx;
                        $this->yystack = $stack;
                        if (!$token) {
                            // end of input: this is valid
                            return true;
                        }
                        // the last token was just ignored, we can't accept
                        // by ignoring input, this is in essence ignoring a
                        // syntax error!
                        return false;
                    } elseif ($nextstate === self::YY_NO_ACTION) {
                        $this->yyidx = $yyidx;
                        $this->yystack = $stack;
                        // input accepted, but not shifted (I guess)
                        return true;
                    } else {
                        $yyact = $nextstate;
                    }
                } while (true);
            }
            break;
        } while (true);
        $this->yyidx = $yyidx;
        $this->yystack = $stack;
        return true;
    }

<<<<<<< HEAD
   function yy_find_shift_action($iLookAhead)
    {
        $stateno = $this->yystack[$this->yyidx]->stateno;

=======
    public function yy_find_shift_action($iLookAhead)
    {
        $stateno = $this->yystack[ $this->yyidx ]->stateno;
>>>>>>> gosa-core_v2.8
        /* if ($this->yyidx < 0) return self::YY_NO_ACTION;  */
        if (!isset(self::$yy_shift_ofst[$stateno])) {
            // no shift actions
            return self::$yy_default[$stateno];
        }
        $i = self::$yy_shift_ofst[$stateno];
        if ($i === self::YY_SHIFT_USE_DFLT) {
            return self::$yy_default[$stateno];
        }
<<<<<<< HEAD
        if ($iLookAhead == self::YYNOCODE) {
=======
        if ($iLookAhead === self::YYNOCODE) {
>>>>>>> gosa-core_v2.8
            return self::YY_NO_ACTION;
        }
        $i += $iLookAhead;
        if ($i < 0 || $i >= self::YY_SZ_ACTTAB ||
              self::$yy_lookahead[$i] != $iLookAhead) {
            if (count(self::$yyFallback) && $iLookAhead < count(self::$yyFallback)
                   && ($iFallback = self::$yyFallback[$iLookAhead]) != 0) {
<<<<<<< HEAD
                if (self::$yyTraceFILE) {
                    fwrite(self::$yyTraceFILE, self::$yyTracePrompt . "FALLBACK " .
                        $this->yyTokenName[$iLookAhead] . " => " .
=======
                if ($this->yyTraceFILE) {
                    fwrite($this->yyTraceFILE, $this->yyTracePrompt . 'FALLBACK ' .
                                               $this->yyTokenName[ $iLookAhead ] . ' => ' .
>>>>>>> gosa-core_v2.8
                        $this->yyTokenName[$iFallback] . "\n");
                }
                return $this->yy_find_shift_action($iFallback);
            }
            return self::$yy_default[$stateno];
        } else {
            return self::$yy_action[$i];
        }
    }

<<<<<<< HEAD
    function yy_find_reduce_action($stateno, $iLookAhead)
    {
        /* $stateno = $this->yystack[$this->yyidx]->stateno; */

=======
    public function yy_find_reduce_action($stateno, $iLookAhead)
    {
        /* $stateno = $this->yystack[$this->yyidx]->stateno; */
>>>>>>> gosa-core_v2.8
        if (!isset(self::$yy_reduce_ofst[$stateno])) {
            return self::$yy_default[$stateno];
        }
        $i = self::$yy_reduce_ofst[$stateno];
<<<<<<< HEAD
        if ($i == self::YY_REDUCE_USE_DFLT) {
            return self::$yy_default[$stateno];
        }
        if ($iLookAhead == self::YYNOCODE) {
=======
        if ($i === self::YY_REDUCE_USE_DFLT) {
            return self::$yy_default[ $stateno ];
        }
        if ($iLookAhead === self::YYNOCODE) {
>>>>>>> gosa-core_v2.8
            return self::YY_NO_ACTION;
        }
        $i += $iLookAhead;
        if ($i < 0 || $i >= self::YY_SZ_ACTTAB ||
              self::$yy_lookahead[$i] != $iLookAhead) {
            return self::$yy_default[$stateno];
        } else {
            return self::$yy_action[$i];
        }
    }

<<<<<<< HEAD
    function yy_shift($yyNewState, $yyMajor, $yypMinor)
=======
    public function yy_shift($yyNewState, $yyMajor, $yypMinor)
>>>>>>> gosa-core_v2.8
    {
        $this->yyidx++;
        if ($this->yyidx >= self::YYSTACKDEPTH) {
            $this->yyidx--;
<<<<<<< HEAD
            if (self::$yyTraceFILE) {
                fprintf(self::$yyTraceFILE, "%sStack Overflow!\n", self::$yyTracePrompt);
=======
            if ($this->yyTraceFILE) {
                fprintf($this->yyTraceFILE, "%sStack Overflow!\n", $this->yyTracePrompt);
>>>>>>> gosa-core_v2.8
            }
            while ($this->yyidx >= 0) {
                $this->yy_pop_parser_stack();
            }
<<<<<<< HEAD
#line 125 "smarty_internal_configfileparser.y"

    $this->internalError = true;
    $this->compiler->trigger_config_file_error("Stack overflow in configfile parser");
#line 593 "smarty_internal_configfileparser.php"
=======
            // line 239 "../smarty/lexer/smarty_internal_configfileparser.y"
            $this->internalError = true;
            $this->compiler->trigger_config_file_error('Stack overflow in configfile parser');
>>>>>>> gosa-core_v2.8
            return;
        }
        $yytos = new TPC_yyStackEntry;
        $yytos->stateno = $yyNewState;
        $yytos->major = $yyMajor;
        $yytos->minor = $yypMinor;
<<<<<<< HEAD
        array_push($this->yystack, $yytos);
        if (self::$yyTraceFILE && $this->yyidx > 0) {
            fprintf(self::$yyTraceFILE, "%sShift %d\n", self::$yyTracePrompt,
                $yyNewState);
            fprintf(self::$yyTraceFILE, "%sStack:", self::$yyTracePrompt);
            for($i = 1; $i <= $this->yyidx; $i++) {
                fprintf(self::$yyTraceFILE, " %s",
                    $this->yyTokenName[$this->yystack[$i]->major]);
            }
            fwrite(self::$yyTraceFILE,"\n");
        }
    }

    static public $yyRuleInfo = array(
  array( 'lhs' => 20, 'rhs' => 2 ),
  array( 'lhs' => 21, 'rhs' => 1 ),
  array( 'lhs' => 22, 'rhs' => 2 ),
  array( 'lhs' => 22, 'rhs' => 0 ),
  array( 'lhs' => 24, 'rhs' => 5 ),
  array( 'lhs' => 24, 'rhs' => 6 ),
  array( 'lhs' => 23, 'rhs' => 2 ),
  array( 'lhs' => 23, 'rhs' => 2 ),
  array( 'lhs' => 23, 'rhs' => 0 ),
  array( 'lhs' => 26, 'rhs' => 3 ),
  array( 'lhs' => 27, 'rhs' => 1 ),
  array( 'lhs' => 27, 'rhs' => 1 ),
  array( 'lhs' => 27, 'rhs' => 1 ),
  array( 'lhs' => 27, 'rhs' => 1 ),
  array( 'lhs' => 27, 'rhs' => 1 ),
  array( 'lhs' => 27, 'rhs' => 3 ),
  array( 'lhs' => 27, 'rhs' => 2 ),
  array( 'lhs' => 27, 'rhs' => 1 ),
  array( 'lhs' => 27, 'rhs' => 1 ),
  array( 'lhs' => 25, 'rhs' => 1 ),
  array( 'lhs' => 25, 'rhs' => 2 ),
  array( 'lhs' => 25, 'rhs' => 3 ),
    );

    static public $yyReduceMap = array(
        0 => 0,
        2 => 0,
        3 => 0,
        19 => 0,
        20 => 0,
        21 => 0,
        1 => 1,
        4 => 4,
        5 => 5,
        6 => 6,
        7 => 7,
        8 => 8,
        9 => 9,
        10 => 10,
        11 => 11,
        12 => 12,
        13 => 13,
        14 => 14,
        15 => 15,
        16 => 16,
        17 => 17,
        18 => 17,
    );
#line 131 "smarty_internal_configfileparser.y"
    function yy_r0(){
    $this->_retvalue = null;
    }
#line 666 "smarty_internal_configfileparser.php"
#line 136 "smarty_internal_configfileparser.y"
    function yy_r1(){
    $this->add_global_vars($this->yystack[$this->yyidx + 0]->minor); $this->_retvalue = null;
    }
#line 671 "smarty_internal_configfileparser.php"
#line 149 "smarty_internal_configfileparser.y"
    function yy_r4(){
    $this->add_section_vars($this->yystack[$this->yyidx + -3]->minor, $this->yystack[$this->yyidx + 0]->minor);
    $this->_retvalue = null;
    }
#line 677 "smarty_internal_configfileparser.php"
#line 154 "smarty_internal_configfileparser.y"
    function yy_r5(){
    if ($this->smarty->config_read_hidden) {
        $this->add_section_vars($this->yystack[$this->yyidx + -3]->minor, $this->yystack[$this->yyidx + 0]->minor);
    }
    $this->_retvalue = null;
    }
#line 685 "smarty_internal_configfileparser.php"
#line 162 "smarty_internal_configfileparser.y"
    function yy_r6(){
    $this->_retvalue = $this->yystack[$this->yyidx + -1]->minor;
    }
#line 690 "smarty_internal_configfileparser.php"
#line 166 "smarty_internal_configfileparser.y"
    function yy_r7(){
    $this->_retvalue = array_merge($this->yystack[$this->yyidx + -1]->minor, Array($this->yystack[$this->yyidx + 0]->minor));
    }
#line 695 "smarty_internal_configfileparser.php"
#line 170 "smarty_internal_configfileparser.y"
    function yy_r8(){
    $this->_retvalue = Array();
    }
#line 700 "smarty_internal_configfileparser.php"
#line 176 "smarty_internal_configfileparser.y"
    function yy_r9(){
    $this->_retvalue = Array("key" => $this->yystack[$this->yyidx + -2]->minor, "value" => $this->yystack[$this->yyidx + 0]->minor);
    }
#line 705 "smarty_internal_configfileparser.php"
#line 181 "smarty_internal_configfileparser.y"
    function yy_r10(){
    $this->_retvalue = (float) $this->yystack[$this->yyidx + 0]->minor;
    }
#line 710 "smarty_internal_configfileparser.php"
#line 185 "smarty_internal_configfileparser.y"
    function yy_r11(){
    $this->_retvalue = (int) $this->yystack[$this->yyidx + 0]->minor;
    }
#line 715 "smarty_internal_configfileparser.php"
#line 189 "smarty_internal_configfileparser.y"
    function yy_r12(){
    $this->_retvalue = $this->parse_bool($this->yystack[$this->yyidx + 0]->minor);
    }
#line 720 "smarty_internal_configfileparser.php"
#line 193 "smarty_internal_configfileparser.y"
    function yy_r13(){
    $this->_retvalue = self::parse_single_quoted_string($this->yystack[$this->yyidx + 0]->minor);
    }
#line 725 "smarty_internal_configfileparser.php"
#line 197 "smarty_internal_configfileparser.y"
    function yy_r14(){
    $this->_retvalue = self::parse_double_quoted_string($this->yystack[$this->yyidx + 0]->minor);
    }
#line 730 "smarty_internal_configfileparser.php"
#line 201 "smarty_internal_configfileparser.y"
    function yy_r15(){
    $this->_retvalue = self::parse_tripple_double_quoted_string($this->yystack[$this->yyidx + -1]->minor);
    }
#line 735 "smarty_internal_configfileparser.php"
#line 205 "smarty_internal_configfileparser.y"
    function yy_r16(){
    $this->_retvalue = '';
    }
#line 740 "smarty_internal_configfileparser.php"
#line 209 "smarty_internal_configfileparser.y"
    function yy_r17(){
    $this->_retvalue = $this->yystack[$this->yyidx + 0]->minor;
    }
#line 745 "smarty_internal_configfileparser.php"

    private $_retvalue;

    function yy_reduce($yyruleno)
    {
        $yymsp = $this->yystack[$this->yyidx];
        if (self::$yyTraceFILE && $yyruleno >= 0
              && $yyruleno < count(self::$yyRuleName)) {
            fprintf(self::$yyTraceFILE, "%sReduce (%d) [%s].\n",
                self::$yyTracePrompt, $yyruleno,
                self::$yyRuleName[$yyruleno]);
        }

        $this->_retvalue = $yy_lefthand_side = null;
        if (array_key_exists($yyruleno, self::$yyReduceMap)) {
=======
        $this->yystack[] = $yytos;
        if ($this->yyTraceFILE && $this->yyidx > 0) {
            fprintf(
                $this->yyTraceFILE,
                "%sShift %d\n",
                $this->yyTracePrompt,
                $yyNewState
            );
            fprintf($this->yyTraceFILE, "%sStack:", $this->yyTracePrompt);
            for ($i = 1; $i <= $this->yyidx; $i++) {
                fprintf(
                    $this->yyTraceFILE,
                    " %s",
                    $this->yyTokenName[ $this->yystack[ $i ]->major ]
                );
            }
            fwrite($this->yyTraceFILE, "\n");
        }
    }

    public function yy_r0()
    {
        $this->_retvalue = null;
    }

    public function yy_r1()
    {
        $this->add_global_vars($this->yystack[ $this->yyidx + 0 ]->minor);
        $this->_retvalue = null;
    }

    public function yy_r4()
    {
        $this->add_section_vars($this->yystack[ $this->yyidx + -3 ]->minor, $this->yystack[ $this->yyidx + 0 ]->minor);
        $this->_retvalue = null;
    }

    // line 245 "../smarty/lexer/smarty_internal_configfileparser.y"
    public function yy_r5()
    {
        if ($this->configReadHidden) {
            $this->add_section_vars(
                $this->yystack[ $this->yyidx + -3 ]->minor,
                $this->yystack[ $this->yyidx + 0 ]->minor
            );
        }
        $this->_retvalue = null;
    }

    // line 250 "../smarty/lexer/smarty_internal_configfileparser.y"
    public function yy_r6()
    {
        $this->_retvalue = $this->yystack[ $this->yyidx + -1 ]->minor;
    }

    // line 264 "../smarty/lexer/smarty_internal_configfileparser.y"
    public function yy_r7()
    {
        $this->_retvalue =
            array_merge($this->yystack[ $this->yyidx + -1 ]->minor, array($this->yystack[ $this->yyidx + 0 ]->minor));
    }

    // line 269 "../smarty/lexer/smarty_internal_configfileparser.y"
    public function yy_r8()
    {
        $this->_retvalue = array();
    }

    // line 277 "../smarty/lexer/smarty_internal_configfileparser.y"
    public function yy_r9()
    {
        $this->_retvalue =
            array(
                'key'   => $this->yystack[ $this->yyidx + -2 ]->minor,
                'value' => $this->yystack[ $this->yyidx + 0 ]->minor
            );
    }

    // line 281 "../smarty/lexer/smarty_internal_configfileparser.y"
    public function yy_r10()
    {
        $this->_retvalue = (float)$this->yystack[ $this->yyidx + 0 ]->minor;
    }

    // line 285 "../smarty/lexer/smarty_internal_configfileparser.y"
    public function yy_r11()
    {
        $this->_retvalue = (int)$this->yystack[ $this->yyidx + 0 ]->minor;
    }

    // line 291 "../smarty/lexer/smarty_internal_configfileparser.y"
    public function yy_r12()
    {
        $this->_retvalue = $this->parse_bool($this->yystack[ $this->yyidx + 0 ]->minor);
    }

    // line 296 "../smarty/lexer/smarty_internal_configfileparser.y"
    public function yy_r13()
    {
        $this->_retvalue = self::parse_single_quoted_string($this->yystack[ $this->yyidx + 0 ]->minor);
    }

    // line 300 "../smarty/lexer/smarty_internal_configfileparser.y"
    public function yy_r14()
    {
        $this->_retvalue = self::parse_double_quoted_string($this->yystack[ $this->yyidx + 0 ]->minor);
    }

    // line 304 "../smarty/lexer/smarty_internal_configfileparser.y"
    public function yy_r15()
    {
        $this->_retvalue = self::parse_tripple_double_quoted_string($this->yystack[ $this->yyidx + -1 ]->minor);
    }

    // line 308 "../smarty/lexer/smarty_internal_configfileparser.y"
    public function yy_r16()
    {
        $this->_retvalue = '';
    }

    // line 312 "../smarty/lexer/smarty_internal_configfileparser.y"
    public function yy_r17()
    {
        $this->_retvalue = $this->yystack[ $this->yyidx + 0 ]->minor;
    }

    // line 316 "../smarty/lexer/smarty_internal_configfileparser.y"
    public function yy_reduce($yyruleno)
    {
        if ($this->yyTraceFILE && $yyruleno >= 0
            && $yyruleno < count(self::$yyRuleName)) {
            fprintf(
                $this->yyTraceFILE,
                "%sReduce (%d) [%s].\n",
                $this->yyTracePrompt,
                $yyruleno,
                self::$yyRuleName[ $yyruleno ]
            );
        }
        $this->_retvalue = $yy_lefthand_side = null;
        if (isset(self::$yyReduceMap[ $yyruleno ])) {
>>>>>>> gosa-core_v2.8
            // call the action
            $this->_retvalue = null;
            $this->{'yy_r' . self::$yyReduceMap[$yyruleno]}();
            $yy_lefthand_side = $this->_retvalue;
        }
<<<<<<< HEAD
        $yygoto = self::$yyRuleInfo[$yyruleno]['lhs'];
        $yysize = self::$yyRuleInfo[$yyruleno]['rhs'];
=======
        $yygoto = self::$yyRuleInfo[ $yyruleno ][ 0 ];
        $yysize = self::$yyRuleInfo[ $yyruleno ][ 1 ];
>>>>>>> gosa-core_v2.8
        $this->yyidx -= $yysize;
        for($i = $yysize; $i; $i--) {
            // pop all of the right-hand side parameters
            array_pop($this->yystack);
        }
        $yyact = $this->yy_find_reduce_action($this->yystack[$this->yyidx]->stateno, $yygoto);
        if ($yyact < self::YYNSTATE) {
<<<<<<< HEAD
            if (!self::$yyTraceFILE && $yysize) {
=======
            if (!$this->yyTraceFILE && $yysize) {
>>>>>>> gosa-core_v2.8
                $this->yyidx++;
                $x = new TPC_yyStackEntry;
                $x->stateno = $yyact;
                $x->major = $yygoto;
                $x->minor = $yy_lefthand_side;
                $this->yystack[$this->yyidx] = $x;
            } else {
                $this->yy_shift($yyact, $yygoto, $yy_lefthand_side);
            }
<<<<<<< HEAD
        } elseif ($yyact == self::YYNSTATE + self::YYNRULE + 1) {
=======
        } elseif ($yyact === self::YYNSTATE + self::YYNRULE + 1) {
>>>>>>> gosa-core_v2.8
            $this->yy_accept();
        }
    }

<<<<<<< HEAD
    function yy_parse_failed()
    {
        if (self::$yyTraceFILE) {
            fprintf(self::$yyTraceFILE, "%sFail!\n", self::$yyTracePrompt);
=======
    // line 320 "../smarty/lexer/smarty_internal_configfileparser.y"
    public function yy_parse_failed()
    {
        if ($this->yyTraceFILE) {
            fprintf($this->yyTraceFILE, "%sFail!\n", $this->yyTracePrompt);
>>>>>>> gosa-core_v2.8
        }
        while ($this->yyidx >= 0) {
            $this->yy_pop_parser_stack();
        }
    }

<<<<<<< HEAD
    function yy_syntax_error($yymajor, $TOKEN)
    {
#line 118 "smarty_internal_configfileparser.y"

    $this->internalError = true;
    $this->yymajor = $yymajor;
    $this->compiler->trigger_config_file_error();
#line 808 "smarty_internal_configfileparser.php"
    }

    function yy_accept()
    {
        if (self::$yyTraceFILE) {
            fprintf(self::$yyTraceFILE, "%sAccept!\n", self::$yyTracePrompt);
        }
        while ($this->yyidx >= 0) {
            $stack = $this->yy_pop_parser_stack();
        }
#line 110 "smarty_internal_configfileparser.y"

    $this->successful = !$this->internalError;
    $this->internalError = false;
    $this->retvalue = $this->_retvalue;
    //echo $this->retvalue."\n\n";
#line 826 "smarty_internal_configfileparser.php"
    }

    function doParse($yymajor, $yytokenvalue)
    {
        $yyerrorhit = 0;   /* True if yymajor has invoked an error */

=======
    // line 324 "../smarty/lexer/smarty_internal_configfileparser.y"
    public function yy_syntax_error($yymajor, $TOKEN)
    {
        // line 232 "../smarty/lexer/smarty_internal_configfileparser.y"
        $this->internalError = true;
        $this->yymajor = $yymajor;
        $this->compiler->trigger_config_file_error();
    }

    public function yy_accept()
    {
        if ($this->yyTraceFILE) {
            fprintf($this->yyTraceFILE, "%sAccept!\n", $this->yyTracePrompt);
        }
        while ($this->yyidx >= 0) {
            $this->yy_pop_parser_stack();
        }
        // line 225 "../smarty/lexer/smarty_internal_configfileparser.y"
        $this->successful = !$this->internalError;
        $this->internalError = false;
        $this->retvalue = $this->_retvalue;
    }

    public function doParse($yymajor, $yytokenvalue)
    {
        $yyerrorhit = 0;   /* True if yymajor has invoked an error */
>>>>>>> gosa-core_v2.8
        if ($this->yyidx === null || $this->yyidx < 0) {
            $this->yyidx = 0;
            $this->yyerrcnt = -1;
            $x = new TPC_yyStackEntry;
            $x->stateno = 0;
            $x->major = 0;
            $this->yystack = array();
<<<<<<< HEAD
            array_push($this->yystack, $x);
        }
        $yyendofinput = ($yymajor==0);

        if (self::$yyTraceFILE) {
            fprintf(self::$yyTraceFILE, "%sInput %s\n",
                self::$yyTracePrompt, $this->yyTokenName[$yymajor]);
        }

=======
            $this->yystack[] = $x;
        }
        $yyendofinput = ($yymajor == 0);
        if ($this->yyTraceFILE) {
            fprintf(
                $this->yyTraceFILE,
                "%sInput %s\n",
                $this->yyTracePrompt,
                $this->yyTokenName[ $yymajor ]
            );
        }
>>>>>>> gosa-core_v2.8
        do {
            $yyact = $this->yy_find_shift_action($yymajor);
            if ($yymajor < self::YYERRORSYMBOL &&
                  !$this->yy_is_expected_token($yymajor)) {
                // force a syntax error
                $yyact = self::YY_ERROR_ACTION;
            }
            if ($yyact < self::YYNSTATE) {
                $this->yy_shift($yyact, $yymajor, $yytokenvalue);
                $this->yyerrcnt--;
                if ($yyendofinput && $this->yyidx >= 0) {
                    $yymajor = 0;
                } else {
                    $yymajor = self::YYNOCODE;
                }
            } elseif ($yyact < self::YYNSTATE + self::YYNRULE) {
                $this->yy_reduce($yyact - self::YYNSTATE);
<<<<<<< HEAD
            } elseif ($yyact == self::YY_ERROR_ACTION) {
                if (self::$yyTraceFILE) {
                    fprintf(self::$yyTraceFILE, "%sSyntax Error!\n",
                        self::$yyTracePrompt);
=======
            } elseif ($yyact === self::YY_ERROR_ACTION) {
                if ($this->yyTraceFILE) {
                    fprintf(
                        $this->yyTraceFILE,
                        "%sSyntax Error!\n",
                        $this->yyTracePrompt
                    );
>>>>>>> gosa-core_v2.8
                }
                if (self::YYERRORSYMBOL) {
                    if ($this->yyerrcnt < 0) {
                        $this->yy_syntax_error($yymajor, $yytokenvalue);
                    }
                    $yymx = $this->yystack[$this->yyidx]->major;
<<<<<<< HEAD
                    if ($yymx == self::YYERRORSYMBOL || $yyerrorhit ){
                        if (self::$yyTraceFILE) {
                            fprintf(self::$yyTraceFILE, "%sDiscard input token %s\n",
                                self::$yyTracePrompt, $this->yyTokenName[$yymajor]);
=======
                    if ($yymx === self::YYERRORSYMBOL || $yyerrorhit) {
                        if ($this->yyTraceFILE) {
                            fprintf(
                                $this->yyTraceFILE,
                                "%sDiscard input token %s\n",
                                $this->yyTracePrompt,
                                $this->yyTokenName[ $yymajor ]
                            );
>>>>>>> gosa-core_v2.8
                        }
                        $this->yy_destructor($yymajor, $yytokenvalue);
                        $yymajor = self::YYNOCODE;
                    } else {
                        while ($this->yyidx >= 0 &&
<<<<<<< HEAD
                                 $yymx != self::YYERRORSYMBOL &&
=======
                               $yymx !== self::YYERRORSYMBOL &&
>>>>>>> gosa-core_v2.8
        ($yyact = $this->yy_find_shift_action(self::YYERRORSYMBOL)) >= self::YYNSTATE
                              ){
                            $this->yy_pop_parser_stack();
                        }
                        if ($this->yyidx < 0 || $yymajor==0) {
                            $this->yy_destructor($yymajor, $yytokenvalue);
                            $this->yy_parse_failed();
                            $yymajor = self::YYNOCODE;
<<<<<<< HEAD
                        } elseif ($yymx != self::YYERRORSYMBOL) {
=======
                        } elseif ($yymx !== self::YYERRORSYMBOL) {
>>>>>>> gosa-core_v2.8
                            $u2 = 0;
                            $this->yy_shift($yyact, self::YYERRORSYMBOL, $u2);
                        }
                    }
                    $this->yyerrcnt = 3;
                    $yyerrorhit = 1;
                } else {
                    if ($this->yyerrcnt <= 0) {
                        $this->yy_syntax_error($yymajor, $yytokenvalue);
                    }
                    $this->yyerrcnt = 3;
                    $this->yy_destructor($yymajor, $yytokenvalue);
                    if ($yyendofinput) {
                        $this->yy_parse_failed();
                    }
                    $yymajor = self::YYNOCODE;
                }
            } else {
                $this->yy_accept();
                $yymajor = self::YYNOCODE;
            }
<<<<<<< HEAD
        } while ($yymajor != self::YYNOCODE && $this->yyidx >= 0);
    }
}
?>
=======
        } while ($yymajor !== self::YYNOCODE && $this->yyidx >= 0);
    }

    /**
     * parse optional boolean keywords
     *
     * @param string $str
     *
     * @return bool
     */
    private function parse_bool($str)
    {
        $str = strtolower($str);
        if (in_array($str, array('on', 'yes', 'true'))) {
            $res = true;
        } else {
            $res = false;
        }
        return $res;
    }

    /**
     * set a config variable in target array
     *
     * @param array $var
     * @param array $target_array
     */
    private function set_var(array $var, array &$target_array)
    {
        $key = $var[ 'key' ];
        $value = $var[ 'value' ];
        if ($this->configOverwrite || !isset($target_array[ 'vars' ][ $key ])) {
            $target_array[ 'vars' ][ $key ] = $value;
        } else {
            settype($target_array[ 'vars' ][ $key ], 'array');
            $target_array[ 'vars' ][ $key ][] = $value;
        }
    }

    /**
     * add config variable to global vars
     *
     * @param array $vars
     */
    private function add_global_vars(array $vars)
    {
        if (!isset($this->compiler->config_data[ 'vars' ])) {
            $this->compiler->config_data[ 'vars' ] = array();
        }
        foreach ($vars as $var) {
            $this->set_var($var, $this->compiler->config_data);
        }
    }

    /**
     * add config variable to section
     *
     * @param string $section_name
     * @param array  $vars
     */
    private function add_section_vars($section_name, array $vars)
    {
        if (!isset($this->compiler->config_data[ 'sections' ][ $section_name ][ 'vars' ])) {
            $this->compiler->config_data[ 'sections' ][ $section_name ][ 'vars' ] = array();
        }
        foreach ($vars as $var) {
            $this->set_var($var, $this->compiler->config_data[ 'sections' ][ $section_name ]);
        }
    }
}
>>>>>>> gosa-core_v2.8
