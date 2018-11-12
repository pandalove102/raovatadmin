<?php
defined('BASE') OR exit('Access Deny');
class attributecontroller  extends controller
{	
	function __construct()
	{
		$this->model = new attributemodel();
		$this->models = new catalogmodel();
		$this->pathview = 'view/products/attribute/';
		
	}
	function index()
	{
		$this->title='Danh sách thuộc tính';
		$this->h = 'Danh sách thuộc tính';
		$this->a = 'Thuộc tính';
		$this->strong = 'Danh sách thuộc tính';
		$this->setscript(array('layout/js/plugins/dataTables/datatables.min.js'));
		$this->setcss(array('layout/css/plugins/dataTables/datatables.min.css'));
		$list_type=array(
			'text'=>'Loại Chữ',
			'number'=>'Loại Số',
			'date'=>'Ngày Tháng Năm',
			'email'=>'Loại Email',
			'radio'=>'Chọn lựa',
			'checkbox'=>'Đánh dấu',
			'dropdown'=>'Danh sách lựa chọn',
			'linkbutton'=>'nút liên kết',
			'button'=>'Nút',
			'color'=>'Màu',
			'image'=>'Một Hình Ảnh ',
			'images'=>'Nhiều Hình Ảnh',
			'editor'=>'Chỉnh sửa văn bản',
			'textarea'=>'Khung văn bản'
		);
		if($this->get() && $this->istoken('tokensearch',$this->model->clean($this->get('tokensearch'))))
		{
			$attribute = $this->model->listattributesearch($this->tim_vi_tri_bat_dau($this->numrow),
														   $this->numrow,
														   $this->get('key')
														);
			if($this->get('key') !='')
			{
				$totalpage =count($attribute);
			}else{
				$totalpage = $this->model->total();
			}
			
		}else
		{
			$attribute=$this->model->listattribute($this->tim_vi_tri_bat_dau($this->numrow),$this->numrow);
			$totalpage = $this->model->total();
		}
		
		$this->setdata(array('attribute'=>$attribute ,'list_type'=>$list_type,'totalpage'=>$totalpage));
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
		$list_type=array(
			'text'=>'Loại Chữ',
			'number'=>'Loại Số',
			'date'=>'Ngày Tháng Năm',
			'email'=>'Loại Email',
			'radio'=>'Chọn lựa',
			'checkbox'=>'Đánh dấu',
			'dropdown'=>'Danh sách lựa chọn',
			'linkbutton'=>'nút liên kết',
			'button'=>'Nút',
			'color'=>'Màu',
			'image'=>'Một Hình Ảnh ',
			'images'=>'Nhiều Hình Ảnh',
			'editor'=>'Chỉnh sửa văn bản',
			'textarea'=>'Khung văn bản'
		);
		if($this->post() && $this->istoken('tokenattribute',$this->model->clean($_POST['tokenattribute'])))
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
						redirect('attribute',2);
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
		$this->setdata(array('list_type'=>$list_type
							));
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
		$list_type=array(
			'text'=>'Loại Chữ',
			'number'=>'Loại Số',
			'date'=>'Ngày Tháng Năm',
			'email'=>'Loại Email',
			'radio'=>'Chọn lựa',
			'checkbox'=>'Đánh dấu',
			'dropdown'=>'Danh sách lựa chọn',
			'linkbutton'=>'nút liên kết',
			'button'=>'Nút',
			'color'=>'Màu',
			'image'=>'Một Hình Ảnh ',
			'images'=>'Nhiều Hình Ảnh',
			'editor'=>'Chỉnh sửa văn bản',
			'textarea'=>'Khung văn bản'
		);
		$attribute = $this->model->getonekey(array('id'=>$id,'hide'=>1));
		if(!$attribute)
			redirect('attribute/edit',1);		
		$this->uri = $this->getactionname();
		if($this->post() && $this->istoken('tokenattribute',$this->model->clean($this->post('tokenattribute'))))
		{			
			$data = array(
				'id' => $attribute->id,
				'value' => $this->model->clean($this->post('value')),
                'defaultvalue' => $this->model->clean($this->post('defaultvalue')),
                'requrire' => $this->model->clean($this->post('requrire')),
				'unique' => $this->model->clean($this->post('unique')),
                'code' => $this->model->clean($this->post('code')),
                'type' => $this->model->clean($this->post('type'))
			);
			if($this->model->update($data))
			{

				$attribute = $this->model->getone($attribute->id);
				$this->model->logs('Cập nhật thành công thuộc tính: '.$attribute->label ,$this->getcontrollername().'/'.$this->uri);
				$this->setmsg('Cập nhật thành công. Đang chuyển hướng...','success');
				if($this->model->clean($this->post('save')) == 1)
				{
					$this->setmsg('Cập nhật thành công.','success');
				}
				else{
					redirect('attribute',2);
				}
			}
			else
			{
				$this->setmsg('Cập nhật thất bại. Đang chuyển hướng...','error');
			}
		}
		$listcatagories=$this->model->listcatagories();
		$detail_catagories_attribute=$this->model->detail_catagories_attribute($id);
		$this->setdata(array('attribute'=>$attribute,
							  'list_type'=>$list_type,
							 'listcatagories'=>$listcatagories,
							 'detail_catagories_attribute'=>$detail_catagories_attribute
							));
		$this->render('create_and_edit_form');
	}
	
	// code cũ 
		// function delete()
		// {
		// 	$id = $this->get('id');
		// 	$attribute = $this->model->getonekey(array('id'=>$id,'hide'=>1));
		// 	if($this->model->delete($attribute->id))
		// 	{
		// 		$this->model->logs('Xóa thành công tài khoản: '.'attribute/delete/'.$attribute->id);
		// 		redirect('attribute',1);
		// 	}
		// 	else
		// 	{
		// 		$this->setmsg('Xóa không thành công!','success');
		// 	}
		// 	$this->render('list_view');
		// }
		
	// Delete : chỉ ẩn không hiển thị
	function delete()
	{
		//get id:
		$id=$this->get('id');
		$attribute= $this->model->getonekey(array('id'=>$id,'hide'=>1));
		if($attribute){
			$data = array(
				'id' => $attribute->id,
				'hide' => 2
			);
			if($this->model->update($data))
			{
				$attribute = $this->model->getone($attribute->id);
				$this->model->logs('Xóa thành công thuộc tính : '.'attribute/delete/'.$attribute->id);
				// $this->setmsg('Xoá thành công. Đang chuyển hướng...','success');
				// redirect('attribute',1);
				// $this->setmsg('Xóa không thành công!','success');
				$this->setmsg('Xoá thành công. Đang chuyển hướng...','success');
				if($this->model->clean($this->post('save')) == 1)
				{
					$this->setmsg('Xoá thành công.','success');
				}
				else{
					redirect('attribute',2);
				}
			}
			else{
				$this->setmsg('Xóa không thành công!','error');
				redirect('attribute',1);
			}
			
		}else{
			$this->setmsg('Xóa không thành công!','error');
			redirect('attribute',1);
		}
		
		
	}


}
 
?>