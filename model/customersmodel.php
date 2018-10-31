<?php 
class customersmodel extends model
{
	function __construct()
	{
		parent::__construct();
		$this->table = 'customers';
	}
	function listcustomers($pos,$numrow)
	{
		if($numrow>0)
		{
			$this->limit = " limit $pos,$numrow";
		}
    	$sql = "select c.*,g.fullname as fullnamegroups from `" . $this->table . "` c LEFT JOIN `groups` g on c.group_id=g.id where  c.hide = 1 {$this->limit} ";
		$this->setQuery($sql);
		return $this->loadAllRow();
	}
	function total()
	{
		$sql = "select count(*) as total from " . $this->table . " where hide = 1 ";
		$this->setQuery($sql);
		return $this->loadRow()->total;
	}
	function city()
	{
		$sql = "select *  from `city` where 1 ";
		$this->setQuery($sql);
		return $this->loadAllRow();
	}
	function groups()
	{
		$sql = "select *  from `groups` where 1 ";
		$this->setQuery($sql);
		return $this->loadAllRow();
	}
	function district($city="")
	{
		$add="1";
		if($city)
		{
			$add=" `cityid`=$city  ";
		}
	
		$sql = "select *  from `district` where  $add  ";
		$this->setQuery($sql);
		return $this->loadAllRow();
	}
	function districtcity($city)
	{
		$add='';
		if($city)
		{
			$add=" `cityid`=$city  ";
		}
	
		$sql = "select *  from `district` where  $add  ";
		$this->setQuery($sql);
		return $this->loadAllRow();

	}
	function detail($id)
	{
		return $this->getone($id);	
	}
	function searchcustomer($users = '', $emails = '', $groups = '', $status = '')
	{
		$w = ' where hide = 1 ';
		if($users != '')
		{
			$w .= " and name LIKE '%$users%'";
		}
		if($emails != '')
		{
			$w .= " and email LIKE '%$emails%'";
		}
		if($groups != '')
		{
			$w .= " and group_id = '$groups'";
		}
		if($status != '')
		{
			$w .= " and status = '$status'";
		}
		$sql = 'select * from '.$this->table.@$w;
		$this->setQuery($sql);
		return $this->loadAllRow();
	}
}

?>