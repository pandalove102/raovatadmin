<?php 
class menumodel extends model
{
	function __construct()
	{
		parent::__construct();
		$this->table = 'menu';
	}

	function listmenu($pos,$numrow)
	{
		if($numrow>0)
		{
			$this->limit = " limit $pos,$numrow";
		}
    	 $sql = "select * from `" . $this->table . "` where  hide = 1 and parent_id=0 {$this->limit} ";
		$this->setQuery($sql);
		return $this->loadAllRow();
	}
	function listmenuall()
	{
	
    	$sql = "select * from `" . $this->table . "` where  hide = 1 ";
		$this->setQuery($sql);
		return $this->loadAllRow();
	}
	function listmenusearch($pos,$numrow,$key='')
	{
		$w = ' where hide=1 ';
		if($key != '')
		{
			$w .= " and name LIKE '%$key%'";
		}
		if($numrow>0)
		{
			$this->limit = " limit $pos,$numrow";
		}
    	 $sql = "select * from `" . $this->table . "` $w {$this->limit} ";
		$this->setQuery($sql);
		return $this->loadAllRow();
	}
	function listmenu_sub($id)
	{
		$w = ' where hide=1 ';
		if($id != '')
		{
			$w .= " and `parent_id`=$id ";
		}
    	$sql = "select * from `" . $this->table . "`  $w  ";
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
}

?>