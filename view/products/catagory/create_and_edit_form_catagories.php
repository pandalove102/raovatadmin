<?php 
 $this->xem_mang($_POST);

?>
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
                    <input type="hidden" name="id_user" id="id_user" value="<?=(isset($catagory)) ? $catagory->id : ''?>">
                    <div class="form-group"><label class="col-sm-2 control-label">Tên danh mục</label>
                        <div class="col-sm-9">
                           <input type="text" required="" placeholder="Name" onchange="stralias('name','alias')" class="form-control area-input" name="name" id="name"  data-error="Nhập tên danh mục" value="<?=(isset($catagory)) ? $catagory->name : ''?>">
                        </div>
                     </div>
                     <div class="hr-line-dashed"></div>
                     <div class="form-group"><label class="col-sm-2 control-label">Alias</label>
                        <div class="col-sm-9">
                           <input type="text" required="" placeholder="alias" class="form-control area-input" 
                           name="alias" id="alias" data-error="Nhập alias" data-error-1="Alias đã tồn tại!" data-url="<?=base_url('catagory/api_check_alias')?>" value="<?=(isset($catagory)) ? $catagory->alias : ''?>">
                        </div>
                     </div>
                     <div class="hr-line-dashed"></div>
                     <div class="form-group"><label class="col-sm-2 control-label">Tiêu đề</label>
						<div class="col-sm-9">
							<div class="relative">
								<input type="text" class="form-control area-input" rows="1" required="" placeholder="Title"  name="title" id="title" value="<?=(isset($catagory)) ? $catagory->title : ''?>">
							</div>
						</div>
                     </div>
                     <div class="hr-line-dashed"></div>
                     <div class="form-group"><label class="col-sm-2 control-label">Mô tả</label>
                        <div class="col-sm-9">
                           <textarea type="text" required=""  placeholder="Description" 
						   class="form-control area-input" name="description" id="description"> <?=(isset($catagory)) ? $catagory->description : ''?></textarea>
                        </div>
                     </div>
                     <div class="hr-line-dashed hidden"></div>
                     <div class="form-group hidden"><label class="col-sm-2 control-label">Metakey</label>
                        <div class="col-sm-9">
                           <input type="text"  placeholder="metakey" class="form-control area-input" 
						   name="metakey" id="metakey" value="<?=(isset($catagory)) ? $catagory->metakey : ''?>">
                        </div>
                     </div>
					 <div class="hr-line-dashed"></div>
                     <div class="form-group"><label class="col-sm-2 control-label">Metadesc</label>
                        <div class="col-sm-9">
                           <input type="text" required="" placeholder="metadesc" class="form-control area-input" 
						   name="metadesc" id="metadesc" value="<?=(isset($catagory)) ? $catagory->metadesc : ''?>">
                        </div>
                     </div>
					 <div class="hr-line-dashed"></div>
                     <div class="form-group"><label class="col-sm-2 control-label">Hình ảnh</label>
                        <div class="col-sm-9">
                           <img src="<?=(isset($catagory)) &&  $catagory->image ? $catagory->image : base_url('layout/images/no-image.png')?>" height="100px" width="100px">
                           <input type="hidden" name="image" value="<?=(isset($catagory)) ? $catagory->image : ''?>"  id="image" />
                            <button class="btn btn-info" type="button" onclick="openPopup('image')">Changes</button>
                            <?php echo $this->size_image ?>                    
                        </div>
                     </div>
                     <div class="hr-line-dashed"></div>
                     <div class="form-group"><label class="col-sm-2 control-label">Hình ảnh chia sẽ</label>
                        <div class="col-sm-9">
                           <img src="<?=(isset($catagory)) && $catagory->imgshare ? $catagory->imgshare : base_url('layout/images/no-image.png')?>" height="100px" width="100px">                  
                           <input type="hidden" name="imgshare" value="<?=(isset($catagory)) ? $catagory->imgshare : ''?>"  id="imgshare" />
                           <button class="btn btn-info" type="button" onclick="openPopup('imgshare')">Changes</button>
                           <?php echo $this->size_imgshare ?>
                        </div>
                     </div>
                     <div class="hr-line-dashed"></div>
                     <div class="form-group"><label class="col-sm-2 control-label">Danh mục</label>
                        <div class="col-sm-4">
                            <?=$this->api_listcatnice('parent_id',@$catagory->parent_id)?>
                        </div>
                     </div>
					  <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Thứ tự</label>
                        <div class="col-sm-9">
                           <input type="text" required="" placeholder="Thứ tự hiển thị" class="form-control area-input" 
						   name="pos" id="thutu" value="<?=(isset($catagory)) ? $catagory->pos : '1'?>">
                        </div>
                     </div>
                     <!-- thêm thuộc tính cho danh mục  -->
                     <div class="modal" id="myModal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Danh sach thuộc tính</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <select class="form-control" name="idattribute" id="idattribute">
                                    <?php 
                                    
                                        for($i=0;$i<count($listattributeall);$i++)
                                        {
                                            
                                    ?>
                                    <option  value="<?php  echo $listattributeall[$i]->id  ?>" ><?php  echo $listattributeall[$i]->label  ?></option>
                                    <?php 
                                                
                                    }
                                    ?>
                                </select>
                            </div>
                                
                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" id='addattribute' value="add" class="btn btn-success" name="save" >Thêm</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                            </div>


                            </div>
                        </div>
                    </div>
                     <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Thuộc tính mở rộng:</label>
                        <div class="col-sm-9">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                            Thêm thuộc tính mới vào danh mục 
                            </button>
                            <?php $this->paging($totalpage,'left'); ?>
                           
                            <table class="table table-striped table-bordered table-hover ">
                                <thead>
                                <tr>
                                    <th data-toggle="true">Chọn lựa</th>
                                    <th data-toggle="true">ID</th>
                                    <th data-toggle="true">Tiêu đề</th>
                                    <th data-toggle="true">Giá Trị</th>
                                    <th data-toggle="true">Giá trị mặc định</th>
                                    <th data-toggle="true">Code</th>
                                    <th data-toggle="true">Loại</th>
                                   
                                </tr>
                                </thead>
                               
                                <tbody id="myTable">
                                <?php if(isset($listattribute)) {foreach ($listattribute as $v) { ?>
                                    <tr class="gradeA odd" role="row">
                                        <td class="sorting_1"><input type="checkbox" name="idattribute[]" value="<?php echo $v->idattribute ?>"></td>
                                        <td class="sorting_1"><input type="hidden" name="idattribute[]" value="<?php echo $v->idattribute ?>"></td>
                                        <td> <?php echo $v->label ?></td>
                                        <td> <?php echo $v->value ?></td>
                                        <td> <?php echo $v->defaultvalue ?></td>
                                        <td> <?php echo $v->code ?></td>
                                        <td> <?php echo $v->type ?></td>
                                    </tr>
                                <?php }}else echo '' ?>
                                </tbody>
                            </table>
                            <?php $this->paging($totalpage); ?>
                                <button type="button"  class="btn btn-w-m btn-danger" id="deleterows">Xóa thuộc tính</button>
                        </div>
                     </div>

                     <!-- The End , thêm thuộc tính cho danh mục -->
                     <div class="hr-line-dashed"></div>
                     <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                          <?=$this->randtoken('tokencatagory'); ?>
                            <a class="btn btn-white" type="text" href="<?=base_url('catagory');?>">Đóng</a>
                            <button class="btn btn-primary" type="submit" name="save" value="1"><?php echo $this->save ?></button>
                            <button class="btn btn-primary" type="submit" name="save" value="2"><?php echo $this->save_close ?></button>
                        </div>
                    </div>
                </form>
             </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">CKEDITOR.replace('description');</script>

<script>
    $("#addattribute").click(function () {
        {
            var selected = $('select#idattribute option:selected').text();
            var idselected = $('select#idattribute option:selected').val();
            $.post('<?=base_url('catagory/api_list_attribute') ?>',{idselected:idselected})
            .done(function(d){
                if(d && d!='[]')
                {
                    var str='';
                    d = JSON.parse(d);

                    // $.each(d, function(k,v) 
                    // {
                    // }
                    // duyệt chuỗi d để tạo thành dòng tabe 
                    $.each(d, function(k,v) 
                    {
                        str+='<tr class="gradeA odd" role="row"><td class="sorting_1"><input type="checkbox" name="idattribute[]" value="'+v.id+'"></td><td class="sorting_1"><input type="hidden" name="idattribute[]" value="'+v.id+'">'+v.id+'</td><td>'+v.label+'</td><td>'+v.value+'</td><td>'+v.defaultvalue+'</td><td>'+v.code+'</td><td>'+v.type+'</td></tr>';
                    });
                     $( "#myTable" ).append(str);
            }else{
                $( "#myTable" ).append('<select class="form-control m-b" name="district"> No data </select> ');
                }
            })

            // Find and remove selected table rows
            $("#deleterows").click(function(){
                $("#myTable").find('input[name="idattribute[]"]').each(function(){
                    if($(this).is(":checked")){
                        $(this).parents("tr").remove();
                    }
                });
            });


         
        }
    });
</script>

<!-- <input type="text" name="idattribute" id="idattribute" value=" "> -->