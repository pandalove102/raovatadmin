<?php 
class statusmodel extends model
{
	function __construct()
	{
		parent::__construct();
		$this->table = 'status_product';
	}

	function status()
	{
		$sql = "select * from ". $this->table. "  where hide=1";
		$this->setQuery($sql);
		return $this->loadAllRow();
	}
	function liststatus($pos,$numrow)
	{
		if($numrow>0)
		{
			$this->limit = " limit $pos,$numrow";
		}
    	 $sql = "select * from `" . $this->table . "` where  hide = 1 {$this->limit} ";
		$this->setQuery($sql);
		return $this->loadAllRow();
	}
	function liststatusall()
	{
    	 $sql = "select * from `" . $this->table . "` where  hide = 1 ";
		$this->setQuery($sql);
		return $this->loadAllRow();
	}
	function total()
	{
		$sql = "select count(*) as total from " . $this->table . " where hide = 1";
		$this->setQuery($sql);
		return $this->loadRow()->total;
	}
	function detail($id)
	{
		return $this->getone($id);	
	}
	function searchstatus($key = '',$pos,$numrow)
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
		echo $sql = 'select * from '.$this->table.@$w." {$this->limit} ";
		$this->setQuery($sql);
		return $this->loadAllRow();
	}
}

?>