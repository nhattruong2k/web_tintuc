@extends('../layout')

@section('content')
    @include('pages.navbar')
@endsection

@section('thembaiviet')
<div class="hero-area height-500 bg-img background-overlay" style="background-image: url('{{asset('img/blog-img/baiviet.jpg')}}')">
    <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="single-blog-title text-center">
                    <!-- Catagory -->
                    <h3>Thêm bài viết mới</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Thêm Bài Viết</div>
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
                    <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data"> 
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
                            <label for="exampleInputEmail1" class="form-label">Tag Bài Viết: </label>
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
                        <style>
                            .bootstrap-tagsinput .tag {
                                margin-right: 2px;
                                color: white;
                                background-color: #5bc0de;
                            }
                            .label {
                                display: inline;
                                padding: 0.2em 0.6em 0.3em;
                                font-size: 75%;
                                font-weight: 700;
                                line-height: 1;
                                color: #fff;
                                text-align: center;
                                white-space: nowrap;
                                vertical-align: baseline;
                                border-radius: 0.25em;
                            }
                        </style>
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
    <br>
</div>
@endsection
@section('scripts_blog')

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>    

<script>
     $(document).ready(function() {
        $('select.select_cate').change(function() {
            var cate_id = $(this).children("option:selected").val();
            var _token = $("input[name=_token]").val();
            var _url = "{{route('post.cate_blog')}}";
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
    })
</script>
@endsection