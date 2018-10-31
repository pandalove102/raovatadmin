<?php 
class catagorymodel extends model
{
	function __construct()
	{
		parent::__construct();
		$this->table = 'catagories';
	}
	
	// function listcatagories($id='')
	// {
	// 	$add = '';
	// 	if($id)
	// 		$add = ' and id != '.$id;
	// 	$sql = "select *,(select pa.name from `catagories` pa where pa.id=`catagories`.parent_id) paname from `catagories` where hide = 1 $add";
	// 	$this->setQuery($sql);
	// 	return $this->loadAllRow();
	// }
	
	// load all ( chưa phân trang )
	// function listparent($id = 0)
	// {
    //  	$sql = "select * from `" . $this->table . "` where parent_id=$id and hide = 1 ";
	// 	$this->setQuery($sql);
	// 	return $this->loadAllRow();
	// }

	function listcatagories($id='')
	{
		$add = '';
		if($id)
			$add = ' and parent_id = '.$id;
		$sql = "select *,(select pa.name from `catagories` pa where pa.id=`catagories`.parent_id) paname from `catagories` where hide = 1 $add";
		$this->setQuery($sql);
		return $this->loadAllRow();
	}
	// load phân trang 
	function listparent($pos,$numrow,$id = 0)
	{
		
		if($numrow>0)
		{
			$this->limit = " limit $pos,$numrow";
		}
    	 $sql = "select * from `" . $this->table . "` where parent_id=$id and hide = 1 {$this->limit} ";
		$this->setQuery($sql);
		return $this->loadAllRow();
	}
	function total()
	{
		$sql = "select count(*) as total from " . $this->table . " where hide = 1 and parent_id=0 ";
		$this->setQuery($sql);
		return $this->loadRow()->total;
	}
   	function listnice()
	{
     	$sql = "select id,name,parent_id from `" . $this->table . "` where hide = 1 ";
		$this->setQuery($sql);
		return $this->loadAllRow();
	}
   
	function detail($id)
	{
		return $this->getone($id);	
	}
	function checknameedit($name,$id)
	{
	    $sql = "select * from `" . $this->table . "` where name=? and hide=1 and id != ? ";
		$this->setQuery($sql);
		return $this->loadRow(array($name,$id));	
	}
	function checkaliasedit($name,$id)
	{
	    $sql = "select * from `" . $this->table . "` where  alias=? and hide=1 and id != ? ";
		$this->setQuery($sql);
		return $this->loadRow(array($name,$id));	
	}
	function searchcatagory($pos,$numrow,$key = '')
	{
		$w = ' where hide=1 ';
		if($numrow>0)
		{
			$this->limit = " limit $pos,$numrow";
		}
		if($key != '')
		{
			$w .= " and name LIKE '%$key%'";
		}
		echo $sql = "select * from `" . $this->table . "` $w {$this->limit} ";
		$this->setQuery($sql);
		return $this->loadAllRow();
	}
	
}

?>