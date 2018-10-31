<?php
defined('BASE') OR exit('Access Deny');
class paymentmethodscontroller  extends controller
{	
	function __construct()
	{
		$this->model = new paymentmethodsmodel();
		$this->pathview = 'view/paymentmethods/paymentmethods/';
	}
	function index()
	{
		$this->title='Danh sách phương thức thanh toán';
		$this->h = 'Danh sách phương thức thanh toán';
		$this->a = 'phương thức thanh toán';
		$this->strong = 'Danh sách phương thức thanh toán';
		$this->setscript(array('layout/js/plugins/dataTables/datatables.min.js'));
		$this->setcss(array('layout/css/plugins/dataTables/datatables.min.css'));
		$totalpage = $this->model->total();
		
		if($this->get() && $this->istoken('tokensearch',$this->model->clean($this->get('tokensearch'))))
		{
			$catalogs = $this->model->searchpaymentmethods($this->tim_vi_tri_bat_dau($this->numrow),
														   $this->numrow,$this->get('key'),
														   $this->get('keydistributor')
														  );
		}else
		{
			$catalogs=$this->model->listpaymentmethods($this->tim_vi_tri_bat_dau($this->numrow),$this->numrow);
		}
		
		$this->setdata(array('paymentmethods'=>$catalogs,'totalpage'=>$totalpage));
		$this->render('list_view');
    }
    function api_check_paymentmethods($return = false)
	{
		if($this->model->islogin()){
			$paymentmethods = $this->model->clean($_POST['name']);
			$uri = $this->model->clean($_POST['uri']);
			$id = $this->model->clean($_POST['id']);
			if($uri == 'create' && empty($id))
			{
				$check = $this->model->getkey(array('name'=>$paymentmethods));
				if($check){
					if($return) return false; else echo "false";
				}
				else{
					if($return) return true; else  echo "true";
				}
			}
			else
			{
				$check = $this->model->getkey(array('paymentmethods'=>$paymentmethods,'id'=>$id));
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
		$this->title ='Thêm phương thức thanh toán';
		$this->h = 'Thêm phương thức thanh toán';
		$this->a = 'Nhóm phương thức thanh toán';
		$this->strong = 'Thêm';
		$this->save = 'Lưu';
		$this->save_close = 'Lưu & Đóng';
		$this->uri = $this->getactionname();
		if($this->post() && $this->istoken('tokenpaymentmethods',$this->model->clean($_POST['tokenpaymentmethods'])))
		{			
			if($this->api_check_paymentmethods(true))
			{ 
				$data = array(
					'name' => $this->model->clean($this->post('name')),
					'state' => $this->model->clean($this->post('state')),
					'distributor'=> $this->model->clean($this->post('distributor')),
					'created' => date('Y-m-d H:i:s'),
	                'hide' => 1
				);
				if($this->model->insert($data))
				{
					$this->model->logs('Thêm thành công paymentmethods: '.$this->model->clean($this->post('name')),$this->getcontrollername().'/'.$this->uri);
					if($this->model->clean($this->post('save')) == 1)
					{
						$this->setmsg('Thêm thành công.','success');
					}
					else{
						redirect('paymentmethods',2);
					}
				}
				else
				{
					$this->setmsg('Thêm thất bại.','error');
				}
			}else
			{
				$this->setmsg('paymentmethods đã tồn tại!','error');
			}
		}
		$this->render('create_and_edit_form');
	}
	function edit()
	{
		$this->title ='Sửa phương thức thanh toán';
		$this->h = 'Sửa phương thức thanh toán';
		$this->a = 'Nhóm phương thức thanh toán';
		$this->strong = 'Sửa';
		$this->save = 'Cập nhật';
		$this->save_close = 'Cập nhật & Đóng';
		$id = $this->get('id');
		$paymentmethods = $this->model->getonekey(array('id'=>$id,'hide'=>1));
		if(!$paymentmethods)
			redirect('paymentmethods/edit',1);		
		$this->uri = $this->getactionname();
		if($this->post() && $this->istoken('tokenpaymentmethods',$this->model->clean($this->post('tokenpaymentmethods'))))
		{			
			$data = array(
				'id' => $paymentmethods->id,
                'name' => $this->model->clean($this->post('name')),
				'state' => $this->model->clean($this->post('state')),
				'distributor'=> $this->model->clean($this->post('distributor'))
			);
			if($this->model->update($data))
			{

				$paymentmethods = $this->model->getone($paymentmethods->id);
				$this->model->logs('Cập nhật thành công paymentmethods: '.$paymentmethods->name ,$this->getcontrollername().'/'.$this->uri);
				$this->setmsg('Cập nhật thành công. Đang chuyển hướng...','success');
				if($this->model->clean($this->post('save')) == 1)
				{
					$this->setmsg('Cập nhật thành công.','success');
				}
				else{
					redirect('paymentmethods',2);
				}
			}
			else
			{
				$this->setmsg('Cập nhật thất bại. Đang chuyển hướng...','error');
			}
		}
		$this->setdata(array('paymentmethods'=>$paymentmethods));
		$this->render('create_and_edit_form');
	}
	// Delete : chỉ ẩn không hiển thị
	function delete()
	{
		//get id:
		$id=$this->get('id');
		$paymentmethods= $this->model->getonekey(array('id'=>$id,'hide'=>1));
		if($paymentmethods){
			$data = array(
				'id' => $paymentmethods->id,
				'hide' => 2
			);
			if($this->model->update($data))
			{
				$paymentmethods = $this->model->getone($paymentmethods->id);
				$this->model->logs('Xóa thành công paymentmethods : '.'paymentmethods/delete/'.$paymentmethods->id);
				$this->setmsg('Xoá thành công. Đang chuyển hướng...','success');
				if($this->model->clean($this->post('save')) == 1)
				{
					$this->setmsg('Xoá thành công.','success');
				}
				else{
					redirect('paymentmethods',2);
				}
			}
			else{
				$this->setmsg('Xóa không thành công!','error');
				redirect('paymentmethods',1);
			}
			
		}else{
			$this->setmsg('Xóa không thành công!','error');
			redirect('paymentmethods',1);
		}
		
		
	}


}
 
?>