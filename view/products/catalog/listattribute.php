
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
                <div class="ibox-title">
                <!-- <h5>All form elements <small>With custom checbox and radion elements.</small></h5> -->
                <div class="ibox-tools"></div>
            </div>
                    <?=$this->randtoken('tokenattribute'); ?>
                  <input type="hidden" name="uri" id="uri" value="<?php echo $this->uri ?>">
                  <input type="hidden" name="idcatagories"  value="<?php echo $this->get('id'); ?>">
                  <div class="wrapper wrapper-content animated fadeInRight ecommerce">
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="tabs-container">
                           <div class="tab-content">
                              <div id="tab-1" class="tab-pane active">
                              <div class="col-lg-12">
                                <div class="ibox">
                                <div style="text-align: right;">
                                        <!-- <a class="btn btn-success" style="margin-bottom: 0px;" type="text" href="<?=base_url('attribute/create'); ?>">Tạo thuộc tính mới</a> -->
                                <div>
                                    <div class="ibox-content">
                                    <?php $this->paging($totalpage,'left'); ?>
                                        <div style="text-align: right;">
                                        <!-- <a class="btn btn-success" style="margin-bottom: 0px;" type="text" href="<?=base_url('catagories/create'); ?>">Tạo thuộc tính mới</a> -->
                                        <!-- Button to Open the Modal -->
                                        <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                            Thêm thuộc tính mới vào danh mục 
                                        </button> -->
                                        </div>
                                          <!-- Button to Open the Modal -->
                                            <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                                Open modal
                                            </button> -->
                                        
                                            <!-- The Modal -->
                                            
                                            <!-- <div class="modal" id="myModal">
                                           
                                                <div class="modal-dialog">
                                                    <div class="modal-content"> -->
                                                    <!-- Modal Header -->
                                                    <!-- <div class="modal-header">
                                                        <h4 class="modal-title">Danh sach thuộc tính</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div> -->
                                                    <!-- Modal body -->
                                                    <!-- <div class="modal-body">
                                                        <select class="form-control" name="idattribute">
                                                            <?php 
                                                            
                                                                for($i=0;$i<count($listattributeall);$i++)
                                                                {
                                                                    
                                                             ?>
                                                             <option  value="<?php  echo $listattributeall[$i]->id  ?>" ><?php  echo $listattributeall[$i]->label  ?></option>
                                                            <?php 
                                                                      
                                                            }
                                                            ?>
                                                        </select>
                                                    </div> -->
                                                      
                                                    <!-- Modal footer -->
                                                    <!-- <div class="modal-footer">
                                                        <button type="submit" value="1" class="btn btn-success" name="save" >Lưu</button>
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div> -->


                                             <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="tabs-container">
                                                    <ul class="nav nav-tabs">
                                                        <li class="active"><a data-toggle="tab" href="#tab-1"> Thuộc tín bài đăng </a></li>
                                                    </ul>
                                                    <div class="tab-content">
                                                    <?php if($listattribute) {foreach ($listattribute as $v) { ?>
                                                        <div id="tab-1" class="tab-pane active">
                                                            <div class="panel-body">
                                                                <fieldset class="form-horizontal">
                                                                <div class="form-group">
                                                                    <label class="col-sm-2 control-label">ID:</label>
                                                                    <div class="col-sm-10"><input type="hidden"  class="form-control area-input" name="idattribute" id="idattribute" value="<?php echo $v->idattribute ?>" ></div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-2 control-label">Tiêu đề:</label>
                                                                    <div class="col-sm-10">
                                                                    <input type="text"  name="label" id="label"   value="<?=(isset($v->label)) ? $v->label : ''?>"></div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-2 control-label">Giá trị:</label>
                                                                    <div class="col-sm-10">
                                                                    <input type="text"  name="label" id="label"   value="<?=(isset($v->label)) ? $v->label : ''?>"></div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-2 control-label">Giá trị mặc định:</label>
                                                                    <div class="col-sm-10">
                                                                    <input type="text"  name="label" id="label"   value="<?=(isset($v->label)) ? $v->label : ''?>"></div>
                                                                </div> 
                                                                <!-- <div class="form-group">
                                                                    <label class="col-sm-2 control-label">Alias</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" required="" placeholder="alias" class="form-control area-input" 
                                                                            name="alias" id="alias" data-error="Nhập alias" data-error-1="Alias đã tồn tại!" data-url="<?=base_url('catalog/api_check_alias')?>" value="<?=(isset($catalogs)) ? $catalogs->alias : ''?>">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-2 control-label">Giá:</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="number" onkeyup="validateInp(this);" required="" placeholder="price" class="form-control area-input" 
                                                                        name="price" id="price" value="<?=(isset($catalogs)) ? $catalogs->price : ''?>">
                                                                    </div>
                                                                </div>
                                                                    <div class="form-group">
                                                                    <label class="col-sm-2 control-label">Màu sắc</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" required="" placeholder="color" class="form-control area-input" 
                                                                            name="color" id="color" data-error="Nhập color"  value="<?=(isset($catalogs)) ? $catalogs->color : ''?>">
                                                                    </div>
                                                                </div>
                                                                    <div class="form-group">
                                                                    <label class="col-sm-2 control-label">Chất liệu</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" required="" placeholder="material" class="form-control area-input" 
                                                                            name="material" id="material" data-error="Nhập Chất liệu" value="<?=(isset($catalogs)) ? $catalogs->material : ''?>">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-2 control-label">Mô tả ngắn:</label>
                                                                    <div class="col-sm-10">
                                                                        <textarea type="text" required=""  placeholder="Description" class="form-control area-input" name="shortdescription" id="shortdescription"><?=(isset($catalogs)) ? $catalogs->shortdescription : ''?></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-2 control-label">Mô tả:</label>
                                                                    <div class="col-sm-10">
                                                                        <textarea type="text" required=""  placeholder="Description" class="form-control area-input" name="description" id="description"> <?=(isset($catalogs)) ? $catalogs->description : ''?></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-2 control-label">Hình ảnh</label>
                                                                    <div class="col-sm-9">
                                                                        <img src="<?=(isset($catalogs) && $catalogs->image) ? $catalogs->image : base_url('layout/images/no-image.png')?>" height="100px" width="100px">
                                                                        <input type="hidden" name="image" value="<?=(isset($catalogs)) ? $catalogs->image : ''?>"  id="image" />
                                                                        <button class="btn btn-info" type="button" onclick="openPopup('image')">Thêm</button>
                                                                        <?php echo $this->size_image ?>                    
                                                                    </div>
                                                                </div> -->
                                                                </fieldset>
                                                            </div>
                                                        </div>
                                                    <?php }}else echo '<div id="tab-1" class="tab-pane active">
                                                            <div class="panel-body">
                                                                <tr><td colspan="10">Chưa có dữ liệu</td></tr>
                                                            </div>
                                                        </div>' ?>
                                                      
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>






                                        <table class="table table-striped table-bordered table-hover ">
                                            <thead>
                                            <tr>
                                                <th data-toggle="true">ID</th>
                                                <th data-toggle="true">Tiêu đề</th>
                                                <th data-toggle="true">Giá Trị</th>
                                                <th data-toggle="true">Giá trị mặc định</th>
                                                <th data-toggle="true">Code</th>
                                                <th data-toggle="true">Loại</th>
                                                <th class="text-right" data-sort-ignore="true">Hành Động</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php if($listattribute) {foreach ($listattribute as $v) { ?>
                                                <tr class="footable-even" style="">
                                                    <td class="footable-visible footable-first-column"><span class="footable-toggle"></span>
                                                        <?php echo $v->idattribute ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $v->label ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $v->value ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $v->defaultvalue ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $v->code ?>
                                                    </td>
                                                    <td>
                                                        <select class="form-control" name="type">
                                                            <option <?php if(isset($v->type)&& $v->type=='select' ) echo 'selected="selected"'; else echo ''; ?> value="select" >Select/option</option>
                                                            <option  <?php if(isset($v->type)&& $v->type=='text' ) echo 'selected="selected"'; else echo ''; ?> value="text" >Text</option>
                                                            <option  <?php if(isset($v->type)&& $v->type=='input' ) echo 'selected="selected"'; else echo ''; ?> value="input" >input</option>
                                                            <option  <?php if(isset($v->type)&& $v->type=='hidden' ) echo 'selected="selected"'; else echo ''; ?> value="hidden" >hidden</option>
                                                            <option  <?php if(isset($v->type)&& $v->type=='date' ) echo 'selected="selected"'; else echo ''; ?> value="date" >date</option>
                                                            <option  <?php if(isset($v->type)&& $v->type=='textarea' ) echo 'selected="selected"'; else echo ''; ?> value="textarea" >textarea</option>
                                                        </select>
                                                    </td>
                                                  
                                                
                                                   
                                                    <td class="text-right">
                                                        <div class="btn-group">
                                                        <a href="<?=base_url('catalog/edit/'.$v->id); ?>" class="btn-white btn btn-xs">Sửa</a>
                                                        <!-- <a href="<?=base_url('attribute/delete/'.$v->id); ?>" class="btn-white btn btn-xs">Xóa</a> -->
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
