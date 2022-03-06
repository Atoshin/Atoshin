
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin.dashboard')}}" class="brand-link">
        <img src="{{asset('admin/dist/img/Atoshinlogo.svg')}}" alt="Atoshin Logo" class="brand-image" style="opacity: .8">
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
                    <a href="#" class="nav-link">
                        <i class="fa fa-user nav-icon"></i>
                        <p>{{\Illuminate\Support\Facades\Auth::guard('admin')->user()->username}}</p>
                    </a>
                </li>
                <li class="nav-item" style="border-bottom: white 0.7px solid;">
                    <a href="{{route('admin.dashboard')}}" class="nav-link">
{{--                        <i class="far fa-circle nav-icon"></i>--}}
                        <i class="fa fa-align-left nav-icon"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                @can('manage galleries')
                <li class="nav-item">
                    <a href="{{route('galleries.index')}}" class="nav-link">
                        <i class="fa fa-building nav-icon"></i>
                        <p>Galleries</p>
                    </a>
                </li>
                @endcan
                @can('manage artists')
                <li class="nav-item">
                    <a href="{{route('artists.index')}}" class="nav-link">
                        <i class="fa fa-palette nav-icon"></i>
                        <p>Artists</p>
                    </a>
                </li>
                @endcan
                @can('manage assets')
                <li class="nav-item">
                    <a href="{{route('assets.index')}}" class="nav-link">
                        <i class="fas fa-paint-brush nav-icon"></i>
                        <p>Assets</p>
                    </a>
                </li>
                @endcan
                @can('manage categories')
                <li class="nav-item" style="border-bottom: white 0.7px solid;">
                    <a href="{{route('categories.index')}}" class="nav-link">
                        <i class="fa fa-cubes nav-icon"></i>
                        <p>Categories</p>
                    </a>
                </li>
                @endcan
                @can('manage users')
                <li class="nav-item" style="border-bottom: white 0.7px solid;">
                    <a href="{{route('users.index')}}" class="nav-link">
                        <i class="fa fa-user nav-icon"></i>
                        <p>Users</p>
                    </a>
                </li>
                @endcan
                @can('manage newsletter')
                    <li class="nav-item" style="border-bottom: white 0.7px solid;">
                        <a href="{{route('newsletters.index')}}" class="nav-link">
                            <i class="fa fa-newspaper nav-icon"></i>
                            <p>NewsLetter</p>
                        </a>
                    </li>
                @endcan
                @can('manage admins')
                <li class="nav-item">
                    <a href="{{route('admins.index')}}" class="nav-link">
                        <i class="fas fa-certificate nav-icon"></i>
                        <p>Admins</p>
                    </a>
                </li>
                @endcan
                @can('manage roles')
                <li class="nav-item">
                    <a href="{{route('roles.index')}}" class="nav-link">
                        <i class="fas fa-user-circle nav-icon"></i>
                        <p>Roles</p>
                    </a>
                </li>
                @endcan
                @can('manage permissions')
                <li class="nav-item">
                    <a href="{{route('permissions.index')}}" class="nav-link">
                        <i class="fas fa-lock nav-icon"></i>
                        <p>Permissions</p>
                    </a>
                </li>
                @endcan
                @can('manage setting')
                    <li class="nav-item"  style="border-top: white 0.7px solid; border-bottom: white 0.7px solid;">
                        <a href="{{route('setting.index')}}" class="nav-link">
                            <i class="fas fa-wrench nav-icon"></i>
                            <p>Settings</p>
                        </a>
                    </li>
                @endcan



            </ul>

        </nav>
        <!-- /.sidebar-menu -->
        <div class="mt-2">
            <form action="{{route('logout')}}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>
    </div>


    <!-- /.sidebar -->
</aside>
