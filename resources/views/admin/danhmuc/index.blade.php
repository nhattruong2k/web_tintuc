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
                     <div class="dt-buttons"> 
                        <div class="row">
                            <div class="col-4" style="max-width: 23.333333%;">
                                <form action="{{url('import-csv')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <label for="user-file">
                                        <div class="btn sbold green"> 
                                            <i class="fa fa-download" aria-hidden="true"></i> Excel
                                        </div>
                                        <input id="user-file" type="file" name="file" style="display:none" class="hidden" accept=".xlsx, .xls, .csv, .ods">
                                    </label>
                                <button type="submit" value="Import Excel" name="import_csv" class="button button2">Nhập Excel</button>        
                                </form>
                            </div>
                            <div class="col-8">
                                <form action="{{url('export-csv')}}" method="POST">
                                    @csrf
                                 <input type="submit" value="Xuất Excel" name="export_csv" class="button button2">
                                </form>
                            </div>
                        </div>
                     </div>
              
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
                                <tr class="cate_{{$danhmuc->id}}">
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
                                                <button class="btn btn-danger delete_category" data-id="{{$danhmuc->id}}"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
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
<style type="text/css">
    .button{
     background-color: #4dc1bdfc;
    border: none;
    color: white;
    padding: 5px 25px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    -webkit-transition-duration: 0.4s;
    transition-duration: 0.4s;
    border-radius: 50px
    }
    .button2:hover {
        box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
        }

    .div-none{
        display: none !important;
    }
</style>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
    });

    $(document).ready(function(){
        $('.delete_category').on('click', function(){
            var id = $(this).data('id');
            var _urlDeleteCategory = '{{route("danhmuc.destroy", ":id")}}';
            _urlDeleteCategory = _urlDeleteCategory.replace(":id", id);
            // alert(_urlDeleteCategory);
            var _token = "{{csrf_token() }}";
            Swal.fire({
                title: 'Bạn có muốn xóa danh mục ?',
                text: "",
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Đồng ý',
                cancelButtonText: 'Đóng'
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",    
                        url: _urlDeleteCategory,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(res){
                            Swal.fire(
                                'Xóa!',
                                'Danh mục đã bị xóa.',
                                'thành công'
                            );
                            const myTimeout = setTimeout(delete_role, 1500);
                            function delete_role(){
                                $('.cate_'+id).addClass('div-none');
                            }
                        }
                    });
                   
                }
            })
        })
    })
    </script>