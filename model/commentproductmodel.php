<?php 
class commentproductmodel extends model
{
	function __construct()
	{
		parent::__construct();
		$this->table = 'comment_product';
	}
	function get_comment($id='')
	{
		if($id!='')
		{
			$w=" and  a.id=$id";
		}
		$sql="SELECT a.*,b.*,c.*,a.id as repid  
			  FROM comment_product a,account b, catalogs c 
			  WHERE a.hide=1 and a.iduser=b.id and a.idpost=c.id $w";
		$this->setQuery($sql);
		return $this->loadRow();
	}
	function get_id_last_comment()
	{
		$sql="SELECT max(id) as id from comment_product WHERE hide=1";
		$this->setQuery($sql);
		return $this->loadRow()->id;
	}
	function get_info($id='')
	{
		if($id!='')
		{
			$w=" and  id=$id";
		}
		$sql="SELECT id,fullname,name FROM account WHERE hide=1  $w ";
		$this->setQuery($sql);
		return $this->loadRow()->kq;
	}
	// AJAX goi ve ID cua binh luan , thu hien show  / hidden 
	function show_hidden_commnet($id)
	{
		if($id!='')
		{
			$w=" id=$id";
		}
		$sql="select state as kq from comment_product where $w ";
		$this->setQuery($sql);
		return $this->loadRow()->kq;
	}
	// load bình luận con 
	function listcomment_id_comment($id='')
	{
		$w='';
		if($id!='')
		{
			$w.=" and parent_id=$id";
		}
		$sql="SELECT * FROM comment_product WHERE hide=1 $w";
		$this->setQuery($sql);
		return $this->loadAllRow();

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
	function list_catalogs_limit($pos,$numrow)
	{
		if($numrow>0)
		{
			$this->limit = " and  limit $pos,$numrow";
		}
		$sql="SELECT a.id,a.`name`,a.alias,a.shortdescription , a.description , a.image,a.imgshare ,a.catagories_id,a.create_at,a.date_show 
		from catalogs a 
		WHERE a.hide=1 {$this->limit}";
		$this->setQuery($sql);
		return $this->loadAllRow();
	}
	function list_catalogs_all()// danh sach bài viết có bài luận
	{
		$sql="SELECT b.id,b.name,b.alias,b.shortdescription,b.description,b.image,b.imgshare,b.create_at,b.date_show 
		FROM catalogs b WHERE b.hide=1 and id in(SELECT idpost FROM comment_product WHERE  hide=1 GROUP BY idpost )";
		$this->setQuery($sql);
		return $this->loadAllRow();
	}
	function catalogs_comment()
	{
		$sql="SELECT a.*,b.name,b.alias,b.shortdescription,b.description,b.image,b.imgshare,b.create_at,b.date_show 
		FROM comment_product a,catalogs b 
		WHERE a.idpost=b.id and a.hide=1 and b.hide=1 ";
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