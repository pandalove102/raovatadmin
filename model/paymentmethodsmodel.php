<?php 
class paymentmethodsmodel extends model
{
	function __construct()
	{
		parent::__construct();
		$this->table = 'paymentmethods';
	}

	function listpaymentmethods($pos,$numrow)
	{
		if($numrow>0)
		{
			$this->limit = " limit $pos,$numrow";
		}
    	 $sql = "select * from `" . $this->table . "` where  hide = 1 {$this->limit} ";
		$this->setQuery($sql);
		return $this->loadAllRow();
	}
	function searchpaymentmethods($pos,$numrow,$key = '',$keydistributor='')
	{
		$w = ' where  hide = 1';
		$this->limit = "  limit $pos,$numrow";
		if($key != '')
		{
			$w .= " and name LIKE '%$key%'";
		}
		if($keydistributor != '')
		{
			$w .= " and distributor LIKE '%$keydistributor%'";
		}
    	echo  $sql = "select * from `" . $this->table ."` $w {$this->limit} ";
		$this->setQuery($sql);
		return $this->loadAllRow();
	}
	// function searchcatagory($key = '')
	// {
	// 	$w = ' where 1 = 1 ';
	// 	if($key != '')
	// 	{
	// 		$w .= " and name LIKE '%$key%'";
	// 	}
	// 	$sql = 'select * from '.$this->table.@$w;
	// 	$this->setQuery($sql);
	// 	return $this->loadAllRow();
	// }
	// function searchcustomer($users = '', $emails = '', $groups = '', $status = '')
	// {
	// 	$w = ' where hide = 1 ';
	// 	if($users != '')
	// 	{
	// 		$w .= " and name LIKE '%$users%'";
	// 	}
	// 	if($emails != '')
	// 	{
	// 		$w .= " and email LIKE '%$emails%'";
	// 	}
	// 	if($groups != '')
	// 	{
	// 		$w .= " and group_id = '$groups'";
	// 	}
	// 	if($status != '')
	// 	{
	// 		$w .= " and status = '$status'";
	// 	}
	// 	$sql = 'select * from '.$this->table.@$w;
	// 	$this->setQuery($sql);
	// 	return $this->loadAllRow();
	// }
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