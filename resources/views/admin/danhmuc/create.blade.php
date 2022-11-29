@extends('layouts.index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Thêm danh mục tin tức</div>
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
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <form method="POST" action="{{route('danhmuc.store')}}"  enctype='multipart/form-data'>
                        @csrf
                      <div class="form-group">
                        <label for="exampleInputEmail1">Tên danh mục</label>
                        <input type="text" class="form-control" value="{{old('tendanhmuc')}}" onkeyup="ChangeToSlug();" name="tendanhmuc" id="slug" aria-describedby="emailHelp" placeholder="Tên danh mục... *">
                        @if($errors->has('tendanhmuc'))
                              <div class="bar error">{{$errors->first('tendanhmuc')}}</div>
                        @endif
                      </div>
                      <!-- <div class="form-group">
                        <label for="exampleInputEmail1">Từ khóa</label>
                        <input type="text" class="form-control" value="{{old('tukhoa')}}" name="tukhoa"  aria-describedby="emailHelp" placeholder="">
                        
                      </div> -->
                      <div class="form-group">
                        <label for="exampleInputEmail1">Slug danh mục</label>
                        <input type="text" class="form-control" value="{{old('slug_danhmuc')}}" name="slug_danhmuc" id="convert_slug" aria-describedby="emailHelp" placeholder="Tên danh mục... *">
                        @if($errors->has('slug_danhmuc'))
                              <div class="bar error">{{$errors->first('slug_danhmuc')}}</div>
                        @endif
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Mô tả danh mục</label>
                        <input type="text" class="form-control" value="{{old('motadanhmuc')}}" name="motadanhmuc" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Mô tả danh mục *">
                        @if($errors->has('motadanhmuc'))
                              <div class="bar error">{{$errors->first('motadanhmuc')}}</div>
                        @endif
                      </div>

                      <div class="form-group">
                        <label for="category">Danh mục cha</label>
                        <select name="parent_id" class="form-control" id="category">
                            <option value="0"> Danh Mục Cha</option>
                                @foreach($categories as $category)
                                    @include('admin.danhmuc.child_category', 
                                    [
                                        'category'=>$category,
                                        'text'=>'',
                                        ])
                                @endforeach
                        </select>
                      </div>
                      @if($errors->has('parent_id'))
                              <div class="bar error">{{$errors->first('parent_id')}}</div>
                        @endif
                        <br>
                      <button type="submit" name="themdanhmuc" class="btn btn-primary">Thêm</button>
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