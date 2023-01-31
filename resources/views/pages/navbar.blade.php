<header class="header-area">
        <div class="container">
                    <nav class="navbar navbar-expand-lg" style="width: 126%; right: 150px;">
                        <!-- Logo -->
                        <a class="navbar-brand" href="{{url('/home-new')}}"><img src="{{asset('img/core-img/logo.png')}}" alt="Logo"></a>
                        <!-- Navbar Toggler -->
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#worldNav" aria-controls="worldNav" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                        <!-- Navbar -->
                        <div style="border-left: 1px solid rgb(246, 221, 221)">
                            <span style="color: white; margin-left: 10px;">
                                @php
                                date_default_timezone_set('Asia/Ho_Chi_Minh');
                                // echo date('l, d/m/Y');
                                $weekday = date("l");
                                $weekday = strtolower($weekday);
                                switch($weekday) {
                                    case 'monday':
                                        $weekday = 'Thứ hai';
                                        break;
                                    case 'tuesday':
                                        $weekday = 'Thứ ba';
                                        break;
                                    case 'wednesday':
                                        $weekday = 'Thứ tư';
                                        break;
                                    case 'thursday':
                                        $weekday = 'Thứ năm';
                                        break;
                                    case 'friday':
                                        $weekday = 'Thứ sáu';
                                        break;
                                    case 'saturday':
                                        $weekday = 'Thứ bảy';
                                        break;
                                    default:
                                        $weekday = 'Chủ nhật';
                                        break;
                                }
                                    echo $date_time= $weekday.', '.date('d/m/Y');
                                    @endphp
                            </span>
                        </div>
                        <div class="collapse navbar-collapse" id="worldNav">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item active">
                                    <a href="{{route('tuc24h')}}" class=" btn24h" role="button" style=""><i class="fa fa-clock-o" aria-hidden="true"></i> Mới nhất</a>
                                </li>
                                <li class="nav-item">
                                    <ul >
                                        <li class="menu">
                                                <a class="nav-link" href="">
                                                    <svg width="14" height="16" viewBox="0 0 14 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M10 7C10 8.65685 8.65685 10 7 10C5.34315 10 4 8.65685 4 7C4 5.34315 5.34315 4 7 4C8.65685 4 10 5.34315 10 7ZM9 7C9 5.89543 8.10457 5 7 5C5.89543 5 5 5.89543 5 7C5 8.10457 5.89543 9 7 9C8.10457 9 9 8.10457 9 7ZM11.9497 11.955C14.6834 9.2201 14.6834 4.78601 11.9497 2.05115C9.21608 -0.683716 4.78392 -0.683716 2.05025 2.05115C-0.683418 4.78601 -0.683418 9.2201 2.05025 11.955L3.57128 13.4538L5.61408 15.4389L5.74691 15.5567C6.52168 16.1847 7.65623 16.1455 8.38611 15.4391L10.8223 13.0691L11.9497 11.955ZM2.75499 2.75619C5.09944 0.410715 8.90055 0.410715 11.245 2.75619C13.5294 5.04153 13.5879 8.71039 11.4207 11.0667L11.245 11.2499L9.92371 12.5539L7.69315 14.7225L7.60016 14.8021C7.24594 15.0699 6.7543 15.0698 6.40012 14.802L6.30713 14.7224L3.3263 11.817L2.75499 11.2499L2.57927 11.0667C0.412077 8.71039 0.47065 5.04153 2.75499 2.75619Z" fill="#9F9F9F"></path>
                                                    </svg>
                                                    <span style="padding-left:3px">Tin theo khu vực </span></a>
                                                <ul class="ani-menu" style="left:21px">
                                                    <li>
                                                        @foreach($province as $blog_provinces)
                                                            <a class="nav-link" href="{{route('blog_province', $blog_provinces->slug_name )}}">{{substr( str_replace("Thành phố","",$blog_provinces->name), 1)}}</a>
                                                        @endforeach 
                                                    </li>
                                                </ul>
                                            </li> 
                                    </ul>
                                </li>
                                <li class="nav-item active" style="border-left: 1px solid rgb(246, 221, 221)">
                                    <a class="nav-link" href="{{url('/home-new')}}"><i class="fa fa-home" aria-hidden="true"></i>
                                        <span class="sr-only">(current)</span>
                                    </a>
                                </li>
                                    @foreach($nav_cate as $danh)
                                            <li class="nav-item">
                                                <ul >
                                                    <li class="menu">
                                                            <a class="nav-link" href="{{route('category', $danh->slug_danhmuc)}}">{{$danh->tendanhmuc}}</a>
                                                            <ul class="ani-menu">
                                                                <li>
                                                                    @foreach($danh->children as $childCategory)
                                                                        <a class="nav-link" href="{{route('category22', ['slug_parent' => $danh->slug_danhmuc, 'slug' => $childCategory->slug_danhmuc])}}">{{ $childCategory->tendanhmuc }}</a>
                                                                    @endforeach
                                                                </li>
                                                            </ul>
                                                        </li> 
                                                </ul>
                                            </li>
                                    @endforeach 
                                <li class="nav-item">
                                    <a href="" class="btn btn-out-light" data-toggle="modal" data-target="#exampleModal" style="color:white">
                                        Xem thêm
                                    </a>
                                </li>
                            </ul>
                            <!-- Search Form  -->
                            <div style="margin: -8px 15px 2px -55px;">   
                                <form id="submit_search" action="{{route('wrap_search')}}">
                                    <div class="search-box">
                                        <div class="input-box">
                                            <input type="text" id="search" name="tenblog" placeholder="Nhập tin tức cần tìm" required>
                                        </div>
                                        <div class="search-btn">
                                            <i class="fa fa-search" aria-hidden="true"></i>
                                        </div>
                                        <div class="cancel-btn">
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                        </div>
                                        {{-- <div class="search-data"> --}}
                                            <div id="search_key" style="position: relative">
                                            </div>
                                            <div id="countryList" style="position: absolute">
                                            </div>
                                        {{-- </div> --}}
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <script>
                                const searchBtn = document.querySelector(".search-btn");
                                const cancelBtn = document.querySelector(".cancel-btn");
                                const searchBox = document.querySelector(".search-box");
                                const searchInput = document.querySelector("#search");
                                const searchData = document.querySelector("#countryList");
                                const searchKeyData = document.querySelector("#search_key");
                                searchBtn.onclick = ()=>{
                                    searchBox.classList.add("active");
                                    searchInput.classList.add("active");
                                    searchBtn.classList.add("active");
                                    cancelBtn.classList.add("active");
                                    searchKeyData.classList.add("active");
                                    if(searchInput.value != ""){
                                        searchData.classList.remove("active");
                                        // searchData.innerHTML = "Không tìm thấy kết quả tìm kiếm";
                                    }else{
                                        searchData.classList.remove("active");
                                        searchData.innerHTML = "";
                                    }
                                }
                                cancelBtn.onclick = ()=>{
                                    searchBox.classList.remove("active");
                                    searchInput.classList.remove("active");
                                    searchBtn.classList.remove("active");
                                    cancelBtn.classList.remove("active");
                                    searchData.classList.add("active");
                                    searchKeyData.classList.remove("active");
                                }
                        </script>
                            <script>
                            $('#countryList').hide();
                                $(document).ready(function(){
                                    $('#search').keyup(function(){
                                        var query  = $(this).val();
                                        if(query != ''){
                                            $('#search_key').html(`
                                                <div style="background:white; padding: 9px 4px;border-bottom: 2px dotted #dfe0e1; margin-top: 7px;">
                                                    <span class="box-triangle">
                                                        <svg viewBox="0 0 20 9" role="presentation">
                                                            <path d="M.47108938 9c.2694725-.26871321.57077721-.56867841.90388257-.89986354C3.12384116 6.36134886 5.74788116 3.76338565 9.2467995.30653888c.4145057-.4095171 1.0844277-.40860098 1.4977971.00205122L19.4935156 9H.47108938z" fill="#ffffff"></path>
                                                        </svg>
                                                    </span>
                                                    <span style="color: Red;font-size: 16px; margin-left: 13px; line-height: inherit;">Từ khóa: `+query+`</span>
                                                </div>
                                                `); 
                                        }else{
                                            $('#search_key').html(`<div style="background:white; padding: 9px 4px;border-bottom: 2px dotted #dfe0e1; margin-top: 7px;">
                                                    <span class="box-triangle">
                                                        <svg viewBox="0 0 20 9" role="presentation">
                                                            <path d="M.47108938 9c.2694725-.26871321.57077721-.56867841.90388257-.89986354C3.12384116 6.36134886 5.74788116 3.76338565 9.2467995.30653888c.4145057-.4095171 1.0844277-.40860098 1.4977971.00205122L19.4935156 9H.47108938z" fill="#ffffff"></path>
                                                        </svg>
                                                    </span>
                                                    <span style="color: Red;font-size: 16px; margin-left: 13px; line-height: inherit;">Từ khóa: `+query+`</span>
                                                </div>`);
                                        }  
                                        search();
                                    });

                                    function search(){
                                        var query  = $('#search').val();                                        
                                        var year  = $('#year').val();
                                        var _token = $('input[name=_token]').val();
                                            $.ajax({
                                                method:'GET',
                                                url: "{{ route('tim_kiem') }}",
                                                data:{
                                                    query: query,
                                                    year: year,
                                                    _token: _token,
                                                },
                                                success: function(data){
                                                    $('#countryList').show(500);
                                                    $('#countryList').fadeIn();
                                                    $('#countryList').html(data);
                                                }
                                            });
                                        
                                    }; 
                                    });
                            </script>

                        <div style="margin: 2px -79px 1px 5px;">
                            <ul class="navbar-nav ml-auto">
                                <!-- Authentication Links -->
                                @guest
                                    @if(Route::has('login'))
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('login') }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="35" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                                  </svg>
                                                Đăng nhập
                                            </a>
                                        </li>
                                    @endif
    
                                    {{-- @if (Route::has('register'))
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                        </li>
                                    @endif --}}
                                @else
                                @if(Auth::user()->email_verified_at != null)    
                                    <div class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            {{ Str::limit((Auth::user()->name),10, '...') }}
                                        </a>
                                        <div class="dropdown-menu position-absolute dropdown-menu-right" aria-labelledby="dropdownMenuButton" style="margin:11px 14px">
                                            <a href="{{route('profileUser')}}" class="dropdown-item">Thông tin cá nhân</a>
                                            <a href="{{route('password')}}" class="dropdown-item">Thay đổi mật khẩu</a>
                                        @role('admin|publisher|writer|editer|deleter')
                                            <a href="{{url('/admin')}}" class="dropdown-item">Trang quản trị</a>
                                        @endrole
                                        @role('blogger')
                                            <a href="{{url('/post/create')}}" class="dropdown-item">Tạo bài viết</a>
                                        @endrole
                                            <a href="{{route('notifications')}}" class="dropdown-item">Góp ý kiến</a>
                                            <a href="{{route('recentViewed')}}" class="dropdown-item">Tin đã xem</a>
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>
        
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                @elseif(Auth::user()->email_verified_at == null)
                                    @if(Route::has('login'))
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('login') }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="35" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                                                </svg>
                                                Đăng nhập
                                            </a>
                                        </li>
                                    @endif
                                @endif
                                @endguest
                            </ul>
                            </div>
                        </div>
                    </nav>
            </div>
    </header>
    <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Tất cả danh mục</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                @include('pages.navdanhmuc')
            </div>
          </div>
        </div>
      </div>
