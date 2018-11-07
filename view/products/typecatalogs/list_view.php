<?php defined('BASE') OR exit('Access Deny');?>
<div class="row">
   <div class="col-lg-12">
      <div class="ibox float-e-margins">
         <div class="ibox-content">
            <div class="table-responsive">
                  <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap" >
                        <div id="DataTables_Table_0_filter" class="dataTables_filter" >
                              <form method="get" action="<?=base_url('typecatalogs'); ?>" id="form-search">
                                    <div class="form-group">
                                    <?=$this->randtoken('tokensearch'); ?>
                                    <input name="key" type="text" class="form-control" value="<?=$this->get('key') ?>" placeholder="Loại tin đăng ? ">
                                    <button class="btn btn-primary" style="margin-bottom: 0px;" type="submit">Tìm Kiếm</button>
                                    <a class="btn btn-success" style="margin-bottom: 0px;" type="text" href="<?=base_url('typecatalogs/create'); ?>">Thêm mới</a>
                                    </div>            
                              </form>
                        </div> 
                  <?php $this->paging($totalpage,'left'); ?> 
                  <table class="table table-striped table-bordered table-hover ">
                     <thead>
                        <tr role="row">
                     <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="ID: activate to sort column descending" style="width: 50px;">ID</th>
                     <th  style="width: 75px;">Loại tin đăng</th>
                     <th style="width: 75px;">Giá</th>
                     <th style="width: 218px;">Ghi chú</th>
                     <th class="text-center"  style="width: 50px;">Trạng Thái</th>
                     <th class="text-center" style="width: 50px;">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php if($typecatalogs ) {foreach ($typecatalogs as $v) { ?>
                           <tr class="gradeA odd" role="row">
                              <td class="sorting_1"><?php echo $v->id ?></td>
                              <td><?php echo $v->name ?></td>
                              <td><?php echo $v->price ?></td>
                              <td><?php echo $v->desc ?></td>
                              <td class="text-center">
                                 <span class="glyphicon glyphicon-ok-circle iconfa-show hide1<?=$v->id?> <?php if($v->state==2) echo 'hide'; ?>" data-id="<?=$v->id?>" data-hide="2" data-url="<?=base_url('users/hide')?>"></span>
                                    <span class="glyphicon glyphicon-remove-circle iconfa-hide hide0<?=$v->id?> <?php if($v->state==1) echo 'hide'; ?>" data-id="<?=$v->id?>" data-hide="1" data-url="<?=base_url('users/hide')?>"></span>
                              </td>
                              <td class="text-center">
                                 <a href="<?=base_url('typecatalogs/edit/'.$v->id); ?>" ><span class="glyphicon glyphicon-pencil"></span></a>
                                 <a class="delete-confirm" href="<?=base_url('typecatalogs/delete/'.$v->id); ?>"><span class="glyphicon glyphicon-trash"></span></a>
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