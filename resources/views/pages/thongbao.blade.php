@extends('../layout')

@section('content')
    @include('pages.navbar')
@endsection

@section('thongbao')
<div class="hero-area height-400 bg-img background-overlay" style="background-image: url('{{asset('img/blog-img/tag.jpg')}}')"></div>

<div class="main-content-wrapper section-padding-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Thông báo cho quản trị</div>
                    {{-- Hiển thị thông báo --}}
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                         @endif
                        {{-- Lưu danh mục --}}
                        <form action="{{ route('insert_noti') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Email: </label>
                                <input name="email" type="text" class="form-control" placeholder="Email">
                            </div>
                            @if($errors->has('email'))
                                <div class="bar error">{{$errors->first('email')}}</div>
                            @endif
                            <div class="form-group">
                                <label>Tiêu đề: </label>
                                <input name="title" type="text" class="form-control" placeholder="Tiêu đề">
                            </div>
                            @if($errors->has('title'))
                                <div class="bar error">{{$errors->first('title')}}</div>
                            @endif
                            <div class="form-group">
                                <label>Nội dung: </label>
                                <textarea name="content" value="{{old('content')}}" class="form-control" rows="7" style="resize: none" placeholder="Nội dung Thông báo"></textarea>
                            </div>
                            @if($errors->has('content'))
                                <div class="bar error">{{$errors->first('content')}}</div>
                            @endif
                            <br>
                            <button type="submit" class="btn btn-primary">Thêm</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
