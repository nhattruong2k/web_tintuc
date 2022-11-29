@extends('layouts.index')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9" style="margin-top:80px">
                <div class="card">
                    <div class="card-header"><h5>Vai trò : {{$role->name}}</h5></div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        {{-- Lưu danh mục --}}
                        <div style="margin-left:73px">
                            <div class="row">
                                <div class="col-7">
                                    <div>
                                        <label for="exampleInputEmail1" class="form-label">Thêm Tên Quyền: </label>
                                      </div>
                                        <form class="form-inline" method="POST" action="{{ route('axtra_permission') }}">
                                        @csrf
                                         <br> 
                                            <input 
                                            type="text" 
                                            class="form-control" 
                                            name="permission" 
                                            value="{{ old('permission') }}" 
                                            aria-describedby="emailHelp"
                                            placeholder="Tên quyền"
                                            > 
                                            <button class="btn btn-outline-secondary mb-2" type="submit" style="height:39px; top:29px; margin-top: 7px;">Thêm</button>
                                        </form>
                                </div>
                                <div class="col-5">
                                    <div>
                                        <form action="{{ url('/insert_permission',[$role->id]) }}" method="POST">
                                            @csrf
                                            <label for="exampleInputEmail1" class="form-label">Permission</label>
                                            @foreach ($permission as $key=>$per )
                                            <div class="form-check">
                                                <div class="row">
                                                    <input class="form-check-input" type="checkbox"  
                                                        @foreach ($get_permission_via_role as $key=> $get )
                                                            @if ($per->id == $get->id)  
                                                                checked
                                                            @endif
                                                        @endforeach
                                                        name="permission[]" 
                                                        value="{{ $per->id }}" 
                                                        id="{{ $per->id }}"
                                                    >
                                                    <label class="form-check-label" for="{{ $per->id }}">
                                                        {{ $per->name }}
                                                    </label>
                                                </div>
                                            </div>
                                            @endforeach
                                            <br>
                                                <input type="submit" name="insertroles" value="Cấp quyền cho user" class="btn btn-danger" style="margin-left: 113px; margin-bottom: -17px">
                                        </form>
                                    </div>
                                </div>
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