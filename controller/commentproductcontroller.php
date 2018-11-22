<?php
defined('BASE') OR exit('Access Deny');
class commentproductcontroller  extends controller
{	
	function __construct()
	{
		$this->model = new commentproductmodel();
		$this->pathview = 'view/commentproduct/commentproduct/';
	}
	function index()
	{
		$this->title='Danh sách bình luận';
		$this->h = 'Danh sách bình luận';
		$this->a = 'Bình Luận';
		$this->strong = 'DS Bình Luận';
		$this->setscript(array('layout/js/plugins/dataTables/datatables.min.js'));
		$this->setcss(array('layout/css/plugins/dataTables/datatables.min.css'));
		// hiển thị theo dạng table 
			// $comment = $this->model->listcommentproduct11($this->tim_vi_tri_bat_dau($this->numrow),$this->numrow);
			// $totalpage = $this->model->total();
			// $this->setdata(array('commentproduct'=>$comment,
			// 					'totalpage'=>$totalpage
			// 			));
			// $this->render('list_view');
		// hiển thị theo dạng bài viết và bình luận 
			// list tất cả bài viết - 1 bài - 1 trang 
			//load bai viết - commnet bài viết 
			$catalogs=$this->model->list_catalogs_all();
			// load coment bài viết 
			$comment = $this->model->listcommentproduct();
			// set data ra View 2 
			$this->setdata(array('catalogs'=>$catalogs,
								 'comment'=>$comment
								));
			// gọi view 2 thể hiện : 
			$this->render('list_view3');
	}
	function api_getsub()
	{
		if($this->post()){
			$list = $this->model->replycommentproduct($this->post('parent'));
			echo json_encode(array('lv'=>$this->post('lv'),'data'=>$list));
		}else
			echo '[]';
	}
	function api_replace_commnet()
	{
		if($this->post()){
			// $rep=$this->post('rep');
			// $id_comment=$this->post('dataid');
			// $id_post=$this->post('dataidpost');
			// $id_user=$this->post('admin_id');
			$data = array(
				'content' => $this->post('rep'), 
                'idpost' => $this->post('dataidpost'),
                'iduser' => $this->post('admin_id'),
				'parent_id' => $this->post('dataid'),
				'state'=>1,
				'hide'=>1,
				'created' => date('Y-m-d H:i:s')
			);
			
			if($this->model->insert($data))
			{
				
				$comment = $this->model->getone($comment->id);
				$this->model->logs('Thêm thành công tài khoản: '.$comment->id,$this->getcontrollername().'/'.$this->uri);
				$data_ajax = array(
					'content' => $this->post('rep'), 
					'idpost' => $this->post('dataidpost'),
					'parent_id' => $this->post('dataid')
				);
				echo json_encode(array('data'=>$data_ajax));
			}
			else
			{
				$this->setmsg('Thêm thất bại. Đang chuyển hướng...','error');
			}
		
	   }
	}
	function api_show_hidden_commnet()
	{
		if($this->post()){
			 $kq = $this->model->show_hidden_commnet($this->post('id'));
			if($kq==1)
			{
				$data = array(
					'id' => $this->post('id'),
					'state'=>0
				);
				if($this->model->update($data))
					echo json_encode(array('data'=>2,'state'=>$kq));
				
			}
			if($kq==0)
			{
				$data = array(
					'id' => $this->post('id'),
					'state'=>1
				);
				if($this->model->update($data))
					echo json_encode(array('data'=>1,'state'=>$kq));
			}
		}
	}
	function replace()
	{
		$this->title ='Trả lời bình luận';
		$this->h = 'Trả lời  bình luận';
		$this->a = 'Bình Luận';
		$this->strong = 'Trả lời ';
		$this->save = 'Lưu';
		$this->save_close = 'Lưu & Đóng';
		$this->size_image = '(300x300)px';
		$id = $this->get('id');
		// $comment = $this->model->getonekey(array('id'=>$id,'hide'=>1));
		$comment = $this->model->detailscommentproduct($id);
		$idcomment= $this->model->idcomment($id);
		$customers= $this->model->customers();
		if(!$comment)
			redirect('commentproduct/edit',1);		
		$this->uri = $this->getactionname();	
		
		if($this->post() && $this->istoken('tokencommentproduct',$this->model->clean($this->post('tokencommentproduct'))))
		{			
			$data = array(
				'content' => $this->model->clean($this->post('content')), 
                'idpost' => $this->model->clean($this->post('idpost')),
                'iduser' => $this->model->clean($this->post('iduser')),
	            'idcomment' => $idcomment,
                'state' => 0,
                'hide' => 1,
                'parent_id' => $this->model->clean($this->post('id')),
                'level' => 0,
                'created' => date('Y-m-d H:i:s')
			);
		
			if($this->model->insert($data))
			{
				
				$comment = $this->model->getone($comment->id);
				$this->model->logs('Thêm thành công tài khoản: '.$comment->id,$this->getcontrollername().'/'.$this->uri);
				$this->setmsg('Thêm thành công. Đang chuyển hướng...','success');
				if($this->model->clean($this->post('save')) == 1)
				{
					$this->setmsg('Thêm thành công.','success');
				}
				else{
					$this->setdata(array('commentproduct'=>$comment,
							 'customers'=>$customers
						));
					redirect('commentproduct',2);
				}
			}
			else
			{
				$this->setmsg('Thêm thất bại. Đang chuyển hướng...','error');
			}
		}
		$this->setdata(array('commentproduct'=>$comment,
							 'customers'=>$customers
						));
		$this->render('replace');
	}
	function edit()
	{
		$this->title ='Sửa bình luận';
		$this->h = 'Sửa bình luận';
		$this->a = 'Bình Luận';
		$this->strong = 'Sửa';
		$this->save = 'Cập nhật';
		$this->save_close = 'Cập nhật & Đóng';
		$this->size_image = '(300x300)px';
		$id = $this->get('id');
		// $comment = $this->model->getonekey(array('id'=>$id,'hide'=>1));
		$comment = $this->model->detailscommentproduct($id);
		if(!$comment)
			redirect('commentproduct/edit',1);		
		$this->uri = $this->getactionname();	
		
		if($this->post() && $this->istoken('tokencommentproduct',$this->model->clean($this->post('tokencommentproduct'))))
		{			
			$data = array(
				'id' => $comment->id,
				'content' => $this->model->clean($this->post('content')),
                'state' => $this->model->clean($this->post('state'))
			);
		
			if($this->model->update($data))
			{
				
				$comment = $this->model->detailscommentproduct($comment->id);
				$this->model->logs('Cập nhật thành công tài khoản: '.$comment->id,$this->getcontrollername().'/'.$this->uri);
				$this->setmsg('Cập nhật thành công. Đang chuyển hướng...','success');
				if($this->model->clean($this->post('save')) == 1)
				{
					$this->setmsg('Cập nhật thành công.','success');
				}
				else{
					redirect('commentproduct',2);
				}
			}
			else
			{
				$this->setmsg('Cập nhật thất bại. Đang chuyển hướng...','error');
			}
		}
		$this->setdata(array('commentproduct'=>$comment));
		$this->render('create_and_edit_form');
	}
	function delete()
	{
		$id = $this->get('id');
		$comment = $this->model->getonekey(array('id'=>$id,'hide'=>1));
		if(!$comment)
			redirect('commentproduct',1);	
		$data = array(
				'id' => $comment->id,
				'hide' => 2
		);
		if($this->model->update($data))
		{
			$this->model->logs('Xóa thành công tài khoản: '.$comment->id,'customers/delete/'.$comment->id);
			redirect('commentproduct',1);
		}
		else
		{
			$this->setmsg('Xóa không thành công!','success');
		}
		$this->render('list_view');
	}


}
?>