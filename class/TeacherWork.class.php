<?php
/**
 *  TeacherWork class
 *
 * @author  zhangjie <zhangjie@altech-it.cn>
 * @version 20110223
 */
class TeacherWork
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
	function addTimes($request)
	{
		$request = $this->_db->escapeSql($request);
		$this->_db->begin();
		$count = 0;
		foreach ($request as $time)
		{
			try
			{
				$sql = sprintf("insert into rlc_member_work(teacher_id, date, StartTime, EndTime) values(%d, '%s', '%s', '%s')",
				$time['teacher_id'], $time['date'], $time['startDate'], $time['endDate']);
				$flag = $this->_db->Execute($sql);
				if(!$flag)
				{
					$this->_db->rollback();
					return false;
				}
				else
				{
					$count++;
				}
			}
			catch (Exception $e)
			{
                $this->_db->rollback();
                return false;
			}
		}
		
		if($count == count($request))
		{
			$this->_db->commit();
			return true;
		}
		else
		{
			$this->_db->rollback();
			return false;
		}
	}
}
?>