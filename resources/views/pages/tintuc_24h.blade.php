@extends('../layout')
@section('content')
    @include('pages.navbar')
@endsection
@section('tin_tuc24h')
<div class="hero-area">
    <!-- Hero Slides Area -->
    @php
    $count = $posts->count();
    @endphp
    @if($count == 0)
    <div class="hero-area height-400 bg-img background-overlay" style="background-image: url('{{asset('public/uploads/blog/sub-category.jpg')}}')">
        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center">
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="single-blog-title text-center">
                        <!-- Catagory -->
                        <h3>Chưa có bài viết mới</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @elseif($count == 1)
    @foreach($posts as $blog )
            <div class="hero-area height-400 bg-img background-overlay" style="background-image: url('{{asset('public/uploads/blog/'.$blog->image)}}')">
                <div class="container h-100">
                    <div class="row h-100 align-items-center justify-content-center">
                        <div class="col-12 col-md-8 col-lg-6">
                            <div class="single-blog-title text-center">
                                <!-- Catagory -->
                                <h3>{{$blog->tenblog}}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    @endforeach  
    @else
    <div class="hero-slides owl-carousel">
        @foreach($posts as $blog )
            <div class="single-hero-slide bg-img background-overlay" style="background-image: url('{{ asset('public/uploads/blog/'.$blog->image)}}');"></div>
        @endforeach
    </div>
    <!-- Hero Post Slide -->
    <div class="hero-post-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="hero-post-slide">
                    @foreach($posts as $key => $blog )
                        <!-- Single Slide -->
                        <div class="single-slide d-flex align-items-center">
                            <div class="post-number">
                                <p>{{$key}}</p>
                            </div>
                            <div class="post-title">
                                <a href="{{route('bai_viet',$blog->slug_blog)}}">{{$blog->tenblog}}</a>
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
<div class="main-content-wrapper section-padding-100">
    <div class="container">
        <div class="row justify-content-center">
            <!-- ============= Post Content Area Start ============= -->
            <div class="col-12 col-lg-8">
                <div class="post-content-area mb-50">
                    <!-- Catagory Area -->
                    <div class="world-catagory-area">
                        <span>Tin tức 24h</span><br>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="title"><h3 style="font-family: Arial, Helvetica,Lucida Console">Mới nhất</h3></li>
                        </ul>
                        @php
                        $count = $posts->count();
                        @endphp
                        @if($count == 0) 
                        <div class="tab-content" id="myTabContent">
                        <div class="single-blog-post post-style-4 d-flex align-items-center wow fadeInUpBig load" data-wow-delay="0.2s">
                            <!-- Post Content -->
                            <div class="post-content" >
                                <h6 style="padding: 13px 21px 8px;">Chưa có bài viết mới...</h6>
                            </div>
                        </div>
                        </div>
                        @else
                        <div class="tab-content" id="myTabContent">
                            <div id="blogs">
                                @foreach($posts as $bai)
                                <!-- Single Blog Post -->
                                    {{-- @if($bai->created_at->diffForHumans()) --}}
                                        <div>
                                            <span>{{$bai->created_at->diffForHumans() }}</span>
                                            <div class="single-blog-post post-style-4 d-flex align-items-center wow fadeInUpBig load mt-3" data-wow-delay="0.2s">
                                                <!-- Post Thumbnail -->
                                                <div class="post-thumbnail">
                                                    <a href="{{route('bai_viet',$bai->slug_blog)}}" class="headline">
                                                        <img src="{{asset('public/uploads/blog/'.$bai->image)}}" alt="">
                                                    </a>
                                                </div>
                                                <!-- Post Content -->
                                                <div class="post-content">
                                                    <a href="{{route('bai_viet',$bai->slug_blog)}}" class="headline" style="color: inherit; text-decoration: none">
                                                        <h5>{{$bai->tenblog}}</h5>
                                                    </a>
                                                    <p>{{$bai->tomtat}}</p>
                                                    <!-- Post Meta -->
                                                    <div class="row">
                                                        <div class="col-10">
                                                            <div class="post-meta">
                                                                <p><a href="{{route('tacgia',['slug'=>$bai->tacgia_slug])}}" class="post-author" style="color: inherit; text-decoration: none; position: relative;">{{$bai->user->name}}</a> on <a href="#" class="post-date" style="color: inherit; text-decoration: none; position: relative;">{{date('d-m-Y', strtotime($bai->created_at));}}</a></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-2">
                                                            <i class="fa fa-eye" aria-hidden="true"> {{$bai->views}} </i>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                @endforeach
                            {{-- @elseif($) --}}
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="piga">
                    {{ $posts->links() }}
                    <style>
                        .piga ul{
                            background-color:white;
                            justify-content: center;
                        }
                    </style>
                </div>
            </div>
            @include('pages.sidebar')
        </div>
    </div>
</div>
@endsection