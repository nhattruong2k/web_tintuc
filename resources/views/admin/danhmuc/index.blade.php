@extends('layouts.index')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Liệt kê danh mục
                </div>
                
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
                    <table class="table table-sm table-bordered table-striped">
                        <thead class="table-light">
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col"><span class="d-flex justify-content-center">Tên danh mục</span></th>
                            <th scope="col"><span class="d-flex justify-content-center">Slug danh mục</span></th>
                            <th scope="col">
                                <span class="d-flex justify-content-center">Mô tả</span>
                            </th>
                            <th scope="col"><span class="d-flex justify-content-center">Danh mục cha</span></th>
                            @role('admin|publisher')
                                <th scope="col">
                                    <span class="d-flex justify-content-center">Kích hoạt</span>
                                </th>
                            @endrole
                                <th scope="col" style="width:77px">
                                    <span class="d-flex justify-content-center">Quản lý</span>
                                </th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ( $danhmuctintuc as $key => $danhmuc )
                                <tr>
                                    <th scope="row">{{ $key }}</th>
                                    <td scope="row"><span class="d-flex justify-content-center">{{ $danhmuc->tendanhmuc }}</span></td>
                                    <td scope="row"><span class="d-flex justify-content-center">{{ $danhmuc->slug_danhmuc }}</span></td>
                                    <td scope="row">
                                        <span class="d-flex justify-content-center">
                                            {{ $danhmuc->motadanhmuc }}
                                        </span>
                                    </td>
                                    <td scope="row">
                                        <span class="d-flex justify-content-center">
                                            @foreach($danhmuctintuc as $parent_danhmuc)
                                                @if($parent_danhmuc->id == $danhmuc->parent_id)
                                                    {{ $parent_danhmuc->tendanhmuc}}
                                                @endif
                                            @endforeach
                                        </span>
                                    </td>
                                    @role('admin|publisher')
                                        <td scope="row">
                                                <select class="custom-select" id="selectKichhoat" name="kichhoat" data-id="{{$danhmuc->id}}" >  
                                                    <option {{$danhmuc->kichhoat==1 ? 'selected' : ''}} value="1">Kích hoạt</option>
                                                    <option {{$danhmuc->kichhoat==0 ? 'selected' : ''}} value="0">Không kích hoạt</option>
                                                </select> 
                                            <input type="hidden" name="_token" value="{{ csrf_token()}}">  
                                        </td>
                                     @endrole
                                    <td scope="row">
                                        <ul class="list-inline">
                                            <li class="list-inline-item">                
                                                <a href="{{ route('danhmuc.edit',[$danhmuc->id]) }}" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                            </li>
                                            <li class="list-inline-item">
                                                <form action="{{ route('danhmuc.destroy',[$danhmuc->id]) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button onclick="return confirm('Bạn chắc chắn xóa danh mục này không')" class="btn btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                                </form>
                                          
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>    
<script>
    $(document).ready(function() {
        $('.custom-select').change(function() {
        var kichhoat = $(this).val();
        var danhmuc_id = $(this).data('id');
        var _token = $("input[name=_token]").val();
            $.ajax({
                    type: "post",    
                    dataType: "json",
                    url: '/kichhoatdanhmuc',
                    data: {kichhoat: kichhoat, danhmuc_id: danhmuc_id, _token:_token},
                    success: function(data){
                      console.log(data.success)
                    }
            });
        })
    })
    </script>