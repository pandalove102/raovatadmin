
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
                  <!-- <input type="hidden" name="id_user" id="id_user" value="<?=(isset($customers)) ? $customers->id : ''?>"> -->
                  <div class="wrapper wrapper-content animated fadeInRight ecommerce">
                    <!-- <div class="col-sm-9 col-sm-offset-8">
                        <a class="btn btn-white" type="text" href="<?=base_url('customers');?>">Cancel</a>
                        <button class="btn btn-primary" type="submit" name="save" value="1"><?php echo $this->save ?></button>
                        <button class="btn btn-primary" type="submit" name="save" value="2"><?php echo $this->save_close ?></button>
                    </div> -->
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="tabs-container">
                           <!-- <ul class="nav nav-tabs">
                              <li class=""><a data-toggle="tab" href="#tab-1"> Danh Sách Bài Viết</a></li>
                           </ul> -->
                           <div class="tab-content">
                              <!-- <div id="tab-1" class="tab-pane active"> -->
                              <div class="col-lg-12">
                                <div class="ibox">
                                    <div class="ibox-content">
                                    <?php $this->paging($totalpage,'left'); ?>
                                        <div style="text-align: right;">
                                        <a class="btn btn-success" style="margin-bottom: 0px;" type="text" href="<?=base_url('catalog/create'); ?>">Thêm bài viết mới</a>
                                        
                                        </div>
                                        
                                        <table class="footable table table-stripped toggle-arrow-tiny" data-paging="false">
                                            <thead>
                                            <tr>
                                                <th data-toggle="true">ID</th>
                                                <th data-toggle="true">SKU</th>
                                                <th data-toggle="true">H/Ảnh</th>
                                                <th data-toggle="true">Tên sản phẩm</th>
                                                <th data-hide="phone">Danh mục</th>
                                                <th data-hide="all">Mô tả</th>
                                                <th data-hide="phone">Giá</th>
                                                <th data-hide="all" >Số lượng</th>
                                                <th data-hide="phone">Trạng thái</th>
                                                <th class="text-right" data-sort-ignore="true">Hành Động</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php if($listpost) {foreach ($listpost as $v) { ?>
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
