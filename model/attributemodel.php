<?php 
class attributemodel extends model
{
	function __construct()
	{
		parent::__construct();
		$this->table = 'attribute';
		
	}

	function listattribute($pos,$numrow)
	{
		if($numrow>0)
		{
			$this->limit = " limit $pos,$numrow";
		}
		 $sql = "select * from " . $this->table . " where hide = 1 {$this->limit}";
		$this->setQuery($sql);
		return $this->loadAllRow();
	}
	
	function listattributesearch($pos,$numrow,$key='')
	{
		$w = ' where hide = 1 ';
		if($numrow>0)
		{
			$this->limit = " limit $pos,$numrow";
		}
		if($key != '')
		{
			$w .= " and label LIKE '%$key%'";
		}
		echo $sql = "select * from " . $this->table . "  $w {$this->limit}";
		$this->setQuery($sql);
		return $this->loadAllRow();
	}
	function listcatagories()
	{
         $sql = "select id,name,parent_id from `catagories` where hide = 1 ";
		$this->setQuery($sql);
		return $this->loadAllRow();
	}
	function detail_catagories_attribute($id='')
	{
		if($id!='')
		{
			$sql="select * from catagories_attribute a , catagories b ,attribute c   
			where a.idattribute=c.id and a.idcatagories=b.id and a.hide = 1 and a.idattribute=$id ";
		}
		$this->setQuery($sql);
		return $this->loadRow();
	}
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
		$sql = "select count(*) as total from " . $this->table . " where hide = 1";
		$this->setQuery($sql);
		return $this->loadRow()->total;
	}
	function detail($id)
	{
		return $this->getone($id);	
	}
	
}

?>