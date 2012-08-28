<?php
/**
 * ADODB wrapper class
 * PHP4 & PHP5 available
 *
 * @author  chenyifei <chenyifei@altech-it.cn>
 * @version 20090717
*/
// read ADODB class file
require_once(ROOT_PATH . "class/ADODB.class.php");

class DatabaseAccess
{
    /**
     *  DB instance
     *
     *  @access public
     */
    var $db_obj;
    
    /**
     *  construct
     *
     *  @access public
     *  @return object
     */
    function DatabaseAccess()
    {
		$this->db_obj =& AdoDb::getInstance();
		if (!$this->db_obj)
		{
		    Error::setMessage('0002');
		}
    }
    
    /**
     *  Execute
     *
     *  @access public
     *  @return object
     */
    function Execute($sql)
    {
		return $this->db_obj->Execute($sql);
	}

    /**
     *  GetOne
     *
     *  @access public
     *  @return object
     */
    function GetOne($sql)
    {
		return $this->db_obj->GetOne($sql);
	}

    /**
     *  GetRow
     *
     *  @access public
     *  @return object
     */
    function GetRow($sql)
    {
		return $this->db_obj->GetRow($sql);
	}

    /**
     *  GetAll
     *
     *  @access public
     *  @return object
     */
    function GetAll($sql)
    {
		return $this->db_obj->GetAll($sql);
	}

    /**
     *  quote
     *
     *  @access public
     *  @return object
     */
    function quote($str, $request_flg = true)
    {
		if ($request_flg) {
			$magic_quotes_enabled = get_magic_quotes_gpc();
		} else {
			$magic_quotes_enabled = false;
		}
		return $this->db_obj->qstr($str, $magic_quotes_enabled);
	}

    /**
     *  qstr
     *
     *  @access public
     *  @return object
     */
    function qstr($str, $request_flg = true)
    {
		if ($request_flg) {
			$magic_quotes_enabled = get_magic_quotes_gpc();
		} else {
			$magic_quotes_enabled = false;
		}
		return $this->db_obj->qstr($str, $magic_quotes_enabled);
	}
	
    /**
     *  begin
     *
     *  @access public
     *  @return object
     */
    function begin()
    {
		return $this->db_obj->Execute("BEGIN");
	}

    /**
     *  rollback
     *
     *  @access public
     *  @return object
     */
    function rollback()
    {
		return $this->db_obj->Execute("ROLLBACK");
	}

    /**
     *  commit
     *
     *  @access public
     *  @return object
     */
    function commit()
    {
		return $this->db_obj->Execute("COMMIT");
	}

    /**
     *  start
     *
     *  @access public
     *  @return object
     */
    function start()
    {
		return $this->db_obj->StartTrans();
	}

    /**
     *  complete
     *
     *  @access public
     *  @return object
     */
    function complete($autoComplete = true)
    {
		return $this->db_obj->CompleteTrans($autoComplete);
	}
	
    /**
     *  escape MySQL
     *
     *  @param  string or N-array
     *  @return string or N-array
     */
    function escapeSql($text)
    {
        if (is_array($text))
        {
            foreach($text as $key => $value)
            {
                $text[$key] = $this->escapeSql($value);
            }
        }
        else 
        {
            $text = mysql_real_escape_string($text);
        }
        
        return $text;
    }
   
    /**
     *  insert_id
     *
     *  @access public
     *  @return object
     */
    function insert_id()
    {
        return $this->db_obj->insert_id();
    }  
     /**
     *  escape sql
     *
     *  @param  string or N-array
     *  @return string or N-array
     */
    function DB_Esc ($text ) 
    {
        if (is_array($text))
        {
            foreach($text as $key => $value)
            {
                $text[$key] = $this->DB_Esc($value);
            }
        }
        else 
        {
            $text = pg_escape_string($text);
        }
        
        return $text;
    }
}

?>
