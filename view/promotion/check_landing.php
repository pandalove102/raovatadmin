<div class="row">
   <div class="col-lg-12">
      <div class="ibox float-e-margins">
         <div class="ibox-title">
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
            <form class="m-t" role="form" action="" method="post" id="form-users">
               <input type="hidden" name="uri" id="uri" value="<?php echo $this->uri ?>">
               <input type="hidden" name="id_user" id="id_user" value="<?=(isset($this->data['list'])) ? $this->data['list']->id : ''?>">
               <div class="table-responsive" style="text-align: center;">
                  <div class="col-sm-7">
                     <label class="col-sm-4">Phone Number:</label>
                     <div class="input-group">
                        <input type="text" class="form-control area-input" rows="1" required="" placeholder="Phone"  name="username" id="username" data-error="Input Phone Number" data-error-1="Phone number does not exist!" data-url="<?=base_url('landing/check_phone')?>" value="<?=(isset($this->data['list'])) ? $this->data['list']->cellularphone : ''?>">
                        <span class="input-group-btn">
                           <button type="submit" class="btn btn-primary">Check!</button>
                        </span>
                     </div>
                  </div>
               </div>
               <?php if(@$this->data['list']){ ?>
               <div class="form-horizontal">
                  <div class="hr-line-dashed"></div>
                  <div class="form-group"><label class="col-sm-3 control-label">Họ & Tên/ Full Name:</label>
                     <div class="col-sm-8">
                        <input type="text" required="" disabled="" placeholder="Full Name" class="form-control" name="fullname" value="<?=(isset($this->data['list'])) ? $this->data['list']->cusname : ''?>"">
                     </div>
                  </div>
                  <div class="form-group"><label class="col-sm-3 control-label">Địa chỉ/ Address:</label>
                     <div class="col-sm-8">
                        <input type="text" required="" disabled="" placeholder="Full Name" class="form-control" name="fullname" value="<?=(isset($this->data['list'])) ? $this->data['list']->address : ''?>"">
                     </div>
                  </div>
                  <div class="form-group"><label class="col-sm-3 control-label">Email:</label>
                     <div class="col-sm-8">
                        <input type="text" required="" disabled="" placeholder="Full Name" class="form-control" name="fullname" value="<?=(isset($this->data['list'])) ? $this->data['list']->email : ''?>"">
                     </div>
                  </div>
                  <div class="form-group"><label class="col-sm-3 control-label">Code</label>
                     <div class="col-sm-8">
                        <input type="text" required="" disabled="" placeholder="Full Name" class="form-control" name="fullname" value="<?=(isset($this->data['list'])) ? $this->data['list']->code : ''?>"">
                     </div>
                  </div>
                  <div class="form-group"><label class="col-sm-3 control-label">Status:</label>
                     <div class="col-sm-4">
                        <select class="form-control m-b" name="status"  <?=$this->data['list']->status == 3?'disabled':'' ?>>
                           <option value="2" <?=(isset($this->data['list']) && $this->data['list']->status==2) ? 'selected="selected"' : '' ?>>Chưa nhận</option>
                           <option value="3" <?=(isset($this->data['list']) && $this->data['list']->status==3) ? 'selected="selected"' : '' ?>>Đã nhận</option>
                        </select>
                     </div>
                  </div>
                  <div class="hr-line-dashed"></div>
                     <div class="form-group">
                        <div class="col-sm-4 col-sm-offset-2">
                          <?=$this->randtoken('tokenlanding'); ?>
                            <a class="btn btn-white" type="text" href="<?=base_url('landing');?>">Close</a>
                            <button class="btn btn-primary" type="submit" name="save" value="1"><?php echo $this->save ?></button>
                        </div>
                    </div>
               </div>
               <?php } ?>
            </form>
         </div>
      </div>
   </div>
</div>