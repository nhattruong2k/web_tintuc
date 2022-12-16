@extends('../layout')

@section('content')
    @include('pages.navbar')
@endsection

@section('category')
    <div class="hero-area height-400 bg-img background-overlay" style="background-image: url('{{asset('img/blog-img/sub-category.jpg')}}')"></div>

    <div class="main-content-wrapper section-padding-100">
        <div class="container">
            <div class="row justify-content-center">
                <!-- ============= Post Content Area Start ============= -->
                <div class="col-12 col-lg-8">
                    <div class="post-content-area mb-100">
                        <!-- Catagory Area -->
                        <div class="world-catagory-area">
                            <h1 class="title"> Danh mục bài viết</h1>
                                <a style="color: #495057;" class="nav-link" style="display:block; width:max-content;text-decoration: none;" href="{{route('category',$danhmuc_parent->slug_danhmuc)}}"> <h5 style="color: inherit;">{{$danhmuc_parent->tendanhmuc}}</h5></a>
                          <style>
                            a:hover{
                                color: inherit;
                                text-decoration: none;
                            }
                            h5{
                                font-family: Helvetica	;
                            }
                            .title{
                                margin-left: 12px;
                            }
                          </style>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                
                                @foreach($danhmuc_parent->children as $navchild)
                                <li class="nav-item">
                                    <a style="color: #495057;" class="nav-link {{$danhmuc_id->slug_danhmuc == $navchild->slug_danhmuc ? 'active' : ''}}" href="{{route('category22', ['slug_parent' => $danhmuc_parent->slug_danhmuc, 'slug' => $navchild->slug_danhmuc])}}" >{{$navchild->tendanhmuc}}</a>
                                </li>
                                @endforeach
                                
                            </ul>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection