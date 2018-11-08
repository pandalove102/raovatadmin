<?php
defined('BASE') OR exit('Access Deny');
class catalogcontroller  extends controller
{	
	function __construct()
	{
		parent::__construct();
		$this->model = new catalogmodel();
		$this->customersmodel = new customersmodel();
		$this->typecatalogsmodel = new typecatalogsmodel();
		$this->models = new catagorymodel();
		$this->modelstatus = new statusmodel();
		$this->pathview = 'view/products/catalog/';
	}
	function index()
	{
		$this->title='Danh sách bài viết';
		$this->h = 'Danh sách bài viết';
		$this->a = 'Bài viết';
		$this->strong = 'Danh sách';
		$status = $this->modelstatus->status();
		if($this->get() && $this->istoken('tokensearch',$this->model->clean($this->get('tokensearch'))))
		{
			// $this->model>varray($this->get('skus'),true);
			echo '2222';
			$catalogs = $this->model->searchproduct($this->get('skus'),$this->get('products'),
													$this->get('prices'),$this->get('qty'),
													$this->get('parent_id'),$this->get('status'),
													$this->pos,
													$this->numrow);
			if($this->get('skus') !='' || 
			   $this->get('products') !='' ||
			   $this->get('prices') !='' || 
			   $this->get('qty') !='' ||
			   $this->get('parent_id') !='' || 
			   $this->get('status') !='')
			{
				$totalpage=count($catalogs);
			}else {
				$totalpage = $this->model->total();
			}
				
		}else
		{
			$catalogs = $this->model->listcatalogs($this->pos,$this->numrow);
			$totalpage = $this->model->total();
		}
		$this->setdata(array('catalogs'=>$catalogs,'status'=>$status,'totalpage'=>$totalpage));
		$this->render('list_view_products');
	}
	function api_check_sku($return = false)
	{
		if($this->model->islogin()){
			$sku = $this->model->clean($this->post('sku'));
			$uri = $this->model->clean($this->post('uri'));
			$id = $this->model->clean($this->post('id_user'));
			if($uri == 'create')
			{
				$check = $this->model->getkey(array('sku'=>$sku,'hide'=>1));
				if($check){
					if($return) return false; else echo "false";
				}
				else{
					if($return) return true; else  echo "true";
				}
			}
			else
			{
				$check = $this->model->getkey(array('sku'=>$sku,'hide'=>1));
			//	print_r($check);
				$check_again = $this->model->getkey(array('id'=>$id,'hide'=>1));
				$checking = $check ? $check[0]->sku:'null';
				if($checking == $check_again[0]->sku)
				{
					if($return) return true; else echo "true";
				}
				else if($checking != 'null' && $checking != $check_again[0]->sku)
				{
					if($return) return false; else echo "false";
				}
				else
				{
					if($return) return true; else echo "true";
				}

			}
		}else
			return false;
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
				$check = $this->model->getkey(array('alias'=>$alias,'hide'=>1));
				$check_again = $this->model->getkey(array('id'=>$id,'hide'=>1));
				$checking = $check ? $check[0]->alias:'null';
				if($checking == $check_again[0]->alias)
				{
					if($return) return true; else echo "true";
				}
				else if($checking != 'null' && $checking != $check_again[0]->alias)
				{
					if($return) return false; else echo "false";
				}
				else
				{
					if($return) return true; else echo "true";
				}

			}
		}else
			return false;
	}
	function api_check_catalogs($return = false)
	{
		if($this->model->islogin()){
			$name = $this->model->clean($this->post('username'));
			$uri = $this->model->clean($this->post('uri'));
			$id = $this->model->clean($this->post('id_user'));
			if($uri == 'create')
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
				$check = $this->model->getkey(array('name'=>$name,'hide'=>1));
				$check_again = $this->model->getkey(array('id'=>$id,'hide'=>1));
				$checking = $check ? $check[0]->name:'null';
				if($checking == $check_again[0]->name)
				{
					if($return) return true; else echo "true";
				}
				else if($checking != 'null' && $checking != $check_again[0]->name)
				{
					if($return) return false; else echo "false";
				}
				else
				{
					if($return) return true; else echo "true";
				}

			}
		}else
			return false;
	}
	function listattribute()
	{
		$this->title='DS thuộc tính tin đăng';
		$this->h = 'DS thuộc tính tin đăng';
		$this->a = 'Danh mục';
		$this->strong = 'Danh sách';
		$this->uri = $this->getactionname();
		$id = $this->get('id');
		$idattribute = $this->post('idattribute');
		$idcatagories = $this->post('idcatagories');

		// get id tin đăng 
		$idcatalog=$this->get('idcatalog');
		// get id danh mục 
		$idcatagories=$this->get('idcatagories');
		// get list thuoc tính đầy đủ từ ID danh mục ra list đầy đủ
		$listattribute = $this->model->listattribute($idcatagories);
		// tính số trang 
		$totalpage =count($listattribute);
		if($totalpage<=0)
		{
			$totalpage=1;
		}
		$this->setdata(array('listattribute'=>$listattribute,
							  'totalpage'=> $totalpage
							));
		$this->render('listattribute');
		// if($this->post())
		// {
		// 		if($this->model->check_idattribute($idattribute,$idcatagories))
		// 		{
				
		// 			$data = array(
		// 				'idattribute' => $this->model->clean($this->post('idattribute')),
		// 				'idcatagories' => $this->model->clean($this->post('idcatagories')),
		// 				'created' => date('Y-m-d H:i:s'),
		// 				'hide' => 1,
		// 				'state' => 1
		// 			);
		// 			if($this->model->insert($data,'','catagories_attribute'))
		// 			{
		// 				$this->model->logs('Thêm thành công thuộc tình vào DM: '.$this->model->clean($this->post('username')),$this->getcontrollername().'/'.$this->uri);
		// 				if($this->model->clean($this->post('save')) == 1)
		// 				{
		// 					$this->setmsg('Thêm thành công.','success');
		// 				}
		// 				else{
		// 					redirect('catagory',2);
		// 				}
		// 			}
		// 			else
		// 			{
		// 				$this->setmsg('Thêm thất bại.','error');
		// 			}
				

		// 	}
		// }
	
		
		
	    
		
		

	}
	function create()
	{
		$this->title ='Thêm bài viết';
		$this->h = 'Thêm bài viết';
		$this->a = 'Bài viết';
		$this->strong = 'Thêm';
		$this->save = 'Lưu';
		$this->save_close = 'Lưu & Đóng';
		$this->size_image = '(600x400)px';
		$this->size_imgshare = '(600x400)px';
		$this->uri = $this->getactionname();
		$items = $this->model->listitem();
		$this->setdata(array('itemkm'=>$items,'status'=>$this->modelstatus->liststatusall()));
		if($this->post() && $this->istoken('tokencatalog',$this->model->clean($this->post('tokencatalog'))))
		{
						$jsonarray = array();
				if($this->post('imgs')){
					foreach($this->post('imgs') as $i=>$img)
					{
						$jsonarray[] = array('img'=>$img,'pos'=>$this->post('pos')[$i]);
					}
				}
				$json = $jsonarray? json_encode($jsonarray):'';
				if($this->api_check_catalogs(true) && $this->api_check_sku(true) && $this->api_check_alias(true))
				{
					
					$data = array(
						'sku' => $this->model->clean($this->post('sku')),
		                'name' => $this->model->clean($this->post('username')),
		                'alias' => $this->post('alias'),
		                'shortdescription' => $this->model->clean($this->post('shortdescription')),
		                'description' => $this->model->clean($this->post('description')),
		                'brand' => $this->model->clean($this->post('brand')),
		                'h1' => $this->model->clean($this->post('h1')),
		                'metakey' => $this->model->clean($this->post('metakey')),
		                'metadesc' => $this->model->clean($this->post('metadesc')),
		                'metatitle' => $this->model->clean($this->post('metatitle')),
		                'image' => $this->model->clean($this->post('image')),
		                'imgshare' => $this->model->clean($this->post('imgshare')),
		                'images' => $json,
						'color' => $this->model->clean($this->post('color')),
						'material' => $this->model->clean($this->post('material')),
		                'price' => $this->model->clean($this->post('price')),
						'status' => $this->model->clean($this->post('status')),
						'quantity' => $this->model->clean($this->post('quantity')),
		                'catagories_id' => $this->model->clean($this->post('catagorie_id')),
		                'tax' => $this->model->clean($this->post('tax')),
		                'afterprice' => (1+0.1)* $this->model->clean($this->post('price')),
		                'username' => $this->model->clean($this->model->session->get('admin_name')),
						'create_at' => date('Y-m-d H:i:s'),
						'hide' => 1
					);
					if($this->model->insert($data))
					{
						$this->model->logs('Thêm thành công bài viết: '.$this->model->clean($this->post('sku')),$this->getcontrollername().'/'.$this->uri);
						$sku = $this->model->getsku($this->model->clean($this->post('sku')));
						if($this->post('disname') && $this->post('disqty') && $this->post('disprice') && $this->post('disstart') && $this->post('disend'))
							{							
								if($sku){
									foreach($this->post('disname') as $i=>$discount)
									{
										$qty = $this->post('disqty')[$i];
										$pri = $this->post('disprice')[$i];
										$st = $this->post('disstart')[$i];
										$en = $this->post('disend')[$i];
										$this->model->adddiscount($sku->sku,$discount,$qty,$pri,$st,$en);
									}
								}
							}						
						if($this->post('kmitem_id') &&  $this->post('kmqty') )
							{
								if($sku){
									foreach($this->post('kmitem_id') as $j=>$km)
									{
										$qty = $this->post('kmqty')[$j];
										$this->model->addkm($sku->sku,$km,$qty);
									}
								}
							}

						if($this->model->clean($this->post('save')) == 1)
						{
							$this->setmsg('Thêm thành công.','success');
						}
						else{
							redirect('catalog',2);
						}
					}
					else
					{
						$this->setmsg('Thêm thất bại.','error');
					}
				}
				else
				{
					$this->setmsg('Tên bài viết đã tồn tại!','error');
				}
		
		}
		$this->render('create_and_edit_form_products');
	}
	function edit()
	{
		$this->title ='Cập nhật bài viết';
		$this->h = 'Bài viết';
		$this->a = 'Cập nhật bài viết';
		$this->strong = 'Sửa';
		$this->save = 'Cập nhật';
		$this->save_close = 'Cập nhật & Đóng';
		$this->size_image = '(600x400)px';
		$this->size_imgshare = '(600x400)px';
		$id = $this->get('id');
		$catalogs = $this->model->getonekey(array('id'=>$id,'hide'=>1));
		$discounts = $this->model->listdis($catalogs->sku);
		$items = $this->model->listitem();
		$listkm = $this->model->listkm($catalogs->sku);
		$status = $this->modelstatus->status();
		// city 
		$city=$this->customersmodel->city();
		// district
		$district=$this->customersmodel->district();
		// loại tin đăng
		$typecatalogs=$this->typecatalogsmodel->listtypecatalogsall();

		if(!$catalogs)
			redirect('catalog/create',1);
		else
		{
			$this->uri = $this->getactionname();
			if($this->post() && $this->istoken('tokencatalog',$this->model->clean($this->post('tokencatalog'))))
			{
				
					$jsonarray = array();
					if($this->post('imgs')){
						foreach($this->post('imgs') as $i=>$img)
						{
							$jsonarray[] = array('img'=>$img,'pos'=>$this->post('pos')[$i]);
						}
					}
					$json = $jsonarray? json_encode($jsonarray):'';
					$data = array(
						'id' => $catalogs->id,
		                'sku' => $this->model->clean($this->post('sku')),
		                'name' => $this->model->clean($this->post('username')),
		                'alias' => $this->post('alias'),
						'color' => $this->model->clean($this->post('color')),
						'material' => $this->model->clean($this->post('material')),
		                'shortdescription' => $this->model->clean($this->post('shortdescription')),
		                'description' => $this->model->clean($this->post('description')),
		                'brand' => $this->model->clean($this->post('brand')),
		                'h1' => $this->model->clean($this->post('h1')),
		                'metakey' => $this->model->clean($this->post('metakey')),
		                'metadesc' => $this->model->clean($this->post('metadesc')),
		                'metatitle' => $this->model->clean($this->post('metatitle')),
		                'image' => $this->model->clean($this->post('image')),
		                'imgshare' => $this->model->clean($this->post('imgshare')),
		                'images' => $json,
		                'price' => $this->model->clean($this->post('price')),
						'status' => $this->model->clean($this->post('status')),
						'quantity' => $this->model->clean($this->post('quantity')),
		                'catagories_id' => $this->model->clean($this->post('catagorie_id')),
		                'tax' => $this->model->clean($this->post('tax')),
		                'city' => $this->model->clean($this->post('city')),
		                'district' => $this->model->clean($this->post('district')),
		                'idtypecatalogs' => $this->model->clean($this->post('idtypecatalogs')),
		                'afterprice' => (1+0.1) * $this->model->clean($this->post('price')),
		                // 'username' => $this->model->clean($this->model->session->get('admin_name')),
						'update_at' => date('Y-m-d H:i:s'),
					);
					if($this->model->update($data))
					{
						$catalogs = $this->model->getone($catalogs->id);
						$this->model->logs('Cập nhật thành công bài viết: '.$catalogs->sku,$this->getcontrollername().'/'.$this->uri);
						$this->setmsg('Cập nhật thành công. Đang chuyển hướng...','success');
						if($this->post('disname') && $this->post('disqty') && $this->post('disprice') && $this->post('disstart') && $this->post('disend'))
							{							
								if($catalogs->sku){
									$this->model->deldis($catalogs->sku);
									foreach($this->post('disname') as $i=>$discount)
									{
										$qty = $this->post('disqty')[$i];
										$pri = $this->post('disprice')[$i];
										$st = $this->post('disstart')[$i];
										$en = $this->post('disend')[$i];
										$this->model->adddiscount($catalogs->sku,$discount,$qty,$pri,$st,$en);
									}
								}
							}
						$this->model->delpro($catalogs->sku);
						if($this->post('kmitem_id') &&  $this->post('kmqty') )
							{
								if($catalogs->sku){	
									foreach($this->post('kmitem_id') as $j=>$km)
									{
										$qty = $this->post('kmqty')[$j];
										$this->model->addkm($catalogs->sku,$km,$qty);
									}
								}
							}
						$discounts = $this->model->listdis($catalogs->sku);
						$items = $this->model->listitem();
						$listkm = $this->model->listkm($catalogs->sku);
						if($this->model->clean($this->post('save')) == 1)
						{
							$this->setmsg('Cập nhật thành công.','success');
						}
						else{
							redirect('catalog',2);
						}
					}
					else
					{
						$this->setmsg('Cập nhật thất bại. Đang chuyển hướng...','error');
					}
			
			}
			// danh sách thuộc tính mở rộng tin đăng
			$listattribute = $this->model->listattribute($this->tim_vi_tri_bat_dau($this->numrow),$this->numrow,$id);
			// tính số trang 
			$totalpage =count($listattribute);
			if($totalpage<=0)
			{
				$totalpage=1;
			}
			$this->setdata(array('catalogs'=>$catalogs,
								 'listattribute'=>$listattribute,
								 'totalpage'=>$totalpage,
								'listdis'=>$discounts,
								'itemkm'=>$items,
								'listkm'=>$listkm,
								'city'=>$city,
								'district'=>$district,
								'typecatalogs'=>$typecatalogs,
								'status'=>$this->modelstatus->status(),
							));
			$this->render('create_and_edit_form_products');
		}
	}
	function delete()
	{
		$id = $this->get('id');
		$catalogs = $this->model->getonekey(array('id'=>$id,'hide'=>1));
		if(!$catalogs)
			redirect('catalog',1);
		$data = array(
				'id' => $catalogs->id,
				'hide' => 2
		);
		if($this->model->update($data))
		{
			$this->model->logs('Xóa thành công bài viết: '.$catalogs->sku,'catalog/delete/'.$catalogs->id);
			$this->setmsg('Xóa thành công!','success');
			redirect('catalog',2);
		}
		else
		{
			$this->setmsg('Xóa không thành công!','success');
		}
		$this->render('list_view_products');
	}
	function api_listcatnice($name='catagories_id',$selectid = 0)
	{
	   $list = $this->model->listcatnice();
	   echo ' <select class="form-control m-b" name="'.$name.'"> <option value="">--- Danh mục bài viết ---</option>';
	   $ar1 = array();$ar2 = array();
	   foreach($list as $item)
	   {
	       if($item->parent_id==0)
	       {
	             echo '<optgroup  label="|-- '.$item->name.'">';
	            foreach ($list as $item1)
	            {
	               
	                if($item1->parent_id==$item->id)
	                {
	                    echo '<option '.($item1->id==$selectid?'selected':'').' value="'.$item1->id.'">|-- '.$item1->name.'</option>';
        	            foreach ($list as $item2)
        	            {
        	                if($item2->parent_id==$item1->id)
        	                {
        	                    echo '<option '.($item2->id==$selectid?'selected':'').' value="'.$item2->id.'">&nbsp;&nbsp;&nbsp;&nbsp;|-- '.$item2->name.'</option>';
        	                }
        	            }
	                }
	            }
	            echo '</optgroup>';
	            $ar1[] = $item;
        	    unset($item);
	            
	       }
	   }
	   echo '<select>';
	}
}
 
?>