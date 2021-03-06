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
	
	function create()
	{
		$this->title ='Thêm loại tin';
		$this->h = 'Thêm loại tin';
		$this->a = 'Thêm loại tin';
		$this->strong = 'Thêm';
		$this->save = 'Lưu';
		$this->save_close = 'Lưu & Đóng';
		$this->uri = $this->getactionname();
		if($this->post() && $this->istoken('tokentypecatalogs',$this->model->clean($_POST['tokentypecatalogs'])))
		{
				$data = array(
					'name' => $this->model->clean($this->post('name')),
					'desc' => $this->model->clean($this->post('desc')),
					'state' => $this->model->clean($this->post('state')),
					'price' => $this->model->clean($this->post('price')),
					'created' => date('Y-m-d H:i:s'),
					'hide'=>1
				);
				if($this->model->insert($data))
				{
					$this->model->logs('Thêm thành công loại tin: '.$this->model->clean($this->post('name')),$this->getcontrollername().'/'.$this->uri);
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
			
			
		}
		$this->render('create_and_edit_form_type_catalogs');
	}
	function edit()
	{
		$this->title ='Sửa loại tin đăng';
		$this->h = 'Sửa loại tin đăng';
		$this->a = 'Loại tin đăng';
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
				'name' => $this->model->clean($this->post('name')),
                'desc' => $this->model->clean($this->post('desc')),
                'state' => $this->model->clean($this->post('state')),
				'price' => $this->model->clean($this->post('price'))
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
		
		$typecatalogs=$this->model->typecatalogs($id);
		$this->setdata(array('typecatalogs'=>$typecatalogs
							));
		$this->render('create_and_edit_form_type_catalogs');
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
				$this->model->logs('Xóa thành công  : '.'typecatalogs/delete/'.$typecatalogs->id);
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