
<!-- <?php $this->xem_mang($_POST); ?> -->
<?php defined('BASE') OR exit('No direct script access allowed');?>
<form class="m-t" role="form" action="" method="post" >
<div class="row">
   <div class="col-lg-12">
      <div class="ibox float-e-margins">
         <div class="ibox-title">
            <h5>All form elements <small>With custom checbox and radion elements.</small></h5>
            <div class="ibox-tools">
               <a class="collapse-link">
               <i class="fa fa-chevron-up"></i>
               </a>
               <a class="dropdown-toggle" data-toggle="dropdown" href="#">
               <i class="fa fa-wrench"></i>
               </a>
               <ul class="dropdown-menu dropdown-user">
                  <li><a href="#">Config option 1</a>
                  </li>
                  <li><a href="#">Config option 2</a>
                  </li>
               </ul>
               <a class="close-link">
               <i class="fa fa-times"></i>
               </a>
            </div>
         </div>
         <div class="ibox-content">
            <div class="form-horizontal">
                    <?=$this->randtoken('tokencustomers'); ?>
                  <input type="hidden" name="uri" id="uri" value="<?php echo $this->uri ?>">
                  <input type="hidden" name="id_user" id="id_user" value="<?=(isset($customers)) ? $customers->id : ''?>">
                  <div class="wrapper wrapper-content animated fadeInRight ecommerce">
                    <div class="col-sm-9 col-sm-offset-8">
                        <a class="btn btn-white" type="text" href="<?=base_url('customers');?>">Cancel</a>
                        <button class="btn btn-primary" type="submit" name="save" value="1"><?php echo $this->save ?></button>
                        <button class="btn btn-primary" type="submit" name="save" value="2"><?php echo $this->save_close ?></button>
                    </div>
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="tabs-container">
                           <ul class="nav nav-tabs">
                              <li class="active"><a data-toggle="tab" href="#tab-1"> Thông tin khách hàng</a></li>
                              <li class=""><a data-toggle="tab" href="#tab-2"> Thông tin khác</a></li>
                              <li class=""><a data-toggle="tab" href="#tab-3"> Danh Sách Bài Viết</a></li>
                           </ul>
                           <div class="tab-content">
                              <div id="tab-1" class="tab-pane active">
                                 <div class="panel-body">
                                    <fieldset class="form-horizontal">
                                        <input type="hidden" name="id" id="id" value="<?=(isset($customers)) ? $customers->id : ''?>">
                                        <div class="form-group">
                                          <label class="col-sm-2 control-label">Tên:</label>
                                          <div class="col-sm-10"><input type="text" required="" placeholder="Full name" class="form-control area-input" 
                                          name="fullname" id="fullname"  value="<?=(isset($customers)) ? $customers->fullname : ''?>"></div>
                                        </div>
                                        <div class="form-group">
                                          <label class="col-sm-2 control-label">Tên tài khoản:</label>
                                          <div class="col-sm-10"><input type="text" required="" placeholder="Name" class="form-control area-input" 
                                          name="name" id="name"  value="<?=(isset($customers)) ? $customers->name : ''?>"></div>
                                        </div>
                                        <div class="form-group">
                                          <label class="col-sm-2 control-label">Mật khẩu:</label>
                                          <div class="col-sm-10"><input type="password" required="" placeholder="Password" class="form-control area-input" 
                                          name="password" id="password"  value="<?=(isset($customers)) ? $customers->password : ''?>"></div>
                                        </div>
                                        <div class="form-group">
                                          <label class="col-sm-2 control-label">Email:</label>
                                          <div class="col-sm-10"><input type="text" required="" placeholder="Email" class="form-control area-input" 
                                          name="email" id="email"  value="<?=(isset($customers)) ? $customers->email : ''?>"></div>
                                        </div>
                                        <div class="form-group">
                                          <label class="col-sm-2 control-label">Địa chỉ:</label>
                                          <div class="col-sm-10"><input type="text" required="" placeholder="Address" class="form-control area-input" 
                                          name="address" id="address"  value="<?=(isset($customers)) ? $customers->address : ''?>"></div>
                                        </div>
                                        <div class="form-group">
                                          <label class="col-sm-2 control-label">Thành Phố:</label>
                                          <div class="col-sm-10">
                                          <select class="form-control m-b" id="city" name="city">
                                                <?php
                                                  for($i=1;$i<count($city);$i++)
                                                  {
                                                ?>
                                                <option value="<?=(isset($city[$i])) ? $city[$i]->id : ''?>" <?=(isset($customers->city) && $city[$i]->id==$customers->city) ? 'selected="selected"' : '' ?>> <?=(isset($city[$i])) ? $city[$i]->name : ''?> </option>
                                                <?php
                                                  }
                                                ?>
                                             </select>
                                             </div>
                                        </div>
                                        <div class="form-group">
                                          <label class="col-sm-2 control-label">Quận/Huyện:</label>
                                          <div class="col-sm-10">
                                            <select class="form-control m-b" id="district" name="district">
                                                <?php
                                                  for($i=1;$i<count($district);$i++)
                                                  {
                                                ?>
                                                <option value="<?=(isset($district[$i])) ? $district[$i]->id : ''?>" <?=(isset($customers->district) && $district[$i]->id==$customers->district) ? 'selected="selected"' : '' ?>> <?=(isset($district[$i])) ? $district[$i]->name : ''?> </option>
                                                <?php
                                                  }
                                                ?>
                                             </select>
                                        </div>
                                        </div>
                                     
                                        <div class="form-group">
                                          <label class="col-sm-2 control-label">Số Điện Thoại:</label>
                                          <div class="col-sm-10"><input type="text" required="" placeholder="Phone" class="form-control area-input" 
                                          name="cellularphone" id="cellularphone"  value="<?=(isset($customers)) ? $customers->cellularphone : ''?>"></div>
                                        </div>
                                       <div class="form-group">
                                          <label class="col-sm-2 control-label">Hình ảnh</label>
                                          <div class="col-sm-9">
                                             <img src="<?=(isset($customers) && $customers->image) ? $customers->image : base_url('layout/images/no-image.png')?>" height="100px" width="100px">
                                             <input type="hidden" name="image" value="<?=(isset($customers)) ? $customers->image : ''?>"  id="image" />
                                              <button class="btn btn-info" type="button" onclick="openPopup('image')">Thêm</button>
                                              <!-- <?php echo $this->size_image ?>                     -->
                                          </div>
                                       </div>
                                    </fieldset>
                                 </div>
                              </div>
                              <div id="tab-2" class="tab-pane">
                                 <div class="panel-body">
                                    <fieldset class="form-horizontal">
                                    <input type="hidden" name="id" id="id" value="<?=(isset($customers)) ? $customers->id : ''?>">
                                        <div class="form-group">
                                          <label class="col-sm-2 control-label">Nhóm:</label>
                                          <div class="col-sm-10">
                                          <select class="form-control m-b" name="group_id">
                                                <?php
                                                  for($i=0;$i<count($groups);$i++)
                                                  {
                                                ?>
                                                <option value="<?php echo $groups[$i]->id  ?>" <?=(isset($customers->group_id) && $groups[$i]->id==$customers->group_id) ? 'selected="selected"' : '' ?>> <?php echo $groups[$i]->fullname  ?> </option>
                                                <?php
                                                  }
                                                ?>
                                             </select>
                                          </div>
                                        </div>
                                        <!-- <div class="form-group">
                                          <label class="col-sm-2 control-label">last_login_time:</label>
                                          <div class="col-sm-10"><input type="text" placeholder="last_login_time" class="form-control area-input" 
                                          name="last_login_time" id="last_login_time"  value="<?=(isset($customers)) ? $customers->last_login_time : ''?>"></div>
                                        </div>
                                        <div class="form-group">
                                          <label class="col-sm-2 control-label">last_login_ip:</label>
                                          <div class="col-sm-10"><input type="text"  placeholder="last_login_ip" class="form-control area-input" 
                                          name="last_login_ip" id="last_login_ip"  value="<?=(isset($customers)) ? $customers->last_login_ip : ''?>"></div>
                                        </div> -->
                                        <div class="form-group">
                                          <label class="col-sm-2 control-label">Loại Vip:</label>
                                          <div class="col-sm-10">
                                             <select class="form-control m-b" name="vip">
                                                <option value="1" <?=(isset($customers) && $customers->vip==1) ? 'selected="selected"' : '' ?>> VIP </option>
							                    <option value="2" <?=(isset($customers) && $customers->vip==2) ? 'selected="selected"' : '' ?>> Không VIP </option>
                                             </select>
                                          </div>
                                        </div>
                                        <div class="form-group">
                                          <label class="col-sm-2 control-label">Tiền:</label>
                                          <div class="col-sm-10"><input type="text"  placeholder="money" class="form-control area-input" 
                                          name="money" id="money"  value="<?=(isset($customers)) ? $customers->money : ''?>"></div>
                                        </div>
                                        <div class="form-group">
                                          <label class="col-sm-2 control-label">Điểm:</label>
                                          <div class="col-sm-10"><input type="text"  placeholder="vip" class="form-control area-input" 
                                          name="point" id="point"  value="<?=(isset($customers)) ? $customers->point : ''?>"></div>
                                        </div>
                                        <!-- <div class="form-group">
                                          <label class="col-sm-2 control-label">Create at:</label>
                                          <div class="col-sm-10"><input type="text"  placeholder="Create at" class="form-control area-input" 
                                          name="create_at" id="create_at"  value="<?=(isset($customers)) ? $customers->create_at : date('Y-m-d H:i:s') ?>"></div>
                                        </div> -->
                                       <div class="form-group">
                                          <label class="col-sm-2 control-label">Trạng Thái:</label>
                                          <div class="col-sm-10">
                                             <select class="form-control m-b" name="status">
                                                <option value="1" <?=(isset($customers) && $customers->status==1) ? 'selected="selected"' : '' ?>> Hoạt Động </option>
							                    <option value="2" <?=(isset($customers) && $customers->status==2) ? 'selected="selected"' : '' ?>> Khóa </option>
                                             </select>
                                          </div>
                                       </div>
                                    </fieldset>
                                 </div>
                              </div>
                              <div id="tab-3" class="tab-pane">
                              <div class="col-lg-12">
              <div class="ibox">
                  <div class="ibox-content">
                    <div style="text-align: right;">
                      <a class="btn btn-success" style="margin-bottom: 0px;" type="text" href="<?=base_url('catalog/create'); ?>">Thêm bài viết mới</a>
					  <?php $this->paging($totalpage,'left'); ?>
                    </div>
					
                      <table class="footable table table-stripped toggle-arrow-tiny" data-paging="false">
                        <thead>
                           <tr>
                              <th data-toggle="true">ID</th>
                              <th data-toggle="true">SKU</th>
                              <th data-toggle="true">H/Ảnh</th>
                              <th data-toggle="true">Tên sản phẩm</th>
                              <th data-hide="phone">Danh mục</th>
                              <!-- <th data-hide="all">Mô tả</th> -->
                              <th data-hide="phone">Giá</th>
                              <th data-hide="all" >Số lượng</th>
                              <th data-hide="phone">Trạng thái</th>
                              <th class="text-right" data-sort-ignore="true">H/Động</th>
                           </tr>
                        </thead>
                          <tbody>
                           <?php if($catalogs) {foreach ($catalogs as $v)  { ?>
                              <tr class="footable-even" style="">
                                 <td class="footable-visible footable-first-column"><span class="footable-toggle"></span>
                                    <?php echo $v->id ?>
                                 </td>
                                 <td class="footable-visible">
                                    <?php echo $v->sku ?>
                                 </td>
                                 <td class="footable-visible">
                                    <img src="<?=($v->image) ? $v->image : base_url('layout/images/no-image.png')?>" height="50px" width="50px">
                                 </td>
                                 <td class="footable-visible">
                                    <?php echo $v->name ?>
                                 </td>
                                 <td class="footable-visible">
                                    <?php echo $v->catname ?>
                                 </td>
                                 <td style="display: none;">
                                    <?php echo $v->description ?>
                                 </td>
                                 <td class="footable-visible">
                                    $ <?php echo number_format($v->price) ?> VNĐ
                                 </td>
                                 <td class="footable-visible">
                                    <?php echo $v->quantity ?>
                                 </td>
                                 <td>
                                  <?php if($status) {foreach ($status as $s) { ?>
                                    <span class="label label-primary"><?=(isset($v->status) && $v->status==$s->id) ? $s->name : '' ?></span>
                                  <?php }} ?>
                                 </td>
                                 <td class="text-right">
                                    <div class="btn-group">
                                       <a href="<?=base_url('catalog/edit/'.$v->id); ?>" class="btn-white btn btn-xs">Sửa</a>
                                       <a href="<?=base_url('catalog/delete/'.$v->id); ?>" class="btn-white btn btn-xs">Xóa</a>
                                    </div>
                                 </td>
                              </tr>
                           <?php }}else echo '<tr><td colspan="10">Chưa có dữ liệu</td></tr>' ?>
                          </tbody>
                      </table>
					  <?php $this->paging($totalpage); ?>
                  </div>
              </div>
          </div>
                              <!-- </div> -->
                              </div>
                           
                           </div>
                        </div>
                     </div>
                  </div>
                 
               </div>
               
            </div>
         </div>
      </div>
   </div>
</div>
</form>
<script>
$(document).on('change','#city', function() {
  var _that = $(this);
  var id=$( "#city" ).val();
  // alert(id);
  $.post('<?=base_url('customers/api_getsub') ?>',{id:id})
  .done(function(d){
			if(d && d!='[]')
			{
        // alert(d);
        var str = '<select class="form-control m-b" name="district">';
				$( "#district" ).empty();
				d = JSON.parse(d);
				$.each(d.data, function(k,v) 
        {
          str +='<option value="'+v.id+'">'+v.name+' </option>';	
        });
				str += '</select>';
        // alert(str);
				$( "#district" ).html(str);
			}else{
				$( "#district" ).html('<select class="form-control m-b" name="district"> No data </select> ');
			}
		})

});
</script>
