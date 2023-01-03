@extends('layouts.index')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
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
                            <th scope="col" style="width:50px"><span class="d-flex justify-content-center">#</span></th>
                            <th scope="col" style="width:230px"><span class="d-flex justify-content-center">Email</span></th>
                            <th scope="col" style="width:230px"><span class="d-flex justify-content-center">Tiêu đề</span></th>
                            <th scope="col" style="width:578px"><span class="d-flex justify-content-center">Nội dung</span></th>
                            @role('admin|blogger')
                            <th scope="col" style="width:125px"><span class="d-flex justify-content-center">Quản lý</span></th>
                            @endrole
                        </tr>
                        </thead>
                        <tbody> 
                            @foreach ( $notifications as $key=>$notification )
                                    <tr class="noti_{{$notification->id}}">
                                        <td scope="row"><span class="d-flex justify-content-center">{{ $key }}</span></td>
                                        <td scope="row"><span class="d-flex justify-content-center">{{ $notification->email }}</span></td>  
                                        <td scope="row"><span class="d-flex justify-content-center">{{ $notification->title }}</span></td>
                                        <td scope="row"><span class="d-flex justify-content-center">{{ $notification->content }}</span></td>
                                        @role('admin|blogger')
                                        <td scope="row">
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                        <button class="btn btn-danger dele_noti" data-id="{{$notification->id}}">Xóa</button>
                                                </li>
                                            </ul>
                                        </td>
                                        @endrole
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
        $('.dele_noti').on('click', function(){
            var id = $(this).data('id');
            var _urlDeleteNoti = '{{route("deletenotification.destroy", ":id")}}';
            _urlDeleteNoti = _urlDeleteNoti.replace(":id", id);
            var _token = "{{csrf_token() }}";
            Swal.fire({
                title: 'Bạn có muốn xóa bài viết này ?',
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
                        url: _urlDeleteNoti,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(res){
                            Swal.fire(
                                'Xóa!',
                                'Bài viết đã bị xóa.',
                                'thành công'
                            );
                            const myTimeout = setTimeout(delete_role, 1500);
                            function delete_role(){
                                $('.noti_'+id).addClass('div-none');
                            }
                        }
                    });
                   
                }
            })
        })
    })
</script>
