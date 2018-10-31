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
               <!-- <div><a class="btn btn-success" style="margin-bottom: 0px;" type="text" href="<?=base_url('commentproduct/create'); ?>">Add New</a> -->
               <?php $this->paging($totalpage,'left'); ?>
                  <table class="table table-striped table-bordered table-hover ">
                     <thead>
                        <tr role="row">
                     <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="ID: activate to sort column descending" style="width: 75px;">ID</th>
                     <th  style="width: 218px;">Content</th>
                     <th style="width: 218px;">Post</th>
                     <th  style="width: 75px;">User</th>
                     <th  style="width: 75px;">Replace</th>
                     <th  style="width: 75px;">All Replace </th>
                     <th style="width: 75px;">State</th>      
                     <th style="width: 75px;">created</th>      
                     <th style="width: 75px;">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php if($commentproduct ) {foreach ($commentproduct as $v) { ?>
                           <tr class="gradeA odd" role="row">
                              <td class="sorting_1" ><?php echo $v->id ?></td>
                              <td><?php echo $v->content ?></td>
                              <td><?php echo $v->title ?></td>
                              <td class="text-center"><?php echo $v->customerspost ?></td>
                              <td class="text-center"><a href="<?=base_url('commentproduct/replace/'.$v->id); ?>"><span  class="fa fas fa-reply"></span></a></td>
                              <td class="text-center">
                                    <a><span class="fa fa-plus-circle btnopenuser" data-lv="1" data-id="<?php echo $v->id ?>"></span></a>                                
                              </td> 
                              <td class="text-center">
			                  <?= $v->state==1 ? '<i class="fa fa-check"></i>':'<i class="fa fa-minus-circle"></i>'?>
                              </td>
                              <td class="text-center" ><?php echo $v->created ?></td>
                              <td class="text-center">
                                 <a href="<?=base_url('commentproduct/edit/'.$v->id); ?>" ><span class="glyphicon glyphicon-pencil"></span></a>
                                 <a class="delete-confirm" href="<?=base_url('commentproduct/delete/'.$v->id); ?>"><span class="glyphicon glyphicon-trash"></span></a>
                              </td>
                           </tr>
                           <tr id="user_<?php echo $v->id ?>" class="hidden">								
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
		c_user.removeClass('hidden').html('<td colspan="10"><i class="fa fa-spin fa-spinner"></i> Đang tải dữ liệu</td>');
		$.post('<?=base_url('commentproduct/api_getsub') ?>',{parent:id,lv:lv}).done(function(d){
			if(d && d!='[]')
			{
				c_user.empty();
				d = JSON.parse(d);
				var str = '<td colspan="9" style="padding:0 0 0 10px"><table class="table  sub-table">';
				$.each(d.data,function(i,u){
					 str +='<tr '+(d.lv==1?'class="success"':'class="info"')+'>'+
                              '<td class="sorting_1" style="width: 75px;">'+u.id+'</td> '+ 
                              '<td style="width: 218px;" >'+(d.lv==1?'|-- ':' |-- ')+u.content+'</td>'+  
                              '<td  style="width: 218px;" >'+u.title+'</td> '+ 
                              '<td style="width: 75px;" >'+u.customerspost+'</td> '+ 
                              '<td class="text-center" style="width: 75px;" ><a href="<?=base_url('commentproduct/replace/'); ?>'+u.id+'" ><span  class="fa fas fa-reply" data-lv="1" data-id="<?php echo $v->id ?>"></span></a></td> '+
                              ' <td class="text-center" style="width: 75px;">'+
						'<a><span class="fa fa-plus-circle btnopenuser" data-lv="'+(d.lv+1)+'" data-id="'+u.id+'"></span></a>'+                                
					'</td>'+
                              '<td class="text-center" style="width:75px;" >'+
                               ( u.state==1?'<i class="fa fa-check"></i>':'<i class="fa fa-minus-circle"></i>')+
                              '</td>'+
                              '<td class="text-center" style="width: 75px;" >'+u.created+'</td> '+
                              '<td class="text-center" style="width: 75px;" ><a href="<?=base_url('commentproduct/edit/'); ?>'+u.id+'" ><span class="glyphicon glyphicon-pencil"></span></a> '+
                                    '<a class="delete-confirm" href="<?=base_url('commentproduct/delete/'); ?>'+u.id+'"><span class="glyphicon glyphicon-trash"></span></a>'+'</td>'+

                              '</tr>'+					
                              '<tr id="user_'+u.id+'" class="hidden"></tr>';					
				});
				str += '</table></td>';
				c_user.html(str);
			}else{
				c_user.html('<td colspan="9">Không tìm thấy dữ liệu</td>');
			}
		})
	}else
	{
		_that.removeClass('fa-minus-circle').addClass('fa fa-plus-circle');
		c_user.addClass('hidden').html('');
	}
})
</script>