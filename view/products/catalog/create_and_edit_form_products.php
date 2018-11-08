<?php defined('BASE') OR exit('No direct script access allowed');?>
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
               <form class="m-t" role="form" action="" method="post" id="form-users">
                  <input type="hidden" name="uri" id="uri" value="<?php echo $this->uri ?>">
                  <input type="hidden" name="id_user" id="id_user" value="<?=(isset($catalogs)) ? $catalogs->id : ''?>">
                  <div class="wrapper wrapper-content animated fadeInRight ecommerce">
                    <div class="col-sm-9 col-sm-offset-8">
                        <a class="btn btn-white" type="text" href="<?=base_url('catalog');?>">Cancel</a>
                        <button class="btn btn-primary" type="submit" name="save" value="1"><?php echo $this->save ?></button>
                        <button class="btn btn-primary" type="submit" name="save" value="2"><?php echo $this->save_close ?></button>
                    </div>
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="tabs-container">
                           <ul class="nav nav-tabs">
                              <li class="active"><a data-toggle="tab" href="#tab-1"> Thông tin chung</a></li>
                              <!-- <li class=""><a data-toggle="tab" href="#tab-2"> Thông tin khác</a></li> -->
                              <!-- <li class=""><a data-toggle="tab" href="#tab-3"> Giảm giá</a></li> -->
                              <li class=""><a data-toggle="tab" href="#tab-4"> Hình ảnh</a></li>
                              <li class=""><a data-toggle="tab" href="#tab-5"> SEO</a></li>
                              <!-- <li class=""><a data-toggle="tab" href="#tab-6"> Khuyến mãi</a></li> -->
                              <li class=""><a data-toggle="tab" href="#tab-7"> Thuộc tính mở rộng</a></li>
                              <li class=""><a data-toggle="tab" href="#tab-8"> Thông tin liên hệ</a></li>
                           </ul>
                           <div class="tab-content">
                              <div id="tab-1" class="tab-pane active">
                                 <div class="panel-body">
                                    <fieldset class="form-horizontal">
                                        <div class="form-group">
                                          <label class="col-sm-2 control-label">Mã bài viết:</label>
                                          <div class="col-sm-10"><input type="text" required="" placeholder="Sku" class="form-control area-input" name="sku" id="sku"  data-error="Nhập Sku" data-error-1="Mã sku đã tồn tại!" data-url="<?=base_url('catalog/api_check_sku')?>" value="<?=(isset($catalogs)) ? $catalogs->sku : ''?>"></div>
                                        </div>
                                        <div class="form-group">
                                          <label class="col-sm-2 control-label">Tên bài viết:</label>
                                          <div class="col-sm-10"><input type="text" required="" placeholder="Name" onchange="stralias('username','alias')" class="form-control area-input" name="username" id="username"  data-error="Nhập tên sản phẩm" data-error-1="Tên sản phẩm đã tồn tại!" data-url="<?=base_url('catalog/api_check_catalogs')?>" value="<?=(isset($catalogs)) ? $catalogs->name : ''?>"></div>
                                       </div>
                                       <div class="form-group">
                                          <label class="col-sm-2 control-label">Alias</label>
                                          <div class="col-sm-10">
                                             <input type="text" required="" placeholder="alias" class="form-control area-input" 
                                                name="alias" id="alias" data-error="Nhập alias" data-error-1="Alias đã tồn tại!" data-url="<?=base_url('catalog/api_check_alias')?>" value="<?=(isset($catalogs)) ? $catalogs->alias : ''?>">
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label class="col-sm-2 control-label">Giá:</label>
                                          <div class="col-sm-10">
                                            <script>
                                               $(function () {
                                                    $("#inlineCheckbox1").click(function () {
                                                        if ($(this).is(":checked")) {
                                                            $("#price").hide();
                                                            $("#price").val('0');
                                                        }
                                                         else {
                                                            $("#price").show();
                                                        }
                                                    });
                                                });
                                                </script>
                                              <input type="number"   placeholder="nhập giá" class="form-control area-input" 
                                             name="price" id="price" value="<?=(isset($catalogs)) ? $catalogs->price : ''?>">
                                                <input type="checkbox" <?php if($catalogs->price==0) echo  'checked' ; else echo ''; ?>  id="inlineCheckbox1" value="lienhe">
                                                <label for="inlineCheckbox1"> Liên hệ </label>
                                          </div>
                                       </div>




                                       <div class="form-group">
                                          <label class="col-sm-2 control-label">Thành Phố:</label>
                                          <div class="col-sm-10">
                                          <select class="form-control m-b" id="city" name="city">
                                                <?php
                                                  for($i=1;$i<count($city);$i++)
                                                  {
                                                ?>
                                                <option value="<?=(isset($city[$i])) ? $city[$i]->id : ''?>" <?=(isset($catalogs->city) && $city[$i]->id==$catalogs->city) ? 'selected="selected"' : '' ?>> <?=(isset($city[$i])) ? $city[$i]->name : ''?> </option>
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
                                                <option value="<?=(isset($district[$i])) ? $district[$i]->id : ''?>" <?=(isset($catalogs->district) && $district[$i]->id==$catalogs->district) ? 'selected="selected"' : '' ?>> <?=(isset($district[$i])) ? $district[$i]->name : ''?> </option>
                                                <?php
                                                  }
                                                ?>
                                             </select>
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
                                       </div>

                                      <div class="form-group">
                                          <label class="col-sm-2 control-label">Danh mục:</label>
                                          <div class="col-sm-10">
                                              <?=$this->api_listcatnice('catagorie_id',@$catalogs->catagories_id)?>
                                          </div>
                                       </div>
                                       
                                       <div class="form-group">
                                          <label class="col-sm-2 control-label">Số lượng:</label>
                                          <div class="col-sm-10">
                                            <input type="number" required="" placeholder="quantity" class="form-control area-input" 
                                             name="quantity" data-error="Nhập số lượng" onkeyup="validateInp(this);" id="quantity" value="<?=(isset($catalogs)) ? $catalogs->quantity : ''?>">
                                          </div>
                                       </div>

                                        <div class="form-group">
                                          <label class="col-sm-2 control-label">Ngày Hiển Thị:</label>
                                          <div class="col-sm-10">
                                             <input type="text" required="" placeholder="Ngày Hiển Thị" class="form-control area-input" 
                                                name="date_show" id="date_show" >
                                          </div>
                                       </div>

                                         <div class="form-group">
                                          <label class="col-sm-2 control-label">Loại tin đăng:</label>
                                          <div class="col-sm-10">
                                             <select class="form-control m-b" name="idtypecatalogs">
                                                 <?php if($typecatalogs) {foreach ($typecatalogs as $v){ ?>
                                                <option value="<?=$v->id?>" <?=$this->uri!='create' ? (isset($v) && $v->id==$catalogs->idtypecatalogs) ? 'selected="selected"' : '' :''?> ><?php echo $v->name ?></option>
                                                <?php }} ?>
                                             </select>
                                          </div>
                                        </div>


                                         <div class="form-group">
                                          <label class="col-sm-2 control-label">Trạng thái:</label>
                                          <div class="col-sm-10">
                                             <select class="form-control m-b" name="status">
                                                 <?php if($status) {foreach ($status as $v){ ?>
                                                <option value="<?=$v->id?>" <?=$this->uri!='create' ? (isset($v) && $v->id==$catalogs->status) ? 'selected="selected"' : '' :''?> ><?php echo $v->name ?></option>
                                                <?php }} ?>
                                             </select>
                                          </div>
                                        </div>

                                      

                                    </fieldset>
                                 </div>
                              </div>
                              <div id="tab-2" class="tab-pane">
                                 <div class="panel-body">
                                    <fieldset class="form-horizontal">
                                       
                                            <input type="hidden" 
                                             name="id" id="id" value="<?=(isset($catalogs)) ? $catalogs->id : ''?>">
                                       <!-- <div class="form-group">
                                          <label class="col-sm-2 control-label">Thương hiệu:</label>
                                          <div class="col-sm-10">
                                             <input type="text" class="form-control" required="" name="brand" id="brand" placeholder="Thương hiệu" data-error="Nhập thương hiệu" value="<?=(isset($catalogs)) ? $catalogs->brand : ''?>">
                                          </div>
                                       </div> -->
                                       <!-- <div class="form-group">
                                          <label class="col-sm-2 control-label">Danh mục:</label>
                                          <div class="col-sm-10">
                                              <?=$this->api_listcatnice('catagorie_id',@$catalogs->catagories_id)?>
                                          </div>
                                       </div> -->
                                       <!-- <div class="form-group">
                                          <label class="col-sm-2 control-label">Thuế</label>
                                          <div class="col-sm-10">
                                             <select class="form-control" id="tax" name="tax">
                                                <option value="10" <?=(isset($catalogs) && $catalogs->tax==10) ? 'selected="selected"' : '' ?>>10 %</option>
                                             </select>
                                          </div>
                                       </div> -->
                                       <!-- <div class="form-group">
                                          <label class="col-sm-2 control-label">Số lượng:</label>
                                          <div class="col-sm-10">
                                            <input type="number" required="" placeholder="quantity" class="form-control area-input" 
                                             name="quantity" data-error="Nhập số lượng" onkeyup="validateInp(this);" id="quantity" value="<?=(isset($catalogs)) ? $catalogs->quantity : ''?>">
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label class="col-sm-2 control-label">Trạng thái:</label>
                                          <div class="col-sm-10">
                                             <select class="form-control m-b" name="status">
                                                 <?php if($status) {foreach ($status as $v){ ?>
                                                <option value="<?=$v->id?>" <?=$this->uri!='create' ? (isset($v) && $v->id==$catalogs->status) ? 'selected="selected"' : '' :''?> ><?php echo $v->name ?></option>
                                                <?php }} ?>
                                             </select>
                                          </div>
                                       </div> -->
                                    </fieldset>
                                 </div>
                              </div>
                              <div id="tab-4" class="tab-pane">
                                 <div class="panel-body">
                                    <div class="table-responsive">
                                       <table class="table table-bordered table-stripped">
                                          <thead>
                                             <tr>
                                                <th>
                                                   Hình ảnh
                                                </th>
                                                <th>
                                                   url ảnh
                                                </th>
                                                <th>
                                                   Thứ tự
                                                </th>
                                                <th>
                                                   Hành động
                                                </th>
                                             </tr>
                                          </thead>
                                          <tbody id="listimg">
                                             <?php  if(isset($catalogs->images) && $catalogs->images){
                                                $listimgs = json_decode($catalogs->images);
                                              foreach ( $listimgs  as $k => $img) { 
                                                $idim = str_replace('.', '_',str_replace('/', '_',str_replace('://', '_', $img->img)));
                                                ?>
                                                   <tr id="img_<?=$idim?>">
                                                      <td> <img width="100" src="<?=$img->img?>"></td>
                                                      <td>    <input type="text" name="imgs[]" class="form-control" value="<?=$img->img?>"></td>
                                                      <td>   <input type="text" name="pos[]" class="form-control" value="<?=$img->pos?>"></td>
                                                      <td>   <button type="button" data-id="<?=$idim?>" class="btn btndelimg btn-white"><i class="fa fa-trash"></i> </button></td>
                                                   </tr>                                    
                                             <?php                                            
                                             }
                                          } ?>
                                          </tbody>
                                       </table>
                                       <a class="btn btn-success" id="hdfinder" onclick="openhd('imgs')">Thêm hình ảnh</a>
                                       <input type="hidden" id="imgs" class="form-control"  value="">
                                    </div>
                                 </div>
                              </div>
                              <div id="tab-5" class="tab-pane">
                                 <div class="panel-body">
                                    <fieldset class="form-horizontal">
                                       <div class="form-group">
                                          <label class="col-sm-2 control-label">Hình ảnh chia sẽ</label>
                                          <div class="col-sm-9">
                                             <img src="<?=(isset($catalogs) && $catalogs->imgshare) ? $catalogs->imgshare : base_url('layout/images/no-image.png')?>" height="100px" width="100px">                  
                                             <input type="hidden" name="imgshare" value="<?=(isset($catalogs)) ? $catalogs->imgshare : ''?>"  id="imgshare" />
                                             <button class="btn btn-info" type="button" onclick="openPopup('imgshare')">Changes</button>
                                             <?php echo $this->size_imgshare ?>
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label class="col-sm-2 control-label">H1:</label>
                                          <div class="col-sm-10">
                                            <input type="text" required="" placeholder="H1" class="form-control area-input" 
                                             name="h1" id="h1" value="<?=(isset($catalogs)) ? $catalogs->h1 : ''?>">
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label class="col-sm-2 control-label">Meta Tag Title:</label>
                                          <div class="col-sm-10">
                                            <input type="text" required="" placeholder="metatitle" class="form-control area-input" 
                                             name="metatitle" id="metatitle" value="<?=(isset($catalogs)) ? $catalogs->metatitle : ''?>">
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label class="col-sm-2 control-label">Meta Tag Description:</label>
                                          <div class="col-sm-10">
                                            <input type="text" required="" placeholder="metadesc" class="form-control area-input" 
                                             name="metadesc" id="metadesc" value="<?=(isset($catalogs)) ? $catalogs->metadesc : ''?>">
                                         </div>
                                       </div>
                                       <!-- <div class="form-group hidden">
                                          <label class="col-sm-2 control-label">Meta Tag Keywords:</label>
                                          <div class="col-sm-10">
                                            <input type="text" required="" placeholder="metakey" class="form-control area-input" 
                                             name="metakey" id="metakey" value="<?=(isset($catalogs)) ? $catalogs->metakey : ''?>">
                                         </div>
                                       </div> -->
                                       <div class="form-group">
                                          <label class="col-sm-2 control-label">Tag:</label>
                                          <div class="col-sm-10">
                                            <textarea type="text" rows="4" placeholder="Tag" class="form-control area-input" 
                                             name="" ><?=(isset($catalogs)) ? $catalogs->metakey : ''?></textarea>
                                         </div>
                                       </div>
                                    </fieldset>
                                 </div>
                              </div>
                              <div id="tab-7" class="tab-pane">
                                 <div class="panel-body">
                                    <div class="table-responsive">
                                      <?php $this->paging($totalpage,'left'); ?>
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
                                                    <!-- $this->form->select(data , dieukien ) -->
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
                                                        <!-- <a href="<?=base_url('attribute/edit/'.$v->idattribute); ?>" class="btn-white btn btn-xs">Sửa</a> -->
                                                        <a href="<?=base_url('catagory/delete_attribute/?idattribute='.$v->idattribute.'&&idcatagories='.$this->get('id')); ?>" class="btn-white btn btn-xs">Xóa</a>
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
                              <div id="tab-8" class="tab-pane">
                                 <div class="panel-body">
                                    <fieldset class="form-horizontal">
                                       <!-- <div class="form-group">
                                          <label class="col-sm-2 control-label">Hình ảnh chia sẽ</label>
                                          <div class="col-sm-9">
                                             <img src="<?=(isset($catalogs) && $catalogs->imgshare) ? $catalogs->imgshare : base_url('layout/images/no-image.png')?>" height="100px" width="100px">                  
                                             <input type="hidden" name="imgshare" value="<?=(isset($catalogs)) ? $catalogs->imgshare : ''?>"  id="imgshare" />
                                             <button class="btn btn-info" type="button" onclick="openPopup('imgshare')">Changes</button>
                                             <?php echo $this->size_imgshare ?>
                                          </div>
                                       </div> -->
                                       <div class="form-group">
                                          <label class="col-sm-2 control-label">Tên:</label>
                                          <div class="col-sm-10">
                                            <input type="text" required="" placeholder="Tên" class="form-control area-input" 
                                             name="h1" id="h1" value="<?=(isset($catalogs->namecontact)) ? $catalogs->namecontact : ''?>">
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label class="col-sm-2 control-label">Số điện thoại:</label>
                                          <div class="col-sm-10">
                                            <input type="text" required="" placeholder="Số điện thoại" class="form-control area-input" 
                                             name="metatitle" id="metatitle" value="<?=(isset($catalogs->phonecontact)) ? $catalogs->phonecontact : ''?>">
                                          </div>
                                       </div>
                                       <div class="form-group">
                                          <label class="col-sm-2 control-label">Email:</label>
                                          <div class="col-sm-10">
                                            <input type="text" required="" placeholder="Email" class="form-control area-input" 
                                             name="metadesc" id="metadesc" value="<?=(isset($catalogs->emailcontact)) ? $catalogs->emailcontact : ''?>">
                                         </div>
                                       </div>
                                       <div class="form-group">
                                          <label class="col-sm-2 control-label">Phương tiện khác:</label>
                                          <div class="col-sm-10">
                                            <input type="text" required="" placeholder="Phương tiện khách" class="form-control area-input" 
                                             name="metadesc" id="metadesc" value="<?=(isset($catalogs->ordercontact)) ? $catalogs->ordercontact : ''?>">
                                         </div>
                                       </div>
                                       <div class="form-group">
                                          <label class="col-sm-2 control-label">Vị trí bản đồ:</label>
                                          <div class="col-sm-10">
                                            <!-- <input type="text" required="" placeholder="Vị trí bản đồ" class="form-control area-input" 
                                             name="metadesc" id="metadesc" value="<?=(isset($catalogs)) ? $catalogs->metadesc : ''?>"> -->
                                             <div>
                                                <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d15673.15986240415!2d106.5996596!3d10.86553605!3m2!1i1024!2i768!4f13.1!5e0!3m2!1svi!2s!4v1541606648945" width="900" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                                             </div>
                                         </div>
                                       </div>
                                       <div class="form-group">
                                          <label class="col-sm-2 control-label">Ghi chú:</label>
                                          <div class="col-sm-10">
                                            <textarea type="text" rows="4" placeholder="Ghi chú" class="form-control area-input" 
                                             name="" ><?=(isset($catalogs->desc)) ? $catalogs->desc : ''?></textarea>
                                         </div>
                                       </div>
                                    </fieldset>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <?=$this->randtoken('tokencatalog'); ?>
               </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">CKEDITOR.replace('description');CKEDITOR.replace('shortdescription');</script>
<script>
      var idd = <?=$idd+1?>;
      var idkm = <?=$idkm+1?>;
    
    $(document).ready(function(){
      
        $('#imgs').change(function(){
            var hinhchon = $(this).val();
            var imgs = hinhchon.split(',');
            $.each(imgs,function(i,img){
                var id = img.replace(/\//g,'_').replace(/\./g,'_').replace(/:/g,'_');
                $('#listimg').append('<tr id="img_'+id+'">'+
                '<td>'+
                   ' <img width="100" src="'+img+'">'+
                '</td>'+
                '<td>'+
                '    <input type="text" name="imgs[]" class="form-control"  value="'+img+'">'+
                '</td>'+
                '<td>'+
                 '   <input type="text" name="pos[]" class="form-control" value="'+(i+1)+'">'+
                '</td>'+
                '<td>'+
                 '   <button type="button" data-id="'+id+'" class="btn btndelimg btn-white"><i class="fa fa-trash"></i> </button>'+
                '</td>'+
                '</tr>');
            });
        });
         $(document).on('click','.btndelimg',function(){  
            var that = $(this);
            //muon tao hieu ung
            that.loading();
            setTimeout(function(){                     
                $('#img_'+that.data('id')).remove();
            },2000);
        });
         $('#adddis').click(function(){
            $('#listdis').append('<tr id="dis_'+idd+'">'+
                '<td>'+
                  '<input type="text" class="form-control" name="disname[]" placeholder="name">'+
                '</td>'+
                '<td>'+
                   '<input type="text" class="form-control" name="disqty[]" placeholder="00">'+
                '</td>'+
                '<td>'+
                  ' <input type="text" class="form-control" name="disprice[]" placeholder="$00.00">'+
                '</td>'+
                '<td>'+
                  ' <div class="input-group">'+
                     ' <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input name="disstart[]" type="text" class="form-control date" value="">'+
                   '</div>'+
                '</td>'+
                '<td>'+
                  ' <div class="input-group">'+
                   '   <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input name="disend[]" type="text" class="form-control date" value="">'+
                 '  </div>'+
                '</td>'+            
               ' <td align="center">'+
               '    <button data-id="'+idd+'" class="btn btndeldis btn-white"><i class="fa fa-trash"></i> </button>'+
               ' </td>'+
            ' </tr>'); $( ".date" ).datepicker({dateFormat:'yy-mm-dd'});
            idd++;
        });
	 $(document).on('click','.btndelkm',function(){  
		   var that = $(this);
		   //muon tao hieu ung
		   that.loading();
		   setTimeout(function(){                     
			   $('#km_'+that.data('id')).remove();
		   },2000);
		});
    });
    $(document).on('click','.btndeldis',function(){  
            var that = $(this);
            that.loading();
            setTimeout(function(){                     
                $('#dis_'+that.data('id')).remove();
            },2000);
        });
    $('#addkm').click(function(){
            $('#listkm').append('<tr id="km_'+idkm+'">'+
                '<td>'+
                     '<div class="col-md-12">'+
                        '<select class="select2_demo_3 form-control" name="kmitem_id[]">'+
                           '<option value=" ">-- Chọn sản phẩm tặng --</option>'+
                           <?php 
                           if(isset($itemkm) && $itemkm)
                           {
                              foreach($itemkm as $item)
                                 echo "'<option value=\"{$item->id}\">{$item->name}</option>'+";
                           }
                           ?>
                        '</select>'+
                    '</div>'+
                '</td>'+
                '<td>'+
                   '<input type="number" class="form-control" name="kmqty[]" placeholder="00">'+
                '</td>'+                     
               ' <td align="center">'+
               '    <a data-id="'+idkm+'" class="btn btndelkm btn-white"><i class="fa fa-trash"></i> </a>'+
               ' </td>'+
            ' </tr>');           
            $(".select2_demo_3").select2({
                placeholder: "Select a state",
                allowClear: true
            });
             $( ".date" ).datepicker({dateFormat:'yy-mm-dd'});
             idkm++;
        });
    
</script>
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
