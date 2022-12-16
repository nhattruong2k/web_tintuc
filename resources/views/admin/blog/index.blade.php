@extends('layouts.index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-16">
            <div class="card">
                <div class="card-header">Liệt Kê Blog</div>
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
                            <th scope="col" style="width:2px">#</th>
                            <th scope="col" style="width:90px"><span class="d-flex justify-content-center">Tên Blog</span></th>
                            <th scope="col" style="width:74px"><span class="d-flex justify-content-center">Hình Ảnh</span></th>
                            <th scope="col" style="width:100px"><span class="d-flex justify-content-center">Tóm Tắt</span></th>
                            <th scope="col" style="width:105px"><span class="d-flex justify-content-center">Nội Dung</span></th>
                            <th scope="col" style="width:75px"><span class="d-flex justify-content-center">Lượt Xem</span></th>
                            <th scope="col" style="width:75px"><span class="d-flex justify-content-center">Danh Mục</span></th>
                            @role('admin|publisher')
                                <th scope="col" style="width:133px">
                                    <span class="d-flex justify-content-center">Kích Hoạt</span>
                                </th>
                            @endrole
                            @role('writer|editer|deleter|blogger|admin')
                                <th scope="col" style="width: 100px;">
                                    <span class="d-flex justify-content-center">Quản lý</span>
                                </th> 
                            @endrole    
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($list_blog as $key=>$blog)
                            <tr>
                                <td scope="row">{{ $key }}</td>
                                <td scope="row">{{ $blog->tenblog}}</td>
                                <td scope="row"><img src="{{ asset('public/uploads/blog/'.$blog->image) }}" style="height:97px; width:89px;"></td>
                                <td scope="row"><span class="d-flex justify-content-center"><p>{!! Str::limit(($blog->tomtat),50, '...') !!}</p></span></td>
                                <td scope="row">
                                <span class="d-flex justify-content-center">
                                    <p>{!! Str::limit(($blog->content),145, '...') !!}</p>
                                </span>
                                    <button class="btn btn-link mt-1 detail-btn" data-toggle="modal" data-target="#myModal" data-id="{{ $blog->id }}">Xem thêm</button>
                                    <div class="modal fade bd-example-modal-lg" tabindex="-1" id="myModal">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 id="blog-tenblog"></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p id="blog-content"></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                </td>

                                <td scope="row"><span class="d-flex justify-content-center">{{ $blog->views}}</span></td>

                                <td scope="row">
                                    @foreach($blog->thuocnhieudanhmucblog as $thuocdanh )
                                    <h6><span class="badge bg-secondary d-flex justify-content-center">{{$thuocdanh->tendanhmuc}}</span></h6>    
                                    @endforeach
                                </td>   
                                @role('admin|publisher')
                                    <td scope="row">
                                        <select class="custom-select" id="selectKichhoat" name="kichhoat" data-id="{{$blog->id}}" >  
                                            <option  {{$blog->kichhoat==1 ? 'selected' : ''}} value="1">Kích hoạt</option>
                                            <option {{$blog->kichhoat==0 ? 'selected' : ''}} value="0">Không kích hoạt</option>
                                        </select> 
                                        <input type="hidden" name="_token" value="{{ csrf_token()}}">  
                                    </td>
                                @endrole
                                @role('writer|editer|deleter|blogger|admin')
                                <td scope="row">
                                    <ul class="list-inline m-0">
                                        <li class="list-inline-item">
                                            <a href="{{ route('blog.show',[$blog->id]) }}" class="btn btn-primary btn-sm" style="background-color:rgb(63, 189, 28)">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                                <a href="{{ route('blog.edit',[$blog->id]) }}" class="btn btn-primary btn-sm">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                </a>
                                        </li>
                    
                                        <li class="list-inline-item">
                                            <form action="{{ route('blog.destroy',[$blog->id]) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button onclick="return confirm('Bạn chắc chắn xóa blog này không')" class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                </button>
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
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>    
<script>
    $(document).ready(function() {
        $('.custom-select').change(function() {
        var kichhoat = $(this).val();
        var blog_id = $(this).data('id');
        var _token = $("input[name=_token]").val();

            $.ajax({
                    type: "post",    
                    dataType: "json",
                    url: '/kichhoat',
                    data: {kichhoat: kichhoat, blog_id: blog_id, _token:_token},
                    success: function(data){
                      console.log(data.success)
                    }
            });
        })
    })
    </script>
