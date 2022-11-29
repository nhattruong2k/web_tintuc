@extends('layouts.index')

@section('content')

<div class="card">
    <div class="container">
        <div class="row  justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                    <a href="{{ URL::previous() }}" class="btn btn-outline-primary">Quay lại</a>
                    <h4 class="row justify-content-center">Xem chi tiết user</h4>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-md-3">
                                <label for="">Hình ảnh</label>
                                <div class="p-2">
                                    <img class="img-thumbnail" src="{{ asset('public/uploads/user/'.$user->avatar) }}" height="200" width="180">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="">Tên User</label>
                                <div class="p-2 border">{{$user->name}}</div>
                                <br>
                                <label for="">Nink name</label>
                                <div class="p-2 border">{{$user->ninkname}}</div>
                                <br>
                                <label for="">Email</label>
                                <div class="p-2 border">{{$user->email}}</div>
                            </div> 
                            <div class="col-md-3">
                            <label for="">Số điện thoại</label>
                                <div class="p-2 border">{{$user->phone}}</div>
                                <br>
                                <label for="">Ngày sinh</label>
                                <div class="p-2 border">{{$user->birth_date}}</div>
                                <br>
                                <label for="">Giới tính</label>
                                <div class="p-2 border">{{$user->gender}}</div>
                            </div>
                            <div class="col-md-3">
                                <label for="">Tỉnh thành</label>
                                <div class="p-2 border">
                                @if($user->province_id == null)
                                    
                                @else
                                    {{$user->province->name}}
                                @endif
                                </div>
                                <br>
                                <label for="">Quận/huyện</label>
                                <div class="p-2 border">
                                    @if($user->district_id == null)
                                    
                                    @else
                                        {{$user->district->name}}
                                    @endif
                                </div>
                                <br>
                                <label for="">Phường/xã</label>
                                <div class="p-2 border">
                                    @if($user->ward_id == null)
                                    @else
                                        {{ $user->ward->name}}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style type="text/css">
    .border{
        height: 40px;
    }
</style>