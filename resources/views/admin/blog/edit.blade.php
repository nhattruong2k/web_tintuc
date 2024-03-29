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
                            <input 
                            type="hidden" 
                            class="form-control" 
                            name="author" 
                            value="{{$blog->author}}" 
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
                            <select name="danhmuc[]" class="custom-select edit_select_cate" id="blog_id" data-blog="{{$blog->id}}">
                                <option value="0">Danh mục cha</option>
                                @foreach($danhmuc as $muc)
                                    <option 
                                    @if($thuocdanhmuc->contains($muc->id))
                                        selected
                                    @endif
                                    value="{{ $muc->id }}">{{$muc->tendanhmuc}}</option>
                                @endforeach
                            </select>
                            <div id="edit_cate_parent" class="mt-3"></div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1">Chọn khu vực</label>
                            <select class="custom-select select_province" name="blog_province">
                                <option value="0">Chọn khu vực</option>
                                @foreach($blog_province as $key=>$blog_provinces)
                                    <option 
                                        @if($blog_provinceId == $blog_provinces->id)
                                            selected
                                        @endif
                                    value="{{$blog_provinces->id}}">{{$blog_provinces->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div id="slug_province" style="display:none"></div>
                        
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Tag Bài Viết</label>
                            <br>
                            <input 
                                type="text" 
                                class="form-control" 
                                name="tagbaiviet"  
                                value="{{$blog->tagbaiviet == null ? "" : $blog->tagbaiviet}}"
                                aria-describedby="emailHelp"
                                placeholder="Tag Bài Viết"
                                data-role="tagsinput"
                                >
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1">Blog nổi bật/hot :</label>
                            <select class="custom-select" name="blog_noibat">
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
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>    
<script>
    $(document).ready(function() {
       cate_child();
       slug_province();
       $('select.edit_select_cate').change(function() {
            cate_child();
       });
       $('select.select_province').change(function(){
            slug_province();
       });

       function cate_child(){
            var blog_id = $('#blog_id').data('blog');
            var cate_id = $('select.edit_select_cate').children("option:selected").val();
            var _token = $("input[name=_token]").val();
            var _url = "{{route('edit_cate_blog')}}";
            $.ajax({
                   type: "post",    
                   dataType: "json",
                   url: _url,
                   data: {
                        blog_id: blog_id,
                        cate_id: cate_id, 
                        _token:_token
                   },
                   success: function(data){
                       $('#edit_cate_parent').html(data);
                   }
           });
       }

       function slug_province(){
            var province_id = $('select.select_province').children("option:selected").val();
            var _token = $("input[name=_token]").val();
            var _url = "{{route('edit_blogProvince')}}";
            $.ajax({
                    type: "post",    
                    dataType: "json",
                    url: _url,
                    data: {
                        province_id: province_id, 
                        _token:_token
                    },
                    success: function(data){
                        $('#slug_province').html(data)
                    }
            });
        }
   })
</script>