<?php
/**
 *	ADODB make instance class
 *
 * @author  chenyifei <chenyifei@altech-it.cn>
 * @version 200906717
*/
define("ADODB_ERROR_LOG_TYPE", 3);
define("ADODB_ERROR_LOG_DEST", ROOT_PATH . 'logs/error_db.log');
require_once(ROOT_PATH . "libs/adodb/adodb-errorhandler.inc.php");
require_once(ROOT_PATH . "libs/adodb/adodb.inc.php");
$ADODB_CACHE_DIR = ROOT_PATH . 'libs/adodb/cache';
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;

class ADODB
{
    /**
     *  getInstance
     *
     *  @access public
     *  @return object  DB instance
     */
    function &getInstance()
    {
        $conn =& ADONewConnection(DB_TYPE);
        //$conn->Connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_Port);
        $conn->Connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $conn->Execute("SET NAMES  '" . DB_CHARSET . "'");
        return $conn;
    }
}

?>