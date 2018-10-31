<?php 
class newsmodel extends model
{
	function __construct()
	{
		parent::__construct();
		$this->table = 'news';
	}

	function listnews($pos,$numrow)
	{
		if($numrow>0)
		{
			$this->limit = " limit $pos,$numrow";
		}
    	 $sql = "select * from `" . $this->table . "` where  hide = 1 {$this->limit} ";
		$this->setQuery($sql);
		return $this->loadAllRow();
	}
	function listnewssearch($pos,$numrow,$key='',$catagories_id= '', $status = '')
	{
		if($numrow>0)
		{
			$this->limit = " limit $pos,$numrow";
		}
		$w = ' where hide=1 ';
		if($key != '')
		{
			$w .= " and name LIKE '%$key%'  ";
		}
		if($status != '')
		{
			$w .= " and status = '$status'";
		}
		if($catagories_id != '')
		{
			$w .= " and catagories_id = '$catagories_id'";
		}
    	echo $sql = "select * from `" . $this->table . "`  $w  {$this->limit} ";
		$this->setQuery($sql);
		return $this->loadAllRow();
	}
	function listnewsid($pos,$numrow,$id)
	{
		if($numrow>0)
		{
			$this->limit = " and `username`=$id   limit $pos,$numrow";
		}
        $sql = "select * from `" . $this->table . "` where  hide = 1 {$this->limit} ";
		$this->setQuery($sql);
		return $this->loadAllRow();
	}
	function totalid($id)
	{
		$sql = "select count(*) as total from `" . $this->table . "` where  hide = 1 and `username`=$id ";
		$this->setQuery($sql);
		return $this->loadRow()->total;
	}
	
	function total()
	{
		$sql = "select count(*) as total from " . $this->table . " where hide = 1 ";
		$this->setQuery($sql);
		return $this->loadRow()->total;
	}
	function detail($id)
	{
		return $this->getone($id);	
	}
}

?>