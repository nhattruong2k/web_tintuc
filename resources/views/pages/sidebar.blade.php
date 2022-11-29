<div class="col-12 col-md-8 col-lg-4">
    <div class="post-sidebar-area wow fadeInUpBig" data-wow-delay="0.2s">
        <!-- Widget Area -->
        <div class="sidebar-widget-area">
            <h5 class="title">Giới thiệu về trang web tin tức</h5>
            <div class="widget-content">
                <p>
                    Trang web tin tức được thành lập vào năm 2017
                </p>
            </div>
        </div>
        <!-- Widget Area -->
        <div class="sidebar-widget-area">
            <h5 class="title">Bài viết HOT</h5>
            <div class="widget-content">
                <!-- Single Blog Post -->
                @foreach($blog_hot as $blog)
                    @if($blog->blog_noibat==1)
                        <div class="single-blog-post post-style-2 d-flex align-items-center widget-post">
                            <!-- Post Thumbnail -->
                            <div class="post-thumbnail">
                                <a href="{{route('bai_viet',$blog->slug_blog)}}" >
                                    <img src="{{asset('public/uploads/blog/'.$blog->image)}}" style="height:75px" alt="">
                                </a>
                            </div>
                            <!-- Post Content -->
                            <div class="post-content">
                                <a href="{{route('bai_viet',$blog->slug_blog)}}" class="headline" style="color: inherit; text-decoration: none; position: relative;">
                                    <h5 class="mb-0">{{$blog->tenblog}}</h5>
                                </a>
                                <i class="fa fa-eye" aria-hidden="true"> {{$blog->views}} </i>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="sidebar-widget-area">
            <h5 class="title">Bài viết xem nhiều</h5>
            <div class="widget-content">
                <!-- Single Blog Post -->
                @foreach($blog_hot as $blog)
                    @if($blog->views >= 4)
                        <div class="single-blog-post post-style-2 d-flex align-items-center widget-post">
                            <!-- Post Thumbnail -->
                            <div class="post-thumbnail">
                                <a href="{{route('bai_viet',$blog->slug_blog)}}">
                                    <img src="{{asset('public/uploads/blog/'.$blog->image)}}" style="height:75px" alt="">
                                </a>
                            </div>
                            <!-- Post Content -->
                            <div class="post-content">
                                <a href="{{route('bai_viet',$blog->slug_blog)}}" class="headline" style="color: inherit; text-decoration: none; position: relative;">
                                    <h5 class="mb-0">{{$blog->tenblog}}</h5>
                                </a>
                                <i class="fa fa-eye" aria-hidden="true"> {{$blog->views}} </i>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        <!-- Widget Area -->
        <div class="sidebar-widget-area">
            <h5 class="title">Liên Hệ</h5>
            <div class="widget-content">
                <div class="social-area d-flex justify-content-between">
                    <a href="#" class="icon"><i class="fa fa-facebook"></i></a>
                    <a href="#" class="icon"><i class="fa fa-twitter"></i></a>
                    <a href="#" class="icon"><i class="fa fa-pinterest"></i></a>
                    <a href="#" class="icon"><i class="fa fa-vimeo"></i></a>
                    <a href="#" class="icon"><i class="fa fa-instagram"></i></a>
                    <a href="#" class="icon"><i class="fa fa-google"></i></a>
                </div>
            </div>
        </div>
        
    </div>
</div>
<style>
    .centFont{
        margin-bottom: 0.5rem;
        font-family: inherit;
        font-weight: 10000;
        line-height: 1.2;
        color: inherit;
    }
    .icon{
        color: inherit; text-decoration: none; position: relative;
    }
</style>