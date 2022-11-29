<aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{url('/admin')}}" class="brand-link">
        <img src="{{ asset('vendors/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Quản Lý Tin Tức</span>
        </a>
        <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ asset('public/uploads/user/'.auth()->user()->avatar) }}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="/profileAdmin" class="d-block">
                        {{auth()->user()->name}}
                    </a>
                </div>
        </div>
        <!-- Sidebar -->

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
                </button>
            </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
            @role('writer|editer|deleter|admin')
                <li class="nav-item">
                        <a href="{{url('/admin')}}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Trang chủ</p>
                        </a>
                    </li> 
                {{-- <li class="nav-item">
                    <a href="" class="nav-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                        </svg>
                        <p>Thông tin cá nhân
                        <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('profileAdmin')}}" class="nav-link active">
                                <i class="far fa-circle nav-icon">
                                Thay đổi thông tin
                                </i>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('changePasswordAdmin')}}" class="nav-link">
                                <i class="far fa-circle nav-icon">
                                Thay đổi mật khẩu
                                </i>
                            </a>
                        </li>
                    </ul>
                </li> --}}

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                        </svg>
                        <p>Quản Lý Người Dùng
                        <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('manager_user.index')}}" class="nav-link active">
                                <i class="far fa-circle nav-icon">
                                Danh sách user
                                </i>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('staff_user')}}" class="nav-link">
                                <i class="far fa-circle nav-icon">
                                Danh sách nhân viên
                                </i>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('manager_user.create')}}" class="nav-link">
                                <i class="far fa-circle nav-icon">
                                Thêm nhân viên
                                </i>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('userpermission.index')}}" class="nav-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                        <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                        <path fill-rule="evenodd" d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216z"/>
                        <path d="M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
                    </svg>
                        <p>Quản Lý Quyền/Vai Trò</p>
                    </a>
                </li>
                {{-- @if(auth()->user()->accept_blogger == 1) --}}
                    <li class="nav-item">
                        <a href="" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                            <p>Quản Lý Danh Mục
                            <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('danhmuc.index')}}" class="nav-link active">
                                    <i class="far fa-circle nav-icon">
                                    Danh sách danh mục
                                    </i>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('danhmuc.create')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon">
                                    Thêm danh mục
                                    </i>
                                </a>
                            </li>
                            </ul>
                    </li>
            @endrole

                <li class="nav-item">
                        <a href="" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                            <p>Quản lý Bài Viết
                            <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('blog.index')}}" class="nav-link active">
                                    <i class="far fa-circle nav-icon">
                                    Danh sách bài viết
                                    </i>
                                </a>
                            </li>
                        </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('blog.create')}}" class="nav-link">
                                <i class="far fa-circle nav-icon">
                                Thêm bài viết
                                </i>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{route('comment.list')}}" class="nav-link">
                        <i class="fa fa-commenting-o" aria-hidden="true"></i> 
                        <p>Quản lý bình luận</p>
                    </a>
                </li>

                @role('writer|editer|deleter|admin')
                    <li class="nav-item">
                        <a href="" class="nav-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bell-fill" viewBox="0 0 16 16">
                            <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zm.995-14.901a1 1 0 1 0-1.99 0A5.002 5.002 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901z"/>
                        </svg>
                            <p>Thông báo
                            <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('notification.index')}}" class="nav-link active">
                                    <i class="far fa-circle nav-icon">
                                    Danh sách thông báo
                                    </i>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('notification.create')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon">
                                    Thêm thông báo
                                    </i>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endrole
                {{-- <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();  document.getElementById('logout-form').submit();">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-door-open-fill" viewBox="0 0 16 16">
                        <path d="M1.5 15a.5.5 0 0 0 0 1h13a.5.5 0 0 0 0-1H13V2.5A1.5 1.5 0 0 0 11.5 1H11V.5a.5.5 0 0 0-.57-.495l-7 1A.5.5 0 0 0 3 1.5V15H1.5zM11 2h.5a.5.5 0 0 1 .5.5V15h-1V2zm-2.5 8c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1z"/>
                        </svg>
                        <p>Đăng xuất</p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                        <button type="submit" class="btn btn-link">Đăng xuất</button>
                    </form>
                </li>  --}}
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>