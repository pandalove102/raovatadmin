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
                        <div class="ibox-content">

                            <div>
                                <div class="feed-activity-list">

                                    <!-- <div class="feed-element">
                                        <a href="#" class="float-left">
                                            <img alt="image" class="rounded-circle" src="img/a1.jpg">
                                        </a>
                                        <div class="media-body ">
                                            <small class="float-right text-navy">1m ago</small>
                                            <strong>Sandra Momot</strong> started following <strong>Monica Smith</strong>. <br>
                                            <small class="text-muted">Today 4:21 pm - 12.06.2014</small>
                                            <div class="actions">
                                                <a href="#"  class="btn btn-xs btn-white"><i class="fa fa-thumbs-up"></i> Like </a>
                                                <a href="#" class="btn btn-xs btn-danger"><i class="fa fa-heart"></i> Love</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="feed-element">
                                        <a href="#" class="float-left">
                                            <img alt="image" class="rounded-circle" src="img/profile.jpg">
                                        </a>
                                        <div class="media-body ">
                                            <small class="float-right">5m ago</small>
                                            <strong>Monica Smith</strong> posted a new blog. <br>
                                            <small class="text-muted">Today 5:60 pm - 12.06.2014</small>

                                        </div>
                                    </div>

                                    <div class="feed-element">
                                        <a href="#" class="float-left">
                                            <img alt="image" class="rounded-circle" src="img/a2.jpg">
                                        </a>
                                        <div class="media-body ">
                                            <small class="float-right">2h ago</small>
                                            <strong>Mark Johnson</strong> posted message on <strong>Monica Smith</strong> site. <br>
                                            <small class="text-muted">Today 2:10 pm - 12.06.2014</small>
                                            <div class="well">
                                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                                                Over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                                            </div>
                                            <div class="float-right">
                                                <a href="#"  class="btn btn-xs btn-white"><i class="fa fa-thumbs-up"></i> Like </a>
                                                <a href="#"  class="btn btn-xs btn-white"><i class="fa fa-heart"></i> Love</a>
                                                <a href="#" class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i> Message</a>
                                            </div>
                                        </div>
                                    </div> -->

                                    <!-- <div class="feed-element">
                                        <a href="#" class="float-left">
                                            <img alt="image" class="rounded-circle" src="img/a3.jpg">
                                        </a>
                                        <div class="media-body ">
                                            <small class="float-right">2h ago</small>
                                            <strong>Janet Rosowski</strong> add 1 photo on <strong>Monica Smith</strong>. <br>
                                            <small class="text-muted">2 days ago at 8:30am</small>
                                            <div class="photos">
                                                <a target="_blank" href="../../78.media.tumblr.com/20a9c501846f50c1271210639987000f/tumblr_n4vje69pJm1st5lhmo1_1280.jpg"> <img alt="image" class="feed-photo" src="img/p1.jpg"></a>
                                                <a target="_blank" href="../../78.media.tumblr.com/9afe602b3e624aff6681b0b51f5a062b/tumblr_n4ef69szs71st5lhmo1_1280.jpg"> <img alt="image" class="feed-photo" src="img/p3.jpg"></a>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="feed-element">
                                        <a href="#" class="float-left">
                                            <img alt="image" class="rounded-circle" src="img/a4.jpg">
                                        </a>
                                        <div class="media-body ">
                                            <small class="float-right text-navy">5h ago</small>
                                            <strong>Chris Johnatan Overtunk</strong> started following <strong>Monica Smith</strong>. <br>
                                            <small class="text-muted">Yesterday 1:21 pm - 11.06.2014</small>
                                            <div class="actions">
                                                <a href="#"  class="btn btn-xs btn-white"><i class="fa fa-thumbs-up"></i> Like </a>
                                                <a href="#"  class="btn btn-xs btn-white"><i class="fa fa-heart"></i> Love</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="feed-element">
                                        <a href="#" class="float-left">
                                            <img alt="image" class="rounded-circle" src="img/a5.jpg">
                                        </a>
                                        <div class="media-body ">
                                            <small class="float-right">2h ago</small>
                                            <strong>Kim Smith</strong> posted message on <strong>Monica Smith</strong> site. <br>
                                            <small class="text-muted">Yesterday 5:20 pm - 12.06.2014</small>
                                            <div class="well">
                                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                                                Over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                                            </div>
                                            <div class="float-right">
                                                <a href="#"  class="btn btn-xs btn-white"><i class="fa fa-thumbs-up"></i> Like </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="feed-element">
                                        <a href="#" class="float-left">
                                            <img alt="image" class="rounded-circle" src="img/profile.jpg">
                                        </a>
                                        <div class="media-body ">
                                            <small class="float-right">23h ago</small>
                                            <strong>Monica Smith</strong> love <strong>Kim Smith</strong>. <br>
                                            <small class="text-muted">2 days ago at 2:30 am - 11.06.2014</small>
                                        </div>
                                    </div>
                                    <div class="feed-element">
                                        <a href="#" class="float-left">
                                            <img alt="image" class="rounded-circle" src="img/a7.jpg">
                                        </a>
                                        <div class="media-body ">
                                            <small class="float-right">46h ago</small>
                                            <strong>Mike Loreipsum</strong> started following <strong>Monica Smith</strong>. <br>
                                            <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                                        </div>
                                    </div> -->






                                       <!-- bình luận cấp 1  -->
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
                        <!-- kết thúc bình luận cấp 1 
                            
                           

                        <-- bình luận cấp 2  -->
                        <div class="social-comment">
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

                        </div>

                        <!-- kết thúc bình luận cấp 2 -->


                                </div>

                                <button class="btn btn-primary btn-block m"><i class="fa fa-arrow-down"></i> Show More</button>

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

 