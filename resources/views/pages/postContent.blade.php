<div class="col-12 col-lg-8">
        <div class="post-content-area">
            <!-- Catagory Area -->
            <div class="world-catagory-area">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="title">Tin trong ngày</li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="world-tab-1" role="tabpanel" aria-labelledby="tab1">
                        <div class="row">
                            <div class="col-12 col-md-7">
                                <div class="world-catagory-slider owl-carousel wow fadeInUpBig" data-wow-delay="0.1s">
                                    @foreach($blogger as $blog)
                                    @if(Auth::user())
                                    <div class="single-blog-post">
                                        <input type="hidden" value="{{$blog->tenblog}}" class="wishlist_tenblog_{{$blog->id}}">
                                        <input type="hidden" value="{{Auth::user()->name}}" class="wishlist_auth_{{$blog->id}}">
                                        <input type="hidden" value="{{$blog->tomtat}}" class="wishlist_tomtat_{{$blog->id}}">
                                        <input type="hidden" value="{{route('bai_viet',$blog->slug_blog)}}" class="wishlist_url_{{$blog->id}}">
                                        <input type="hidden" value="{{$blog->user->name}}" class="wishlist_tacgia_{{$blog->id}}">
                                        <input type="hidden" value="{{route('tacgia',['slug'=>$blog->tacgia_slug])}}" class="wishlist_tacgia_url_{{$blog->id}}">
                                        <input type="hidden" value="{{date('d-m-Y', strtotime($blog->created_at));}}" class="wishlist_created_{{$blog->id}}">
                                        <input type="hidden" value=" {{$blog->views}}" class="wishlist_view_{{$blog->id}}">
                                        <!-- Post Thumbnail -->
                                        <div class="post-thumbnail">
                                            <a data-id="{{$blog->id}}" class="btn-blog" href="{{route('bai_viet',$blog->slug_blog)}}" class="headline">
                                                <img style="height:400px; width:650px;" src="{{asset('public/uploads/blog/'.$blog->image)}}" alt="" class="wishlist_image_{{$blog->id}}">
                                            </a>
                                            <div class="post-cta">
                                                @foreach($blog->thuocnhieudanhmucblog as $thuocdanh)
                                                    <a href="{{route('category',$thuocdanh->slug_danhmuc)}}" style="text-decoration: none;">{{ $thuocdanh->tendanhmuc }}</a>
                                                @endforeach
                                            </div>
                                            <!-- Catagory -->
                                        </div>
                                        <!-- Post Content -->
                                        <div class="post-content" style="padding: 5px 30px">
                                            <a data-id="{{$blog->id}}" class="btn-blog post-content" href="{{route('bai_viet',$blog->slug_blog)}}" class="headline" style="color: inherit; text-decoration: none; position: relative;">
                                                <h5>{{$blog->tenblog}}</h6>
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
                                    @else
                                    <!-- Single Blog Post -->
                                        <div class="single-blog-post">
                                            <!-- Post Thumbnail -->
                                            <div class="post-thumbnail">
                                                <a href="{{route('bai_viet',$blog->slug_blog)}}" class="headline">
                                                    <img style="height:400px; width:650px;" src="{{asset('public/uploads/blog/'.$blog->image)}}" alt="">
                                                </a>
                                                <div class="post-cta">
                                                    @foreach($blog->thuocnhieudanhmucblog as $thuocdanh)
                                                        <a href="{{route('category',$thuocdanh->slug_danhmuc)}}" style="text-decoration: none;">{{ $thuocdanh->tendanhmuc }}</a>
                                                    @endforeach
                                                </div>
                                                <!-- Catagory -->
                                            </div>
                                            <!-- Post Content -->
                                            <div class="post-content">
                                                <a href="{{route('bai_viet',$blog->slug_blog)}}" class="headline" style="color: inherit; text-decoration: none; position: relative;">
                                                        <h5>{{$blog->tenblog}}</h5>
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
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-12 col-md-5">
                                <!-- Single Blog Post -->
                                @foreach($blogger->take(6) as $blog)
                                @if(Auth::user())
                                <div class="single-blog-post post-style-2 d-flex align-items-center wow fadeInUpBig" data-wow-delay="0.2s">
                                    <!-- Post Thumbnail -->
                                    <div class="post-thumbnail">
                                        <a  data-id="{{$blog->id}}" class="btn-blog" href="{{route('bai_viet',$blog->slug_blog)}}" class="headline">
                                            <img src="{{asset('public/uploads/blog/'.$blog->image)}}" style="height:99px" alt="">
                                        </a>
                                    </div>
                                    <!-- Post Content -->
                                    <div class="post-content">

                                        <a data-id="{{$blog->id}}" class="btn-blog" href="{{route('bai_viet',$blog->slug_blog)}}"  class="headline" style="color: inherit; text-decoration: none; position: relative;">
                                            <h6>{{$blog->tenblog}}</h6>
                                        </a>
                                        <!-- Post Meta -->
                                        <div class="post-meta">
                                            <p><a href="{{route('tacgia',['slug'=>$blog->tacgia_slug])}}" class="post-author" style="color: inherit; text-decoration: none; position: relative;">{{$blog->user->name}}</a> on <a href="#" class="post-date" style="color: inherit; text-decoration: none; position: relative;">{{date('d-m-Y', strtotime($blog->created_at));}}</a></p>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="single-blog-post post-style-2 d-flex align-items-center wow fadeInUpBig" data-wow-delay="0.2s">
                                    <!-- Post Thumbnail -->
                                    <div class="post-thumbnail">
                                        <a href="{{route('bai_viet',$blog->slug_blog)}}" class="headline">
                                            <img src="{{asset('public/uploads/blog/'.$blog->image)}}" style="height:99px" alt="">
                                        </a>
                                    </div>
                                    <!-- Post Content -->
                                    <div class="post-content">

                                        <a href="{{route('bai_viet',$blog->slug_blog)}}"  class="headline" style="color: inherit; text-decoration: none; position: relative;">
                                            <h6>{{$blog->tenblog}}</h6>
                                        </a>
                                        <!-- Post Meta -->
                                        <div class="post-meta">
                                            <p><a href="{{route('tacgia',['slug'=>$blog->tacgia_slug])}}" class="post-author" style="color: inherit; text-decoration: none; position: relative;">{{$blog->user->name}}</a> on <a href="#" class="post-date" style="color: inherit; text-decoration: none; position: relative;">{{date('d-m-Y', strtotime($blog->created_at));}}</a></p>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>