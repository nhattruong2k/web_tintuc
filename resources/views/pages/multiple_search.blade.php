@extends('../layout')
@section('content')
    @include('pages.navbar')
@endsection

@section('wrap_search')
<div class="hero-area height-400 bg-img background-overlay" style="background-image: url('{{asset('img/blog-img/sub-category.jpg')}}')"></div>
<div class="main-content-wrapper section-padding-100">
    <div class="container">
            <div class="col-12 col-lg-8">
                <div class="single-blog-content mb-100">
                    <div class="world-catagory-area">
                        <h2 class="text-4 mb-3">Tìm kiếm</h2>
                        <div class="wrap_search">
                            <form id="form_search" action="wrap_search" method="GET">
                                <div class="search">
                                    <input type="text" class="searchTerm" name="tenblog" id="multiple_search" value="{{$val_keyword}}" placeholder="Tìm kiếm" required>
                                    <input type="hidden" id="thoigian" value="">
                                    <button type="submit" class="searchButton" id="btn_multiple">
                                            <i class="fa fa-search"></i>
                                    </button>
                                </div>
                                <div style="margin-top:15px" class="search_row">
                                    <label for="content_type" class="input-form">
                                        <h5 class="title-input">Tìm kiếm theo </h5>
                                        <select class="search_condition" name="content_type" id="content_type" data-type="date_format">   
                                            <option {{isset($_GET['content_type']) && $_GET['content_type'] == 'all' ? 'selected' : ''}}  value="all">Tất cả</option>
                                            <option {{isset($_GET['content_type']) && $_GET['content_type'] == 'tenblog' ? 'selected' : ''}}  value="tenblog">Tiêu đề</option>
                                            <option  {{isset($_GET['content_type']) && $_GET['content_type'] == 'tomtat' ? 'selected' : ''}} value="tomtat">Nội dung</option>
                                            <option {{isset($_GET['content_type']) && $_GET['content_type'] == 'author' ? 'selected' : ''}} value="author">Tác giả</option>
                                        </select>
                                    </label>
                                    <label for="time" class="input-form">
                                        <h5 class="title-input">Thời gian</h5>
                                        <select class="search_condition" name="time" id="time" data-type="date_format">   
                                            <option {{isset($_GET['time']) && $_GET['time'] == 'all' ? 'selected' : ''}} value="all">Tất cả</option>
                                            <option {{isset($_GET['time']) && $_GET['time'] == 'day' ? 'selected' : ''}} value="day">Hôm nay</option>
                                            <option {{isset($_GET['time']) && $_GET['time'] == 'week' ? 'selected' : ''}} value="week">7 ngày trước</option>
                                            <option {{isset($_GET['time']) && $_GET['time'] == 'month' ? 'selected' : ''}} value="month">30 ngày trước</option>
                                        </select>
                                    </label>
                                    <label for="category" class="input-form">
                                        <h5 class="title-input">Chuyên mục</h5>
                                        <select class="search_condition" name="category" id="category" data-type="date_format">   
                                            <option {{isset($_GET['category']) && $_GET['category'] == 'all' ? 'selected' : ''}} value="all">Tất cả</option>
                                            @foreach($danhmuc as $danh)
                                                <option {{isset($_GET['category']) && $_GET['category'] == $danh->slug_danhmuc ? 'selected' : ''}} value="{{$danh->slug_danhmuc}}">{{$danh->tendanhmuc}}</option>
                                            @endforeach
                                        </select>
                                    </label>
                                </div>
                            </form>
                        </div>
                        <div class="tab-content" id="myTabContent" style="padding-top: 160px;">
                            @foreach($search_blog as $blog)
                            <div class="tab-pane fade show active" id="world-tab-1" role="tabpanel" aria-labelledby="tab1">
                                <!-- Single Blog Post -->
                                <div class="single-blog-post post-style-4 d-flex align-items-center">
                                    <!-- Post Thumbnail -->
                                    <div class="post-thumbnail">
                                        <a data-id="{{$blog->id}}" class="btn-blog" href="{{route('bai_viet',$blog->slug_blog)}}" class="headline">
                                            <img src="{{asset('public/uploads/blog/'.$blog->image)}}" alt="" style="height: 160px" class="wishlist_image_{{$blog->id}}">
                                         </a>
                                    </div>
                                    <!-- Post Content -->
                                    <div>
                                        <a data-id="{{$blog->id}}" class="btn-blog" href="{{route('bai_viet',$blog->slug_blog)}}" class="headline" style="color: inherit; text-decoration: none; position: relative;">
                                            <h5>{{$blog->tenblog}}</h5>
                                        </a>
                                        <a data-id="{{$blog->id}}" class="btn-blog" href="{{route('bai_viet',$blog->slug_blog)}}" class="headline">
                                            <p>{{$blog->tomtat}}</p>
                                        </a>
                                        <!-- Post Meta -->
                                        <div>
                                            <div class="row">
                                                <div class="col-10">
                                                    <p><a href="{{route('tacgia',['slug'=>$blog->tacgia_slug])}}" class="post-author" style="color: inherit; text-decoration: none; position: relative;">{{$blog->user->name}}</a> on <a class="post-date" style="color: inherit; text-decoration: none; position: relative;">{{date('d-m-Y', strtotime($blog->created_at));}}</a></p>
                                                </div>
                                                <div class="col-2">
                                                    <i class="fa fa-eye" aria-hidden="true"> {{$blog->views}} </i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="piga mt-5">
                            {{ $search_blog->links() }}
                            <style>
                                .piga ul{
                                    background-color:white;
                                    justify-content: center;
                                }
                            </style>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .title-input{
        font-size: 15px;
        color: #757575;
    }
    .search_condition{
        display: block;
        width: 100%;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
    }
    .input-form{
        width: 25%;
        margin-right: 15px;
    }
    .wrap_search{
        width: 95%;
        position: absolute;
        left: 49%;
        margin-top: 20px;
        transform: translate(-50%, -20%);
    }
    .search {
    width: 105%;
    position: relative;
    display: flex;
    }

    .searchTerm {
    position: relative;
    width: 90%;
    border: 2px solid black;
    border-right: none;
    padding: 8px;
    height: 45px;
    border-radius: 5px 0 0 5px;
    outline: none;
    color: black;
    }

    .searchTerm:focus{
    color: #00B4CC;
    }

    .searchButton {
    position: absolute;
    left:89%;
    width: 50px;
    height: 45px;
    background: none;
    text-align: center;
    color: black;
    border-radius: 0 5px 5px 0;
    cursor: pointer;
    font-size: 20px;
    border-left:none; 
    }

    /*Resize the wrap to see the search bar change!*/
    .wrap{
    width: 95%;
    position: absolute;
    left: 49%;
    margin-top:20px; 
    transform: translate(-50%, -50%);
    }
</style>
<script>
    $(document).ready(function(){
        $('select.search_condition').change(function(){
            var thoigian = $(this).children("option:selected").val();
            if($('.searchTerm').val() != ''){
                $('#form_search').submit()
            }  
        })
    })
    // $(document).keypress(function(){
    //     var keycode = (event.keyCode ? event.keyCode : event.which);
    //     if(keycode == '13'){
    //         var val_keyword = $('#multiple_search').val();
    //         var _urlSearchKey = "{{route('ajax_mulSearch')}}"
    //         var _token = "{{csrf_token() }}";
    //         $.ajax({
    //             type:"GET",    
    //             dataType: "json",
    //             url:_urlSearchKey,
    //             data:{
    //                 tenblog: val_keyword,
    //                 _token:_token
    //             },
    //             success : function (data){
                   
    //             }
    //         })
    //     }
    // })
</script>
@endsection