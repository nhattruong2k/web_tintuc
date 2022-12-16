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
                                @if(Auth::user())
                                <input type="hidden" value="{{$tac->tenblog}}" class="wishlist_tenblog_{{$tac->id}}">
                                <input type="hidden" value="{{Auth::user()->name}}" class="wishlist_auth_{{$tac->id}}">
                                <input type="hidden" value="{{$tac->tomtat}}" class="wishlist_tomtat_{{$tac->id}}">
                                <input type="hidden" value="{{route('bai_viet',$tac->slug_blog)}}" class="wishlist_url_{{$tac->id}}">
                                <input type="hidden" value="{{$tac->user->name}}" class="wishlist_tacgia_{{$tac->id}}">
                                <input type="hidden" value="{{route('tacgia',['slug'=>$tac->tacgia_slug])}}" class="wishlist_tacgia_url_{{$tac->id}}">
                                <input type="hidden" value="{{date('d-m-Y', strtotime($tac->created_at));}}" class="wishlist_created_{{$tac->id}}">
                                <input type="hidden" value=" {{$tac->views}}" class="wishlist_view_{{$tac->id}}">
                                <div class="tab-pane fade show active" id="world-tab-1" role="tabpanel" aria-labelledby="tab1">
                                    <!-- Single Blog Post -->
                                    <div class="single-blog-post post-style-4 d-flex align-items-center wow fadeInUpBig load">
                                        <!-- Post Thumbnail -->
                                        <div class="post-thumbnail">
                                            <a data-id="{{$tac->id}}" class="btn-blog" href="{{route('bai_viet',$tac->slug_blog)}}" class="headline">
                                                <img class="btn-blog wishlist_image_{{$tac->id}}" style="height: 185px;" src="{{asset('public/uploads/blog/'.$tac->image)}}" alt="">
                                             </a>
                                        </div>
                                        <!-- Post Content -->
                                        <div class="post-content">
                                            <a data-id="{{$tac->id}}" class="btn-blog post-content" href="{{route('bai_viet',$tac->slug_blog)}}" class="headline"  style="color: inherit; text-decoration: none; position: relative;">
                                                <h5>{{$tac->tenblog}}</h5>
                                                <p>{{$tac->tomtat}}</p>
                                            </a>
                                            <!-- Post Meta -->
                                            <div class="post-meta">
                                                <div class="row">
                                                    <div class="col-10">
                                                        <p><a href="{{route('tacgia',['slug'=>$tac->tacgia_slug])}}" class="post-author" style="color: inherit; text-decoration: none; position: relative;">{{$tac->user->name}}</a> on <a href="#" style="color: inherit; text-decoration: none; position: relative;" class="post-date">{{date('d-m-Y', strtotime($tac->created_at));}}</a></p>
                                                    </div>
                                                    <div class="col-2">
                                                        <i class="fa fa-eye" aria-hidden="true"> {{$tac->views}} </i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="tab-pane fade show active" id="world-tab-1" role="tabpanel" aria-labelledby="tab1">
                                    <!-- Single Blog Post -->
                                    <div class="single-blog-post post-style-4 d-flex align-items-center wow fadeInUpBig load">
                                        <!-- Post Thumbnail -->
                                        <div class="post-thumbnail">
                                            <a href="{{route('bai_viet',$tac->slug_blog)}}" class="headline">
                                                <img  style="height: 185px;" src="{{asset('public/uploads/blog/'.$tac->image)}}" alt="">
                                             </a>
                                        </div>
                                        <!-- Post Content -->
                                        <div class="post-content">
                                            <a class="post-content" href="{{route('bai_viet',$tac->slug_blog)}}" class="headline"  style="color: inherit; text-decoration: none; position: relative;">
                                                <h5>{{$tac->tenblog}}</h5>
                                                <p>{{$tac->tomtat}}</p>
                                            </a>
                                            <!-- Post Meta -->
                                            <div class="post-meta">
                                                <div class="row">
                                                    <div class="col-10">
                                                        <p><a href="{{route('tacgia',['slug'=>$tac->tacgia_slug])}}" class="post-author" style="color: inherit; text-decoration: none; position: relative;">{{$tac->user->name}}</a> on <a href="#" style="color: inherit; text-decoration: none; position: relative;" class="post-date">{{date('d-m-Y', strtotime($tac->created_at));}}</a></p>
                                                    </div>
                                                    <div class="col-2">
                                                        <i class="fa fa-eye" aria-hidden="true"> {{$tac->views}} </i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
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