<div class="row">
   <div class="wrapper wrapper-content animated fadeInRight ecommerce">
        <form class="m-t"  action="<?=base_url('news'); ?>" method="get" >
            <div class="ibox-content m-b-sm border-bottom">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="control-label" >Tên bài viết</label>
                            <input type="text" name="key" value="<?=$this->get('key') ?>" placeholder="Tên bài viết" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="control-label" for="status">Danh mục bài viết</label>
                            <select name="catagories_id" id="catagories_id" class="form-control">
                                <option value="" >Chọn Danh mục bài viết</option>
                                <?php if($catagories) {foreach ($catagories as $v) { ?>
                                    <option <?php echo $this->get('catagories_id') ==$v->id? 'selected':'' ?>  value="<?php echo $v->id  ?>"><?php echo $v->name?></option>
                                <?php }} ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="control-label" for="status">Trạng thái</label>
                            <select name="status" id="status" class="form-control">
                                <option value="" >Trạng Thái</option>
                                <option value="1"> Hiện</option>
                                <option value="2">Ẩn</option>
                                
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3" style="margin-top: 2.8%;">
                        <?=$this->randtoken('tokensearch'); ?>
                        <div class="form-group" style="text-align: left;">
                            <button class="btn btn-primary" type="submit">Search</button>
                            <a class="btn btn-success" style="margin-bottom: 0px;" type="text" href="<?=base_url('news/create'); ?>">Add New</a>
                        </div>
                    </div>
                   
                   
                </div>
            </div>
        </form>
      <div class="row">
          <div class="col-lg-12">
              <div class="ibox">
                  <div class="ibox-content">
                    <?php $this->paging($totalpage,'left'); ?>
                      <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="15">
                        <thead>
                           <tr>
                              <th data-toggle="true">ID</th>
                              <th data-toggle="true">Hình</th>
                              <th data-toggle="true">Tên bài viết</th>
                              <th data-hide="phone">Danh mục</th>
                              <th data-hide="all">Nội dung ngắn</th>
                              <th data-hide="phone">Trạng thái</th>
                              <th class="text-right" data-sort-ignore="true">Action</th>
                           </tr>
                        </thead>
                          <tbody>
                           <?php if($news) {foreach ($news as $v) { ?>
                              <tr class="footable-even" style="">
                                 <td class="footable-visible footable-first-column"><span class="footable-toggle"></span>
                                    <?php echo $v->id ?>
                                 </td>
                                 <td class="footable-visible">
                                    <img src="<?=($v->image) ? $v->image : base_url('layout/images/no-image.png')?>" height="50px" width="50px">
                                 </td>
                                 <td class="footable-visible">
                                    <?php echo $v->name ?>
                                 </td>
                                 <td class="footable-visible">
                                    <?php foreach ($catagories as $k) {
                                       if($k->id == $v->catagories_id)
                                          echo $k->name?>
                                    <?php }?>
                                 </td>
                                 <td style="display: none;">
                                    <?php echo $v->shortdescription ?>
                                 </td>

                                 <td>
                                    <span class="label label-primary <?php if($v->status!=1) echo 'hide'; ?>">Hiện</span>
                                    <span class="label label-danger <?php if($v->status!=2) echo 'hide'; ?>">Ẩn</span>
                                 </td>
                                 <td class="text-right">
                                    <div class="btn-group">
                                       <a href="<?=base_url('news/edit/'.$v->id); ?>" class="btn-white btn btn-xs">Sửa</a>
                                       <a href="<?=base_url('news/delete/'.$v->id); ?>" class="btn-white btn btn-xs">Xóa</a>
                                    </div>
                                 </td>
                              </tr>
                           <?php }}else echo '<tr><td colspan="10">Chưa có dữ liệu</td></tr>' ?>
                          </tbody>
                      </table>
                      <?php $this->paging($totalpage); ?>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>