<?php
defined('BASE') OR exit('Access Deny');
class customerscontroller  extends controller
{	
	function __construct()
	{
		$this->model = new customersmodel();
		$this->modelnews = new newsmodel();
		$this->models = new catalogmodel(); 
		$this->statusmodel = new statusmodel(); 
		$this->pathview = 'view/customers/customers/';
	}
	function index()
	{
		$this->title='Danh sách khách hàng';
		$this->h = 'Danh sách khách hàng';
		$this->a = 'khách hàng';
		$this->strong = 'Danh sách khách hàng';
		$this->setscript(array('layout/js/plugins/dataTables/datatables.min.js'));
		$this->setcss(array('layout/css/plugins/dataTables/datatables.min.css'));
		$this->setdata(array('customers'=>$this->model->listcustomers($this->tim_vi_tri_bat_dau($this->numrow),$this->numrow),
							 'totalpage'=>$this->model->total()
								));
		$this->render('list_view');
	}
	function api_getsub()
	{
		if($this->post()){
			$list = $this->model->districtcity($this->post('id'));
			echo json_encode(array('data'=>$list));
		}else
			echo '[]';

	}
	function create()
	{
		$this->title ='Thêm khách hàng';
		$this->h = 'Thêm khách hàng';
		$this->a = 'Nhóm khách hàng';
		$this->strong = 'Thêm';
		$this->save = 'Lưu';
		$this->save_close = 'Lưu & Đóng';
		$this->uri = $this->getactionname();
		if($this->post() && $this->istoken('tokencustomers',$this->model->clean($_POST['tokencustomers'])))
		{	
				$data = array(
					'fullname' => $this->model->clean($this->post('fullname')),
					'name' => $this->model->clean($this->post('name')),
					'email' => $this->model->clean($this->post('email')),
					'address' => $this->model->clean($this->post('address')),
					'city' => $this->model->clean($this->post('city')),
					'cellularphone' => $this->model->clean($this->post('cellularphone')),
					'image' => $this->model->clean($this->post('image')),
					'group_id' => $this->model->clean($this->post('group_id')),
					'last_login_time' => $this->model->clean($this->post('last_login_time')),
					'last_login_ip' => $this->model->clean($this->post('last_login_ip')),
					'vip' => $this->model->clean($this->post('vip')),
					'money' => $this->model->clean($this->post('money')),
					'point' => $this->model->clean($this->post('point')),
					'create_at' => $this->model->clean($this->post('create_at')),
					'status' => $this->model->clean($this->post('status')),
					'password' => $this->model->hashmd5($this->model->clean($_POST['password']))

					);
				if($this->model->insert($data))
				{
					$this->model->logs('Thêm thành công : '.$this->model->clean($this->post('name')),$this->getcontrollername().'/'.$this->uri);
					if($this->model->clean($this->post('save')) == 1)
					{
						$this->setmsg('Thêm thành công.','success');
					}
					else{
						redirect('customers',2);
					}
				}
				else
				{
					$this->setmsg('Thêm thất bại.','error');
				}
		}
		$this->render('create_and_edit_form');
	}
	function edit()
	{
		$this->title ='Sửa khách hàng';
		$this->h = 'Sửa khách hàng';
		$this->a = 'Khách hàng';
		$this->strong = 'Sửa';
		$this->save = 'Cập nhật';
		$this->save_close = 'Cập nhật & Đóng';
		$id = $this->get('id');
		$city=$this->model->city();
		$district=$this->model->district();
		$groups=$this->model->groups();
		$news=$this->modelnews->listnewsid($this->tim_vi_tri_bat_dau($this->numrow),$this->numrow,$id);
		$customers =$this->model->getonekey(array('id'=>$id,'hide'=>1));
		if(!$customers)
			redirect('customers/edit',1);		
		$this->uri = $this->getactionname();
		if($this->post() && $this->istoken('tokencustomers',$this->model->clean($this->post('tokencustomers'))))
		{			
			$data = array(
				'id' => $customers->id,
                'fullname' => $this->model->clean($this->post('fullname')),
                'name' => $this->model->clean($this->post('name')),
				'email' => $this->model->clean($this->post('email')),
                'address' => $this->model->clean($this->post('address')),
                'city' => $this->model->clean($this->post('city')),
                'district' => $this->model->clean($this->post('district')),
                'cellularphone' => $this->model->clean($this->post('cellularphone')),
                'image' => $this->model->clean($this->post('image')),
                'group_id' => $this->model->clean($this->post('group_id')),
                'last_login_time' => $this->model->clean($this->post('last_login_time')),
                'last_login_ip' => $this->model->clean($this->post('last_login_ip')),
                'vip' => $this->model->clean($this->post('vip')),
                'money' => $this->model->clean($this->post('money')),
                'point' => $this->model->clean($this->post('point')),
                'create_at' => $this->model->clean($this->post('create_at')),
				'status' => $this->model->clean($this->post('status')),
				'password' => $this->model->hashmd5($this->model->clean($_POST['password']))
			);
			if($this->model->update($data))
			{

				$customers = $this->model->getone($customers->id);
				$this->model->logs('Cập nhật thành công khách hàng: '.$customers->name ,$this->getcontrollername().'/'.$this->uri);
				$this->setmsg('Cập nhật thành công. Đang chuyển hướng...','success');
				if($this->model->clean($this->post('save')) == 1)
				{
					$this->setmsg('Cập nhật thành công.','success');
				}
				else{
					redirect('customers',2);
				}
			}
			else
			{
				$this->setmsg('Cập nhật thất bại. Đang chuyển hướng...','error');
			}
		}
		$this->setdata(array('customers'=>$customers,
							 'city'=>$city,
							 'district'=>$district,
							 'groups'=>$groups,
							 'news'=>$news,
							 'totalpage'=>$this->modelnews->totalid($id),
							 'catalogs'=>$this->models->listcatalogsid($this->tim_vi_tri_bat_dau($this->numrow),$this->numrow,$id),
							 'status'=>$this->statusmodel->liststatusall()
							 				 
							));
		$this->render('create_and_edit_form');
	}

	// Delete : chỉ ẩn không hiển thị
	function delete()
	{
		//get id:
		$id=$this->get('id');
		$customers= $this->model->getonekey(array('id'=>$id,'hide'=>1));
		if($customers){
			$data = array(
				'id' => $customers->id,
				'hide' => 2
			);
			if($this->model->update($data))
			{
				$customers = $this->model->getone($customers->id);
				$this->model->logs('Xóa thành công khách hàng : '.'customers/delete/'.$customers->id);
				// $this->setmsg('Xoá thành công. Đang chuyển hướng...','success');
				// redirect('customers',1);
				// $this->setmsg('Xóa không thành công!','success');
				$this->setmsg('Xoá thành công. Đang chuyển hướng...','success');
				if($this->model->clean($this->post('save')) == 1)
				{
					$this->setmsg('Xoá thành công.','success');
				}
				else{
					redirect('customers',2);
				}
			}
			else{
				$this->setmsg('Xóa không thành công!','error');
				redirect('customers',1);
			}
			
		}else{
			$this->setmsg('Xóa không thành công!','error');
			redirect('customers',1);
		}
		
		
	}


}
 
?>