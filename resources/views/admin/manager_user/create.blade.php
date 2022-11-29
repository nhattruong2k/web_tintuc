@extends('layouts.index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Thêm Nhân Viên</div>
                <div class="card-body">
                    @if (session('success'))
                            <div class="alert alert-success" role="alert" id="demo" >
                        <script>
                            const myTimeout = setTimeout(myGreeting, 5000);
                            function myGreeting() {
                               $("#demo").addClass('d-none');
                            }
                        </script>
                         {{ session('success') }}
                        </div>
                     @endif
                    <form method="POST" action="{{ route('manager_user.store') }}" enctype="multipart/form-data"> 
                        @csrf   
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Tên User <span class="hoathi">*</span></label>
                          <input 
                            type="text" 
                            class="form-control" 
                            name="name" 
                            {{-- old nó sẽ giữ tên user đã có --}}
                            value="{{ old('name') }}" 
                            aria-describedby="emailHelp"
                            placeholder="Tên user"
                            >
                            @if($errors->has('name'))
                                <div class="bar error">{{$errors->first('name')}}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Nink Name <span class="hoathi">*</span></label>
                          <input 
                            type="text" 
                            class="form-control" 
                            name="ninkname" 
                            {{-- old nó sẽ giữ tên user đã có --}}
                            value="{{ old('ninkname') }}" 
                            aria-describedby="emailHelp"
                            placeholder="Nink name"
                            >
                            @if($errors->has('ninkname'))
                                <div class="bar error">{{$errors->first('ninkname')}}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email <span class="hoathi">*</span></label>
                            <input 
                                type="text" 
                                class="form-control" 
                                name="email" 
                                value="{{ old('email') }}"
                                aria-describedby="emailHelp"
                                placeholder="Email user"
                                >
                                @if($errors->has('email'))
                                    <div class="bar error">{{$errors->first('email')}}</div>
                                @endif
                        </div>
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Số điện thoại <span class="hoathi">*</span></label>
                          <input 
                            type="number" 
                            class="form-control" 
                            name="phone" 
                            value="{{ old('phone') }}" 
                            aria-describedby="emailHelp"
                            placeholder="Số điện thoại"
                            >
                            @if($errors->has('phone'))
                                <div class="bar error">{{$errors->first('phone')}}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="gender" class="form-label">Giới tính <span class="hoathi">*</span></label>
                            <div class="form-check form-check-inline" style="right:-8px">
                                <input type="radio" name="gender" value="Nam" id="genderM" class="form-check-input"
                                        value="{{old('gender') == 'Male' ? 'checked' : ''}}}" checked>
                                <label for="genderM" class="form-check-label">Nam</label>
                            </div>

                                <div class="form-check form-check-inline" style="right:-8px">
                                    <input type="radio" name="gender" value="Nu" id="genderF" class="form-check-input"
                                            value="{{old('gender') == 'Female' ? 'checked' : ''}}}">
                                    <label for="genderF" class="form-check-label">Nữ</label>
                                </div>
                        </div>

                        <div class="mb-3">
                          <label for="birth_date" type="text" class="form-label">Ngày sinh <span class="hoathi">*</span></label>
                          <input 
                            type="text" id="datepicker" id="dob"
                            class="form-control datepicker" 
                            name="birth_date" 
                            {{-- old nó sẽ giữ tên user đã có --}}
                            value="{{ old('birth_date') }}" 
                            aria-describedby="emailHelp"
                            placeholder="Ngày sinh"
                            >
                            @if($errors->has('birth_date'))
                                <div class="bar error">{{$errors->first('birth_date')}}</div>
                            @endif
                        </div>

                        <div class="mb-4">
                          <label for="avatar" class="form-label">Hình ảnh <span class="hoathi">*</span></label>
                          <br>
                          <img class="img-thumbnail" src="{{ asset('public/uploads/user/default-avatar.jpg') }}" height="110" width="120">
                          <div class="mt-3" >
                            <input 
                                type="file" id="avatar" 
                                class="form-control datepicker"  placeholder="Avatar"
                                name="avatar" accept="image/jpeg, image/gif, image/png"
                                onchange="chooseFile(this)"
                                >
                          </div>
                            @if($errors->has('avatar'))
                                <div class="bar error">{{$errors->first('avatar')}}</div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Mật khẩu <span class="hoathi">*</span></label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <input 
                                  type="password" 
                                  id="new-password"
                                  class="form-control" 
                                  name="password" 
                                  value="{{ old('password') }}" 
                                  aria-describedby="emailHelp"
                                  placeholder="Password user"
                                  >
                              </div>
                              <span class="input-group-text" id="basic-addon1"><i onclick="myfunctionx()" class="fa fa-eye" aria-hidden="true"></i></span>
                            </div>
                            @if($errors->has('password'))
                                    <div class="bar error">{{$errors->first('password')}}</div>
                                  @endif
                            <script type="application/javascript">
                                    var s = true;
                                    function myfunctionx(){
                                        if(s){
                                            document.getElementById("new-password").type = "text";
                                            s = false;
                                        }else{
                                            document.getElementById("new-password").type = "password";
                                            s = true;
                                        }
                                    }
                                </script> 
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Vai trò <span class="hoathi">*</span></label>
                            <select class="form-control" name="role">    
                                @foreach($role as $key=>$r)
                                    <option value="{{$r->name}}">{{$r->name}}</option>
                                @endforeach
                            </select>
                        </div> 
                        <div class="mb-3">
                            <location-selector :address="{{json_encode($userAddress)}}"></location-selector>
                        </div>
                        <a href="{{ URL::previous() }}" class="btn btn-outline-primary">Quay lại</a>
                        <button type="submit" name="themuser" class="btn btn-primary">Thêm User</button>
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
<script>    
     function chooseFile(fileInput){
        if(fileInput.files && fileInput.files[0]){
            var reader = new FileReader();

            reader.onload = function(e){
                $('.img-thumbnail').attr('src', e.target.result);
            };
            reader.readAsDataURL(fileInput.files[0]);
        }
     }
</script>