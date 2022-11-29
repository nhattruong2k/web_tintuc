@extends('layouts.app')
@section('content')

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
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                     @endif
                    {{-- Lưu danh mục --}}
                    <form method="POST" action="{{ route('user.update', [$user->id])}}" enctype="multipart/form-data"> 
                        @method('PUT')
                        @csrf   
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Name</label>
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
                            value="{{ $user->ninkname}}"
                            aria-describedby="emailHelp"
                            placeholder="Tên Nink Name"
                            >
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email</label>
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
                                value="{{ $user->phone}}" 
                                aria-describedby="emailHelp"
                                placeholder="Telephone"
                                >
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-check-inline">Giới tính</label>
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
                            <label for="exampleInputEmail1" class="form-label">Ngày sinh</label>
                            <input type="text" id="datepicker" 
                                       class="form-control datepicker" 
                                       name="birth_date"
                                       value="{{$user->birth_date}}">
                            </div>
                        <div class="mb-3">
                        <img class="img-thumbnail" src="{{ asset('public/uploads/user/'.$user->avatar) }}" height="200" width="180">
                        <br>
                            <label for="exampleInputEmail1" class="form-label">Ảnh đại diện</label>
                            <input 
                                type="file" 
                                class="img-thumbnail" 
                                name="image" 
                            >
                            <br>
                        </div>
                        <div class="mb-3">
                        <!-- <div class="form-group">
                            <span>Tỉnh thành:</span>
                            <select name="province" class="form-control custom-select">
                            <option value="">Tỉnh thành</option>
                            @foreach($province_all as $province_alls)
                                <option value="{{ $province_alls->id }}" 
                                @if($province_alls->id == $user->province_id) 
                                    selected
                                @endif
                                >{{ $province_alls->name }}</option>
                            @endforeach
                            </select>
                        </div> -->

                        <div class="form-group">
                            <span>Tỉnh thành:</span>
                            <select name="province_id" class="form-control custom-select">
                            <option value="">Tỉnh thành</option>

                            @foreach($province_all as $province_alls)
                                <option value="{{ $province_alls->id }}"
                                @if($province_alls->id == $user->province_id) 
                                    selected
                                @endif
                                    >{{ $province_alls->name }}
                                </option>
                            @endforeach

                            </select>
                        </div>

                        <div class="form-group">
                            <span>Quận/huyện:</span>
                            <select name="district_id" class="form-control custom-select">
                            <option value="">Quận/huyện</option>
                            @foreach($district_all as $district_alls)
                                <option value="{{ $district_alls->id }}" 
                                @if($district_alls->id == $user->district_id) 
                                    selected
                                @endif
                                >{{ $district_alls->name }}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <span>Phường/xã:</span>
                            <select name="ward_id" class="form-control custom-select">
                            <option value="">Phường/xã</option>
                            @foreach($ward_all as $ward_alls)
                                <option value="{{ $ward_alls->id }}" 
                                @if($ward_alls->id == $user->ward_id) 
                                    selected
                                @endif
                                >{{ $ward_alls->name }}</option>
                            @endforeach
                            </select>
                        </div>
                        </div>
                        <br>
                        <button name="themuser" type="submit" class="btn btn-primary">Cập Nhật User</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
