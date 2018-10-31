
<?php defined('BASE') OR exit('Access Deny');?>
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
                    <input type="hidden" name="uri"  value="<?php echo $this->uri ?>">
                    <input type="hidden" name="id"  value="<?=(isset($menu)) ? $menu->id : ''?>">
                     <!-- <div class="form-group"><label class="col-sm-2 control-label">ID</label>
                        <div class="col-sm-9">
                           <div class="relative">
                              <input type="text" class="form-control area-input" <?=$this->uri == 'edit'?'disabled':'' ?> rows="1" required=""  name="id"  data-error="Nhập label" data-error-1="Label đã tồn tại!" data-url="<?=base_url('menu/api_check_label')?>" value="<?=(isset($menu)) ? $menu->id : ''?>">
                           </div>
                        </div>
                     </div> -->
                    <div class="hr-line-dashed"></div>
                     <div class="form-group"><label class="col-sm-2 control-label">Menu</label>
                        <div class="col-sm-9">
                           <div class="relative">
                              <input type="text" class="form-control area-input" rows="1" required=""  name="name" data-error="Nhập content" value="<?=(isset($menu)) ? $menu->name : ''?>">
                           </div>
                        </div>
                     </div>
                     <div class="hr-line-dashed"></div>
                     <div class="form-group"><label class="col-sm-2 control-label">Link</label>
                        <div class="col-sm-9">
                           <div class="relative">
                              <input type="text" class="form-control area-input" rows="1" required=""  name="name" data-error="Nhập content" value="<?=(isset($menu)) ? $menu->link : ''?>">
                           </div>
                        </div>
                     </div>
                     <div class="hr-line-dashed"></div>
                     <div class="form-group"><label class="col-sm-2 control-label">created</label>
                        <div class="col-sm-9">
                            <div class="relative">
                            <input type="text" class="form-control area-input" rows="1" name='created'  value="<?=(isset($menu->created)) ? $menu->created :  date('Y-m-d H:i:s') ?>">
                           
                            </div>
                        </div>
                     </div>
                     <div class="hr-line-dashed"></div>
                     <div class="form-group"><label class="col-sm-2 control-label">state</label>
                        <div class="col-sm-9">
                           <div class="relative">
                           <select class="form-control m-b" name="state">                              
                              <option value="1" <?=(isset($menu) && $menu->state==1) ? 'selected="selected"' : '' ?>>Hiện</option>
							  <option value="2" <?=(isset($menu) && $menu->state==2) ? 'selected="selected"' : '' ?>>Ẩn</option>
                           </select>
                           </div>
                          
                        </div>
                     </div>
                     <div class="hr-line-dashed"></div>
                     <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                          <?=$this->randtoken('tokenmenu'); ?>
                            <a class="btn btn-white" type="text" href="<?=base_url('menu');?>">Đóng</a>
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