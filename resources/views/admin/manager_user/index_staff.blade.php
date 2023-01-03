@extends('layouts.index')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11" style="margin-top:30px">
            <div class="card">
                <div class="card-header">Liệt Kê User</div>

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
                            <th scope="col" style="width:58px"><span class="d-flex justify-content-center">Hình ảnh</span></th>
                            <th scope="col"><span class="d-flex justify-content-center">Tên User</span></th>
                            <th scope="col"><span class="d-flex justify-content-center">Nick Name</span></th>
                            <th scope="col"><span class="d-flex justify-content-center">Email</span></th>
                            <th scope="col"><span class="d-flex justify-content-center">Số điện thoại</span></th>
                            <th scope="col"><span class="d-flex justify-content-center">Quản Lý</span></th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($user as $key=>$u)
                                <tr class="trStaff_{{$u->id}}">
                                    <th scope="row"><span class="d-flex justify-content-center">{{ $key }}</span></th>
                                    <td scope="row"><img class="d-flex justify-content-center" src="{{ asset('public/uploads/user/'.$u->avatar) }}" style="height:70px; width:74px; border-radius:50%"></td>
                                    <td scope="row"><span class="d-flex justify-content-center">{{ $u->name }}</span></td>
                                    <td scope="row"><span class="d-flex justify-content-center">{{ $u->ninkname }}</span></td>
                                    <td scope="row"><span class="d-flex justify-content-center">{{ $u->email }}</span></td>
                                    <td scope="row"><span class="d-flex justify-content-center">{{ $u->phone }}</span></td>
                                    <td scope="row">
                                        <ul class="list-inline">
                                            <!-- Show view -->
                                            <li class="list-inline-item">
                                                <a href="{{ route('manager_user.show',[$u->id]) }}" class="btn btn-primary btn-sm" style="background-color:rgb(63, 189, 28)">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </a>
                                            </li>
                                            <!-- Edit -->
                                            <li class="list-inline-item">
                                                <a href="{{ route('manager_user.edit',[$u->id]) }}" class="btn btn-primary btn-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                </svg>
                                                </a>
                                            </li>
                                            <!-- Reset password -->
                                            <li class="list-inline-item">
                                                <a href="{{ route('showPassword', [$u->id]) }}" class="btn btn-primary btn-sm" style="background-color:rgb(48, 119, 174)">
                                                <i class="fa fa-key" aria-hidden="true"></i>
                                                </a>
                                            </li>
                                            @role('admin')
                                            <li class="list-inline-item">
                                                <a href="{{url('phan-vaitro/'.$u->id)}}" class="btn btn-outline-secondary btn-sm " style="background-color:rgb(247, 186, 5); ">
                                                    <i class="fa fa-cog" aria-hidden="true" style="color:white"></i>
                                                </a>
                                            </li>  
                                            @endrole
                                            <!-- Delete -->
                                            <li class="list-inline-item">
                                                <a class="btn btn-danger btn-sm dele_staff" data-id="{{$u->id}}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                                    </svg>                                                
                                                </a>
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
<style>
    .div-none{
        display: none !important;
    }
</style>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function(){
        $('.dele_staff').on('click', function(){
            var id = $(this).data('id');
            var _urlDeleteStaff = '{{route("manager_user.destroy", ":id")}}';
            _urlDeleteStaff = _urlDeleteStaff.replace(":id", id);
            var _token = "{{csrf_token() }}";
            Swal.fire({
                title: 'Bạn có muốn xóa thành viên ?',
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
                        url: _urlDeleteStaff,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(res){
                            Swal.fire(
                                'Xóa!',
                                'Thành viên đã bị xóa.',
                                'thành công'
                            );
                            const myTimeout = setTimeout(delete_role, 1500);
                            function delete_role(){
                                $('.trStaff_'+id).addClass('div-none');
                            }
                        }
                    });
                   
                }
            })
        })
    })
</script>