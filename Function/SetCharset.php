<?php
require_once('Generic.php');

/**
* Converter: mysql_select_db
*
* @category   Functions
* @package    MySQLConverterTool
* @author     Nokim <nokim@ukr.net>
* @license    http://www.php.net/license/3_0.txt  PHP License 3.0
* @version    CVS: $Id:$, Release: @package_version@
* @link       http://www.mysql.com
* @since      Class available since Release 1.0
*/
class MySQLConverterTool_Function_SetCharset extends MySQLConverterTool_Function_Generic {
  
    
    public $new_name = 'mysqli_set_charset';

    
    public function __construct() {   
    }
  
    
    function handle(Array $params = array()) {
      
        // bool mysql_select_db ( string database_name [, resource link_identifier] )
        // mixed mysqli_query ( mysqli link, string query [, int resultmode] )
        
        if (count($params) < 1 || count($params) > 2)
            return array(self::PARSE_ERROR_WRONG_PARAMS, NULL);
        
        @list($charset, $conn) = $this->extractParamValues($params);
        if (is_null($conn)) 
            $conn = $this->ston_name;

        list($charset, $charset_type) = $this->extractValueAndType(trim($charset));            
        if ('const' == $charset_type) {
            $ret = sprintf('((bool)mysqli_set_charset(%s, constant(\'%s\')))', $conn, $charset);
        } else {
            $ret = sprintf('((bool)mysqli_set_charset(%s, "%s"))', $conn, $charset);
        }
        
        return array(null, $ret);
    }
    
    
    function getConversionHint() {
        
        return 'Direct mapping to mysqli_set_charset with swapping parameters.';
    }


}
?>
