@extends('../layout')

@section('content')
    @include('pages.navbar')
@endsection

@section('blog')
<div class="hero-area height-600 bg-img background-overlay" style="background-image: url('{{ asset('public/uploads/blog/'.$baiviet->image)}}');">
    <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="single-blog-title text-center">
                    <!-- Catagory -->
                    <h3>{{$baiviet->tenblog}}</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="main-content-wrapper section-padding-100" data-blog="{{$baiviet->id}}" id="btn_view">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="single-blog-content mb-100">
                    <!-- Post Meta -->
                    <div class="post-meta">
                        <p><a href="{{route('tacgia',['slug'=>$baiviet->tacgia_slug])}}" class="post-author">{{$baiviet->user->name}}</a> on <a href="#" class="post-date">{{date('d-m-Y', strtotime($baiviet->created_at));}}</a></p>
                    </div>
                    <!-- Post Content -->
                    <h3>{{$baiviet->tenblog}}</h3>
                    <br>
                    <div class="post-content">
                        <h3>{!! $baiviet->content!!}</h3>
                        <style type="text/css">
                            h3 {
                                font-family: Helvetica	;
                            }
                            h3 a{
                                color:#8d8d8d;
                                text-decoration: none;
                            }
                        </style>
                        <!-- Post Tags -->
                        <ul class="post-tags">
                            <label for=""><i class="fa fa-tag"></i></label>
                            @php
                                $tags = $baiviet->tagbaiviet;
                                $tag =explode(",", $tags);
                            @endphp
                            @foreach($tag as $baiviets)
                                @if($baiviets == 0 || $baiviets == NULL )
                                    <li><a>Chưa có tags</a></li>
                                @else
                                    <li><a href="{{route('tagbaiviet',str_slug($baiviets))}}">{{$baiviets}}</a></li>
                                @endif
                            @endforeach
                        </ul>
                        <style type="text/css">
                            label{
                                font-size: 20px;
                            }
                        </style>
                        <!-- Post Meta -->
                        <div class="post-meta second-part">
                            <p><a href="{{route('tacgia',['slug'=>$baiviet->tacgia_slug])}}" class="post-author">{{$baiviet->user->name}}</a> on <a href="#" class="post-date">{{date('d-m-Y', strtotime($baiviet->created_at));}}</a></p>
                        </div>
                        @if(Auth::check())
                            <small class="float-right" style="margin-top:-25px;margin-right: -6px;">
                                {{-- <a href="#" class="like" class="btn btn-primary">{{$like}} Thích</a> |
                                <a href="#" class="like">{{$dislike}} Không thích</a> --}}
                                @php
                                    $result = DB::table('like_dislikes')->where('user_id', Auth::user()->id)->where('blog_id',$baiviet->id)->count();
                                @endphp
                                <button class="like_btn button_like" data-blogid="{{$baiviet->id}}" >
                                        <span id="icon" class="iconlike">{!! $result > 0 ? '<i class="fa fa-heart" aria-hidden="true"></i>':'<i class="fa fa-heart-o" aria-hidden="true"></i>' !!} </span>
                                        <span id="count" class="like"> {{$like}} </span> Like
                                    </button>
                            </small>
                        @else
                        <small class="float-right" style="margin-top:-25px;margin-right: -6px;">
                            {{-- <form action="{{route('like',$baiviet->id)}}" method="GET" > --}}
                                <button class="like_btn button_like" data-toggle="modal" data-target="#exampleModal1">
                                    <span id="icon" >{!! $like_count > 0 ? '<i class="fa fa-heart" aria-hidden="true"></i>':'<i class="fa fa-heart-o" aria-hidden="true"></i>' !!} </span>
                                    <span id="count" > {{$like}} </span> Like
                                </button>
                            {{-- </form> --}}
                         </small>
                        @endif
                        <style>
                            #likedislike:hover{
                                background: rgb(221, 230, 244);
                                color: blue;
                                text-decoration: none;
                                /* margin: 0px 0px 0px 0px; */
                                padding: 10px;
                            }
                            @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@600&display=swap');
                            .like_btn{
                                padding: 10px 15px;
                                background:#0080ff;
                                font-size: 18px;
                                font-family: 'Open Sans', sans-serif;
                                border:none;
                                outline: none;
                                color: #e8efff;
                                border-radius: 5px;
                                cursor: pointer; 
                            }
                        </style>
                    </div>
                </div>
            </div>
            @include('pages.sidebar')
        </div>
        
    <!-- ============== Related Post ============== -->
    <h4>Các bài viết liên quan</h4>
        <div class="row">
            @foreach($cungdanhmuc as $danh)
                @foreach($danh->nhieublog as $nhieubaiviet)
                @if($nhieubaiviet->id != $baiviet->id)
                @if(Auth::user())
                <input type="hidden" value="{{$nhieubaiviet->tenblog}}" class="wishlist_tenblog_{{$nhieubaiviet->id}}">
                <input type="hidden" value="{{Auth::user()->name}}" class="wishlist_auth_{{$nhieubaiviet->id}}">
                <input type="hidden" value="{{$nhieubaiviet->tomtat}}" class="wishlist_tomtat_{{$nhieubaiviet->id}}">
                <input type="hidden" value="{{route('bai_viet',$nhieubaiviet->slug_blog)}}" class="wishlist_url_{{$nhieubaiviet->id}}">
                <input type="hidden" value="{{$nhieubaiviet->user->name}}" class="wishlist_tacgia_{{$nhieubaiviet->id}}">
                <input type="hidden" value="{{route('tacgia',['slug'=>$nhieubaiviet->tacgia_slug])}}" class="wishlist_tacgia_url_{{$nhieubaiviet->id}}">
                <input type="hidden" value="{{date('d-m-Y', strtotime($nhieubaiviet->created_at));}}" class="wishlist_created_{{$nhieubaiviet->id}}">
                <input type="hidden" value=" {{$nhieubaiviet->views}}" class="wishlist_view_{{$nhieubaiviet->id}}">
                <div class="col-12 col-md-6 col-lg-4">
                    <!-- Single Blog Post -->
                    <div class="single-blog-post">
                        <!-- Post Thumbnail -->
                        <div class="post-thumbnail">
                            <a data-id="{{$nhieubaiviet->id}}" class="btn-blog" href="{{route('bai_viet',$nhieubaiviet->slug_blog)}}" class="headline">
                                <img src="{{asset('public/uploads/blog/'.$nhieubaiviet->image)}}" style="height:385px" alt=""  class="btn-blog wishlist_image_{{$nhieubaiviet->id}}">
                            </a>
                            <div class="post-cta">
                                @foreach($nhieubaiviet->thuocnhieudanhmucblog as $thuocdanh)
                                    <a href="{{route('category',$thuocdanh->slug_danhmuc)}}" style="text-decoration: none;">{{ $thuocdanh->tendanhmuc }}</a>
                                @endforeach
                            </div>
                        </div>
                        <!-- Post Content -->
                        <div class="post-content">
                            <a data-id="{{$nhieubaiviet->id}}" class="btn-blog" href="{{route('bai_viet',$nhieubaiviet->slug_blog)}}" class="headline" style="color: inherit; text-decoration: none; position: relative;">
                                <h5>{{$nhieubaiviet->tenblog}}</h5>
                            </a>
                            <p>{{$nhieubaiviet->tomtat}}</p>
                            <!-- Post Meta -->
                            <div class="post-meta">
                                <p><a href="{{route('tacgia',['slug'=>$nhieubaiviet->tacgia_slug])}}" class="post-author">{{$nhieubaiviet->user->name}}</a> on <a href="#" class="post-date">{{$nhieubaiviet->created_at}}</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="col-12 col-md-6 col-lg-4">
                    <!-- Single Blog Post -->
                    <div class="single-blog-post">
                        <!-- Post Thumbnail -->
                        <div class="post-thumbnail">
                            <a class="btn-blog" href="{{route('bai_viet',$nhieubaiviet->slug_blog)}}" class="headline">
                                <img src="{{asset('public/uploads/blog/'.$nhieubaiviet->image)}}" style="height:385px" alt="" >
                            </a>
                            <div class="post-cta">
                                @foreach($nhieubaiviet->thuocnhieudanhmucblog as $thuocdanh)
                                    <a href="{{route('category',$thuocdanh->slug_danhmuc)}}" style="text-decoration: none;">{{ $thuocdanh->tendanhmuc }}</a>
                                @endforeach
                            </div>
                        </div>
                        <!-- Post Content -->
                        <div class="post-content">
                            <a href="{{route('bai_viet',$nhieubaiviet->slug_blog)}}" class="headline" style="color: inherit; text-decoration: none; position: relative;">
                                <h5>{{$nhieubaiviet->tenblog}}</h5>
                            </a>
                            <p>{{$nhieubaiviet->tomtat}}</p>
                            <!-- Post Meta -->
                            <div class="post-meta">
                                <p><a href="{{route('tacgia',['slug'=>$nhieubaiviet->tacgia_slug])}}" class="post-author">{{$nhieubaiviet->user->name}}</a> on <a href="#" class="post-date">{{$nhieubaiviet->created_at}}</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @endif
                @endforeach
            @endforeach
        </div>

            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="post-a-comment-area mt-70">
                        <h5>Ý kiến ({{$countComments}})</h5>
                        <!-- Contact Form -->
                    @if(Auth::check())
                        <form action="#" method="POST">
                            {{-- @csrf --}}
                            <div class="row">
                                <div class="col-12">
                                    <div class="group">
                                        {{-- Input ẩn --}}
                                        <input type="hidden" class="blog_id" value="{{$baiviet->id}}" name="blog_id">
                                        <textarea name="comment_body" id="comment_body" placeholder="Nhập ý kiến của bạn (*)"></textarea>
                                        <br>
                                        <h6 id="comment-error" class="help-blog" style="color:red"></h6>
                                    </div>
                                </div>
                                <div style="margin-bottom: -38px;margin-left: 16px;">
                                    <h5>
                                    <img src="{{ asset('public/uploads/user/'.auth()->user()->avatar) }}" style="width: 50px; border-radius: 50%;}">
                                    <span style="padding: 11px;">{{Auth::user()->name}}</span>    
                                    </h5>
                                </div>
                                <div class="col-12" >
                                    <button type="submit" class="btn world-btn" id="btn-comment">Gửi ý kiến</button>
                                </div>
                            </div>
                        </form>
                        @else
                            <div class="row">
                                <div class="col-12">
                                    <div class="group" data-toggle="modal" data-target="#exampleModal1">
                                        {{-- Input ẩn --}}
                                        <input type="hidden" value="{{$baiviet->id}}" name="blog_id">
                                        <textarea name="comment_body" required="required"></textarea>
                                        <span class="highlight"></span>
                                        <label>Ý kiến của bạn</label>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    @if(Auth::user())
                        <div id="comment">
                            @include('pages.list-comment')
                        </div>
                    @endif
                </div>
            </div>
        </div>          
    </div>    
    </div>
</div>
</div>
</div>

{{-- Modal boostrap --}}

  <!-- Modal -->
  <div class="modal fade bd-example-modal-lg" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Đăng nhập ngay</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-6" style="border-right: 1px solid rgb(193, 187, 187)">
                    <div id="error"></div>
                    <form action="" method="post" role="form">
                        <div>
                            <span class="d-flex justify-content-center"><h6>Đăng nhập với email</h6></span>
                        </div>
                       <div class="form-group" style="bo">
                            <input style="border-radius: 20px;" type="email" name="email" class="form-control" id="email" placeholder="điền vào email">
                       </div>
                       <div class="form-group">
                            <input style="border-radius: 20px;" type="password" name="password"  class="form-control" id="password" placeholder="điền vào mật khẩu">
                        </div>
                         <div class="form-group">
                            <button style="border-radius: 20px;"type="button" class="btn btn-primary btn-block" id="btn-login">Đăng nhập</button>
                        </div>
                    </form>
                </div>
                <div class="col-6">
                    <div id="error_register"></div>
                    <form role="form" method="POST" action="">
                        <input type="hidden" name="_token" value="">
                        <div>
                            <span class="d-flex justify-content-center"><h6>Đăng ký với email</h6></span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="text"  class="form-control input-lg" name="name" id="name" value="" style="border-radius: 20px;" placeholder="điền vào tên">
                            </div>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="text"  class="form-control input-lg" name="nickname" id="nickname" value="" style="border-radius: 20px;" placeholder="điền vào nickname">
                            </div>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="email" class="form-control input-lg" name="email" id="emai1" value="" style="border-radius: 20px;" placeholder="điền vào email">
                            </div>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="password" class="form-control input-lg"  name="password" id="password1" style="border-radius: 20px;" placeholder="điền vào mật khẩu">  
                            </div>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="number" class="form-control input-lg"  name="phone" id="phone" style="border-radius: 20px;" placeholder="điền vào số điện thoại">  
                            </div>
                        </div>
                        <div class="form-group">
                            <button style="border-radius: 20px;"type="button" class="btn btn-danger btn-block" id="btn-register">Đăng ký</button>                    
                        </div>
                    </form>
                </div>
            </div>
            <hr>
            <div>
                <span class="d-flex justify-content-center"><h6>Đăng nhập bằng mạng xã hội</h6></span>
            </div>
                <div class="form-group">
                    <form action="{{ route('redirectGoogle') }}" method="get">
                    <button style="border-radius: 20px; width: 332px; margin: 0 auto;display: block;"type="submit" class="btn btn-block btn-danger"> 
                        <i class="fa fa-google-plus" aria-hidden="true"></i> Đăng nhập bằng Google+
                    </button>
                </form>
                </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts_blog')

<script>

    $('#btn-comment').click(function(event) {
        event.preventDefault();
        var comment_body =  $('#comment_body').val();
        var _urlComment = "{{route('comment.binhluan',$baiviet->id)}}";
        var _token = "{{csrf_token() }}";
        // console.log(comment_body,comment_blog_id,_urlComment,_token);
        $.ajax({
            type: "POST",    
            url: _urlComment,
            data: {
                comment_body:comment_body,
                _token:_token,
            },
            success: function(res){
            if(res.error){
                $('#comment-error').html(res.error);
            }else{
                $('#comment-error').html('');
                $('#comment_body').val('');
                $('#comment').html(res);
                // console.log(res);    
                }
            }
        });
})
    // Bắt click để lấy id theo comment cha
    $(document).on('click', '.btn-show-reply', function(event){
        event.preventDefault();
        var id = $(this).data('id');
        var comment_reply_id = '#content-reply-' + id;
        var commentReply =  $(comment_reply_id).val();
        var form_reply = '.form-reply-' + id; 
        // alert(form_reply);
        $('.fromRepled').slideUp();
        $(form_reply).slideDown();
    })
    $(document).on('click', '.btn-send-comment-reply', function(event){
        event.preventDefault();
        var id = $(this).data('id');
        var comment_reply_id = '#content-reply-' + id;
        var commentReply =  $(comment_reply_id).val();  
        var form_reply = '.form-reply-' + id; 
        var _urlComment = "{{route('comment.binhluan',$baiviet->id)}}";
        var _token = "{{csrf_token() }}";

        $.ajax({
            type: "POST",    
            url: _urlComment,
            data: {
                comment_body:commentReply,
                reply_id:id,
                _token:_token,
            },
            success: function(res){
            if(res.error){
                $('#comment-reply-error-' + id).html(res.error);
            }else{
                $('#comment-reply-error-' + id).html('');
                $('#comment_body').val('');
                $('#comment').html(res);
                // console.log(res);    
                }
            }
        });
    })
</script>

{{-- Login --}}
<script>
    $('#btn-login').on('click', function(event){
        event.preventDefault();
        var email = $('#email').val();
        var _loginUrl = "{{route('comment.login')}}";
        var _token = "{{csrf_token() }}";
        var password = $('#password').val();
        $.ajax({
            type: "POST",    
            dataType: "json",
            url: _loginUrl,
            data: {
                email:email,
                password:password,
                _token:_token,
            },
            success: function(result){
                if(result.error){
                    let _html_error = '<div class="alert alert-danger"><button href="#" class="close" data-dismiss="alert" aria-label="close">&times;</button>'
                    for(let error of result.error){
                        _html_error += `<li>${error}</li>`;
                    }
                    _html_error += '</div>';
                    $('#error').html(_html_error);
                }else{
                    location.reload();
                    alert('Bạn đã đang nhập thành công');
                }
            }
        });
    });
</script>
{{-- Register --}}
<script>
    $('#btn-register').on('click', function(event){
        event.preventDefault();
        var name = $('#name').val();
        var nickname = $('#nickname').val();
        var email= $('#emai1').val();
        var password = $('#password1').val();
        var phone = $('#phone').val();
        var _registerUrl = "{{route('comment.register')}}";
        var _token = "{{csrf_token() }}";
        // console.log(name,nickname ,email, password,phone ,_registerUrl, _token);
        $.ajax({
            type: "POST",    
            dataType: "json",
            url: _registerUrl,
            data: {
                name:name,
                nickname:nickname,
                email:email,
                password:password,
                phone:phone,
                _token:_token,
            },
            success:function(res){
                if(res.error){
                    let _html_error = '<div class="alert alert-danger"><button href="#" class="close" data-dismiss="alert" aria-label="close">&times;</button>'
                    for(let error of res.error){
                        _html_error += `<li>${error}</li>`;
                    }
                    _html_error += '</div>';
                    $('#error_register').html(_html_error);
                }else{
                    location.reload();
                    alert('Bạn đã đang nhập thành công');
                }
            }
        })
    })
</script>
{{-- Like --}}
<script>
    $('.like_btn').on('click', function(){
        var blogId = $(this).data('blogid');
        $.ajax({
            type:"POST",    
            dataType: "json",
            url: "{{route('save.likeDislike')}}",
            data:{
                blogId: blogId,
                _token:"{{ csrf_token() }}"
            },
            success : function (result){
               $('#count').html(result);
               if(result > 0){
                   $('.iconlike').html('<i class="fa fa-heart" aria-hidden="true"></i>');  
               }else{
                $('.iconlike').html('<i class="fa fa-heart-o" aria-hidden="true"></i>'); 
               }
            }
        })
        
    })

</script>
<script>
    $(document).ready(function(){
        var view_count = $('#btn_view').data('blog');
        var _urlView = "{{route('view')}}"
        var _token = "{{csrf_token() }}";
        setTimeout(function(){
            $.ajax({
            type:"POST",    
            dataType: "json",
            url: _urlView ,
            data:{
                blog_id: view_count,
                _token:_token
            },
        })
        }, 5000);
    })
</script>
<style>
        .world-btn {
        position: relative;
        z-index: 1;
        padding: 0 25px;
        width: auto;
        height: 35px;
        border: 1px solid;
        border-color: #d7d7d7;
        font-size: 14px;
        border-radius: 50px;
        line-height: 32px;
    }
</style>
@endsection