@extends('../layout')

@section('content')
    @include('pages.navbar')
@endsection

@section('blog_province')
<div class="hero-area bg-img background-overlay" style="background-image: url('{{asset('img/blog-img/sign-in.jpg')}}'); height:280px"></div>

<div class="main-content-wrapper section-padding-100">
    <div class="container">
        <div class="row justify-content-center">
            <!-- ============= Post Content Area Start ============= -->
            <div class="col-12 col-lg-8">
                <div class="post-content-area mb-100">
                    <!-- Catagory Area -->
                    <div class="world-catagory-area">
                        <h3 class="title">Tin theo khu vực</h3>
                        <div class="blog_province" style="align-items: center;">
                                @foreach($blogger->take(1) as $blog)
                                    <h4 class="title" style="display:inline-block">{{$blog->province_blog}}</h4>
                                @endforeach
                            <div class="province" style="z-index:2">
                                <span class="icon-arrow"></span>
                                    <ul class="sub-area">
                                        @foreach($province as $provinces)
                                            <li>
                                                <a class="{{$provinces->slug_name == $blog_province ? 'disabled' : ''}}" href="{{route('blog_province', $provinces->slug_name)}}">{{$provinces->name_province}}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                            </div>
                        </div>
                        <div class="tab-content" id="myTabContent">
                            @php
                            $count = count($blogger); //Đếm $truyện
                            @endphp
                            {{-- Nếu $truyen không có thì Trang đang cập nhật...  --}}
                            @if($count == 0) 
                            <div class="col-md-12">
                                <div class="card mb-12 box-shadow">
                                <div class="card-body">
                                    <p>Trang đang cập nhật....</p>
                                </div>
                                </div>
                            </div>
                            @else
                            @foreach($blogger as $blog)
                            @if(Auth::user())
                            <input type="hidden" value="{{$blog->tenblog}}" class="wishlist_tenblog_{{$blog->id}}">
                            <input type="hidden" value="{{Auth::user()->name}}" class="wishlist_auth_{{$blog->id}}">
                            <input type="hidden" value="{{$blog->tomtat}}" class="wishlist_tomtat_{{$blog->id}}">
                            <input type="hidden" value="{{route('bai_viet',$blog->slug_blog)}}" class="wishlist_url_{{$blog->id}}">
                            <input type="hidden" value="{{$blog->user->name}}" class="wishlist_tacgia_{{$blog->id}}">
                            <input type="hidden" value="{{route('tacgia',['slug'=>$blog->tacgia_slug])}}" class="wishlist_tacgia_url_{{$blog->id}}">
                            <input type="hidden" value="{{date('d-m-Y', strtotime($blog->created_at));}}" class="wishlist_created_{{$blog->id}}">
                            <input type="hidden" value=" {{$blog->views}}" class="wishlist_view_{{$blog->id}}">
                            <div class="tab-pane fade show active" id="world-tab-1" role="tabpanel" aria-labelledby="tab1">
                                <!-- Single Blog Post -->
                                <div class="single-blog-post post-style-4 d-flex align-items-center">
                                    <!-- Post Thumbnail -->
                                    <div class="post-thumbnail">
                                        <a data-id="{{$blog->id}}" class="btn-blog" href="{{route('bai_viet',$blog->slug_blog)}}" class="headline">
                                            <img src="{{asset('public/uploads/blog/'.$blog->image)}}" alt="" style="height: 130px" class="wishlist_image_{{$blog->id}}">
                                         </a>
                                    </div>
                                    <!-- Post Content -->
                                    <div class="post-content">
                                        <a data-id="{{$blog->id}}" class="btn-blog" href="{{route('bai_viet',$blog->slug_blog)}}" class="headline" style="color: inherit; text-decoration: none; position: relative;">
                                            <h5>{{$blog->tenblog}}</h5>
                                        </a>
                                        <a data-id="{{$blog->id}}" class="btn-blog" href="{{route('bai_viet',$blog->slug_blog)}}" class="headline">
                                            <p>{{$blog->tomtat}}</p>
                                        </a>
                                        <!-- Post Meta -->
                                        <div class="post-meta">
                                            <div class="row">
                                                <div class="col-10">
                                                    <p><a href="{{route('tacgia',['slug'=>$blog->tacgia_slug])}}" class="post-author" style="color: inherit; text-decoration: none; position: relative;">{{$blog->user->name}}</a> on <a href="#" class="post-date" style="color: inherit; text-decoration: none; position: relative;">{{date('d-m-Y', strtotime($blog->created_at));}}</a></p>
                                                </div>
                                                <div class="col-2">
                                                    <i class="fa fa-eye" aria-hidden="true"> {{$blog->views}} </i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            @else
                            <!-- Single Blog Post -->
                                <div class="single-blog-post post-style-4 d-flex align-items-center">
                                    <!-- Post Thumbnail -->
                                    <div class="post-thumbnail">
                                        <a href="{{route('bai_viet',$blog->slug_blog)}}" class="headline">
                                            <img src="{{asset('public/uploads/blog/'.$blog->image)}}" alt="" style="height: 130px">
                                        </a>
                                    </div>
                                    <!-- Post Content -->
                                    <div class="post-content">
                                        <a href="{{route('bai_viet',$blog->slug_blog)}}" class="headline" style="color: inherit; text-decoration: none; position: relative;">
                                            <h5>{{$blog->tenblog}}</h5>
                                        </a>
                                        <a href="{{route('bai_viet',$blog->slug_blog)}}" class="headline">
                                            <p>{{$blog->tomtat}}</p>
                                        </a>
                                        <!-- Post Meta -->
                                        <div class="post-meta">
                                            <div class="row">
                                                <div class="col-10">
                                                    <p><a href="{{route('tacgia',['slug'=>$blog->tacgia_slug])}}" class="post-author" style="color: inherit; text-decoration: none; position: relative;">{{$blog->user->name}}</a> on <a href="#" class="post-date" style="color: inherit; text-decoration: none; position: relative;">{{date('d-m-Y', strtotime($blog->created_at));}}</a></p>
                                                </div>
                                                <div class="col-2">
                                                    <i class="fa fa-eye" aria-hidden="true"> {{$blog->views}} </i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            @endif
                            @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="piga mt-3">
                        {{ $blogger->links() }}
                        <style>
                            .piga ul{
                                background-color:white;
                                justify-content: center;
                            }
                        </style>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .sub-area .disabled {
        pointer-events: none;
        cursor: default;
        color: #9f9f9f;
    }
    .blog_province{
        position: relative;
        display: flex;
    }
    .province{
        position: relative;
        display: inline-block;
        margin-left: 10px;
        cursor: pointer;
        padding: 8px 0;
    }
    .icon-arrow{
        width: 32px;
        height: 32px;
        background: #EFEFEF;
        border-radius: 50%;
        display: block;
        margin-left: 8px;
        position: relative;
    }
    .icon-arrow::before{
        border: solid #757575;
        border-width: 0 1px 1px 0;
        display: inline-block;
        padding: 3px;
        content: '';
        position: absolute;
        top: 11px;
        left: 12px;
        transform: rotate(45deg);
        -webkit-transform: rotate(45deg);
    }
    .sub-area{
        width: 155px;
        background: #fff;
        box-shadow: 0 1px 4px rgb(0 0 0 / 20%);
        border-radius: 4px;
        position: absolute;
        left: 0;
        opacity: 0;
        visibility: hidden;
        top: 85%;
        transition-duration: 200ms;
        transition-property: all;
        transition-timing-function: cubic-bezier(.7,1,.7,1);
    }

    .province:hover .sub-area{
        visibility:visible;
        opacity:1;  
    }
    
    .sub-area li a {
        display: block;
        padding: 12px 15px;
        color: #4f4f4f;
        font-size: 14px;
        line-height: 140%;
        font-weight: 700;
    }
    
</style>
@endsection
