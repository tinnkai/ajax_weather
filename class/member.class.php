<?php
/**
 *  member class
 *
 * @author  wangzhoufeng <wangzhoufeng@altech-it.cn>
 * @version 20110223
 */
class Member
{
	/**
	 *  DB instance
	 */
	private $_db;

	/**
	 *  construct
	 *
	 *  @param
	 *  @return
	 */
	function __construct()
	{
		global $Database;

		if (!is_object($Database))
		{
			$this->_db = & new DatabaseAccess();
		}
		else
		{
			$this->_db = & $Database;
		}
	}
	/*
	 * insert table project_master
	 * @param  $user_code, $loginid,$password,$user_name,$section_code,$unit_price,$authority_code
	 * @return
	 */
	function insertMember_student($request)
	{
		$request = $this->_db->DB_Esc($request);
		$sql = "insert into rlc_member_student (hanzi_name,riwen_name,login_id,mail,pwd,sky_user,level,file,source)values('".$request['hanzi_name']."','".$request['riwen_name']."','".$request['login_id']."','".$request['mail']."','".md5($request['pwd'])."','".$request['sky_user']."','".$request['level']."','".$request['file']."','".$request['source']."')";
		$res=$this->_db->Execute($sql);
		return $res;
	}
     /**
     *  getOneUser
     *
     *  @return  array
     */
    function getOneUser($mail)
	{
		$request = $this->_db->DB_Esc($mail);
		$sql = "select * from rlc_member_student where mail ='". $mail ."'";
        return $this->_db->GetAll($sql);
	}
	/**
     *   check user
     *
     *  @param $_POST 
     *  @return  array
     */
    function checkUser($user)
	{
		$user = $this->_db->DB_Esc($user);
		$sql = "select * from rlc_member_student where mail='". $user ."'";
        return $this->_db->GetRow($sql);
	}
	/**
     *  login check
     *
     *  @param $_POST 
     *  @return  array
     */
    function checkLogin($user, $pwd)
	{
		$user = $this->_db->DB_Esc($user);
		$pwd  = $this->_db->DB_Esc($pwd);
		$sql  = "select * from rlc_member_student where mail='". $user ."' and pwd = '".md5($pwd)."'";
        return $this->_db->GetRow($sql);
	}
	/*
	 * check empty
	 * @param
	 * @return
	 */
	function authEmpty($pram, $error = null)
	{
		if (strlen($pram)<1)
		{
			$this->error = $error;
			return false;
		}
		else
		{
			return true;
		}
	}
	/*
	 * check mail
	 * @param
	 * @return
	 */
	function checkMail($str)
	{
		$patt_email = "/^[_a-zA-Z0-9-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,4}$/";
		if (preg_match($patt_email, $str))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
    /**
     *  getMemberBooking
     *
     *  @return  array
     */
    function getMemberBooking($student_id)
	{
		$student_id = $this->_db->DB_Esc($student_id);
		$sql = "select s.*, t.hanzi_name as hanzi_name, t.sky_user as sky_user from rlc_member_work_status as s left join  rlc_member_teacher as t on s.teacher_id=t.id  where s.student_id = '".$student_id."' and  s.status > 0";
        return $this->_db->GetAll($sql);
	}
	 /**
     *  getMemberHistory
     *
     *  @return  array
     */
    function getMemberHistory($student_id)
	{
		$student_id = $this->_db->DB_Esc($student_id);
		$sql = "select s.*, t.hanzi_name as hanzi_name, t.sky_user as sky_user from rlc_member_work_status as s left join  rlc_member_teacher as t on s.teacher_id=t.id  where s.student_id = '".$student_id."' and  s.status = 0";
        return $this->_db->GetAll($sql);
	}
	/**
     *  delMemberBooking
     *
     *  @return  array
     */
    function delMemberBooking($request)
	{
		$request = $this->_db->DB_Esc($request);
		$sql = "delete from rlc_member_work_status  where student_id = '".$request['customer_code']."' and  s.status > 0";
        return $this->_db->GetAll($sql);
	}
	
}
?>