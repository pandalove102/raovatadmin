
<div class="wrapper wrapper-content  animated fadeInRight">
<input type="hidden" name="admin_id" id="admin_id" value="<?=(isset($_SESSION['admin_id'])) ? $_SESSION['admin_id'] : ''?>">
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
                                    <a >
                                        <img alt="image" src="<?=(isset($v->image) && $v->image) ? $v->image : base_url('layout/images/no-image.png')?>">
                                    </a>
                                </div>
                                <div class="social-feed-box">
                                    <!-- bài viết   -->
                                    <div class="social-avatar">
                                        <a >
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
                                                    
                                                    if($j->idpost==$v->id && $j->parent_id==0 && count($this->model->listcomment_id_comment($j->id))==0)
                                                    {
                                            ?>
                                                        <!-- bình luận cấp 1  -->
                                                            <?=($j->parent_id==0)?'<div class="feed-element">':'<div class="feed-element" style="margin-left: 50px;" >' ?>
                                                                <a  class="float-left">
                                                                    <img alt="image" class="rounded-circle" src="<?=(isset($j->image)? $j->image :'' ) ?>">
                                                                </a>
                                                                <small class="text-muted">Người tạo: <?=(isset($j->fullname)? $j->fullname :'')?></small>
                                                                <div class="media-body ">
                                                                    <small class="text-muted">Ngày tạo: <?=(isset($j->created)? $j->created :'')?></small>
                                                                    <div class="actions">
                                                                        <a   data-id="<?php echo $j->id ?>" id="comment_<?php echo $j->id ?>"  class="btn btn-xs <?=($j->state==0)?'btn-success':'btn-danger' ?> state "><i class="fa fa-comments"></i> <?=($j->state==0)?' Đã duyệt / Hiện ':' Không Duyệ / Ẩn ' ?> </a>
                                                                    </div>
                                                                    <div class="well">
                                                                        <div class="media-body ">
                                                                            <?=(isset($j->content)?$j->content:'') ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="chat-form">
                                                                        <form role="form">
                                                                            <div class="form-group">
                                                                                <textarea id="rep<?php echo $j->id ?>" data-idpost="<?php echo $v->id ?>"  data-id="<?php echo $j->id ?>" class="form-control" placeholder="Message"></textarea>
                                                                            </div>
                                                                            <div class="text-right">
                                                                                <a class="btn btn-white btn-bitbucket" at="<?php echo $j->id ?>" >
                                                                                    <i class="fa fa-star"></i> Trả lời
                                                                                </a>
                                                                            </div>
                                                                        </form>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <div id="div<?php echo $j->id ?>"></div>
                                                        <!-- kết thúc bình luận cấp 1  -->
                                            <?php
                                                    }
                                                    if($j->idpost==$v->id &&  count($this->model->listcomment_id_comment($j->id))>0)
                                                    {
                                            ?>
                                                        <!-- bình luận cấp 1  -->
                                                        <?=($j->parent_id==0)?'<div class="feed-element">':'<div class="feed-element" style="margin-left: 50px;" >' ?>
                                                            <a  class="float-left">
                                                                <img alt="image" class="rounded-circle" src="<?=(isset($j->image)? $j->image :'' ) ?>">
                                                            </a>
                                                            <small class="text-muted">Người tạo: <?=(isset($j->fullname)? $j->fullname :'')?></small>
                                                            <div class="media-body ">
                                                                <small class="text-muted">Ngày tạo: <?=(isset($j->created)? $j->created :'')?></small>
                                                                <div class="actions">
                                                                    <a  data-id="<?php echo $j->id ?>" id="comment_<?php echo $j->id ?>"  class="btn btn-xs <?=($j->state==0)?'btn-success':'btn-danger' ?> state "><i class="fa fa-comments"></i> <?=($j->state==0)?' Đã duyệt / Hiện ':' Không Duyệ / Ẩn ' ?> </a>
                                                                </div>
                                                                <div class="well">
                                                                    <div class="media-body ">
                                                                        <?=(isset($j->content)?$j->content:'') ?>
                                                                    </div>
                                                                </div>
                                                                <div class="chat-form">
                                                                        <div class="form-group">
                                                                            <textarea id="rep<?php echo $j->id ?>" data-idpost="<?php echo $v->id ?>"  data-id="<?php echo $j->id ?>" class="form-control" placeholder="Message"></textarea>
                                                                        </div>
                                                                        <div class="text-right">
                                                                            <a class="btn btn-white btn-bitbucket replace" at="<?php echo $j->id ?>" >
                                                                                <i class="fa fa-star" ></i> Trả lời
                                                                            </a>
                                                                        </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div id="div<?php echo $j->id ?>"></div>
                                                        <!-- kết thúc bình luận cấp 1  -->
                                                            <?php
                                                                        foreach($comment as $o=>$l)// duyệt bình luận cấp 2 của bình luận cấp 1 
                                                                        {
                                                                            if($l->parent_id==$j->id)
                                                                            {
                                                            ?>
                                                                                <!-- bình luận cấp 2  -->
                                                                                <?=($l->parent_id==0)?'<div class="feed-element">':'<div class="feed-element" style="margin-left: 50px;" >' ?>
                                                                                        <a  class="float-left">
                                                                                            <img alt="image" class="rounded-circle" src="<?=(isset($l->image)? $l->image :'' ) ?>">
                                                                                        </a>
                                                                                        <small class="text-muted">Người tạo: <?=(isset($l->fullname)? $l->fullname :'')?></small>
                                                                                        <div class="media-body ">
                                                                                            <small class="text-muted">Ngày tạo: <?=(isset($l->created)? $l->created :'')?></small>
                                                                                            <div class="actions">
                                                                                                <a  data-id="<?php echo $l->id ?>" id="comment_<?php echo $l->id ?>" class="btn btn-xs <?=($l->state==0)?'btn-success':'btn-danger' ?> state "><i class="fa fa-comments"></i> <?=($l->state==0)?' Đã duyệt / Hiện ':' Không Duyệ / Ẩn ' ?> </a>
                                                                                            </div>
                                                                                            <div class="well">
                                                                                                <div class="media-body ">
                                                                                                    <?=(isset($l->content)?$l->content:'') ?>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="chat-form">
                                                                                                    <div class="form-group"  >
                                                                                                        <textarea id="rep<?php echo $l->id ?>" data-idpost="<?php echo $v->id ?>"  data-id="<?php echo $l->id ?>" class="form-control" placeholder="Message"></textarea>
                                                                                                    </div>
                                                                                                    <div class="text-right">
                                                                                                        <a class="btn btn-white btn-bitbucket replace" at="<?php echo $l->id ?>"   >
                                                                                                            <i class="fa fa-star"></i> Trả lời
                                                                                                        </a>
                                                                                                    </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div id="div<?php echo $l->id ?>"></div>
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

    $(document).on('click', '.state', function () {
        var _that = $(this);
        var id = _that.data('id');
        var idcomment = $('rep' + id);
        $.post('<?=base_url('commentproduct/api_show_hidden_commnet') ?>', {id: id})
            .done(function (d) {
                d = JSON.parse(d);
                //  alert(d.data)
                if (d.data == 1) {
                    _that.addClass('btn-success state');
                }
                if (d.data == 0) {
                    _that.addClass('btn-danger state');
                }
            })
    })
</script>
<script>
    $(document).on('click', '.btn-bitbucket', function () {

        var _that = $(this);
        var parent_id = _that.attr('at');
        var id='rep' + parent_id;
        var rep = $('#'+id).val();
        var dataidpost =$('#'+id).data('idpost');
        var admin_id = $('#admin_id').val();
        $.post('<?=base_url('commentproduct/api_replace_commnet') ?>', {
            parent_id: parent_id ,
            dataidpost: dataidpost ,
            admin_id: admin_id ,
            rep: rep
        })
        .done(function (d) {
            d = JSON.parse(d);
            $('#div'+parent_id).append(d.text);
        })
    })

</script>
