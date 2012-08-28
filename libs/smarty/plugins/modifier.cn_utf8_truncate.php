<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty cn_utf8_truncate.php modifier plugin
 *
 * Type:     modifier<br>
 * Name:     mb_truncate<br>
 * Purpose:  Truncate a string to a certain length if necessary,
 *           optionally splitting in the middle of a word, and
 *           appending the $etc string or inserting $etc into the middle.
 * @link http://smarty.php.net/manual/en/language.modifier.truncate.php
 *          truncate (Smarty online manual)
 * @param string
 * @param integer
 * @param string
 * @param boolean
 * @param boolean
 * @return string
 */
function smarty_modifier_cn_utf8_truncate($string, $length = 20, $etc = '...') 
{
    if ($length == 0) {return '';}    
//    if (mb_strlen($string,'utf-8') > $length) {
//        return mb_substr($string, 0, $length,'utf-8').$etc;
//    } else {
//        return $string;
//    }
        
        if(mb_strlen($string,'UTF-8')>$length)
        {
            $string=mb_substr($string,0,$length,'utf-8').'...';
        }        
        $string=htmlspecialchars($string);
        return $string;
     
}
 

/* vim: set expandtab: */

?>