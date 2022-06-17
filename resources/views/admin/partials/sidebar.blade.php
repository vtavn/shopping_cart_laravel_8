<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{asset('template_admin')}}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('template_admin')}}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{\Auth::user()->name ?? 'Khách'}}</a>
            </div>
        </div>

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


                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-stream"></i>
                        <p>
                            Danh mục
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.categories.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh Sách</p>
                            </a>
                        </li>
                            <li class="nav-item">
                                <a href="{{route('admin.categories.create')}}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Thêm mới</p>
                                </a>
                            </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-bars"></i>
                        <p>
                            Menu
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.menus.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh Sách</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.menus.create')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm mới</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-store"></i>
                        <p>
                            Sản Phẩm
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.products.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh Sách</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.products.create')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm mới</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-bread-slice"></i>
                        <p>
                            Slider
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.sliders.index')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh Sách</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.sliders.create')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm mới</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{route('admin.users.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Danh sách tài khoản
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('admin.roles.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Quản Lý Nhóm
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('admin.permissions.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-radiation"></i>
                        <p>
                            Quản lý Module
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('admin.settings.index')}}" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Setting
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
