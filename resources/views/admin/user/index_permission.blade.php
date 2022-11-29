@extends('layouts.index')
@section('content')
        <div class="row justify-content-center">
            <div class="col-md-10" style="margin-top:5px">
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
                            <th scope="col">
                                <span class="d-flex justify-content-center">Quản Lý</span>
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($role as $key=>$r)
                            <tr>
                                <th scope="row"><span class="d-flex justify-content-center">{{ $key }}</span></th>
                                <td scope="row">
                                  <h5><span class=" d-flex justify-content-center" style="">{{$r->name}}</span></h5>
                                </td>
                                <td scope="row" align="center">
                                    <a href="{{route('phanquyen', $r->id)}}" class="btn btn-outline-info">Phân quyền</a>
                                </td>
                             </tr>
                            @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
            </div>
        </div>
@endsection
<style>
    th.sorting_1 {
    display: flex;
    justify-content: center;
}
</style>