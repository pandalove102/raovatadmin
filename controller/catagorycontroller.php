<?php
defined('BASE') OR exit('Access Deny');
class catagorycontroller  extends controller
{	
	function __construct()
	{
		$this->model = new catagorymodel();
		$this->modelstatus =new statusmodel();
		$this->pathview = 'view/products/catagory/';
	}
	function index()
	{
		$this->title='Danh sách danh mục';
		$this->h = 'Danh sách danh mục';
		$this->a = 'Danh mục';
		$this->strong = 'Danh sách';
		
		if($this->get() && $this->istoken('tokensearch',$this->model->clean($this->get('tokensearch'))))
		{
			$catagories = $this->model->searchcatagory($this->tim_vi_tri_bat_dau($this->numrow),$this->numrow,$this->get('key'));
			if($this->get('key') !='')
			{
				$totalpage =count($catagories);
			}else{
				$totalpage = $this->model->total();
			}
			
		}else
		{
			$catagories = $this->model->listparent($this->tim_vi_tri_bat_dau($this->numrow),$this->numrow);
			$totalpage = $this->model->total();
			
		}
		
		$this->setdata(array('catagories'=>$catagories,'totalpage'=>$totalpage));
		$this->render('list_view_catagories');
	}
	function api_check_alias($return = false)
	{
		if($this->model->islogin()){
			$alias = $this->model->clean($this->post('alias'));	
			$uri = $this->model->clean($this->post('uri'));
			$id = $this->model->clean($this->post('id_user'));
			if($uri == 'create')
			{
				$check = $this->model->getkey(array('alias'=>$alias,'hide'=>1));
				if($check){
					if($return) return false; else echo "false";
				}
				else{
					if($return) return true; else  echo "true";
				}
			}
			else
			{
				$check = $this->model->checkaliasedit($alias,$id);
				if(!$check)
				{
					if($return) return true; else echo "true";
				}
				else
				{
					if($return) return false; else echo "false";
				}

			}
		}else
			return false;
	}
	function listattribute()
	{
		$this->title='Danh sách danh mục';
		$this->h = 'Danh sách danh mục';
		$this->a = 'Danh mục';
		$this->strong = 'Danh sách';
		$this->uri = $this->getactionname();
		$id = $this->get('id');
		$idattribute = $this->post('idattribute');
		echo $idcatagories = $this->post('idcatagories');
		if($this->post())
		{
				if($this->model->check_idattribute($idattribute,$idcatagories))
				{
				
					$data = array(
						'idattribute' => $this->model->clean($this->post('idattribute')),
						'idcatagories' => $this->model->clean($this->post('idcatagories')),
						'created' => date('Y-m-d H:i:s'),
						'hide' => 1,
						'state' => 1
					);
					if($this->model->insert($data,'','catagories_attribute'))
					{
						$this->model->logs('Thêm thành công thuộc tình vào DM: '.$this->model->clean($this->post('username')),$this->getcontrollername().'/'.$this->uri);
						if($this->model->clean($this->post('save')) == 1)
						{
							$this->setmsg('Thêm thành công.','success');
						}
						else{
							redirect('catagory',2);
						}
					}
					else
					{
						$this->setmsg('Thêm thất bại.','error');
					}
				

			}
		}
		$status = $this->modelstatus->status();
		$catagories=$this->model->catagories_idcatagories($id);
		$listattribute = $this->model->listattribute($this->tim_vi_tri_bat_dau($this->numrow),$this->numrow,$id);
		$listattributeall = $this->model->listattributeall();
	    $totalpage =count($listattribute);
		$this->setdata(array('listattribute'=>$listattribute,
							  'catagories'=>$catagories,
							 'listattributeall'=>$listattributeall,
							  'totalpage'=> $totalpage,
							  'status'=>$status
							));
		$this->render('listattribute');
	}
	function delete_attribute()
	{
		if(isset($_GET))
		{
			$idattribute = $this->get('idattribute');
			$idcatagories = $this->get('idcatagories');
			if($this->model->delete_attribute_model($idattribute,$idcatagories)) // update hide=2
			{
				$this->model->logs('Xóa thành công thuộc tính');
				redirect('catagory/listattribute/'.$idcatagories,2);
			}
			else
			{
				$this->setmsg('Thêm thất bại.','error');
			}
			$this->render('listattribute');
		}
	}
	// function api_getsub()
	// {
	// 	if($this->post()){
	// 		$list = $this->model->listparent($this->post('parent'));
	// 		echo json_encode(array('lv'=>$this->post('lv'),'data'=>$list));
	// 	}else
	// 		echo '[]';
	// }
	function api_getsub()
	{
		if($this->post()){
			$list = $this->model->listcatagories($this->post('parent'));
			echo json_encode(array('lv'=>$this->post('lv'),'data'=>$list));
		}else
			echo '[]';
	}
	function api_check_catagory($return = false)
	{
		if($this->model->islogin()){
			$name = $this->model->clean($this->post('username'));
			$uri = $this->model->clean($this->post('uri'));
			$id = $this->model->clean($this->post('id_user'));
			if($uri == 'create' && empty($id))
			{
				$check = $this->model->getkey(array('name'=>$name,'hide'=>1));
				if($check){
					if($return) return false; else echo "false";
				}
				else{
					if($return) return true; else  echo "true";
				}
			}
			else
			{
				$check = $this->model->checknameedit($name,$id);
				if(!$check){
					if($return) return true; else echo "true";
				}
				else{
					if($return) return false; else  echo "false";
				}
			}
		}else
			return false;
	}
	function create()
	{
		$this->title ='Thêm danh mục';
		$this->h = 'Thêm danh mục';
		$this->a = 'Danh mục';
		$this->strong = 'Thêm';
		$this->save = 'Lưu';
		$this->save_close = 'Lưu & Đóng';
		$this->size_image = '(300x300)px';
		$this->size_imgshare = '(300x300)px';
		$this->uri = $this->getactionname();
		$listattributeall = $this->model->listattributeall();
		$totalpage=1;
		if($this->post() && $this->istoken('tokencatagory',$this->model->clean($this->post('tokencatagory'))))
		{			
			if($this->api_check_catagory(true))
			{ 
				$data = array(
					'title' => $this->model->clean($this->post('title')),
	                'name' => $this->model->clean($this->post('name')),
	                'alias' => $this->post('alias'),
	                'description' => $this->model->clean($this->post('description')),
	                'metakey' => $this->model->clean($this->post('metakey')),
	                'metadesc' => $this->model->clean($this->post('metadesc')),
	                'image' => $this->model->clean($this->post('image')),
	                'imgshare' => $this->model->clean($this->post('imgshare')),
					'pos' => $this->model->clean($this->post('pos')),
					'status' => 1,
	                'parent_id' => $this->model->clean($this->post('parent_id')),
	                'username' => $this->model->clean($this->model->session->get('admin_user')),    
					'create_at' => date('Y-m-d H:i:s'),
					'hide' => 1
				);
				if($this->model->insert($data))
				{
					 $last_id=$this->model->get_id_last();
					 $idattribute=array();
					 $idattribute=$this->post('idattribute');
					if(isset($last_id))
					{
						foreach ($idattribute as $key => $value) 
						{
							if($this->model->check_idattribute($value,$last_id))
							{
								$data = array(
									'idattribute' => $value,
									'idcatagories' => $last_id,
									'created' => date('Y-m-d H:i:s'),
									'hide' => 1,
									'state' => 1
								);
								if($this->model->insert($data,'','catagories_attribute')){
									$this->setmsg('Thêm thành công.','success');
								}
								
							}
								
							
						}
					}
					$this->model->logs('Thêm thành công danh mục: '.$this->model->clean($this->post('username')),$this->getcontrollername().'/'.$this->uri);
					if($this->model->clean($this->post('save')) == 1)
					{
						$this->setmsg('Thêm thành công.','success');
					}
					else{
						redirect('catagory',2);
					}
				}
				else
				{
					$this->setmsg('Thêm thất bại.','error');
				}
			}else
			{
				$this->setmsg('Tên danh mục đã tồn tại!','error');
			}
		}
		$this->setdata(array('list_catagory'=>$this->model->listcatagories(),
							  'totalpage'=>$totalpage,
							 'listattributeall'=>$listattributeall
							));
	
		$this->render('create_and_edit_form_catagories');
	}
	function edit()
	{

		$this->title ='Sửa danh mục';
		$this->h = 'Sửa danh mục';
		$this->a = 'Danh mục';
		$this->strong = 'Sửa';
		$this->save = 'Cập nhật';
		$this->save_close = 'Cập nhật & Đóng';
		$this->size_image = '(300x300)px';
		$this->size_imgshare = '(300x300)px';
		$listattributeall = $this->model->listattributeall();
		$totalpage=1;
		$id = $this->get('id');
		$catagory = $this->model->getonekey(array('id'=>$id,'hide'=>1));
		if(!$catagory)
			redirect('catagory/create',1);
		else
		{
			$this->uri = $this->getactionname();
			if($this->post() && $this->istoken('tokencatagory',$this->model->clean($this->post('tokencatagory'))))
			{
				$data = array(
					'id' => $catagory->id,
	                'title' => $this->model->clean($this->post('title')),
	                'name' => $this->model->clean($this->post('name')),
	                'alias' => $this->model->clean($this->post('alias')),
	                'description' => $this->model->clean($this->post('description')),
	                'metakey' => $this->model->clean($this->post('metakey')),
	                'metadesc' => $this->model->clean($this->post('metadesc')),
	                'image' => $this->model->clean($this->post('image')),
					'pos' => $this->model->clean($this->post('pos')),
	                'imgshare' => $this->model->clean($this->post('imgshare')),
	                'parent_id' => $this->model->clean($this->post('parent_id')),
					'username' => $this->model->clean($this->model->session->get('admin_user')),
					'status' => $this->model->clean($this->post('status')),
					'update_at' => date('Y-m-d H:i:s'),
				);
				if($this->model->update($data))
				{
					$catagory = $this->model->getone($catagory->id);
					$this->model->logs('Cập nhật thành công nhóm: '.$catagory->name,$this->getcontrollername().'/'.$this->uri);
					$this->setmsg('Cập nhật thành công. Đang chuyển hướng...','success');
					if($this->model->clean($this->post('save')) == 1)
					{
						$this->setmsg('Cập nhật thành công.','success');
					}
					else{
						redirect('catagory',2);
					}
				}
				else
				{
					$this->setmsg('Cập nhật thất bại. Đang chuyển hướng...','error');
				}
			}
			$listattribute=$this->model->listattribute($this->tim_vi_tri_bat_dau($this->numrow),$this->numrow,$id);
			$totalpage=count($listattribute);
			$this->setdata(array('catagory'=>$catagory,
								 'list_catagory'=>$this->model->listcatagories(),
								 'totalpage'=>$totalpage,
								 'listattribute'=>$listattribute,
								 'listattributeall'=>$listattributeall
								));
			$this->render('create_and_edit_form_catagories');
		}
	}
	function delete()
	{
		$id = $this->get('id');
		$catagory = $this->model->getonekey(array('id'=>$id,'hide'=>1));
		if(!$catagory)
			redirect('catagory',1);	
		$data = array(
				'id' => $catagory->id,
				'hide' => 2
		);
		if($this->model->update($data))
		{
			$this->model->logs('Xóa thành công tài khoản: '.$catagory->name,'catagory/delete/'.$catagory->id);
			redirect('catagory',2);
		}
		else
		{
			$this->setmsg('Xóa không thành công!','success');
		}
		$this->render('list_view_catagories');
	}
	function api_listcatnice($name='parent_id',$selectid = 0)
	{
	   $list = $this->model->listnice();
	   echo ' <select class="form-control m-b" name="'.$name.'"> <option value="0">--- Danh mục cha ---</option>';
	   $ar1 = array();$ar2 = array();
	   foreach($list as $item)
	   {
	       if($item->parent_id==0)
	       {
	             echo '<option '.($item->id==$selectid?'selected':'').' value="'.$item->id.'">|-- '.$item->name.'</option>';
	            foreach ($list as $item1)
	            {
	               
	                if($item1->parent_id==$item->id)
	                {
	                    echo '<option '.($item1->id==$selectid?'selected':'').' value="'.$item1->id.'">&nbsp;&nbsp;&nbsp;&nbsp;|-- '.$item1->name.'</option>';
        	            foreach ($list as $item2)
        	            {
        	                if($item2->parent_id==$item1->id)
        	                {
        	                    echo '<option '.($item2->id==$selectid?'selected':'').' value="'.$item2->id.'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|-- '.$item2->name.'</option>';
        	                }
        	            }
	                }
	            }
	            $ar1[] = $item;
        	    unset($item);
	            
	       }
	   }
	   echo '<select>';
	}
	function api_listcatnicemulti($name='parent_id',$selectid ='')
	{
	   $list = $this->model->listnice();
	   $selectids = explode(',',$selectid);
	  // varray($selectids);
	   echo ' <select class="form-control m-b" size="10" name="'.$name.'[]" multiple> <option value="0">--- Danh mục cha ---</option>';
	   $ar1 = array();$ar2 = array();
	   foreach($list as $item)
	   {
	       if($item->parent_id==0)
	       {
	             echo '<option '.(in_array($item->id,$selectids )?'selected':'').' value="'.$item->id.'">|-- '.$item->name.'</option>';
	            foreach ($list as $item1)
	            {
	               
	                if($item1->parent_id==$item->id)
	                {
	                    echo '<option '.(in_array($item1->id,$selectids )?'selected':'').' value="'.$item1->id.'">&nbsp;&nbsp;&nbsp;&nbsp;|-- '.$item1->name.'</option>';
        	            foreach ($list as $item2)
        	            {
        	                if($item2->parent_id==$item1->id)
        	                {
        	                    echo '<option '.(in_array($item2->id,$selectids )?'selected':'').' value="'.$item2->id.'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|-- '.$item2->name.'</option>';
        	                }
        	            }
	                }
	            }
	            $ar1[] = $item;
        	    unset($item);
	            
	       }
	   }
	   echo '<select>';
	}
	function api_list_attribute()
	{
		if($this->post()){
			
			$list_attribute = $this->model->list_attribute($this->post('idselected'));
			echo json_encode(array('data'=>$list_attribute));
		}else
			echo '[]';

	}

	
}
 
?>