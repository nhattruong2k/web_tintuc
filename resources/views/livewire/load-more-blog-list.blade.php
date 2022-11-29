<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <div class="world-latest-articles">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="title">
                    <h4 class="more-blog">Các bài viết</h4>
                </div>
                <style>
                    .more-blog{
                        font-size: 1.5rem;
                        color: #000000;
                        margin-bottom: 0;
                        margin-right: auto;
                        font-family: inherit;
                        line-height: 1.2;
                        padding: 10px 0;
                        border-bottom: 2px solid #f1f1f1;
                    }
                </style>
                <div id="blogs">
                    @foreach($blogger as $blog)
                    <!-- Single Blog Post -->
                        <div class="single-blog-post post-style-4 d-flex align-items-center wow fadeInUpBig load" data-wow-delay="0.2s">
                            <!-- Post Thumbnail -->
                            <div class="post-thumbnail">
                                <a href="{{route('bai_viet',$blog->slug_blog)}}" class="headline">
                                    <img src="{{asset('public/uploads/blog/'.$blog->image)}}" alt="" style="height: 150px;">
                                </a>
                            </div>
                            <!-- Post Content -->
                            <div class="post-content">
                                <a href="{{route('bai_viet',$blog->slug_blog)}}" class="headline" style="color: inherit; text-decoration: none; position: relative;">
                                    <h5>{{$blog->tenblog}}</h5>
                                </a>
                                <p>{{$blog->tomtat}}</p>
                                <!-- Post Meta -->
                                <div class="post-meta">
                                    <div class="row">
                                        <div class="col-10">
                                            <p><a href="{{route('tacgia',['slug'=>$blog->tacgia_slug])}}" class="post-author" style="color: inherit; text-decoration: none; position: relative;">{{$blog->user->name}}</a> on <a href="#" class="post-date" style="color: inherit; text-decoration: none; position: relative;">{{date('d-m-Y', strtotime($blog->created_at));}}</a></p>
                                        </div>
                                        <div class="col-2">
                                            <i class="fa fa-eye" aria-hidden="true"> {{$blog->views}} </i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                   
                </div>
            </div>
            @if($blogger->total() > 0 && $blogger->count() < $blogger->total())
            <div class="col-12 col-lg-8">
                <div class="load-more-btn mt-50 text-center">
                    <a  wire:click="$emitSelf('load-more')" class="btn loadMore"><p class="world-btn">Xem thêm</p></a>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
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
