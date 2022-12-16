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
                        @if(Auth::user())
                            <div class="single-blog-post post-style-2 d-flex align-items-center widget-post">
                                <!-- Post Thumbnail -->
                                <div class="post-thumbnail">
                                    <a data-id="{{$blog->id}}" class="btn-blog" href="{{route('bai_viet',$blog->slug_blog)}}" >
                                        <img src="{{asset('public/uploads/blog/'.$blog->image)}}" style="height:75px" alt="">
                                    </a>
                                </div>
                                <!-- Post Content -->
                                <div class="post-content">
                                    <a href="{{route('bai_viet',$blog->slug_blog)}}" data-id="{{$blog->id}}" class="btn-blog" class="headline" style="color: inherit; text-decoration: none; position: relative;">
                                        <h6 class="mb-0">{{$blog->tenblog}}</h6>
                                    </a>
                                    <i class="fa fa-eye" aria-hidden="true"> {{$blog->views}} </i>
                                </div>
                            </div>
                        @else 
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
                                        <h6 class="mb-0">{{$blog->tenblog}}</h6>
                                    </a>
                                    <i class="fa fa-eye" aria-hidden="true"> {{$blog->views}} </i>
                                </div>
                            </div>
                        @endif
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
                        @if(Auth::user())
                        <input type="hidden" value="{{$blog->tenblog}}" class="wishlist_tenblog_{{$blog->id}}">
                        <input type="hidden" value="{{Auth::user()->name}}" class="wishlist_auth_{{$blog->id}}">
                        <input type="hidden" value="{{$blog->tomtat}}" class="wishlist_tomtat_{{$blog->id}}">
                        <input type="hidden" value="{{route('bai_viet',$blog->slug_blog)}}" class="wishlist_url_{{$blog->id}}">
                        <input type="hidden" value="{{$blog->user->name}}" class="wishlist_tacgia_{{$blog->id}}">
                        <input type="hidden" value="{{route('tacgia',['slug'=>$blog->tacgia_slug])}}" class="wishlist_tacgia_url_{{$blog->id}}">
                        <input type="hidden" value="{{date('d-m-Y', strtotime($blog->created_at));}}" class="wishlist_created_{{$blog->id}}">
                        <input type="hidden" value=" {{$blog->views}}" class="wishlist_view_{{$blog->id}}">
                        <div class="single-blog-post post-style-2 d-flex align-items-center widget-post">
                            <!-- Post Thumbnail -->
                            <div class="post-thumbnail">
                                <a data-id="{{$blog->id}}" class="btn-blog" href="{{route('bai_viet',$blog->slug_blog)}}">
                                    <img src="{{asset('public/uploads/blog/'.$blog->image)}}" style="height:75px" alt="" class="wishlist_image_{{$blog->id}}">
                                </a>
                            </div>
                            <!-- Post Content -->
                            <div class="post-content">
                                <a href="{{route('bai_viet',$blog->slug_blog)}}" data-id="{{$blog->id}}" class="btn-blog" class="headline" style="color: inherit; text-decoration: none; position: relative;">
                                    <h6 class="mb-0">{{$blog->tenblog}}</h6>
                                </a>
                                <i class="fa fa-eye" aria-hidden="true"> {{$blog->views}} </i>
                            </div>
                        </div>
                        @else
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
                                        <h6 class="mb-0">{{$blog->tenblog}}</h6>
                                    </a>
                                    <i class="fa fa-eye" aria-hidden="true"> {{$blog->views}} </i>
                                </div>
                            </div>
                        @endif
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