@extends('../layout')

@section('content')
    @include('pages.navbar')
@endsection

@section('tacgia')
    <div class="hero-area height-400 bg-img background-overlay" style="background-image: url('{{asset('img/blog-img/sub-category.jpg')}}')"></div>

    <div class="main-content-wrapper section-padding-100">
        <div class="container">
            <div class="row justify-content-center">
                <!-- ============= Post Content Area Start ============= -->
                <div class="col-12 col-lg-8">
                    <div class="post-content-area mb-100">
                        <!-- Catagory Area -->
                        <div class="world-catagory-area">
                            <h1 class="title">Tác giải bài viết</h1>
                                <h5>Tên tác giả: {{$tacgia}}</h5>
                            <hr>
                            <div class="tab-content" id="myTabContent">
                                @php
                                $count = count($blog_slug); //Đếm $truyện
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
                                @foreach($blog_slug as $tac)
                                <div class="tab-pane fade show active" id="world-tab-1" role="tabpanel" aria-labelledby="tab1">
                                    <!-- Single Blog Post -->
                                    <div class="single-blog-post post-style-4 d-flex align-items-center">
                                        <!-- Post Thumbnail -->
                                        <div class="post-thumbnail">
                                            <a href="{{route('bai_viet',$tac->slug_blog)}}" class="headline">
                                                <img src="{{asset('public/uploads/blog/'.$tac->image)}}" alt="">
                                             </a>
                                        </div>
                                        <!-- Post Content -->
                                        <div class="post-content">
                                            <a href="{{route('bai_viet',$tac->slug_blog)}}" class="headline">
                                                <h5>{{$tac->tenblog}}</h5>
                                            </a>
                                            <a href="{{route('bai_viet',$tac->slug_blog)}}" class="headline">
                                                <p>{{$tac->tomtat}}</p>
                                            </a>
                                            <!-- Post Meta -->
                                            <div class="post-meta">
                                                <div class="row">
                                                    <div class="col-10">
                                                        <p><a href="{{route('tacgia',['slug'=>$tac->tacgia_slug])}}" class="post-author">{{$tac->user->name}}</a> on <a href="#" class="post-date">{{date('d-m-Y', strtotime($tac->created_at));}}</a></p>
                                                    </div>
                                                    <div class="col-2">
                                                        <i class="fa fa-eye" aria-hidden="true"> {{$tac->views}} </i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection