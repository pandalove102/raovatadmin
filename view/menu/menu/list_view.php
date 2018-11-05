<?php defined('BASE') OR exit('Access Deny');?>
<div class="row">
   <div class="col-lg-12">
      <div class="ibox float-e-margins">
         <div class="ibox-title">
            <h5>Basic Data Tables example with responsive plugin</h5>
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
            <div class="table-responsive">
               <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                  <div id="DataTables_Table_0_filter" class="dataTables_filter">
                     <form method="get" action="<?=base_url('menu'); ?>" id="form-search">
                     <?=$this->randtoken('tokenmenu'); ?>
                        <div class="form-group">
                            <input name="key" type="text"  class="form-control" placeholder="Tên menu">
                            <button class="btn btn-primary" style="margin-bottom: 0px;" type="submit">Search</button>
                            <a class="btn btn-success" style="margin-bottom: 0px;" type="text" href="<?=base_url('menu/create'); ?>">Add New</a>
                        </div>            
                     </form>
                  </div>
                  <!-- <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">Showing 1 to 25 of 57 entries</div> -->
                  <?php $this->paging($totalpage,'left'); ?>
                  <table class="table table-striped table-bordered table-hover ">
                     <thead>
                        <tr role="row">
                           <th class="sorting"  style="width: 75px;">ID</th>
                           <th class="sorting"  style="width: 218px;" >Menu</th>
                           <th class="sorting"  style="width: 218px;" >Link</th>
                           <th class="sorting"  style="width: 196px;">Ngày tạo</th>
                           <th class="sorting"  style="width: 75px;" >Cấp độ</th>
                           <th class="sorting"  style="width: 75px;">Trạng thái</th>
                     <th class="sorting"  style="width: 75px;">Hành động</th>
                        </tr>
                     </thead>
                     <tbody >
                        <?php if($menu ) {foreach ($menu as $v) { ?>
                           <tr class="gradeA odd" role="row">
                              <td class="sorting_1 text-center"><?php echo $v->id ?></td>
                              <td><?php echo $v->name ?></td>
                              <td><?php echo $v->link ?></td>
                              <td class="text-center" ><?php echo $v->created ?></td>
                              <td class="text-center" >
                                    <a><span class="fa fa-plus-circle btnopenuser" data-lv="1" data-id="<?php echo $v->id ?>"></span></a>                                
                              </td> 
                              <td class="text-center">
			                  <?= $v->state==1 ? '<i class="fa fa-check"></i>':'<i class="fa fa-minus-circle"></i>'?>
                              </td>
                              <td class="text-center">
                                 <a href="<?=base_url('menu/edit/'.$v->id); ?>" ><span class="glyphicon glyphicon-pencil"></span></a>
                                 <a class="delete-confirm" href="<?=base_url('menu/delete/'.$v->id); ?>"><span class="glyphicon glyphicon-trash"></span></a>
                              </td>
                           </tr>
                          
                           <tr id="user_<?php echo $v->id ?>" class="hidden"></tr>

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

<style>
.sub-table{
	margin: 0;
}
.sub-table td{
	
}
</style>
<script>
$(document).on('click','.btnopenuser',function(){
	var _that = $(this),id=_that.data('id'),lv=_that.data('lv'),c_user = $('#user_'+id);
	if(c_user.hasClass('hidden')){
		_that.removeClass('fa-plus-circle').addClass('fa fa-minus-circle');
		c_user.removeClass('hidden').html('<td colspan="7"><i class="fa fa-spin fa-spinner"></i> Đang tải dữ liệu</td>');
		$.post('<?=base_url('menu/api_getsub') ?>',{parent:id,lv:lv}).done(function(d){
			if(d && d!='[]')
			{
				c_user.empty();
				d = JSON.parse(d);
				var str = '<td colspan="7" style="padding:0"><table class="table  sub-table">';
				$.each(d.data,function(i,u){
					 str += '<tr '+(d.lv==1?'class="success"':'class="info"')+'>'+
                              '<td class="text-center" style="width: 70px;" >'+u.id+'</td>'+                            
                              '<td style="width: 218px;" >|--'+u.name+'</td>'+
                              '<td style="width: 218px;"  >|--'+u.link+'</td>'+  
                              '<td class="text-center" style="width: 196px;" >'+u.created+'</td>'+
                              '<td class="text-center" style="width: 75px;">'+'<a><span class="fa fa-plus-circle btnopenuser" data-lv="'+(d.lv+1)+'" data-id="'+u.id+'"></span></a>'+'</td>'+
					'<td class="text-center" style="width: 75px;">'+( u.state==1?'<i class="fa fa-check"></i>':'<i class="fa fa-minus-circle"></i>')+'</td>'+
                              '<td   class="text-center" style="width: 75px;">'+
                                 '<a href="<?=base_url('menu/edit/'); ?>'+u.id+'" >'+
                                 '<span class="glyphicon glyphicon-pencil"></span></a>'+
                                 '<a class="delete-confirm" href="<?=base_url('menu/delete/'); ?>'+u.id+'">'+
                                 '<span class="glyphicon glyphicon-trash"></span></a>'+
                              '</td>'+
                           '</tr>'+
                            '<tr id="user_'+u.id+'" class="hidden"></tr>';					
				});
				str += '</table></td>';
                      
				c_user.html(str);
			}else{
				c_user.html('<td colspan="7">Không tìm thấy dữ liệu</td>');
			}
		})
	}else
	{
		_that.removeClass('fa-minus-circle').addClass('fa fa-plus-circle');
		c_user.addClass('hidden').html('');
	}
})
</script>