
<div class="wrapper wrapper-content  animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
        <?php 
            foreach($commentproduct as $k=>$v)
            {
                if(isset($v->idpost))
                {
        ?>
          <!-- bắt đầu bài viết và bình luận  -->
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
                        <small class="text-muted">Ngày tạo :<?=(isset($v->created) ? $v->created : '' )?> </small>
                    </div>
                    <div class="social-body">
                        <p>
                            <?=(isset($v->shortdescription) ? $v->shortdescription : '' )?>
                            <?php echo "<br>";?>
                            <?=(isset($v->description) ? $v->description : '' )?>
                        </p>
                      
                    </div>
                    <!-- kết thúc bài viết  -->
                    <div class="social-footer">

                        <!--bình luận cấp 1  -->
                        <div class="social-comment">
                            <a href="#" class="float-left">
                                <img alt="image" src="img/a4.jpg">
                            </a>
                            <div class="media-body">
                                <a href="#">
                                    Andrew Williams
                                </a>
                                Making this the first true generator on the Internet. It uses a dictionary of.
                                <br/>
                                <a href="#" class="small"><i class="fa fa-thumbs-up"></i> 11 Like this!</a> -
                                <small class="text-muted">10.07.2014</small>
                            </div>
                            <div class="btn-group">
                                <button class="btn btn-white btn-xs"><i class="fa fa-thumbs-up"></i> Duyệt </button>
                                <button class="btn btn-white btn-xs"><i class="fa fa-comments"></i> Hiện </button>
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
                        <!-- kết thúc bình luận cấp 1  -->
                            
                           

                        <!-- bình luận cấp 2  -->
                        <!-- <div class="social-comment">
                                <a href="#" class="float-left">
                                    <img alt="image" src="img/a7.jpg">
                                </a>
                                <div class="media-body">
                                    <a href="#">
                                        Andrew Williams
                                    </a>
                                    Making this the first true generator on the Internet. It uses a dictionary of.
                                    <br/>
                                    <a href="#" class="small"><i class="fa fa-thumbs-up"></i> 11 Like this!</a> -
                                    <small class="text-muted">10.07.2014</small>
                                </div>
                                
                                <div class="btn-group">
                                    <button class="btn btn-white btn-xs"><i class="fa fa-thumbs-up"></i> Duyệt </button>
                                    <button class="btn btn-white btn-xs"><i class="fa fa-comments"></i> Hiện </button>
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

                        </div> -->

                        <!-- kết thúc bình luận cấp 2 -->

                    

                      

                    </div>
                </div>
            </div> 
        <!-- kết thúc bình luận của 1 bài viết  -->
        <?php
            }
        }
        ?>
        </div>
    </div>
</div>