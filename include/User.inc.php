<?php
/**
 * User common file
 * 
 * @author  chenyifei <chenyifei@altech-it.cn>
 * @version 20101224
 */
session_start();
header("Content-type:   text/html;   charset=UTF-8");
//ini_set("display_errors", "on"); 
// config
require_once(dirname(__FILE__) . "/Config.inc.php");
// Page
require_once(ROOT_PATH . "class/Page.class.php");
// Database
require_once(ROOT_PATH . "class/DatabaseAccess.class.php");
$Database =& new DatabaseAccess();
// Smarty
require_once(ROOT_PATH . "class/SmartyUtility.class.php");
$Smarty =& new SmartyUtility();
//teach
require_once(ROOT_PATH . "class/teacher.class.php");
$teacher = new Teacher();
//TeacherWork
require_once(ROOT_PATH . "class/TeacherWork.class.php");
$TeacherWork = new TeacherWork();
//member
require_once(ROOT_PATH . "class/member.class.php");
$member = new Member();
?>
