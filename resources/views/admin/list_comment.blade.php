@extends('layouts.index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Liệt kê bình luận</div>

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
                            <th scope="col" style="width:74px"><span class="d-flex justify-content-center">Tên người dùng</span></th>
                            <th scope="col" style="width:133px"><span class="d-flex justify-content-center">Nội dung bình luận</span></th>
                            <th scope="col" style="width:104px"><span class="d-flex justify-content-center">Tên bài viết</span></th>
                            <th scope="col" style="width:75px"><span class="d-flex justify-content-center">Kích hoạt</span></th>  
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($list_comment as $key=>$list_com)
                            <tr>
                                <td scope="row">{{ $key }}</td>
                                <td scope="row">{{$list_com->user->name}}</td>
                                <td scope="row">{{$list_com->comment_body}}</td>
                                <td scope="row">{{$list_com->baiviet->tenblog}}</td>
                                <td scope="row">
                                    <select name="kichhoat" class="selectKichhoat" data-id="{{$list_com->id}}">
                                        <option {{$list_com->kichhoat==0 ? 'selected' : ''}} value="0">Kích hoạt</option>
                                        <option  {{$list_com->kichhoat==1 ? 'selected' : ''}} value="1">Không kích hoạt</option>
                                    </select>
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
        $('.selectKichhoat').change(function() {
        var kichhoat = $(this).val();
        var comment_id = $(this).data('id');
        var _urlComment = "{{route('comment.update')}}"
        var _token = "{{csrf_token() }}"
        // console.log(kichhoat, comment_id, _token, _urlComment);
            $.ajax({
                    type: "post",    
                    dataType: "json",
                    url: _urlComment,
                    data: {
                        kichhoat: kichhoat, 
                        comment_id: comment_id, 
                        _token:_token
                    },
                    success: function(data){
                      console.log(data.success)
                    }
            });
        })
    })
    </script>