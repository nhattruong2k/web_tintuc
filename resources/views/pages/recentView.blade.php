@extends('../layout')
@section('content')
    @include('pages.navbar')
@endsection
@section('tin_da_xem')
<div class="hero-area">
    <!-- Hero Slides Area -->
    @php
    $count = $recentBlog->count();
    @endphp
    @if($count == 0)
    <div class="hero-area height-400 bg-img background-overlay" style="background-image: url('{{asset('public/uploads/blog/sub-category.jpg')}}')">
        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center">
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="single-blog-title text-center">
                        <!-- Catagory -->
                        <h3>Chưa có tin đã xem</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @elseif($count == 1)
    @foreach($recentBlog as $recent)
            <div class="hero-area height-400 bg-img background-overlay" style="background-image: url('{{asset('public/uploads/blog/'.$recent->blog->image)}}')">
                <div class="container h-100">
                    <div class="row h-100 align-items-center justify-content-center">
                        <div class="col-12 col-md-8 col-lg-6">
                            <div class="single-blog-title text-center">
                                <!-- Catagory -->
                                <h3>{{$recent->blog->tenblog}}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    @endforeach 
    @else
    <div class="hero-slides owl-carousel">
        @foreach($recentBlog as $recent)
            <div class="single-hero-slide bg-img background-overlay" style="background-image: url('{{ asset('public/uploads/blog/'.$recent->blog->image)}}');"></div>
        @endforeach
    </div>
    <!-- Hero Post Slide -->
    <div class="hero-post-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="hero-post-slide">
                    @foreach($recentBlog as $key => $recent )
                        <!-- Single Slide -->
                        <div class="single-slide d-flex align-items-center">
                            <div class="post-number">
                                <p>{{$key}}</p>
                            </div>
                            <div class="post-title">
                                <a href="{{route('bai_viet',$recent->blog->slug_blog)}}">{{$recent->blog->tenblog}}</a>
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
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="title"><h4 style="font-family: Arial, Helvetica,Lucida Console">Tin tức đã xem</h4></li>
                        </ul>
                        @php
                        $count = $recentBlog->count();
                        @endphp
                        @if($count == 0) 
                        <div class="tab-content" id="myTabContent">
                        <div class="single-blog-post post-style-4 d-flex align-items-center wow fadeInUpBig load" data-wow-delay="0.2s">
                            <!-- Post Content -->
                            <div class="post-content" >
                                <h6 style="padding: 13px 21px 8px;">Chưa có tin đã xem...</h6>
                            </div>
                        </div>
                        </div>
                        @else
                        <div class="tab-content" id="myTabContent">
                            <div id="blogs">
                                @foreach($recentBlog as $recent)
                                <!-- Single Blog Post -->
                                    {{-- @if($bai->created_at->diffForHumans()) --}}
                                        <div>
                                            <div class="single-blog-post post-style-4 d-flex align-items-center wow fadeInUpBig load" data-wow-delay="0.2s">
                                                <!-- Post Thumbnail -->
                                                <div class="post-thumbnail">
                                                    <a href="{{route('bai_viet',$recent->blog->slug_blog)}}" class="headline">
                                                        <img src="{{asset('public/uploads/blog/'.$recent->blog->image)}}" alt="">
                                                    </a>
                                                </div>
                                                <!-- Post Content -->
                                                <div class="post-content">
                                                    <a href="{{route('bai_viet',$recent->blog->slug_blog)}}" class="headline" style="color: inherit; text-decoration: none; position: relative;">
                                                        <h5>{{$recent->blog->tenblog}}</h5>
                                                    </a>
                                                    <p>{{$recent->blog->tomtat}}</p>
                                                    <!-- Post Meta -->
                                                    <div class="row">
                                                        <div class="col-10">
                                                            <div class="post-meta">
                                                                <p><a href="{{route('tacgia',['slug'=>$recent->tacgia_slug])}}" class="post-author" style="color: inherit; text-decoration: none; position: relative;">{{$recent->user->name}}</a> on <a href="#" class="post-date" style="color: inherit; text-decoration: none; position: relative;">{{date('d-m-Y', strtotime($recent->blog->created_at));}}</a></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-2">
                                                            <i class="fa fa-eye" aria-hidden="true"> {{$recent->blog->views}} </i>
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
            </div>
        </div>
    </div>
</div>
@endsection