@extends('layouts.index')
@section('content')
<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <span>Cập nhật user</span>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                     @endif
                    {{-- Lưu danh mục --}}
                    <form method="POST" action="{{ route('manager_user.update', [$user->id])}}" enctype="multipart/form-data"> 
                        @method('PUT')
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
                        @if($errors->has('name'))
                            <div class="bar error">{{$errors->first('name')}}</div>
                        @endif
                        </div>
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Nink Name</label>
                          <input 
                            type="text" 
                            class="form-control" 
                            name="ninkname" 
                            value="{{ $user->ninkname}}"
                            aria-describedby="emailHelp"
                            placeholder="Tên Nink Name"
                            >
                            @if($errors->has('ninkname'))
                                <div class="bar error">{{$errors->first('ninkname')}}</div>
                            @endif
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
                              @if($errors->has('email'))
                                <div class="bar error">{{$errors->first('email')}}</div>
                              @endif
                          </div>
                          <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Số điện thoại</label>
                            <input 
                                type="text" 
                                class="form-control" 
                                name="phone" 
                                value="{{ $user->phone}}" 
                                aria-describedby="emailHelp"
                                placeholder="Số điện thoại"
                                >
                                @if($errors->has('phone'))
                                    <div class="bar error">{{$errors->first('phone')}}</div>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-check-inline">Giới tính <span class="hoathi">*</span></label>
                                <div class="form-check-inline">
                                        <label for="genderM" class="form-check-label">
                                        <input 
                                        id="genderM" value="Nam" type="radio" 
                                                class="form-check-input" 
                                                name="gender"
                                                {{$user->gender == 'Nam' ? 'checked' : ''}}>
                                        Nam</label>
                                </div>
                                <div class="form-check-inline">
                                        <label for="genderF" class="form-check-label">
                                        <input 
                                        id="genderF" value="Nữ" type="radio" 
                                                class="form-check-input" 
                                                name="gender"
                                                {{$user->gender == 'Nữ' ? 'checked' : ''}}>
                                         Nữ</label>
                                </div>
                            </div>
                            <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Ngày sinh <span class="hoathi">*</span></label>
                            <input type="text" id="datepicker" 
                                       class="form-control datepicker" 
                                       name="birth_date"
                                       value="{{$user->birth_date}}"
                                       placeholder="ngày"
                                       >
                                       @if($errors->has('birth_date'))
                                            <div class="bar error">{{$errors->first('birth_date')}}</div>
                                        @endif
                            </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Ảnh đại diện <span class="hoathi">*</span></label>
                            <br>
                            <img class="img-thumbnail" src="{{ asset('public/uploads/user/'.$user->avatar) }}" height="200" width="200">
                            <br>
                            <input 
                                type="file" 
                                class="img-thumbnail" 
                                name="avatar"  
                            >
                            @if($errors->has('avatar'))
                            <div class="bar error">{{$errors->first('avatar')}}</div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <location-selector :address="{{json_encode($userAddress)}}"></location-selector>
                        </div>
                        <br>
                        <a href="{{ URL::previous() }}" class="btn btn-outline-primary">Quay lại</a>
                        <button name="themuser" type="submit" class="btn btn-primary">Cập Nhật User</button>
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