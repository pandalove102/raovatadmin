<?php 
class catagoriesmodel extends model
{
	function __construct()
	{
		parent::__construct();
		$this->table = 'new_catagories';
	}

	function listcatagories($pos,$numrow)
	{
		if($numrow>0)
		{
			$this->limit = " limit $pos,$numrow";
		}
		$sql = "select * from `" . $this->table . "` where hide = 1   {$this->limit} ";
		$this->setQuery($sql);
		return $this->loadAllRow();
	}
	function listcatagoriessearch($pos,$numrow,$key)
	{
		if($numrow>0)
		{
			$this->limit = " limit $pos,$numrow";
		}
		$w = ' where hide=1 ';
		if($key != '')
		{
			$w .= " and name LIKE '%$key%' || title LIKE '%$key%' ";
		}
		$sql = "select * from `" . $this->table . "`  $w  {$this->limit} ";
		$this->setQuery($sql);
		return $this->loadAllRow();
	}
	function listcatagoriesall()
	{
		$sql = "select * from `" . $this->table . "` where hide = 1  ";
		$this->setQuery($sql);
		return $this->loadAllRow();
	}
	function listparent($pos,$numrow)
	{
		if($numrow>0)
		{
			$this->limit = " limit $pos,$numrow";
		}
    	 $sql = "select *  from `" . $this->table . "` where parent_id=0 and hide = 1 {$this->limit} ";
		$this->setQuery($sql);
		return $this->loadAllRow(); 
	}
	function total()
	{
		$sql = "select count(*) as total from " . $this->table . " where hide = 1 and parent_id=0 ";
		$this->setQuery($sql);
		return $this->loadRow()->total;
	}
	
	function detail($id)
	{
		return $this->getone($id);	
	}
	function checknameedit($name,$id)
	{
	   echo  $sql = "select * from `" . $this->table . "` where name=? and id != ? ";
		$this->setQuery($sql);
		return $this->loadRow(array($name,$id));	
	}
	// function listattribute($pos,$numrow,$id)
	// {
	// 	if($numrow>0)
	// 	{
	// 		$this->limit = " limit $pos,$numrow";
	// 	}
	// 	$w = ' where hide=1 ';
	// 	if($id != '')
	// 	{
	// 		$w .= " and `parent_id`=$id  ";
	// 	}
	// 	$sql = "select * from `" . $this->table . "`  $w  {$this->limit} ";
	// 	$this->setQuery($sql);
	// 	return $this->loadAllRow();

	// }
}

?>