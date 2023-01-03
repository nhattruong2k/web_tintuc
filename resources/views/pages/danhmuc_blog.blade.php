@foreach ($danh_blog as $danh)
<div >
    {{-- Because she competes with no one, no one can compete with her. --}}
    <div class="world-latest-articles" style="margin-right:225px; width:100%;">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="title" style=" margin-bottom: 2px;">
                    <h2 style="border-bottom: 2px solid #780533;" class="parent-cate">
                        <a href="{{route('category',$danh->slug_danhmuc)}}" style="color:inherit; text-decoration:none; position: relative;
                        display: inline-block; font-family: serif">
                            <h4>{{$danh->tendanhmuc}}</h4>
                        </a>
                    </h2>
                    <style>
                        .parent-cate{
                            float: left
                        }
                    </style>
                        @foreach($danh->children as $child_danh)
                        <span style="line-height: 3.50; font-size: 16px; margin-left:15px; color: #5f5c5c; font-family: arial;">
                            <a href="{{route('category22',['slug_parent'=>$danh->slug_danhmuc, 'slug'=>$child_danh->slug_danhmuc])}}" style="color: inherit; text-decoration: none; position: relative;">{{$child_danh->tendanhmuc}} </a> 
                        </span>
                        @endforeach
                </div>
                <div id="blogs">
                    @foreach($danh->nhieublog->take(4) as $blog)
                    @if($blog->kichhoat == 1)
                    <!-- Single Blog Post -->
                    @if(Auth::user())
                        <div class="single-blog-post post-style-4 d-flex align-items-center wow fadeInUpBig load" data-wow-delay="0.2s">
                            <!-- Post Thumbnail -->
                            <div class="post-thumbnail">
                                <a data-id="{{$blog->id}}" class="btn-blog" href="{{route('bai_viet',$blog->slug_blog)}}" class="headline">
                                    <img src="{{asset('public/uploads/blog/'.$blog->image)}}" alt="" style="height: 150px;">
                                </a>
                            </div>
                            <!-- Post Content -->
                            <div class="post-content">
                                <a data-id="{{$blog->id}}" class="btn-blog" href="{{route('bai_viet',$blog->slug_blog)}}" class="headline" style="color: inherit; text-decoration: none; position: relative;">
                                    <h5>{{$blog->tenblog}}</h5>
                                </a>
                                <p>{{$blog->tomtat}}</p>
                                <!-- Post Meta -->
                                <div class="post-meta">
                                    <div class="row" style="margin-right:96px; width:100%">
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
                        <div class="single-blog-post post-style-4 d-flex align-items-center wow fadeInUpBig load" data-wow-delay="0.2s">
                            <!-- Post Thumbnail -->
                            <div class="post-thumbnail">
                                <a href="{{route('bai_viet',$blog->slug_blog)}}" class="headline">
                                    <img src="{{asset('public/uploads/blog/'.$blog->image)}}" alt="" style="height: 150px;">
                                </a>
                            </div>
                            <!-- Post Content -->
                            <div class="post-content">
                                <a href="{{route('bai_viet',$blog->slug_blog)}}" class="headline" style="color: inherit; text-decoration: none; position: relative;">
                                    <h5>{{$blog->tenblog}}</h5>
                                </a>
                                <p>{{$blog->tomtat}}</p>
                                <!-- Post Meta -->
                                <div class="post-meta">
                                    <div class="row" style="margin-right:96px; width:100%">
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
                    @endif
                    @endforeach
                   
                    @foreach($danh->children->take(4) as $danh_children)
                        @foreach($danh_children->nhieublog as $blog_chil)
                            @if( !in_array($blog_chil->id,$array_blog) && $blog_chil->kichhoat == 1)
                                @if(Auth::user())
                                <div class="single-blog-post post-style-4 d-flex align-items-center wow fadeInUpBig load" data-wow-delay="0.2s">
                                    <!-- Post Thumbnail -->
                                    <div class="post-thumbnail">
                                        <a data-id="{{$blog_chil->id}}" class="btn-blog" href="{{route('bai_viet',$blog_chil->slug_blog)}}" class="headline">
                                            <img src="{{asset('public/uploads/blog/'.$blog_chil->image)}}" alt="" style="height: 150px;">
                                        </a>
                                    </div>
                                    <!-- Post Content -->
                                    <div class="post-content" >
                                        <a data-id="{{$blog_chil->id}}" class="btn-blog" href="{{route('bai_viet',$blog_chil->slug_blog)}}" class="headline" style="color: inherit; text-decoration: none; position: relative;">
                                            <h5>{{$blog_chil->tenblog}}</h5>
                                        </a>
                                        <p>{{$blog_chil->tomtat}}</p>
                                        <!-- Post Meta -->
                                        <div class="post-meta">
                                            <div class="row">
                                                <div class="col-10">
                                                    <p><a href="{{route('tacgia',['slug'=>$blog_chil->tacgia_slug])}}" class="post-author" style="color: inherit; text-decoration: none; position: relative;">{{$blog_chil->user->name}}</a> on <a href="#" class="post-date" style="color: inherit; text-decoration: none; position: relative;">{{date('d-m-Y', strtotime($blog_chil->created_at));}}</a></p>
                                                </div>
                                                <div class="col-2" style="right: 22px">
                                                    <i class="fa fa-eye" aria-hidden="true"> {{$blog_chil->views}} </i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="single-blog-post post-style-4 d-flex align-items-center wow fadeInUpBig load" data-wow-delay="0.2s">
                                    <!-- Post Thumbnail -->
                                    <div class="post-thumbnail">
                                        <a href="{{route('bai_viet',$blog_chil->slug_blog)}}" class="headline">
                                            <img src="{{asset('public/uploads/blog/'.$blog_chil->image)}}" alt="" style="height: 150px;">
                                        </a>
                                    </div>
                                    <!-- Post Content -->
                                    <div class="post-content" >
                                        <a href="{{route('bai_viet',$blog_chil->slug_blog)}}" class="headline" style="color: inherit; text-decoration: none; position: relative;">
                                            <h5>{{$blog_chil->tenblog}}</h5>
                                        </a>
                                        <p>{{$blog_chil->tomtat}}</p>
                                        <!-- Post Meta -->
                                        <div class="post-meta">
                                            <div class="row">
                                                <div class="col-10">
                                                    <p><a href="{{route('tacgia',['slug'=>$blog_chil->tacgia_slug])}}" class="post-author" style="color: inherit; text-decoration: none; position: relative;">{{$blog_chil->user->name}}</a> on <a href="#" class="post-date" style="color: inherit; text-decoration: none; position: relative;">{{date('d-m-Y', strtotime($blog_chil->created_at));}}</a></p>
                                                </div>
                                                <div class="col-2" style="right: 22px">
                                                    <i class="fa fa-eye" aria-hidden="true"> {{$blog_chil->views}} </i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @endif
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>


@endforeach