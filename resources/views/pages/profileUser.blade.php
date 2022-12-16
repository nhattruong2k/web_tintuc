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
                            <button  data-toggle="modal" data-target="#exampleModal4" type="button" class="btn btn-danger">Xóa tài khoản</button>
                            <div class="modal fade" id="exampleModal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel4" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel4"><span style="margin: 0px 93px;">Bạn muốn xóa tài khoản ?</span></h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      <p style="padding-left: 15px;margin-left: 10px; color:black">Người dùng khác vẫn có thể thấy ý kiến và lượt thích của bạn.</p>
                                      <p style="padding-left: 15px;margin-left: 10px; color:black">Tất cả tin đã lưu và lịch sử đọc sẽ bị xóa.</p>
                                      <h6 style="padding-left: 15px;margin-left: 10px;">Để xoá tài khoản bạn cần xác nhận bằng mật khẩu</h6>
                                      <div class="input-group" style="margin: 0px 90px;" >
                                        <div class="input-group-prepend">
                                            <input style="border-radius: 20px; display:none" type="email" name="email" class="form-control" id="email" placeholder="điền vào email" value="{{Auth::user()->email}}">
                                            <input id="password" type="password" class="form-control" name="password" placeholder="Nhập lại mật khẩu cũ" required>
                                        </div>
                                        <span class="input-group-text" id="basic-addon1"><i onclick="myfunctionss()" class="fa fa-eye" aria-hidden="true"></i></span>
                                    </div>
                             
                                    </div>
                                    <div class="modal-footer">
                                    <a id="btn-deleUser" type="button" style="width: 100%;margin: 0 20px 0 0;isplay: block;border-radius: 3px;height: 48px;line-height:40px;text-align: center;cursor: pointer;border: none;font-size: 15px;color: #fff;font-weight: bold;" class="btn btn-danger deleUser" >Xóa</a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
     </div>
    <br>
@endsection

@section('scripts_blog')
<script type="text/javascript">
    var n = true;
    function myfunctionss(){
        if(n){
            document.getElementById("password").type = "text";
            n = false;
        }else{
            document.getElementById("password").type = "password";
            n = true;
        }
    }
</script>

<script>
    $('#btn-deleUser').on('click', function(event){
        event.preventDefault();
        var _loginUrl = "{{route('dele_account')}}";
        var _token = "{{csrf_token() }}";
        var email = $('#email').val();
        var password = $('#password').val();
        $.ajax({
            type: "POST",    
            dataType: "json",
            url: _loginUrl,
            data: {
                email:email,
                password:password,
                _token:_token,
            },
            success: function(res){
                window.location.href="/home-new" ;
            }
        });
    });
</script>
@endsection