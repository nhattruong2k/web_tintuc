<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>World-Website Tin Tức</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">    
    <!-- Favicon  -->
    <link rel="icon" href="img/core-img/favicon.ico">
    <!-- Style CSS -->
    <link rel="shortcut icon" href="#" />

    <!-- Style CSS -->
    <link rel="stylesheet" href="{{asset('style.css')}}">
    <link rel="stylesheet" href="{{asset('css/navdanhmuc.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-tagsinput.css')}}" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">    
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="{{asset('js/bootstrap-tagsinput.js')}}"></script>
    <script src="{{asset('js/bootstrap-tagsinput.min.js')}}"></script>
    <link href="{{ asset('css/search.css') }}" rel="stylesheet">
    <link href="{{ asset('css/pass.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css'rel='stylesheet'>
    
    @livewireStyles
</head>

<body >
           <!-- Preloader End -->
           @yield('wrap_search')
           @yield('blog_province')
           @yield('tin_da_xem')
           @yield('content')
           @yield('category')
           @yield('tacgia')
           @yield('tin_tuc24h')
           @yield('blog')
           @yield('thembaiviet')
           @yield('updateDetails')
           @yield('password')
           @yield('thongbao')
        <a class="btn-top" href="javascript:void(0);" title="Top" style="display: inline;">
            <img src="{{asset('img/btn_top.png')}}" alt="" style="border-radius: 50%; ">
        </a>
        <style>
            .btn-top {
                border: medium none;
                bottom: 20px;
                cursor: pointer;
                display: none;
                height: 50px;
                outline: medium none;
                padding: 0;
                position: fixed;
                right: 20px;
                width: 50px;
                z-index: 9999;
            }
        </style>
        <!-- ***** Footer Area Start ***** -->
    <footer class="footer-area">
        <input type="hidden" value="{{Auth::check() ? Auth::user()->name : ''}}" id="user_auth">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="footer-single-widget">
                        <a href="#"><img src="{{asset('img/core-img/logo.png') }}" alt=""></a>
                        <div class="copywrite-text mt-30">
                            <p>Báo tiếng việt nhiều người xem</p><br>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="footer-single-widget">
                        <ul class="footer-menu d-flex justify-content-between">
                            @foreach($danhmuc->take(6) as $danh)
                            <li>
                                <a class="nav-link" href="{{route('category', $danh->slug_danhmuc)}}" style="color: white; text-decoration: none; position: relative;">{{$danh->tendanhmuc}}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="footer-single-widget">
                        <h5>Subscribe</h5>
                        <form action="#" method="post">
                            <input type="email" name="email" id="email" placeholder="Enter your mail">
                            <button type="button"><i class="fa fa-arrow-right"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
        $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
    })
    </script>
    {{-- Dropdown --}}
 <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <!-- ***** Footer Area End ***** -->
   <!-- jQuery (Necessary for All JavaScript Plugins) -->
   <script src="{{asset('js/jquery/jquery-2.2.4.min.js')}}"></script>
   <!-- Popper js -->
   <script src="{{asset('js/popper.min.js')}}"></script>
    <!-- Bootstrap js -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
   <!-- Plugins js -->
   <script src="{{asset('js/plugins.js')}}"></script>
   <!-- Active js -->
   <script src="{{asset('js/active.js') }}"></script>
   <script src="{{ asset('js/app.js') }}"></script>

    <script src="//cdn.ckeditor.com/4.16.0/full/ckeditor.js"></script>
    <script type="text/javascript"> 
        CKEDITOR.replace('ckeditor1')
    </script>
    
    <script type="text/javascript">
        function ChangeToSlug()
            {
                var slug;
            
                //Lấy slug từ thẻ input slug 
                slug = document.getElementById("slug").value;
                //Đổi chữ hoa thành chữ thường
                slug = slug.toLowerCase();
                // Kiểm trả slug
                    // alert(slug);
                //Đổi ký tự có dấu thành không dấu
                slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
                slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
                slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
                slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
                slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
                slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
                slug = slug.replace(/đ/gi, 'd');
                //Xóa các ký tự đặt biệt
                slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
                //Đổi khoảng trắng thành ký tự gạch ngang
                slug = slug.replace(/ /gi, "-");
                //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
                //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
                slug = slug.replace(/\-\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-/gi, '-');
                slug = slug.replace(/\-\-/gi, '-');
                //Xóa các ký tự gạch ngang ở đầu và cuối
                slug = '@' + slug + '@';
                slug = slug.replace(/\@\-|\-\@|\@/gi, '');
                //In slug ra textbox có id “convert_slug”
                document.getElementById('convert_slug').value = slug;
            }
        </script>
       <script>
        $(function () {
            $('input').tagsinput();
        });
    </script>

    <!-- jQuery Birth_date -->
    <script src= "https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" ></script>
    <script src= "https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" ></script>
    <script>
        $( function() {
            $("#datepicks" ).datepicker({
                dataFormat: "yy/mm/dd",
                changeMonth: true,
                changeYear: true,
                showOtherMonths: true,
                selectOtherMonths: true,
                minDate: "-1Y",
                maxDate: "Y",
            });
        } );
    </script>
    <script>
        jQuery(document).ready(function($){ 	
            if($(".btn-top").length > 0){
                $(window).scroll(function () {
                    var e = $(window).scrollTop();
                    if (e > 300) {
                        $(".btn-top").show()
                    } else {
                        $(".btn-top").hide()
                    }
                });
                $(".btn-top").click(function () {
                    $('body,html').animate({
                        scrollTop: 0
                    })
                })
            }		
        });
    </script>

    <script>
    function view(){
            if(localStorage.getItem('wishlist_blog')!=null){
                var data = JSON.parse(localStorage.getItem('wishlist_blog'));
                var user = $('#user_auth').val();
                    for(i=0; i<data.length; i++){
                        var id = data[i].id;
                        var auth_name=data[i].auth_name;
                        // console.log(user);
                        var tenblog = data[i].tenblog;
                        var tomtat = data[i].tomtat;
                        var images = data[i].images;
                        var url = data[i].url;
                        var tacgia = data[i].tacgia;
                        var tacgia_url = data[i].tacgia_url;
                        var created = data[i].created;
                        var view = data[i].view;
                        if(user==auth_name){
                            // alert(user);
                            $('#row_wishlist').append(`<div 
                            class="single-blog-post post-style-4 d-flex align-items-center wow fadeInUpBig load" data-wow-delay="0.2s"><div 
                            class="post-thumbnail"><a href="`+url+`" class="headline"><img 
                            src="`+images+`" style="height: 150px;"></a></div><div class="post-content"><a 
                            href="`+url+`" class="headline" style="color: inherit; text-decoration: none; position: relative;"><h5>`+tenblog+`</h5></a><p>`+tomtat+`</p><div class="post-meta"><div class="row"><div class="col-10"><p><a href="`+tacgia_url+`" class="post-author" style="color: inherit; text-decoration: none; position: relative;">`+tacgia+`</a> on <a class="post-date" style="color: inherit; text-decoration: none; position: relative;">`+created+`</a></p></div><div class="col-2"><i class="fa fa-eye" aria-hidden="true">`+view+`</i></div></div></div></div></div>`);
                        }
                    }           
            }
        }
        view();

        function dele_data(){
            var hourse = 24*7;
            var now = new Date().getTime();
            var wishlist_blog = localStorage.getItem('wishlist_blog');
            if(wishlist_blog==null){
                localStorage.setItem('setupTime', now)
            }else{  
                var setupTime = localStorage.getItem('setupTime');
                if(now - setupTime > hourse*60*60*1000){
                    localStorage.setItem('wishlist_blog',[]);
                }
            }
        }
        dele_data();

        $('.btn-blog').click(function(){
            var id = $(this).data('id');
            var auth_name = $('.wishlist_auth_'+id).val();
            var tenblog = $('.wishlist_tenblog_'+id).val();
            var tomtat = $('.wishlist_tomtat_'+id).val();
            var images = $('.wishlist_image_'+id).attr('src');
            var url = $('.wishlist_url_'+id).val();
            var tacgia = $('.wishlist_tacgia_'+id).val();
            var tacgia_url = $('.wishlist_tacgia_url_'+id).val();
            var created = $('.wishlist_created_'+id).val();
            var view = $('.wishlist_view_'+id).val();
            // alert(images);

            var newItem = {
                'id':id,
                'auth_name':auth_name,
                'tenblog':tenblog,
                'tomtat':tomtat,
                'images':images,
                'url':url,
                'tacgia':tacgia,
                'tacgia_url':tacgia_url,
                'created':created,
                'view':view,
            }
            if(localStorage.getItem('wishlist_blog')==null){
                localStorage.setItem('wishlist_blog','[]');
            }

            var old_data = JSON.parse(localStorage.getItem('wishlist_blog'));
    
            var matches = $.grep(old_data, function(obj){
                return obj.id == id;
            })
            if(matches.length){
                alert('bài viết bạn đã xem');
            }else{
                old_data.push(newItem);
            }
            localStorage.setItem('wishlist_blog', JSON.stringify(old_data));

        })
    </script>
    <script>
        // window.addEventListener('alert', event => {
        //     toastr[event.detail.type](event.detail.message,
        //         event.detail.title ?? ''), toastr.options = {
        //         "closeButton": true,
        //         "progressBar": true,
        //     };
        // })
    </script>
    @yield('scripts_blog')
    @yield('comment_script')
    @livewireScripts
</body>
</html>
