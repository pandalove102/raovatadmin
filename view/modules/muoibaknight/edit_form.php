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
                        <a class="btn btn-white" type="text" href="<?=base_url('muoibaknight');?>">Cancel</a>
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
                                          <label class="col-sm-2 control-label"><?=$name->description?>:</label>
                                          <div class="col-sm-10"><input type="text" required="" placeholder="<?=$name->description?>" class="form-control area-input" name="<?=$name->name.'-'.$name->id?>"  value="<?=$name->value?>"></div>
                                       </div>  
									    <div class="form-group">
                                          <label class="col-sm-2 control-label"><?=$mota->description?>:</label>
                                          <div class="col-sm-10"><input type="text" required="" placeholder="<?=$mota->description?>" class="form-control area-input" name="<?=$mota->name.'-'.$mota->id?>"  value="<?=$mota->value?>"></div>
                                       </div>
									   <?php if($image) { ?>
										<div class="form-group">
                                          <label class="col-sm-2 control-label"><?=$image->description?></label>
                                          <div class="col-sm-9">
                                             <img src="<?=$image->value?>" height="100px" width="100px">
                                             <input type="hidden" name="<?=$image->name.'-'.$image->id?>" value="<?=$image->value?>"  id="image" />
                                              <button class="btn btn-info" type="button" onclick="openPopup('image')">Thêm</button>
                                              <?php echo $image->small ?>                    
                                          </div>
                                       </div>   			
									   <?php } ?>	
										<div class="form-group">
                                          <label class="col-sm-2 control-label"><?=$content->description?>:</label>
                                          <div class="col-sm-10"><textarea id="content" required="" placeholder="<?=$content->description?>" class="form-control area-input" name="<?=$content->name.'-'.$content->id?>" ><?=$content->value?></textarea></div>
                                       </div>									   
                                       
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