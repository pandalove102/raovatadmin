<?php defined('BASE') OR exit('Access Deny');?>
<div class="row">
   <div class="col-lg-12">
      <div class="ibox float-e-margins">
         <div class="ibox-content">
            <div class="table-responsive">
                  <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                        <div id="DataTables_Table_0_filter" class="dataTables_filter">
                              <form method="get" action="<?=base_url('paymentmethods'); ?>" id="form-search">
                                    <div class="form-group">
                                    <?=$this->randtoken('tokensearch'); ?>
                                    <input name="key" type="text" class="form-control" value="<?=$this->get('key') ?>" placeholder="Phương thức TT">
                                    <button class="btn btn-primary" style="margin-bottom: 0px;" type="submit">Tìm Kiếm</button>
                                    <input name="keydistributor" type="text" class="form-control" value="<?=$this->get('keydistributor') ?>" placeholder="Nhà Cùng Cấp PTTT">
                                    <button class="btn btn-primary" style="margin-bottom: 0px;" type="submit">Tìm Kiếm</button>
                                    <a class="btn btn-success" style="margin-bottom: 0px;" type="text" href="<?=base_url('paymentmethods/create'); ?>">Thêm mới</a>
                                    </div>            
                              </form>
                        </div> 
                        <?php $this->paging($totalpage,'left'); ?>  
                  <table class="table table-striped table-bordered table-hover ">
                     <thead>
                        <tr role="row">
                              <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="ID: activate to sort column descending" style="width: 50px;">ID</th>
                              <th  style="width: 218px;">Phương thức thanh toán</th>
                              <th style="width: 100px;">Nhà cung cấp</th>
                              <th  style="width: 60px;">Trạng thái</th>      
                              <th style="width: 75px;">Hành động</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php if($paymentmethods ) {foreach ($paymentmethods as $v) { ?>
                           <tr class="gradeA odd" role="row">
                              <td class="sorting_1 text-center"><?php echo $v->id ?></td>
                              <td><?php echo $v->name ?></td>
                              <td class="text-center" ><?php echo $v->distributor ?></td>
                              <td class="text-center">
			                  <?= $v->state==1 ? '<i class="fa fa-check"></i>':'<i class="fa fa-minus-circle"></i>'?>
                              </td>
                              <td class="text-center">
                                 <a href="<?=base_url('paymentmethods/edit/'.$v->id); ?>" ><span class="glyphicon glyphicon-pencil"></span></a>
                                 <a class="delete-confirm" href="<?=base_url('paymentmethods/delete/'.$v->id); ?>"><span class="glyphicon glyphicon-trash"></span></a>
                              </td>
                           </tr>
                        <?php }} else echo '<tr><td colspan="10">Chưa có dữ liệu</td></tr>' ?>
                     </tbody>
                  </table>
                  <?php $this->paging($totalpage); ?>
            </div>
         </div>
      </div>
   </div>
</div>