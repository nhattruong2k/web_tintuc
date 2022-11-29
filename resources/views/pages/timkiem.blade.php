@extends('../layout')

@section('content')
    @include('pages.navbar')
@endsection

@section('category')
    <div class="hero-area height-400 bg-img background-overlay" style="background-image: url('{{asset('img/blog-img/bg3.jpg')}}')"></div>

    <div class="main-content-wrapper section-padding-100">
        <div class="container">
            <div class="row justify-content-center">
                <!-- ============= Post Content Area Start ============= -->
                <div class="col-12 col-lg-8">
                    <div class="post-content-area mb-100">
                        <!-- Catagory Area -->
                        <div class="world-catagory-area">
                            <h3 class="title"></h3>
                            <div class="tab-content" id="myTabContent">
                                @foreach($tim_baiviet as $timkiem)
                                    <div class="tab-pane fade show active" id="world-tab-1" role="tabpanel" aria-labelledby="tab1">
                                        <!-- Single Blog Post -->
                                        <div class="single-blog-post post-style-4 d-flex align-items-center">
                                            <!-- Post Thumbnail -->
                                            <div class="post-thumbnail">
                                                <a href="" class="headline">
                                                    <img src="{{asset('public/uploads/blog/'.$timkiem->image)}}" alt="">
                                                </a>
                                            </div>
                                            <!-- Post Content -->
                                            <div class="post-content">
                                                <a href="" class="headline">
                                                    <h5>{{$timkiem->tenblog}}</h5>
                                                </a>
                                                <a href="" class="headline">
                                                    <p>{{$timkiem->tomtat}}</p>
                                                </a>
                                                <!-- Post Meta -->
                                                <div class="post-meta">
                                                    <p><a href="#" class="post-author">{{$timkiem->tacgia}}</a> on <a href="#" class="post-date">{{$timkiem->created_at}}</a></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection