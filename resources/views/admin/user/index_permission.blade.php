@extends('layouts.index')
@section('content')
        <div class="row justify-content-center">
            <div class="card card-danger">
                <div class="card-header">
                <h3 class="card-title">Thêm vai trò</h3>
                </div>
                <div class="card-body">
                <div class="row">
                        <div class="col-8">
                            <input type="text" id="text_role" class="form-control" placeholder="Thêm vai trò">
                        </div>
                        <div class="col-4">
                            <button class="btn btn-outline-danger" id="extra_role" type="submit">Thêm</button>
                        </div>
                </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8" style="margin-top:5px">
            <div class="card">
                <div class="card-header">Liệt Kê User_Permission</div>
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
                            <th scope="col"> <span class="d-flex justify-content-center">#</span></th>
                            <th scope="col">
                                <span class="d-flex justify-content-center">Vai trò</span>
                            </th>
                            <th scope="col" style="width:265px">
                                <span class="d-flex justify-content-center">Quản Lý</span>
                            </th>
                          </tr>
                        </thead>
                      @foreach($role as $key=>$r)
                        <tr class="tr_{{$r->id}}">
                            <th scope="row"><span class="d-flex justify-content-center">{{ $key }}</span></th>
                            <td scope="row">
                              <h5><span class=" d-flex justify-content-center" style="">{{$r->name}}</span></h5>
                            </td>
                            <td scope="row" align="center">
                                <a href="{{route('phanquyen', $r->id)}}" class="btn btn-outline-info">Phân quyền</a>
                                <a id="dele_role" data-id="{{$r->id}}" class="btn btn-outline-danger delete_role">Xóa Vai Trò</a>
                            </td>
                          </tr>
                      @endforeach
                      </table>                      
                </div>
            </div>
            </div>
        </div>
@endsection

<style>
    .div-none{
        display: none !important;
    }
    th.sorting_1 {
    display: flex;
    justify-content: center;
}
</style>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
{!! Toastr::message() !!}
<script>
    $(document).ready(function(){
        $('.delete_role').on('click', function(){
            var id = $(this).data('id');
            var _urlDeleteRole = '{{route("delete_role", ":id")}}';
            _urlDeleteRole = _urlDeleteRole.replace(":id", id);
            var _token = "{{csrf_token() }}";
            Swal.fire({
                title: 'Bạn có muốn xóa vai trò ?',
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
                        type: "POST",    
                        url: _urlDeleteRole,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(res){
                            Swal.fire(
                                'Xóa!',
                                'Vai trò đã bị xóa.',
                                'thành công'
                            );
                            const myTimeout = setTimeout(delete_role, 1500);
                            function delete_role(){
                                $('.tr_'+id).addClass('div-none');
                            }
                        }
                    });
                   
                }
            })
        })
    })
</script>
<script>
    $(document).ready(function(){
        $('#extra_role').on('click', function(){
            // event.preventDefault();
            var text_role = $('#text_role').val();
            var _urlExtraRole = "{{route('extra_role')}}";
            var _token = "{{csrf_token() }}";
            $.ajax({
                type: "POST",    
                url: _urlExtraRole, 
                data: {
                    text_role:text_role,
                    _token:_token,
                },
                success: function(res){
                    location.reload();
                }
            })
        })
    })
</script>