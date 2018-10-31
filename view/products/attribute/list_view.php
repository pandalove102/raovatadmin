<?php defined('BASE') OR exit('Access Deny');?>
<div class="row">
   <div class="col-lg-12">
      <div class="ibox float-e-margins">
         <div class="ibox-content">
            <div class="table-responsive">
                  <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap" >
                        <div id="DataTables_Table_0_filter" class="dataTables_filter" >
                              <form method="get" action="<?=base_url('attribute'); ?>" id="form-search">
                                    <div class="form-group">
                                    <?=$this->randtoken('tokensearch'); ?>
                                    <input name="key" type="text" class="form-control" value="<?=$this->get('key') ?>" placeholder="tên thuộc tính ">
                                    <button class="btn btn-primary" style="margin-bottom: 0px;" type="submit">Tìm Kiếm</button>
                                    <a class="btn btn-success" style="margin-bottom: 0px;" type="text" href="<?=base_url('attribute/create'); ?>">Thêm mới</a>
                                    </div>            
                              </form>
                        </div> 
                  <?php $this->paging($totalpage,'left'); ?> 
                  <table class="table table-striped table-bordered table-hover ">
                     <thead>
                        <tr role="row">
                     <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="ID: activate to sort column descending" style="width: 50px;">ID</th>
                     <th  style="width: 218px;">Thuộc tính</th>
                     <th style="width: 218px;">Giá trị thuộc tính</th>
                     <th style="width: 218px;">Giá trị mặc định thuộc tính</th>
                     <th  style="width: 196px;">Bắt buộc</th>
                     <th  style="width: 196px;">Không trùng</th>
                     <th  style="width: 218px;">Code</th>
                     <th style="width: 218px;">Type</th>      
                     <th style="width: 75px;">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php if($attribute ) {foreach ($attribute as $v) { ?>
                           <tr class="gradeA odd" role="row">
                              <td class="sorting_1"><?php echo $v->id ?></td>
                              <td><?php echo $v->label ?></td>
                              <td><?php echo $v->value ?></td>
                              <td><?php echo $v->defaultvalue ?></td>
                              <td><?php echo $v->requrire==1?'Có':'Không' ?></td>
                              <td><?php echo $v->unique==1?'Có':'Không' ?></td>
                              <td><?php echo $v->code ?></td>
                              <td><?php echo $v->type ?></td>
                              <td class="center">
                                 <a href="<?=base_url('attribute/edit/'.$v->id); ?>" ><span class="glyphicon glyphicon-pencil"></span></a>
                                 <a class="delete-confirm" href="<?=base_url('attribute/delete/'.$v->id); ?>"><span class="glyphicon glyphicon-trash"></span></a>
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