<?php 
class commentproductmodel extends model
{
	function __construct()
	{
		parent::__construct();
		$this->table = 'comment_product';
	}
	//load bình luận theo kiểu bài viết - bình luận 
	function listcommentproduct()
	{
       	$sql = "SELECT a.*,b.name,b.shortdescription,b.description,b.create_at,b.date_show,c.fullname,c.image 
		   		FROM comment_product a,catalogs b , customers c 
				WHERE a.idpost=b.id and a.iduser=c.id and a.hide=1 ";
		$this->setQuery($sql);
		return $this->loadAllRow();
	}
	// load theo dạng table - phân trang 
	function listcommentproduct11($pos,$numrow)
	{
		if($numrow>0)
		{
			$this->limit = " and `level`=0 limit $pos,$numrow";
		}
       	$sql = "select cp.*,c.fullname as customerspost,n.name as title from `" . $this->table . "` cp , `news` n , `customers` c where cp.idpost=n.id and cp.iduser=c.id and parent_id=0 and cp.hide = 1 {$this->limit} ";
		$this->setQuery($sql);
		return $this->loadAllRow();
	}
	function detailscommentproduct($id)
	{
		$add='';
		if($id)
		{
			$add=" cp.`id`=$id";
		}
        $sql = "select cp.*,c.fullname as customerspost,n.name as title from `" . $this->table . "` cp , `news` n , `customers` c where cp.idpost=n.id and cp.iduser=c.id and  cp.hide = 1 and $add ";
		$this->setQuery($sql);
		return $this->loadRow();
	}
	function idcomment($id='')
	{
		$add='';
		if($id)
		{
			$add="  and `id`=$id";
		}
		$sql = "select `idcomment` as idcomment from `comment_product` where hide = 1 $add ";
		$this->setQuery($sql);
		return $this->loadRow()->idcomment;
	}
	function news()
	{
		$sql = "select * from `news` where hide = 1 ";
		$this->setQuery($sql);
		return $this->loadAllRow();
	}
	function customers()
	{
		$sql = "select * from `customers` where hide = 1 ";
		$this->setQuery($sql);
		return $this->loadAllRow();
	}
	function account()
	{
		$sql = "select * from `account` where hide = 1 ";
		$this->setQuery($sql);
		return $this->loadAllRow();
	}
	function replycommentproduct($id='')
	{
		$add = '';
		if($id){
			$add = ' and parent_id = '.$id;
		}
		$sql = "select cp.*,c.fullname as customerspost,n.name as title from `" . $this->table . "` cp , `news` n , `customers` c where cp.idpost=n.id and cp.iduser=c.id and  cp.hide = 1  $add ";
		$this->setQuery($sql);
		return $this->loadAllRow();

	}
	function total()
	{
		$sql = "select count(*) as total from " . $this->table . " where hide = 1 and parent_id=0";
		$this->setQuery($sql);
		return $this->loadRow()->total;
	}
	function detail($id)
	{
		return $this->getone($id);	
	}
}
?>