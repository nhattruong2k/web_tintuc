@extends('../layout')

@section('content')
    @include('pages.navbar')
@endsection

@section('updateDetails')
<div class="hero-area height-400 bg-img background-overlay" style="background-image: url('{{asset('img/blog-img/istockphoto.jpg')}}')">
    <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="single-blog-title text-center">
                    <h3>Thông tin cá nhân</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
 <div class="app">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Cập nhật thông tin cá nhân</div>
                    {{-- Hiển thị thông báo --}}
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
                            <div class="alert alert-success" role="alert" id="demo" >
                                <script>
                                    const myTimeout = setTimeout(myGreeting, 3000);
                                    function myGreeting() {
                                    $("#demo").addClass('d-none');
                                    }
                                </script>
                                {{ session('success') }}
                            </div>
                        @endif
                        {{-- Lưu danh mục --}}
                        <form method="POST" action="{{ route('storeProfile')}}" enctype="multipart/form-data"> 
                            @csrf   
                            <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Name <span class="hoathi">*</span></label>
                            <input 
                                type="text" 
                                class="form-control" 
                                name="name" 
                                value="{{ $user->name}}" 
                                aria-describedby="emailHelp"
                                placeholder="Tên Name"
                                >
                            </div>
                            <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nink Name</label>
                            <input 
                                type="text" 
                                class="form-control" 
                                name="ninkname" 
                                value="{{$user->ninkname == null ? '' : $user->ninkname}}"
                                aria-describedby="emailHelp"
                                placeholder="Tên Nink Name"
                                >
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email <span class="hoathi">*</span></label>
                                <input 
                                type="email" 
                                class="form-control" 
                                name="email" 
                                value="{{ $user->email }}" 
                                aria-describedby="emailHelp"
                                placeholder="Email address"
                                >
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Phone</label>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    name="phone" 
                                    value="{{$user->phone == null ? '' : $user->phone}}"
                                    aria-describedby="emailHelp"
                                    placeholder="số điện thoại"
                                    >
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-check-inline">Giới tính </label>
                                    <div class="form-check-inline">
                                            <label for="genderM" class="form-check-label">
                                            <input id="genderM" value="Nam" type="radio" 
                                                    class="form-check-input" 
                                                    name="gender"
                                                    {{$user->gender == 'Nam' ? 'checked' : ''}}>
                                            Nam</label>
                                    </div>
                                    <div class="form-check-inline">
                                            <label for="genderF" class="form-check-label">
                                            <input id="genderF" value="Nữ" type="radio" 
                                                    class="form-check-input" 
                                                    name="gender"
                                                    {{$user->gender == 'Nữ' ? 'checked' : ''}}>
                                            Nữ</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Ngày sinh <span class="hoathi">*</span></label>
                                <input type="text" id="datepicks"
                                        class="form-control" 
                                        placeholder="ngày sinh"
                                        name="birth_date" value="{{$user->birth_date}}"
                                        >
                                </div>
                            <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Ảnh đại diện <span class="hoathi">*</span></label>
                            <br>
                            <img class="img-thumbnail" src="{{ asset('public/uploads/user/'.$user->avatar) }}" height="200" width="200">
                            <br>
                            <div class="mt-3">
                                <input 
                                    type="file" 
                                    class="img-thumbnail" 
                                    name="image" 
                                >
                            </div>
                            </div>
                            <div class="mb-3">
                                <location-selector :address="{{json_encode($userAddress)}}"></location-selector>
                            </div>
                            <button name="themuser" type="submit" class="btn btn-primary">Cập Nhật User</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
     </div>
    <br>
    
@endsection
