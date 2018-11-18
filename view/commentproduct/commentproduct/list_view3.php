
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <?php 
            foreach($catalogs as $k=>$v)
            {
                if(isset($v->id))
                {
        ?>
        <!-- bắt đầu bài viết - bình luận  -->
            <div class="col-md-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5><?=(isset($v->name) ? $v->name : '' )?></h5>
                            <div class="social-feed-separated">
                                <!-- hình người đăng  bài viết  -->
                                <div class="social-avatar">
                                    <a href="#">
                                        <img alt="image" src="<?=(isset($v->image) && $v->image) ? $v->image : base_url('layout/images/no-image.png')?>">
                                    </a>
                                </div>
                                <div class="social-feed-box">
                                    <!-- bài viết   -->
                                    <div class="social-avatar">
                                        <a href="#">
                                            <?=(isset($v->name) ? $v->name : '' )?>
                                        </a>
                                        <small class="text-muted">Ngày tạo :<?=(isset($v->created) ? $v->created : '' )?> -------- Ngày ngày hiển thị :<?=(isset($v->date_show) ? $v->date_show : '' )?></small>
                                    </div>
                                    <!-- <div class="social-body"> -->
                                        <p>
                                            <?=(isset($v->shortdescription) ? $v->shortdescription : '' )?>
                                            <?php echo "<br>";?>
                                            <?=(isset($v->description) ? $v->description : '' )?>
                                        </p>
                                    <!-- </div> -->
                                </div>
                                </div> 
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                </div>
                                </div>
                                <div class="ibox-content" style="display: none;">
                                  
                                        <div class="feed-activity-list">
                                            <?php
                                                foreach($comment as $i=>$j)
                                                {
                                                    // if($j->idpost==$v->id && $j->parent_id==0 && count($this->model->listcomment_id_comment($j->id))==0 )
                                                    if($j->idpost==$v->id && $j->parent_id==0 && count($this->model->listcomment_id_comment($j->id))==0)
                                                    {
                                            ?>
                                                        <!-- bình luận cấp 1  -->
                                                            <?=($j->parent_id==0)?'<div class="feed-element">':'<div class="feed-element" style="margin-left: 50px;" >' ?>
                                                                <a href="#" class="float-left">
                                                                    <img alt="image" class="rounded-circle" src="<?=(isset($j->image)? $j->image :'' ) ?>">
                                                                </a>
                                                                <small class="text-muted">Người tạo: <?=(isset($j->fullname)? $j->fullname :'')?></small>
                                                                <div class="media-body ">
                                                                    <small class="text-muted">Ngày tạo: <?=(isset($j->created)? $j->created :'')?></small>
                                                                
                                                                    <div class="well">
                                                                        <div class="media-body ">
                                                                            <?=(isset($j->content)?$j->content:'') ?>
                                                                        </div>
                                                                    </div>

                                                                    <div class="actions">
                                                                        <a href="#" class="btn btn-xs <?=($j->state==0)?'btn-success':'btn-danger' ?>"><i class="fa fa-comments"></i> <?=($j->state==0)?' Đã duyệt / Hiện ':' Không Duyệ / Ẩn ' ?> </a>
                                                                    </div>
                                                                
                                                                    <div class="chat-form">
                                                                        <form role="form">
                                                                            <div class="form-group">
                                                                                <textarea class="form-control" placeholder="Message"></textarea>
                                                                            </div>
                                                                            <div class="text-right">
                                                                                <button type="submit" class="btn btn-sm btn-primary m-t-n-xs"><strong>Trả lời</strong></button>
                                                                            </div>
                                                                        </form>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        <!-- kết thúc bình luận cấp 1  -->
                                            <?php
                                                    }
                                                    if($j->idpost==$v->id &&  count($this->model->listcomment_id_comment($j->id))>0)
                                                    {
                                            ?>
                                                        <!-- bình luận cấp 1  -->
                                                        <?=($j->parent_id==0)?'<div class="feed-element">':'<div class="feed-element" style="margin-left: 50px;" >' ?>
                                                            <a href="#" class="float-left">
                                                                <img alt="image" class="rounded-circle" src="<?=(isset($j->image)? $j->image :'' ) ?>">
                                                            </a>
                                                            <small class="text-muted">Người tạo: <?=(isset($j->fullname)? $j->fullname :'')?></small>
                                                            <div class="media-body ">
                                                                <small class="text-muted">Ngày tạo: <?=(isset($j->created)? $j->created :'')?></small>
                                                            
                                                                <div class="well">
                                                                    <div class="media-body ">
                                                                        <?=(isset($j->content)?$j->content:'') ?>
                                                                    </div>
                                                                </div>

                                                                <div class="actions">
                                                                    <a href="#" data-id="<?php echo $j->id ?>" onclick="update();"  class="btn btn-xs <?=($j->state==0)?'btn-success':'btn-danger' ?> state "><i class="fa fa-comments"></i> <?=($j->state==0)?' Đã duyệt / Hiện ':' Không Duyệ / Ẩn ' ?> </a>
                                                                </div>
                                                            
                                                                <div class="chat-form">
                                                                    <form role="form">
                                                                        <div class="form-group">
                                                                            <textarea class="form-control" placeholder="Message"></textarea>
                                                                        </div>
                                                                        <div class="text-right">
                                                                            <button type="submit" class="btn btn-sm btn-primary m-t-n-xs"><strong>Trả lời</strong></button>
                                                                        </div>
                                                                    </form>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <!-- kết thúc bình luận cấp 1  -->
                                                            <?php
                                                                        foreach($comment as $o=>$l)// duyệt bình luận cấp 2 của bình luận cấp 1 
                                                                        {
                                                                            if($l->parent_id==$j->id)
                                                                            {
                                                            ?>
                                                                                <!-- bình luận cấp 2  -->
                                                                                <?=($l->parent_id==0)?'<div class="feed-element">':'<div class="feed-element" style="margin-left: 50px;" >' ?>
                                                                                        <a href="#" class="float-left">
                                                                                            <img alt="image" class="rounded-circle" src="<?=(isset($l->image)? $l->image :'' ) ?>">
                                                                                        </a>
                                                                                        <small class="text-muted">Người tạo: <?=(isset($l->fullname)? $l->fullname :'')?></small>
                                                                                        <div class="media-body ">
                                                                                            <small class="text-muted">Ngày tạo: <?=(isset($l->created)? $l->created :'')?></small>
                                                                                        
                                                                                            <div class="well">
                                                                                                <div class="media-body ">
                                                                                                    <?=(isset($l->content)?$l->content:'') ?>
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="actions">
                                                                                                
                                                                                                <a href="#" data-id="<?php echo $l->id ?>" onclick="update();" class="btn btn-xs <?=($l->state==0)?'btn-success':'btn-danger' ?> state "><i class="fa fa-comments"></i> <?=($l->state==0)?' Đã duyệt / Hiện ':' Không Duyệ / Ẩn ' ?> </a>
                                                                                            </div>
                                                                                        
                                                                                            <div class="chat-form">
                                                                                                <form role="form">
                                                                                                    <div class="form-group">
                                                                                                        <textarea class="form-control" placeholder="Message"></textarea>
                                                                                                    </div>
                                                                                                    <div class="text-right">
                                                                                                        <button type="submit" class="btn btn-sm btn-primary m-t-n-xs"><strong>Trả lời</strong></button>
                                                                                                    </div>
                                                                                                </form>
                                                                                            </div>

                                                                                        </div>
                                                                                    </div>
                                                                                <!-- kết thúc bình luận cấp 2  -->
                                                            <?php
                                                                            }
                                                                        }

                                                                
                                                            ?>
                                            <?php
                                                    }
                                                    
                                                }
                                            ?>

                                        </div>
                                  
                                </div>
                            </div>
                        </div>
                
            <!--  kết thúc bài viết - bình luận  -->
    <?php 
            }
        }
    ?>
      </div>
</div>


 <script>
    $.get_id = function() {
        // var id=$(this).data('state');
        alert($(this).data("id"));
    };
    function update() {
    $.get_id();
    };
</script>

 