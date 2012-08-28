<?php
/**
 * config file
 * 
 * @author  chenyifei <chenyifei@altech-it.cn>
 * @version 20090717
 */

// Host
define("HOST_NAME",     $_SERVER['SERVER_NAME']);
// URL
define("HTTP_URL",      'http://' . HOST_NAME . '/ajax_weather');
define("HTTPS_URL",     'https://' . HOST_NAME . '/ajax_weather/');
// Path
define("ROOT_PATH",     $_SERVER['DOCUMENT_ROOT'].'/ajax_weather/');
define("PHOTO_PATH",     $_SERVER['DOCUMENT_ROOT'].'/ajax_weather/upload/');
// Database
define("DB_TYPE",       'mysql');
define("DB_HOST",       'localhost');
define("DB_Port",       '3306');
define("DB_USER",       'root');
define("DB_PASS",       'root');
define("DB_NAME",       'rlc_wangke');
define("DB_CHARSET",    'utf8');
// Smarty template path
define("SMARTY_PATH",   ROOT_PATH);
// Pager
define("PAGE_LIMIT",    10);

?>
