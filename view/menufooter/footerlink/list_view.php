<div class="row">
   <div class="wrapper wrapper-content animated fadeInRight ecommerce">
     
      <div class="row">
          <div class="col-lg-12">
              <div class="ibox">
                  <div class="ibox-content">                   
                      <table class="footable table table-stripped">
                        <thead>
                           <tr>                             
                              <th >Tên</th>
                              <th class="text-right">Action</th>
                           </tr>
                        </thead>
                          <tbody>
                           <?php if($links) {foreach ($links as $k=>$v) { ?>
                              <tr >
                                
                                 <td class="footable-visible">
                                    <?php echo $v['name'] ?>
                                 </td>                               
                                 <td class="text-right">
                                    <div class="btn-group">
                                       <a href="<?=base_url('footerlink/edit/'.$k); ?>" class="btn-white btn btn-xs">Sửa</a>
                                    </div>
                                 </td>
                              </tr>
                           <?php }}else echo '<tr><td colspan="2">Chưa có dữ liệu</td></tr>' ?>
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>