@extends('layouts.index')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Cập Nhật Danh Mục</div>
                {{-- Hiển thị thông báo --}}
                <!-- @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif -->
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                     @endif
                    {{-- Lưu danh mục --}}
                    <form method="POST" action="{{ route('danhmuc.update', [$danhmuctintuc->id]) }}"> 
                        @method('PUT')
                        @csrf   
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Tên Danh Mục</label>
                          <input 
                            type="text" 
                            class="form-control" 
                            name="tendanhmuc" 
                            onkeyup="ChangeToSlug();"
                            id="slug" 
                            aria-describedby="emailHelp"
                            value="{{ $danhmuctintuc->tendanhmuc }}"
                            placeholder="Tên"
                            >
                            @if($errors->has('tendanhmuc'))
                                <div class="bar error">{{$errors->first('tendanhmuc')}}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Slug Danh Mục</label>
                            <input 
                                type="text" 
                                class="form-control" 
                                name="slug_danhmuc" 
                                {{-- old nó sẽ giữ mô tả danh mục đã có --}}
                                value="{{ $danhmuctintuc->slug_danhmuc }}"
                                id="convert_slug" 
                                aria-describedby="emailHelp"
                                placeholder="Slug danh mục"
                                >
                                @if($errors->has('slug_danhmuc'))
                                    <div class="bar error">{{$errors->first('slug_danhmuc')}}</div>
                                @endif
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Mô Tả Danh Mục</label>
                            <input 
                                type="text" 
                                class="form-control" 
                                name="motadanhmuc" 
                                id="exampleInputEmail1" 
                                aria-describedby="emailHelp"
                                value="{{ $danhmuctintuc->motadanhmuc }} "
                                placeholder="Mô tả"
                            >
                            @if($errors->has('motadanhmuc'))
                                <div class="bar error">{{$errors->first('motadanhmuc')}}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="category">Danh mục cha</label>
                            <select name="parent_id" class="form-control" id="category" >
                                <option value="0">Danh Mục Cha</option>
                                @foreach($danhmuc as $parent_danhmucs)
                                    @include('admin.danhmuc.edit_category', 
                                    [
                                        'danhmuctintuc'=>$danhmuctintuc,
                                        'parent_danhmucs'=>$parent_danhmucs,
                                        'text'=>'',
                                    ])
                                @endforeach
                            </select>
                            @if($errors->has('parent_id'))
                                <div class="bar error">{{$errors->first('parent_id')}}</div>
                            @endif
                        </div>  
                        <br>
                        <a href="{{ URL::previous() }}" class="btn btn-outline-primary">Quay lại</a>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<style type="text/css">
    .bar {
    padding: 10px;
    margin: 10px;
    color: #333;
    background: #fafafa;
    border: 1px solid #ccc;
    }
    .error {
    color: #ba3939;
    background: #ffe0e0;
    border: 1px solid #a33a3a;
    }

</style>