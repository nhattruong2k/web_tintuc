@extends('layouts.index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Thêm Blooger</div>
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
                    {{-- Lưu danh mục --}}
                    <form method="POST" action="{{ route('blog.store') }}" enctype="multipart/form-data"> 
                        @csrf   
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Tên Blog *</label>
                          <input 
                            type="text" 
                            class="form-control" 
                            name="tenblog" 
                            value="{{ old('tenblog') }}" 
                            onkeyup="ChangeToSlug();"
                            id="slug" 
                            aria-describedby="emailHelp"
                            placeholder="Tên Blog *"
                            >
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Slug Blog *</label>
                            <input 
                                type="text" 
                                class="form-control" 
                                name="slug_blog" 
                                value="{{ old('slug_blog') }}"
                                id="convert_slug" 
                                aria-describedby="emailHelp"
                                placeholder="Slug Blog *"
                                >
                        </div>
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Tác Giả *</label>
                          <input 
                            type="hidden" 
                            class="form-control" 
                            name="user_id"
                            value="{{ Auth::user()->id }}" 
                            placeholder="{{Auth::user()->name}}"
                            >
                            <input 
                            type="hidden" 
                            class="form-control" 
                            name="author"
                            value="{{ Auth::user()->name }}" 
                            placeholder="{{Auth::user()->name}}"
                            >
                            <div class="p-2 border" value="">{{Auth::user()->name}}</div>
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Tóm Tắt Blog *</label>
                            <textarea name="tomtat" value="{{old('tomtat')}}" class="form-control" rows="5" style="resize: none" placeholder="Tóm Tắt Blog *"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nội Dung Blog *</label>
                            <textarea name="content" value="{{old('content')}}" id="ckeditor1" class="form-control" rows="7" style="resize: none" placeholder="Nội dung Blog *"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Hình Ảnh Blog *</label>
                            <input type="file" class="form-control-file" name="image" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1 mt-2">Danh Mục Blog *</label><br>
                            <select name="danhmuc[]" class="custom-select select_cate">
                                <option value="">Danh mục cha</option>
                                @foreach($danhmuc as $muc)
                                    <option value="{{ $muc->id }}">{{$muc->tendanhmuc}}</option>
                                @endforeach
                            </select>
                            <input type="hidden" name="_token" value="{{ csrf_token()}}">  
                           <br>
                            <div id="cate_parent" class="mt-3"></div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1">Chọn khu vực</label>
                            <select class="custom-select select_province" name="blog_province" >
                                <option value="0">Chọn khu vực</option>
                                @foreach($blog_province as $key=>$blog_provinces)
                                    <option value="{{$blog_provinces->id}}">{{$blog_provinces->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div id="province" style="display:none"></div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Tag Bài Viết</label>
                            <br>
                            <input 
                                type="text" 
                                class="form-control" 
                                name="tagbaiviet"  
                                value="{{ old('tagbaiviet') }}" 
                                aria-describedby="emailHelp"
                                placeholder="Tag Bài Viết"
                                data-role="tagsinput"
                                >
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1">Blog nổi bật/hot *</label>
                            <select class="custom-select" name="blog_noibat">
                                <option value="0">Blog mới</option>
                                <option value="1">Blog hot</option>
                            </select>
                        </div>
                        <button name="themblog" type="submit" class="btn btn-primary">Thêm Blog</button>
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
        $('select.select_cate').change(function() {
            var cate_id = $(this).children("option:selected").val();
            var _token = $("input[name=_token]").val();
            var _url = "{{route('cate_blog')}}";
            $.ajax({
                    type: "post",    
                    dataType: "json",
                    url: _url,
                    data: {
                        cate_id: cate_id, 
                        _token:_token
                    },
                    success: function(data){
                        $('#cate_parent').html(data);
                    }
            });
        })
        $('select.select_province').change(function(){
            var province_id = $(this).children("option:selected").val();
            var _token = $("input[name=_token]").val();
            var _url = "{{route('blog.blog_province')}}";
            $.ajax({
                    type: "post",    
                    dataType: "json",
                    url: _url,
                    data: {
                        province_id: province_id, 
                        _token:_token
                    },
                    success: function(data){
                        $('#province').html(data)
                    }
            });
        })
    })
</script>