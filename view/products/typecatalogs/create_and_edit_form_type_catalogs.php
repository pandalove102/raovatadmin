
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
                    <input type="hidden" name="uri" id="uri" value="<?php echo $this->uri ?>">
                    <input type="hidden" name="id" id="id" value="<?=(isset($typecatalogs)) ? $typecatalogs->id : ''?>">
                     <div class="form-group"><label class="col-sm-2 control-label">Loại tin đăng</label>
                        <div class="col-sm-9">
                           <div class="relative">
                              <input type="text" class="form-control area-input"  rows="1" required="" placeholder="Loai tin đăng"  name="name" id="name"  value="<?=(isset($typecatalogs->name)) ? $typecatalogs->name : ''?>">
                           </div>
                        </div>
                     </div>
                     <div class="hr-line-dashed"></div>
                     <div class="form-group"><label class="col-sm-2 control-label">Giá</label>
                        <div class="col-sm-9">
                           <div class="relative">
                              <input type="text" class="form-control area-input" rows="1" required="" placeholder="Giá loại tin"  name="price" id="price"  value="<?=(isset($typecatalogs)) ? $typecatalogs->price : ''?>">
                           </div>
                        </div>
                     </div>
                    <div class="hr-line-dashed"></div>
                     <div class="form-group"><label class="col-sm-2 control-label">Ghi chú</label>
                        <div class="col-sm-9">
                           <div class="relative">
                           <textarea type="text"  rows="4"  placeholder="Description" class="form-control area-input" name="desc" id="desc"> <?=(isset($typecatalogs)) ? $typecatalogs->desc : ''?></textarea>
                           </div>
                        </div>
                     </div>
                     <div class="hr-line-dashed"></div>
                     <div class="form-group"><label class="col-sm-2 control-label">Trạng thái</label>
                        <div class="col-sm-9">
                           <div class="relative">
                                <td>
                                    <select class="form-control" name="state">
                                        <option <?php if(isset($typecatalogs->state)&& $typecatalogs->state==2 ) echo 'selected="selected"'; else echo ''; ?> value="2" >Ẩn</option>
                                        <option  <?php if(isset($typecatalogs->state)&& $typecatalogs->state==1 ) echo 'selected="selected"'; else echo ''; ?> value="1" >Hiện</option>
                                       
                                    </select>
                                </td>
                             
                           </div>
                        </div>
                     </div>
                    
                     <div class="hr-line-dashed"></div>
                     <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                          <?=$this->randtoken('tokentypecatalogs'); ?>
                            <a class="btn btn-white" type="text" href="<?=base_url('typecatalogs');?>">Đóng</a>
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
<script type="text/javascript">
    $('#example-multiple-optgroups-classes').multiselect();
</script>
