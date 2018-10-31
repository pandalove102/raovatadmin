<?php
defined('BASE') OR exit('Access Deny');
class rechargecontroller  extends controller
{	
	function __construct()
	{
		$this->model = new rechargemodel();
		$this->pathview = 'view/recharge/recharge/';
	}
	function index()
	{
		$this->title='Danh sách recharge';
		$this->h = 'Danh sách recharge';
		$this->a = 'recharge';
		$this->strong = 'Danh sách recharge';
		$this->setscript(array('layout/js/plugins/dataTables/datatables.min.js'));
		$this->setcss(array('layout/css/plugins/dataTables/datatables.min.css'));
		$totalpage = $this->model->total();
		$this->setdata(array('recharge'=>$this->model->listrecharge($this->tim_vi_tri_bat_dau($this->numrow),$this->numrow),'totalpage'=>$totalpage));
		$this->render('list_view');
    }
    function api_check_recharge($return = false)
	{
		if($this->model->islogin()){
			$recharge = $this->model->clean($_POST['name']);
			$uri = $this->model->clean($_POST['uri']);
			$id = $this->model->clean($_POST['id']);
			if($uri == 'create' && empty($id))
			{
				$check = $this->model->getkey(array('name'=>$recharge));
				if($check){
					if($return) return false; else echo "false";
				}
				else{
					if($return) return true; else  echo "true";
				}
			}
			else
			{
				$check = $this->model->getkey(array('recharge'=>$recharge,'id'=>$id));
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
		$this->title ='Thêm recharge';
		$this->h = 'Thêm recharge';
		$this->a = 'Nhóm recharge';
		$this->strong = 'Thêm';
		$this->save = 'Lưu';
		$this->save_close = 'Lưu & Đóng';
		$this->uri = $this->getactionname();
		if($this->post() && $this->istoken('tokenrecharge',$this->model->clean($_POST['tokenrecharge'])))
		{			
			if($this->api_check_recharge(true))
			{ 
				$data = array(
					'name' => $this->model->clean($this->post('name')),
					'state' => $this->model->clean($this->post('state')),
					'created' => date('Y-m-d H:i:s'),
	                'hide' => 1
				);
				if($this->model->insert($data))
				{
					$this->model->logs('Thêm thành công recharge: '.$this->model->clean($this->post('name')),$this->getcontrollername().'/'.$this->uri);
					if($this->model->clean($this->post('save')) == 1)
					{
						$this->setmsg('Thêm thành công.','success');
					}
					else{
						redirect('recharge',2);
					}
				}
				else
				{
					$this->setmsg('Thêm thất bại.','error');
				}
			}else
			{
				$this->setmsg('recharge đã tồn tại!','error');
			}
		}
		$this->render('create_and_edit_form');
	}
	function edit()
	{
		$this->title ='Sửa recharge';
		$this->h = 'Sửa recharge';
		$this->a = 'Nhóm recharge';
		$this->strong = 'Sửa';
		$this->save = 'Cập nhật';
		$this->save_close = 'Cập nhật & Đóng';
		$id = $this->get('id');
		$recharge = $this->model->getonekey(array('id'=>$id,'hide'=>1));
		if(!$recharge)
			redirect('recharge/edit',1);		
		$this->uri = $this->getactionname();
		if($this->post() && $this->istoken('tokenrecharge',$this->model->clean($this->post('tokenrecharge'))))
		{			
			$data = array(
				'id' => $recharge->id,
                'name' => $this->model->clean($this->post('name')),
                'state' => $this->model->clean($this->post('state')),
				'created' => date('Y-m-d H:i:s')
			);
			if($this->model->update($data))
			{

				$recharge = $this->model->getone($recharge->id);
				$this->model->logs('Cập nhật thành công recharge: '.$recharge->name ,$this->getcontrollername().'/'.$this->uri);
				$this->setmsg('Cập nhật thành công. Đang chuyển hướng...','success');
				if($this->model->clean($this->post('save')) == 1)
				{
					$this->setmsg('Cập nhật thành công.','success');
				}
				else{
					redirect('recharge',2);
				}
			}
			else
			{
				$this->setmsg('Cập nhật thất bại. Đang chuyển hướng...','error');
			}
		}
		$this->setdata(array('recharge'=>$recharge));
		$this->render('create_and_edit_form');
	}
	// Delete : chỉ ẩn không hiển thị
	function delete()
	{
		//get id:
		$id=$this->get('id');
		$recharge= $this->model->getonekey(array('id'=>$id,'hide'=>1));
		if($recharge){
			$data = array(
				'id' => $recharge->id,
				'hide' => 2
			);
			if($this->model->update($data))
			{
				$recharge = $this->model->getone($recharge->id);
				$this->model->logs('Xóa thành công recharge : '.'recharge/delete/'.$recharge->id);
				$this->setmsg('Xoá thành công. Đang chuyển hướng...','success');
				if($this->model->clean($this->post('save')) == 1)
				{
					$this->setmsg('Xoá thành công.','success');
				}
				else{
					redirect('recharge',2);
				}
			}
			else{
				$this->setmsg('Xóa không thành công!','error');
				redirect('recharge',1);
			}
			
		}else{
			$this->setmsg('Xóa không thành công!','error');
			redirect('recharge',1);
		}
		
		
	}


}
 
?>