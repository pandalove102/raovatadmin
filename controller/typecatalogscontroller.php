<?php
defined('BASE') OR exit('Access Deny');
class typecatalogscontroller  extends controller
{	
	function __construct()
	{
		$this->model = new typecatalogsmodel();
		$this->pathview = 'view/products/typecatalogs/';
	}
	function index()
	{
		$this->title='DS loại tin đăng';
		$this->h = 'DS loại tin đăng';
		$this->a = 'Loại tin đăng';
		$this->strong = 'DS loại tin đăng';
		$this->setscript(array('layout/js/plugins/dataTables/datatables.min.js'));
		$this->setcss(array('layout/css/plugins/dataTables/datatables.min.css'));
		if($this->get() && $this->istoken('tokensearch',$this->model->clean($this->get('tokensearch'))))
		{
			$typecatalogs = $this->model->listtypecatalogssearch($this->tim_vi_tri_bat_dau($this->numrow),
														   $this->numrow,
														   $this->get('key')
														);
			if($this->get('key') !='')
			{
				$totalpage =count($typecatalogs);
			}else{
				$totalpage = $this->model->total();
			}
			
		}else
		{
			$typecatalogs=$this->model->listtypecatalogs($this->tim_vi_tri_bat_dau($this->numrow),$this->numrow);
			$totalpage = $this->model->total();
		}
		
		$this->setdata(array('typecatalogs'=>$typecatalogs ,'totalpage'=>$totalpage));
		$this->render('list_view');
	}
	function api_check_label($return = false)
	{
		if($this->model->islogin()){
			$label = $this->model->clean($_POST['username']);
			$uri = $this->model->clean($_POST['uri']);
			$id = $this->model->clean($_POST['id_user']);
			if($uri == 'create' && empty($id))
			{
				$check = $this->model->getkey(array('label'=>$label));
				if($check){
					if($return) return false; else echo "false";
				}
				else{
					if($return) return true; else  echo "true";
				}
			}
			else
			{
				$check = $this->model->getkey(array('label'=>$label,'id'=>$id));
				if($check){
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
		$this->title ='Thêm thuộc tính';
		$this->h = 'Thêm thuộc tính';
		$this->a = 'Nhóm thuộc tính';
		$this->strong = 'Thêm';
		$this->save = 'Lưu';
		$this->save_close = 'Lưu & Đóng';
		$this->uri = $this->getactionname();
		if($this->post() && $this->istoken('tokentypecatalogs',$this->model->clean($_POST['tokentypecatalogs'])))
		{			
			if($this->api_check_label(true))
			{ 
				$data = array(
					'label' => $this->model->clean($this->post('username')),
	                'value' => $this->model->clean($this->post('value')),
	                'defaultvalue' => $this->model->clean($this->post('defaultvalue')),
	                'requrire' => $this->model->clean($this->post('requrire')),
					'unique' => $this->model->clean($this->post('unique')),
	                'code' => $this->model->clean($this->post('code')),
	                'type' => $this->model->clean($this->post('type'))
				);
				if($this->model->insert($data))
				{
					$this->model->logs('Thêm thành công thuộc tính: '.$this->model->clean($this->post('lable')),$this->getcontrollername().'/'.$this->uri);
					if($this->model->clean($this->post('save')) == 1)
					{
						$this->setmsg('Thêm thành công.','success');
					}
					else{
						redirect('typecatalogs',2);
					}
				}
				else
				{
					$this->setmsg('Thêm thất bại.','error');
				}
			}else
			{
				$this->setmsg('Thuộc tính đã tồn tại!','error');
			}
		}
		$this->render('create_and_edit_form');
	}
	function edit()
	{
		$this->title ='Sửa thuộc tính';
		$this->h = 'Sửa thuộc tính';
		$this->a = 'Nhóm thuộc tính';
		$this->strong = 'Sửa';
		$this->save = 'Cập nhật';
		$this->save_close = 'Cập nhật & Đóng';
		$id = $this->get('id');
		$typecatalogs = $this->model->getonekey(array('id'=>$id,'hide'=>1));
		if(!$typecatalogs)
			redirect('typecatalogs/edit',1);		
		$this->uri = $this->getactionname();
		if($this->post() && $this->istoken('tokentypecatalogs',$this->model->clean($this->post('tokentypecatalogs'))))
		{			
			$data = array(
				'id' => $typecatalogs->id,
				'value' => $this->model->clean($this->post('value')),
                'defaultvalue' => $this->model->clean($this->post('defaultvalue')),
                'requrire' => $this->model->clean($this->post('requrire')),
				'unique' => $this->model->clean($this->post('unique')),
                'code' => $this->model->clean($this->post('code')),
                'type' => $this->model->clean($this->post('type'))
			);
			if($this->model->update($data))
			{

				$typecatalogs = $this->model->getone($typecatalogs->id);
				$this->model->logs('Cập nhật thành công thuộc tính: '.$typecatalogs->label ,$this->getcontrollername().'/'.$this->uri);
				$this->setmsg('Cập nhật thành công. Đang chuyển hướng...','success');
				if($this->model->clean($this->post('save')) == 1)
				{
					$this->setmsg('Cập nhật thành công.','success');
				}
				else{
					redirect('typecatalogs',2);
				}
			}
			else
			{
				$this->setmsg('Cập nhật thất bại. Đang chuyển hướng...','error');
			}
		}
		$listcatagories=$this->model->listcatagories();
		$detail_catagories_typecatalogs=$this->model->detail_catagories_typecatalogs($id);
		$this->setdata(array('typecatalogs'=>$typecatalogs,
							 'listcatagories'=>$listcatagories,
							 'detail_catagories_typecatalogs'=>$detail_catagories_typecatalogs
							));
		$this->render('create_and_edit_form');
	}
	
	function delete()
	{
		//get id:
		$id=$this->get('id');
		$typecatalogs= $this->model->getonekey(array('id'=>$id,'hide'=>1));
		if($typecatalogs){
			$data = array(
				'id' => $typecatalogs->id,
				'hide' => 2
			);
			if($this->model->update($data))
			{
				$typecatalogs = $this->model->getone($typecatalogs->id);
				$this->model->logs('Xóa thành công thuộc tính : '.'typecatalogs/delete/'.$typecatalogs->id);
				// $this->setmsg('Xoá thành công. Đang chuyển hướng...','success');
				// redirect('typecatalogs',1);
				// $this->setmsg('Xóa không thành công!','success');
				$this->setmsg('Xoá thành công. Đang chuyển hướng...','success');
				if($this->model->clean($this->post('save')) == 1)
				{
					$this->setmsg('Xoá thành công.','success');
				}
				else{
					redirect('typecatalogs',2);
				}
			}
			else{
				$this->setmsg('Xóa không thành công!','error');
				redirect('typecatalogs',1);
			}
			
		}else{
			$this->setmsg('Xóa không thành công!','error');
			redirect('typecatalogs',1);
		}
		
		
	}


}
 
?>