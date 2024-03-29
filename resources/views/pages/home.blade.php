@extends('../layout')

@section('content')
    @include('pages.navbar')
    {{-- <div class="container">
        @if(Session::has('yes'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{Session::get('yes')}}
            </div>
        @endif
        @if(Session::has('no'))
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{Session::get('no')}}
            </div>
        @endif
    </div> --}}
    <!-- ***** Header Area End ***** -->
    <!-- ********** Hero Area Start ********** -->
    <div class="hero-area">
        <!-- Hero Slides Area -->
        <div class="hero-slides owl-carousel">
            @foreach($blogger as $blog )
            <!-- Single Slide -->
            <div class="single-hero-slide bg-img background-overlay" style="background-image: url('{{ asset('public/uploads/blog/'.$blog->image)}}');"></div>
            @endforeach
        </div>
        <!-- Hero Post Slide -->
        <div class="hero-post-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="hero-post-slide">
                        @foreach($blogger as $key => $blog )
                            <!-- Single Slide -->
                            <div class="single-slide d-flex align-items-center">
                                <div class="post-number">
                                    <p>{{$key}}</p>
                                </div>
                                <div class="post-title">
                                    @if(Auth::user())
                                    <a data-id="{{$blog->id}}" class="btn-blog" href="{{route('bai_viet',$blog->slug_blog)}}">{{$blog->tenblog}}</a>
                                    @else
                                    <a href="{{route('bai_viet',$blog->slug_blog)}}">{{$blog->tenblog}}</a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ********** Hero Area End ********** -->

    <div class="main-content-wrapper section-padding-100">
        <div class="container">
            <div class="row justify-content-center">
                <!-- ============= Post Content Area Start ============= -->
                @include('pages.postContent')
                <!-- ========== Sidebar Area ========== -->
                @include('pages.sidebar')
            </div>
            @include('pages.danhmuc_blog')
            @include('pages.worldLatestArticles')
        </div>
    </div>
</div>
@endsection