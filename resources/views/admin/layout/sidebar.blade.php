
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin.dashboard')}}" class="brand-link">
        <img src="{{asset('admin/dist/img/Atoshinlogo.png')}}" alt="Atoshin Logo" class="brand-image" style="opacity: .8">
{{--        <span class="brand-text font-weight-light">Atoshin</span>--}}
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item" style="border-bottom: white 0.7px solid;">
                    <a href="{{route('admin.dashboard')}}" class="nav-link">
{{--                        <i class="far fa-circle nav-icon"></i>--}}
                        <i class="fa fa-align-left nav-icon"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('galleries.index')}}" class="nav-link">
                        <i class="fa fa-building nav-icon"></i>
                        <p>Galleries</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('artists.index')}}" class="nav-link">
                        <i class="fa fa-palette nav-icon"></i>
                        <p>Artists</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('assets.index')}}" class="nav-link">
                        <i class="fas fa-paint-brush nav-icon"></i>
                        <p>Assets</p>
                    </a>
                </li>

                <li class="nav-item" style="border-bottom: white 0.7px solid;">
                    <a href="{{route('categories.index')}}" class="nav-link">
                        <i class="fa fa-cubes nav-icon"></i>
                        <p>Categories</p>
                    </a>
                </li>

                <li class="nav-item" style="border-bottom: white 0.7px solid;">
                    <a href="{{route('users.index')}}" class="nav-link">
                        <i class="fa fa-user nav-icon"></i>
                        <p>Users</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('admins.index')}}" class="nav-link">
                        <i class="fas fa-certificate nav-icon"></i>
                        <p>admins</p>
                    </a>
                </li>



{{--                <li class="nav-header">EXAMPLES</li>--}}

{{--                <li class="nav-item">--}}
{{--                    --}}
{{--                    <a href="#" class="nav-link">--}}
{{--                        <i class="nav-icon fas fa-copy"></i>--}}
{{--                        <p>--}}
{{--                            Layout Options--}}
{{--                            <i class="fas fa-angle-left right"></i>--}}
{{--                            <span class="badge badge-info right">6</span>--}}
{{--                        </p>--}}
{{--                    </a>--}}
{{--                    <ul class="nav nav-treeview">--}}
{{--                        --}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="pages/layout/top-nav-sidebar.html" class="nav-link">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>Top Navigation + Sidebar</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}

{{--                    </ul>--}}
{{--                    --}}
{{--                </li>--}}

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
