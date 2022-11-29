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
                                    <tr>
                                        <td scope="row"><span class="d-flex justify-content-center">{{ $key }}</span></td>
                                        <td scope="row"><span class="d-flex justify-content-center">{{ $notification->email }}</span></td>  
                                        <td scope="row"><span class="d-flex justify-content-center">{{ $notification->title }}</span></td>
                                        <td scope="row"><span class="d-flex justify-content-center">{{ $notification->content }}</span></td>
                                        @role('admin|blogger')
                                        <td scope="row">
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <form action="{{ route('deletenotification.destroy',[$notification->id]) }}" method="POST" style="margin-left: 27px">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button onclick="return confirm('Bạn chắc chắn xóa danh mục này không')" class="btn btn-danger">Xóa</button>
                                                    </form>
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
