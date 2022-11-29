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
                                <li class="nav-item active" style="margin-right: 20px;">
                                    <a href="{{route('tuc24h')}}" class=" btn24h" role="button" style=""><i class="fa fa-clock-o" aria-hidden="true"></i> Mới nhất</a>
                                </li>
                                <li class="nav-item active" style="border-left: 1px solid rgb(246, 221, 221)">
                                    <a class="nav-link" href="{{url('/home-new')}}"><i class="fa fa-home" aria-hidden="true"></i>
                                        <span class="sr-only">(current)</span>
                                    </a>
                                </li>
                                {{-- Thể Thao --}}
                                    @foreach($danhmuc->take(4) as $danh)
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
                            <div style="margin: -8px 28px 2px -42px;">   
                                <form action="#">
                                    <div class="search-box">
                                        <div class="input-box">
                                            <input type="text" id="search" name="tenblog" placeholder="Nhập tin tức cần tìm">
                                        </div>
                                        <div class="search-btn">
                                            <i class="fa fa-search" aria-hidden="true"></i>
                                        </div>
                                        <div class="cancel-btn">
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                        </div>
                                        {{-- <div class="search-data"> --}}
                                            <div id="countryList">
                                                <br>
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
                                const searchInput = document.querySelector("input");
                                const searchData = document.querySelector("#countryList");
                                searchBtn.onclick = ()=>{
                                    searchBox.classList.add("active");
                                    searchInput.classList.add("active");
                                    searchBtn.classList.add("active");
                                    cancelBtn.classList.add("active");
                                    if(searchInput.value != ""){
                                        searchData.classList.remove("active");
                                        // searchData.innerHTML = "Không tìm thấy kết quả tìm kiếm";
                                    }else{
                                        searchData.innerHTML = "";
                                    }
                                }
                                cancelBtn.onclick = ()=>{
                                    searchBox.classList.remove("active");
                                    searchInput.classList.remove("active");
                                    searchBtn.classList.remove("active");
                                    cancelBtn.classList.remove("active");
                                    searchData.classList.add("active");
                                }
                        </script>
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
                            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
                            <script>
                            
                                $(document).ready(function(){
                                    $('#search').keyup(function(){
                                        var query  = $(this).val();
                                    if(query  != '')
                                        {
                                            var _token = $('input[name=_token]').val();
                                            $.ajax({
                                                method:'GET',
                                                url: "{{ route('tim_kiem') }}",
                                                data:{
                                                    query: query,
                                                    _token: _token,
                                                },
                                                success: function(data){
                                                    $('#countryList').fadeIn();  
                                                    $('#countryList').html(data);
                                                }
                                            });
                                        }
                                    });
                                    // $(document).on('click','li', function(){
                                    //     $('#search').val($(this).text());  
                                    //     $('#countryList').fadeOut(); 
                                    // });
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
    
                                    @if (Route::has('register'))
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                        </li>
                                    @endif
                                @else    
                                <div class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
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
                                        <a href="{{route('notifications')}}" class="dropdown-item">Thông báo</a>
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
