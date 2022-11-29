@extends('layouts.index')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Sửa Blog</div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                     @endif
                    <form method="POST" action="{{ route('blog.update', [$blog->id])}}" enctype="multipart/form-data"> 
                        @method('PUT')
                        @csrf   
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Tên Blog</label>
                          <input 
                            type="text" 
                            class="form-control" 
                            name="tenblog" 
                            value="{{ $blog->tenblog }}" 
                            onkeyup="ChangeToSlug();"
                            id="slug" 
                            aria-describedby="emailHelp"
                            placeholder="Tên"
                            >
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Slug Blog</label>
                            <input 
                                type="text" 
                                class="form-control" 
                                name="slug_blog" 
                                value="{{ $blog->slug_blog }}"
                                id="convert_slug" 
                                aria-describedby="emailHelp"
                                placeholder="Slug blog"
                                >
                        </div>
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Tên Tác Giả</label>
                          <input 
                            type="hidden" 
                            class="form-control" 
                            name="user_id" 
                            value="{{$blog->user_id}}" 
                            placeholder="{{$blog->user->name}}"
                            >
                            <div class="p-2 border" value="">{{$blog->user->name}}</div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Tóm Tắt blog</label>
                            <textarea name="tomtat" class="form-control" rows="5" style="resize: none">{{ $blog->tomtat }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nội Dung Blog</label>
                            <textarea name="content" id="ckeditor1" class="form-control" rows="7" style="resize: none" >{{$blog->content}}</textarea>
                          </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Hình Ảnh Blog</label>
                            <input 
                                type="file" 
                                class="form-control-file" 
                                name="image" 
                            >
                            <img src="{{ asset('public/uploads/blog/'.$blog->image) }}" height="160" width="150">
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1">Danh Mục Blog</label>
                            <br>
                            @foreach($danhmuc as $key=>$muc)
                                <div class="form-check-inline mt-2">
                                    <input
                                    @if( $thuocdanhmuc->contains($muc->id) ) 
                                            checked 
                                        @endif
                                        name="danhmuc[]" type="checkbox" id="danhmuc_{{ $muc->id }}" value="{{ $muc->id }}">
                                    <label class="form-check-label" for="danhmuc_{{$muc->id }}">{{ $muc->tendanhmuc }}</label>
                                </div>
                            @endforeach
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Tag Bài Viết</label>
                            <br>
                            <input 
                                type="text" 
                                class="form-control" 
                                name="tagbaiviet"  
                                value="{{$blog->tagbaiviet == 0 ? "" : $blog->tagbaiviet}}"
                                aria-describedby="emailHelp"
                                placeholder="Tag Bài Viết"
                                data-role="tagsinput"
                                >
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1">Blog nổi bật/hot:</label>
                            <select class="custom-select" name="blognoibat">
                                @if ($blog->blog_noibat==0)
                                    <option selected value="0">Blog mới</option>
                                    <option value="1">Blog nổi bật</option>
                                @elseif($blog->blog_noibat==1)
                                    <option value="0">Blog mới</option>
                                    <option selected value="1">Blog nổi bật</option>
                                @endif
                            </select>
                        </div>
                        
                        <br>
                        <button name="themblog" type="submit" class="btn btn-primary">Cập Nhật Blog</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
