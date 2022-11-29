<ol class="children" style="width:665px; margin-left:56px">
    <li class="single_comment_area">
        <!-- Comment Content -->
        <div class="comment-content">
            <!-- Comment Meta -->
            <div class="comment-meta d-flex align-items-center justify-content-between">
                <p><a href="#" class="post-author" style=" text-decoration: underline; color:burlywood; text-decoration: none;">{{$child1->user->name}}</a> on <a href="#" class="post-date" style=" text-decoration: underline; color:burlywood; text-decoration: none;">{{date('d-m-Y', strtotime($child1->created_at));}}</a></p>
                @if(Auth::check())
                <a href="#" class="comment-reply btn world-btn btn-show-reply" data-id="{{$child1->id}}">Trả lời</a>
                @else
                <a href="#" class="comment-reply btn world-btn" data-toggle="modal" data-target="#exampleModal1">Trả lời</a>
                @endif
            </div>
            <div class="row">
                <div class="col">
                    {{-- @if(Auth) --}}
                    <img style="width: 52px;border-radius: 50%" src="{{ asset('public/uploads/user/'.$child1->user->avatar) }}" alt="">
                </div>
                <div class="col-10" style="margin-right: 28px;">
                    <h6>{{$child1->user->name}}</h6>
                    <p>{!! $child1->comment_body !!}</p>
                </div>
                <div style="margin: 25px 86px;">
                    <form action="" method="POST"  style="display:none" class="fromRepled form-reply-{{$child1->id}}">
                        <div class="row">
                            <div class="col-12">
                                <div class="group">
                                    {{-- Input ẩn --}}
                                    <textarea name="comment_body" id="content-reply-{{$child1->id}}" style="width: 410px;"></textarea>
                                    <h6 id="comment-reply-error-{{$child1->id}}" class="help-blog" style="color:red"></h6>
                                    <span class="highlight"></span>
                                    <label>Ý kiến của bạn</label>
                                </div>
                            </div>
                            <div class="col-12" >
                                <button type="submit" class="btn world-btn btn-send-comment-reply" data-id="{{$child1->id}}">Gửi</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </li>
</ol>
@foreach($child1->replies as $child2)
@include('pages.child_list_comment',
    [
    'child1'=>$child2,
    ])
@endforeach
