
<?php defined('BASE') OR exit('Access Deny');?>
<div class="row">
	<div class="col-lg-12">
	   <div class="ibox float-e-margins">
			<div class="ibox-content">
				<div class="table-responsive">
               		<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
						<div id="DataTables_Table_0_filter" class="dataTables_filter">
		                  <div id="DataTables_Table_0_filter" class="dataTables_filter">
		                     <form method="get" action="<?=base_url('customers'); ?>" id="form-search">
		                        <div class="form-group">
		                           <?=$this->randtoken('tokencustomers'); ?>
		                           <input name="key" type="text" class="form-control" value="<?=$this->get('key') ?>" placeholder="Tên trạng thái">
		                           <button class="btn btn-primary" style="margin-bottom: 0px;" type="submit">Tìm Kiếm</button>
		                           <a class="btn btn-success" style="margin-bottom: 0px;" type="text" href="<?=base_url('customers/create'); ?>">Thêm mới</a>
		                        </div>            
		                     </form>
		                  </div>
		             	</div><br>
						 <?php $this->paging($totalpage,'left'); ?>
						<table class="table table-bordered  table-hover">
							<thead>
							<tr>
							 <th  style="width: 40px;">ID</th>
							 <th  style="width: 75px;">Hình</th>
							 <th  style="width: 60px;">Tên</th>
							<th style="width: 150px;">Email</th>
							<th  style="width: 150px;">Bài Viết</th>
							<th  style="width: 75px;">Nhóm</th>
							<th  style="width: 75px;">Số Điẹn Thoại</th>
							<th  style="width: 60px;">Tiền</th>
							<th  style="width: 60px;">Điểm</th>
							<th  style="width: 60px;">vip</th>
							<th style="width: 60px;">Trạng thái</th>
							<th  style="width: 75px;">Hành động</th>
							</tr>
							</thead>
							<tbody>
							 <?php if($customers ) {foreach ($customers as $v) { ?>
			                           <tr >
			                              <td ><?php echo $v->id ?></td>                             
			                              <td><img src="<?=(isset($v->image) && $v->image) ? $v->image : base_url('layout/images/no-image.png')?>" height="50px" width="50px"></td>
			                              <td ><?php echo $v->fullname ?></td>  
			                              <td ><?php echo $v->email ?></td>  
			                              <td ><a href="<?=base_url('customers/listpost/'.$v->id); ?>">Xem Bài Viết</a></td>  
			                              <td ><?php echo $v->fullnamegroups ?></td>  
			                              <td ><?php echo $v->cellularphone ?></td> 
										
			                              <td ><?php echo $v->money ?></td> 
			                              <td ><?php echo $v->point ?></td> 
										  <td class="text-center">
			                                 <?=$v->vip==1?'<i class="fa fa-check"></i>':'<i class="fa fa-minus-circle"></i>'?>
			                              </td>
			                              <td class="text-center">
			                                 <?=$v->status==1?'<i class="fa fa-check"></i>':'<i class="fa fa-minus-circle"></i>'?>
			                              </td>
			                              <td class="center">
			                                 <a href="<?=base_url('customers/edit/'.$v->id); ?>" ><span class="glyphicon glyphicon-pencil"></span></a>
			                                 <a class="delete-confirm" href="<?=base_url('customers/delete/'.$v->id); ?>"><span class="glyphicon glyphicon-trash"></span></a>
			                              </td>
			                           </tr>
									   <tr id="user_<?php echo $v->id ?>" class="hidden">								
									   </tr>
			                        <?php }} else echo '<tr><td colspan="7">Chưa có dữ liệu</td></tr>' ?>
						   
							</tbody>
						</table>
						<?php $this->paging($totalpage); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

