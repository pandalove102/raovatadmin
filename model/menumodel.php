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
    	 $sql = "select * from `" . $this->table . "` where  hide = 1 {$this->limit} ";
		$this->setQuery($sql);
		return $this->loadAllRow();
	}
	function total()
	{
		$sql = "select count(*) as total from " . $this->table . " where hide = 1  ";
		$this->setQuery($sql);
		return $this->loadRow()->total;
	}
	function detail($id)
	{
		return $this->getone($id);	
	}
}

?>