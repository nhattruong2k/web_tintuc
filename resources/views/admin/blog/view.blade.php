@extends('layouts.index')

@section('content')
<div class="card">
    <div class="container">
        <div class="row  justify-content-center">
            <div class="col-lg-11">
                <div class="card">
                    <div class="card-header">
                    <a href="{{ URL::previous() }}" class="btn btn-outline-primary">Quay lại</a>
                    <h4 class="row justify-content-center">Xem chi tiết bài viết</h4>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-md-2">
                                <label for="">Hình ảnh</label>
                                <div class="p-1 border">
                                    <img class="img-thumbnail" src="{{ asset('public/uploads/blog/'.$blog->image) }}" height="200" width="200">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="">Tên Blog</label>
                                <div class="p-2 border">{{$blog->tenblog}}</div>
                                <br>
                                <label for="">Slug_blog</label>
                                <div class="p-2 border">{{$blog->slug_blog}}</div>
                                <br>
                                <label for="">Tác giả</label>
                                <div class="p-2 border">{{$tacgia->user->name}}</div>
                                <br>
                                <label for="">Bài viết khu vực: </label>
                                @if($blog->blog_province == 0)
                                    <div class="p-2 border">Chưa có bài viết theo khu vực</div>
                                    @elseif($blog->blog_province != 0)
                                    <div class="p-2 border">{{$blog->province->name}}</div>
                                @endif
                            </div> 
                            <div class="col-md-3">
                            <label for="">Tóm tắt</label>
                                <div class="p-2 border">{{$blog->tomtat}}</div>
                            <br>
                            <label for="">Nội dung</label>
                                <div class="p-2 border">
                                    <span class="d-flex justify-content-center">
                                        <p>{!! Str::limit(($blog->content),150, '...') !!}</p>
                                    </span>
                                </div>
                                <br>
                            <label>Tag Bài Viết</label>
                            <div class="p-2 border">
                                @if($blog->tagbaiviet == 0)
                                    <span class="d-flex justify-content-center">
                                        chưa có tag bài viết
                                    </span>
                                @else
                                    <span class="d-flex justify-content-center">
                                        {{$blog->tagbaiviet}}
                                    </span>
                                @endif
                            </div>
                            </div>
                            <div class="col-md-3">
                                <label for="">Thuộc danh mục</label>
                                     <div class="p-2 border">
                                    @foreach($blog->thuocnhieudanhmucblog as $blogs)
                                        {{$blogs->tendanhmuc}};
                                    @endforeach
                                    </div>
                                <br>
                                <label for="">Nổi bật</label>
                                @if($blog->blog_noibat == 0)
                                    <div class="p-2 border">Blog mới</div>
                                @else
                                    <div class="p-2 border">Blog hot</div>
                                @endif   
                                    <br>
                                <label for="">Kích hoạt</label>
                                    @if($blog->kichhoat == 0)
                                        <div class="p-2 border">Kích hoạt</div>
                                    @else
                                        <div class="p-2 border">Không kích hoạt</div>
                                    @endif
                                <br>
                                <label for="">Lượt xem</label>
                                <div class="p-2 border">{{$blog->views}}</div>
                                <br>
                                <label for="">Ngày đăng</label>
                                <div class="p-2 border">
                                    <span class="d-flex">
                                        {{$blog->created_at}}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection