<?php
defined('BASE') OR exit('Access Deny');
class menucontroller  extends controller
{	
	function __construct()
	{
		$this->model = new menumodel();
		$this->pathview = 'view/menu/menu/';
	}
	function index()
	{
		$this->title='Danh sách Menu';
		$this->h = 'Danh sách Menu';
		$this->a = 'Menu';
		$this->strong = 'Danh sách Menu';
		$this->setscript(array('layout/js/plugins/dataTables/datatables.min.js'));
		$this->setcss(array('layout/css/plugins/dataTables/datatables.min.css'));
		$totalpage = $this->model->total();
		$this->setdata(array('menu'=>$this->model->listmenu($this->tim_vi_tri_bat_dau($this->numrow),$this->numrow),'totalpage'=>$totalpage));
		$this->render('list_view');
    }
    function api_check_menu($return = false)
	{
		if($this->model->islogin()){
			$menu = $this->model->clean($_POST['name']);
			$uri = $this->model->clean($_POST['uri']);
			$id = $this->model->clean($_POST['id']);
			if($uri == 'create' && empty($id))
			{
				$check = $this->model->getkey(array('name'=>$menu));
				if($check){
					if($return) return false; else echo "false";
				}
				else{
					if($return) return true; else  echo "true";
				}
			}
			else
			{
				$check = $this->model->getkey(array('menu'=>$menu,'id'=>$id));
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
		$this->title ='Thêm Menu';
		$this->h = 'Thêm Menu';
		$this->a = 'Menu';
		$this->strong = 'Thêm';
		$this->save = 'Lưu';
		$this->save_close = 'Lưu & Đóng';
		$this->uri = $this->getactionname();
		if($this->post() && $this->istoken('tokenmenu',$this->model->clean($_POST['tokenmenu'])))
		{			
			if($this->api_check_menu(true))
			{ 
				$data = array(
					'name' => $this->model->clean($this->post('name')),
					'state' => $this->model->clean($this->post('state')),
					'created' => date('Y-m-d H:i:s'),
	                'hide' => 1
				);
				if($this->model->insert($data))
				{
					$this->model->logs('Thêm thành công Menu: '.$this->model->clean($this->post('name')),$this->getcontrollername().'/'.$this->uri);
					if($this->model->clean($this->post('save')) == 1)
					{
						$this->setmsg('Thêm thành công.','success');
					}
					else{
						redirect('menu',2);
					}
				}
				else
				{
					$this->setmsg('Thêm thất bại.','error');
				}
			}else
			{
				$this->setmsg('Menu đã tồn tại!','error');
			}
		}
		$this->render('create_and_edit_form');
	}
	function edit()
	{
		$this->title ='Sửa Menu';
		$this->h = 'Sửa Menu';
		$this->a = ' Menu';
		$this->strong = 'Sửa';
		$this->save = 'Cập nhật';
		$this->save_close = 'Cập nhật & Đóng';
		$id = $this->get('id');
		$menu = $this->model->getonekey(array('id'=>$id,'hide'=>1));
		if(!$menu)
			redirect('menu/edit',1);		
		$this->uri = $this->getactionname();
		if($this->post() && $this->istoken('tokenmenu',$this->model->clean($this->post('tokenmenu'))))
		{			
			$data = array(
				'id' => $menu->id,
                'name' => $this->model->clean($this->post('name')),
                'state' => $this->model->clean($this->post('state'))
				
			);
			if($this->model->update($data))
			{

				$menu = $this->model->getone($menu->id);
				$this->model->logs('Cập nhật thành công Menu: '.$menu->name ,$this->getcontrollername().'/'.$this->uri);
				$this->setmsg('Cập nhật thành công. Đang chuyển hướng...','success');
				if($this->model->clean($this->post('save')) == 1)
				{
					$this->setmsg('Cập nhật thành công.','success');
				}
				else{
					redirect('menu',2);
				}
			}
			else
			{
				$this->setmsg('Cập nhật thất bại. Đang chuyển hướng...','error');
			}
		}
		$this->setdata(array('menu'=>$menu));
		$this->render('create_and_edit_form');
	}
	// Delete : chỉ ẩn không hiển thị
	function delete()
	{
		//get id:
		$id=$this->get('id');
		$menu= $this->model->getonekey(array('id'=>$id,'hide'=>1));
		if($menu){
			$data = array(
				'id' => $menu->id,
				'hide' => 2
			);
			if($this->model->update($data))
			{
				$menu = $this->model->getone($menu->id);
				$this->model->logs('Xóa thành công Menu : '.'menu/delete/'.$menu->id);
				$this->setmsg('Xoá thành công. Đang chuyển hướng...','success');
				if($this->model->clean($this->post('save')) == 1)
				{
					$this->setmsg('Xoá thành công.','success');
				}
				else{
					redirect('menu',2);
				}
			}
			else{
				$this->setmsg('Xóa không thành công!','error');
				redirect('menu',1);
			}
			
		}else{
			$this->setmsg('Xóa không thành công!','error');
			redirect('menu',1);
		}
		
		
	}


}
 
?>