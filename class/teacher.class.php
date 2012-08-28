<?php
/**
 *  index class
 *
 * @author  chenyifei <chenyifei@altech-it.cn>
 * @version 20110223
 */
class Teacher
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
     * addTeach
     * @param array
     * @return 
     */
	function addTeach($request)
	{
		$pics = explode('.',$_FILES['picture']['name']);
		$photo = md5(uniqid(rand(), true)) . "." . $pics[1];
		$photopath = PHOTO_PATH . $photo;
		if (!move_uploaded_file($_FILES['picture']['tmp_name'], $photopath))
        {
            // failure
            header('HTTP/1.1 500 Internal Server Error');
            exit();
        }
        $request = $this->_db->escapeSql($request);
		$sql = sprintf(
					"insert into rlc_member_teacher(hanzi_name, pwd, pinyin_name, mail, sky_user,residence, level, picture, account, hobby) 
					values('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')", $request['hanzi_name'], md5($request['pwd']), 
					$request['pinyin_name'], $request['mail'], $request['sky_user'], $request['residence'], $request['level'],
					$photo, $request['account'], $request['hobby']
				);
		return $this->_db->Execute($sql);
	}
	/*
     * getTeach
     * @param
     * @return array
     */
	function getTeach()
	{
		$sql = "select * from rlc_member_teacher where flag =0 order by id desc";
		return $this->_db->GetAll($sql);
	}
	/*
     * delTeach
     * @param
     * @return bool
     */
	function delTeach($id)
	{
		$id = $this->_db->escapeSql($id);
		$sql = "update  rlc_member_teacher set flag = 1 where id = " . $id;
		return $this->_db->Execute($sql);
	}
	/*
     * getTeachById
     * @param int
     * @return array
     */
	function getTeachById($id)
	{
		$id = $this->_db->escapeSql($id);
		$sql = "select * from rlc_member_teacher where id=" . $id;
		return $this->_db->GetAll($sql);
	}
	/*
     * updateTeach
     * @param array
     * @return bool
     */
	function updateTeach($request)
	{
		$photo = "";
		if(!empty($_FILES['picture']['name']))
		{
			$pics = explode('.',$_FILES['picture']['name']);
			$photo = md5(uniqid(rand(), true)) . "." . $pics[1];
			$photopath = PHOTO_PATH . $photo;
			if (!move_uploaded_file($_FILES['picture']['tmp_name'], $photopath))
	        {
	            // failure , picture
	            header('HTTP/1.1 500 Internal Server Error');
	            exit();
	        }
	        $dataRows = $this->getTeachById($request['id']);
	        $oldPhotoPath = PHOTO_PATH . $dataRows[0]['picture'];
	        @unlink($oldPhotoPath);
		}
		$sql = "update rlc_member_teacher set hanzi_name='" . $request['hanzi_name'] . "', pwd='" . md5($request['pwd']) . "', 
				pinyin_name='" . $request['pinyin_name'] . "', mail='" . $request['mail'] . "', sky_user='" . $request['sky_user'] . "',
				residence='" . $request['residence'] . "', level='" . $request['level'] . "', account='" . $request['account'] . "',
			    hobby='" . $request['hobby'] . "'";
		if($photo != "")
		{
			$sql .= ",picture='" . $photo . "'";
		}
		$sql .= "  where id=". $request['id'];
		return $this->_db->Execute($sql);
		
	}
	/*
     * getAllStudent
     * @param 
     * @return array
     */
	function getAllStudent()
	{
		$sql = "select * from rlc_member_student order by id desc";
		return $this->_db->GetAll($sql);
	}
}
?>