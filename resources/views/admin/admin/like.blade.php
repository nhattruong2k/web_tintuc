@extends('layouts.index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Xem lượt thích</div>

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
                            <th scope="col" style=" width: 30px;"><span class="d-flex justify-content-center">#</span></th>
                            <th scope="col" style="width: 86px;"><span class="d-flex justify-content-center">Số lượt thích</span></th>
                            <th scope="col" style="width: 215px;"><span class="d-flex justify-content-center">Người dùng</span></th>
                            <th scope="col"><span class="d-flex justify-content-center">Tên bài viết</span></th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($like as $key=>$likes)
                            <tr>
                                <td scope="row"><span class="d-flex justify-content-center">{{ $key }}</span></td>
                                <td scope="row"><span class="d-flex justify-content-center">{{$likes->like}}</span></td>
                                <td scope="row"><span class="d-flex justify-content-center">{{$likes->user->name}}</span></td>
                                <td scope="row">{{$likes->blog->tenblog}}</td>
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