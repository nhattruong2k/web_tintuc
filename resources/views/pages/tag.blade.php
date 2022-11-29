@extends('../layout')

@section('content')
    @include('pages.navbar')
@endsection

@section('category')
    <div class="hero-area height-400 bg-img background-overlay" style="background-image: url('{{asset('img/blog-img/tag.jpg')}}')"></div>

    <div class="main-content-wrapper section-padding-100">
        <div class="container">
            <div class="row justify-content-center">
                <!-- ============= Post Content Area Start ============= -->
                <div class="col-12 col-lg-8">
                    <div class="post-content-area mb-100">
                        <!-- Catagory Area -->
                        <div class="world-catagory-area">
                            <h3 class="title">Tag Bài Viết Tìm Kiếm: {{$tag_baiviet}}</h3>
                            <div class="tab-content" id="myTabContent">
                                @php
                                $count = count($baiviet_tag); //Đếm $truyện\
                                // echo $count
                                @endphp
                                @if($count == 0) 
                                <div class="col-md-12">
                                    <div class="card mb-12 box-shadow">
                                        <div class="card-body">
                                            <p>Không tìm thấy tag bài viết</p>
                                        </div>
                                    </div>
                                </div>
                                @else
                                    @foreach($baiviet_tag as $tag)
                                    <div class="tab-pane fade show active" id="world-tab-1" role="tabpanel" aria-labelledby="tab1">
                                        <!-- Single Blog Post -->
                                        <div class="single-blog-post post-style-4 d-flex align-items-center">
                                            <!-- Post Thumbnail -->
                                            <div class="post-thumbnail">
                                                <a href="{{route('bai_viet',$tag->slug_blog)}}" class="headline">
                                                    <img src="{{asset('public/uploads/blog/'.$tag->image)}}" alt="">
                                                </a>
                                            </div>
                                            <!-- Post Content -->
                                            <div class="post-content">
                                                <a href="{{route('bai_viet',$tag->slug_blog)}}" class="headline">
                                                    <h5>{{$tag->tenblog}}</h5>
                                                </a>
                                                <a href="{{route('bai_viet',$tag->slug_blog)}}" class="headline">
                                                    <p>{{$tag->tomtat}}</p>
                                                </a>
                                                <!-- Post Meta -->
                                                <div class="post-meta">
                                                    <p><a href="{{route('tacgia',['slug'=>$tag->tacgia_slug])}}" class="post-author">{{$tag->user->name}}</a> on <a href="#" class="post-date">{{$tag->created_at}}</a></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection