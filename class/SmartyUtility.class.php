<?
/**
* Smarty wrapper class
* 
* @author  chenyifei <chenyifei@altech-it.cn>
* @version 20090717
* @see      Smarty.class.php
*/
// read Smarty class
require_once(ROOT_PATH . "libs/smarty/Smarty.class.php");

class SmartyUtility extends Smarty{

    /**
    * construct
    * 
    * @param 
    * @return 
    */
    function __construct(){
        
        parent::__construct();
        
        // Smarty directories
        $this->template_dir = SMARTY_PATH . 'tpl';
        $this->compile_dir  = SMARTY_PATH . 'tpl_c';
        //$this->cache_dir    = SMARTY_PATH . 'cache';
        //$this->config_dir   = SMARTY_PATH . 'configs';
        
        // clear cache
        //$this->clear_all_cache();
        
        // register PHP.number_format
        //$this->register_modifier("number_format", "number_format");
    }
    
}

?>