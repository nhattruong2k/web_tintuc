@foreach($comment as $com)
{{-- @if($com->blog_id == $baiviet->id) --}}
    <div class="col-12 col-lg-8">
        <!-- Comment Area Start -->
        <div class="comment_area clearfix mt-70">
            <ol>
                <!-- Single Comment Area -->
                <li class="single_comment_area" style="width: 720px;">
                    <!-- Comment Content -->
                    <div class="comment-content">
                        <!-- Comment Meta -->
                        <div class="comment-meta d-flex align-items-center justify-content-between">
                            <p><a href="#" class="post-author" style=" text-decoration: underline; color:burlywood; text-decoration: none;">{{$com->user->name}}</a> on <a href="#" class="post-date" style=" text-decoration: underline; color:burlywood; text-decoration: none;">{{date('d-m-Y', strtotime($com->created_at));}}</a></p>
                            @if(Auth::check())
                            <a href="#" class="comment-reply btn world-btn btn-show-reply" data-id="{{$com->id}}">Trả lời</a>
                            @else
                            <a href="#" class="comment-reply btn world-btn" data-toggle="modal" data-target="#exampleModal1">Trả lời</a>
                            @endif
                        </div>
                        <h6>{{$com->user->name}}</h6>
                        <div style="word-wrap: break-word;">
                            <p>{{ $com->comment_body }}</p>
                        </div>
                        <div class="row">
                            <div class="col">
                                <img style="width: 52px;border-radius: 50%" src="{{ asset('public/uploads/user/'.$com->user->avatar) }}" alt="">
                            </div>
                            <div class="col-10" style="margin-right: 28px;">
                                <div style="margin-top: 36px;">
                                @if(Auth::check())
                                    <form action="" method="POST" style="display:none" class="fromRepled form-reply-{{$com->id}}">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="group">
                                                    {{-- Input ẩn --}}
                                                    <textarea name="comment_body" id="content-reply-{{$com->id}}" ></textarea>
                                                    <br>
                                                    <h6 id="comment-reply-error-{{$com->id}}" class="help-blog" style="color:red"></h6>
                                                    <span class="highlight"></span>
                                                    <label style="color:black">Ý kiến của bạn</label>
                                                </div>
                                            </div>
                                            <div class="col-12" >
                                                <button type="submit" class="btn world-btn btn-send-comment-reply" data-id="{{$com->id}}">Gửi</button>
                                            </div>
                                        </div>
                                    </form>
                                @else
                                <div class="row">
                                    <div class="col-12">
                                        <div class="group" data-toggle="modal" data-target="#exampleModal1">
                                            {{-- Input ẩn --}}
                                            <textarea name="comment_body" id="message"></textarea>
                                            <span class="highlight"></span>
                                            <label>Ý kiến của bạn</label>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                </div>
                            </div>
                        </div>
                        @if($com->replies->count() > 0)
                            <div style="padding: 23px; margin-left: -25px;">
                                <button class="btn btn-outline-primary btn-show-com chatbutton_{{$com->id}}" data-listcom="{{$com->id}}" data-toggle="collapse" href="#collapseExample-{{$com->id}}" aria-expanded="false" aria-controls="collapseExample">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-return-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M1.5 1.5A.5.5 0 0 0 1 2v4.8a2.5 2.5 0 0 0 2.5 2.5h9.793l-3.347 3.346a.5.5 0 0 0 .708.708l4.2-4.2a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 8.3H3.5A1.5 1.5 0 0 1 2 6.8V2a.5.5 0 0 0-.5-.5z"/>
                                    </svg>
                                    xem phản hồi
                                        {{$com->replies->count()}}
                                </button>
                            </div>
                        @endif
                    </div>
                    {{-- Các bình luận con --}}
                    <div class="collapse" id="collapseExample-{{$com->id}}">
                        @foreach($com->replies as $child)
                        <ol class="children">
                            <li class="single_comment_area">
                                <!-- Comment Content -->
                                <div class="comment-content">
                                    <!-- Comment Meta -->
                                    <div class="comment-meta d-flex align-items-center justify-content-between">
                                        <p><a href="#" class="post-author" style=" text-decoration: underline; color:burlywood; text-decoration: none;">{{$child->user->name}}</a> on <a href="#" class="post-date" style=" text-decoration: underline; color:burlywood; text-decoration: none;">{{date('d-m-Y', strtotime($child->created_at));}}</a></p>
                                        @if(Auth::check())
                                        <a href="#" class="comment-reply btn world-btn btn-show-reply" data-id="{{$child->id}}">Trả lời</a>
                                        @else
                                        <a href="#" class="comment-reply btn world-btn" data-toggle="modal" data-target="#exampleModal1">Trả lời</a>
                                        @endif
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            {{-- @if(Auth) --}}
                                            <img style="width: 52px;border-radius: 50%" src="{{ asset('public/uploads/user/'.$child->user->avatar) }}" alt="">
                                        </div>
                                        <div class="col-10" style="margin-right: 28px;">
                                            <h6>{{$child->user->name}}</h6>
                                            <p>{!! $child->comment_body !!}</p>
                                        </div>
                                        <div style="margin: 25px 86px;">
                                            {{-- @if(Auth::check()) --}}
                                            <form action="" method="POST"  style="display:none" class="fromRepled form-reply-{{$child->id}}">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="group">
                                                            {{-- Input ẩn --}}
                                                            <textarea name="comment_body" id="content-reply-{{$child->id}}" style="width: 410px;"></textarea>
                                                            <h6 id="comment-reply-error-{{$child->id}}" class="help-blog" style="color:red"></h6>
                                                            <span class="highlight"></span>
                                                            <label>Ý kiến của bạn</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12" >
                                                        <button type="submit" class="btn world-btn btn-send-comment-reply" data-id="{{$child->id}}">Gửi</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ol>
                            @foreach($child->replies as $child1)
                            @include('pages.child_list_comment',
                            [
                                'child1'=>$child1,
                            ])
                            @endforeach
                        @endforeach
                    </div>
                </li>
            </ol>
        </div>
    </div>
{{-- @endif --}}
@endforeach
{{-- <style>
    .btn-show-com{
        display: none;
    }
</style> --}}
@section('comment_script')
   <script>
     $(document).on('click', '.btn-show-com', function(event){
        event.preventDefault();
        var id_comment = $(this).data('listcom');
        var com_id = '.chatbutton_' + id_comment;
        $(com_id).css("display", "none");
     })
   </script>
@endsection