<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{auth()->user()->name}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">

                        <router-link to="/admin/dashboard" class="nav-link">
                            <i class="nav-icon fa fa-dashboard"></i>
                            dashboard</router-link>
                </li>

                <li class="nav-item">
                    <router-link to="/admin/profile" class="nav-link">
                        <i class="nav-icon fa fa-user"></i>

                        profile</router-link>
                </li>

                <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link active">
                        <p>
                            Starter Pages
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <router-link to="/admin/users" class="nav-link">
                                <i class="fa fa-users nav-icon"></i>
                                <p>All users</p>
                            </router-link>
                        </li>

                        <li class="nav-item">
                            <router-link to="/admin/organizations" class="nav-link">
                                <i class="fa fa-building-o nav-icon"></i>
                                <p>Organizations</p>
                            </router-link>
                        </li>

                        <li class="nav-item">
                            <router-link to="/admin/developer" class="nav-link">
                                <i class="fa fa-code nav-icon"></i>
                                <p>Developer</p>
                            </router-link>
                        </li>





                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-th"></i>
                        <p>
                            Simple Link
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                        <a  class="nav-link" href="{{ route('admin.logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="nav-icon fa fa-power-off"></i>

                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
