<?php $this->xem_mang($_POST); ?>
<?php defined('BASE') OR exit('Access Deny');?>
<div class="row">
    <div class="col-lg-6">
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
                    <input type="hidden" name="id"  value="<?=(isset($commentproduct)) ? $commentproduct->id : ''?>">
                    <input type="hidden" name="idpost"  value="<?=(isset($commentproduct)) ? $commentproduct->idpost : ''?>">
                     <div class="form-group"><label class="col-sm-2 control-label">ID</label>
                        <div class="col-sm-9">
                           <div class="relative">
                              <input type="text" disabled class="form-control area-input" <?=$this->uri == 'edit'?'disabled':'' ?> rows="1" required="" placeholder="Nhãn"  name="idcontent"  data-error="Nhập label" data-error-1="Label đã tồn tại!" data-url="<?=base_url('commentproduct/api_check_label')?>" value="<?=(isset($commentproduct)) ? $commentproduct->id : ''?>">
                           </div>
                        </div>
                     </div>
                    <div class="hr-line-dashed"></div>
                     <div class="form-group"><label class="col-sm-2 control-label">content</label>
                        <div class="col-sm-9">
                           <div class="relative">
                              <input type="text" class="form-control area-input" rows="1" disabled  value="<?=(isset($commentproduct)) ? $commentproduct->content : ''?>">
                           </div>
                        </div>
                     </div>
                     <div class="hr-line-dashed"></div>
                     <div class="form-group"><label class="col-sm-2 control-label">Post</label>
                        <div class="col-sm-9">
                            <div class="relative">
                            <input type="text" class="form-control area-input" rows="1" disabled  value="<?=(isset($commentproduct)) ? $commentproduct->title : ''?>">
                           
                            </div>
                        </div>
                     </div>
                     <div class="hr-line-dashed"></div>
                     <div class="form-group"><label class="col-sm-2 control-label">User</label>
                            <div class="col-sm-9">
                            <div class="relative">
                            
                            <input type="text" class="form-control area-input" rows="1" disabled  value="<?=(isset($commentproduct)) ? $commentproduct->customerspost : ''?>">
                            
                            </div>
                        </div>
                     </div>
                  
                     <div class="hr-line-dashed"></div>
                     <div class="form-group"><label class="col-sm-2 control-label">state</label>
                        <div class="col-sm-9">
                           <div class="relative">
                           <select disabled class="form-control m-b" name="state">                              
                              <option value="0" <?=(isset($commentproduct) && $commentproduct->state==0) ? 'selected="selected"' : '' ?>>Chưa kiểm duyệt</option>
							  <option value="1" <?=(isset($commentproduct) && $commentproduct->state==1) ? 'selected="selected"' : '' ?>>Đã kiểm duyệt</option>
                           </select>
                           </div>
                          
                        </div>
                     </div>
                     <div class="hr-line-dashed"></div>
                   

                <!-- </form> -->
             </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
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
                     <div class="hr-line-dashed"></div>
                     <div class="form-group"><label class="col-sm-2 control-label">User</label>
                            <div class="col-sm-9">
                            <div class="relative">
                                <select  class="form-control m-b" name="iduser">
                                    <?php
                                        for($i=0;$i<count($customers);$i++)
                                        {

                                    ?>                      
                                    <option value="<?=$customers[$i]->id?>" ><?=$customers[$i]->fullname?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            
                            </div>
                        </div>
                     </div>
                   
                    <div class="hr-line-dashed"></div>
                     <div class="form-group"><label class="col-sm-2 control-label">content</label>
                        <div class="col-sm-9">
                           <div class="relative">
                              <textarea type="text" class="form-control area-input" rows="4" autofocus required="" placeholder="nhập content"  name="content"></textarea>
                           </div>
                        </div>
                     </div>
                     
                    
                   
                     <div class="hr-line-dashed"></div>
                     <div class="form-group">
                        <div class="col-sm-6 col-sm-offset-2">
                          <?=$this->randtoken('tokencommentproduct'); ?>
                            <a class="btn btn-white" type="text" href="<?=base_url('commentproduct');?>">Đóng</a>
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