<?php defined('BASE') OR exit('No direct script access allowed');
?>
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
               <form class="m-t" role="form" action="" method="post" >           
                  <div class="wrapper wrapper-content animated fadeInRight ecommerce">
                    <div class="col-sm-9 col-sm-offset-8">
                        <a class="btn btn-white" type="text" href="<?=base_url('danhmucxemnhieu');?>">Cancel</a>
                        <button class="btn btn-primary" type="submit" name="save" value="1"><?php echo $this->save ?></button>
                        <button class="btn btn-primary" type="submit" name="save" value="2"><?php echo $this->save_close ?></button>
                    </div>
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="tabs-container">
                           <ul class="nav nav-tabs">
                              <li class="active"><a data-toggle="tab" href="#tab-1"> Nội dung cập nhật</a></li>                         
                           </ul>
                           <div class="tab-content">
                              <div id="tab-1" class="tab-pane active">
                                 <div class="panel-body">
                                    <fieldset class="form-horizontal">
                                        									   
                                       <div class="form-group">
                                          <label class="col-sm-2 control-label">Danh mục sản phẩm (chọn 2):</label>
                                          <div class="col-sm-10">
                                             <?=$catcontrl->api_listcatnicemulti('catshowhome',@$cat->value)?>
                                          </div>
                                       </div>
									   <div class="form-group">
                                          <label class="col-sm-2 control-label"><?=$cat1->description?>:</label>
                                          <div class="col-sm-10"><input type="text" required="" placeholder="<?=$cat1->description?>" class="form-control area-input" name="<?=$cat1->name.'-'.$cat1->id?>"  value="<?=$cat1->value?>"></div>
                                       </div>  
									   <?php if($hinh1) { ?>
										<div class="form-group">
                                          <label class="col-sm-2 control-label"><?=$hinh1->description?></label>
                                          <div class="col-sm-9">
                                             <img src="<?=$hinh1->value?>" height="100px" width="100px">
                                             <input type="hidden" name="<?=$hinh1->name.'-'.$hinh1->id?>" value="<?=$hinh1->value?>"  id="image" />
                                              <button class="btn btn-info" type="button" onclick="openPopup('image')">Thêm</button>
                                              <?php echo $hinh1->small ?>                    
                                          </div>
                                       </div>   			
									   <?php } ?>	
									   <div class="form-group">
                                          <label class="col-sm-2 control-label"><?=$cat2->description?>:</label>
                                          <div class="col-sm-10"><input type="text" required="" placeholder="<?=$cat2->description?>" class="form-control area-input" name="<?=$cat2->name.'-'.$cat2->id?>"  value="<?=$cat2->value?>"></div>
                                       </div>  
									   <?php if($hinh2) { ?>
										<div class="form-group">
                                          <label class="col-sm-2 control-label"><?=$hinh2->description?></label>
                                          <div class="col-sm-9">
                                             <img src="<?=$hinh2->value?>" height="100px" width="100px">
                                             <input type="hidden" name="<?=$hinh2->name.'-'.$hinh2->id?>" value="<?=$hinh2->value?>"  id="image1" />
                                              <button class="btn btn-info" type="button" onclick="openPopup('image1')">Thêm</button>
                                              <?php echo $hinh2->small ?>                    
                                          </div>
                                       </div>   			
									   <?php } ?>	
                                    </fieldset>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <?=$this->randtoken('tokenconfigs'); ?>
               </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">CKEDITOR.replace('content');</script>