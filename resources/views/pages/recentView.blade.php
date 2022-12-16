@extends('../layout')
@section('content')
    @include('pages.navbar')
@endsection
@section('tin_da_xem')
<div class="hero-area height-500 bg-img background-overlay" style="background-image: url('{{asset('img/blog-img/baiviet.jpg')}}')">
    <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="single-blog-title text-center">
                    <!-- Catagory -->
                    <h3>Các bài viết đã xem</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="main-content-wrapper section-padding-100">
    <div class="container">
        <div class="row justify-content-center">
            <!-- ============= Post Content Area Start ============= -->
            <div class="col-12 col-lg-8">
                <div id="row_wishlist"></div>
            </div>
        </div>
    </div>
</div>
@endsection