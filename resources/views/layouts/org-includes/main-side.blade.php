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

                        <router-link to="/org/dashboard" class="nav-link">
                            <i class="nav-icon fa fa-dashboard"></i>
                            dashboard</router-link>
                </li>

                <li class="nav-item">
                    <router-link to="/org/profile" class="nav-link">
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
                            <router-link to="/org/users" class="nav-link">
                                <i class="fa fa-users nav-icon"></i>
                                <p>All users</p>
                            </router-link>
                        </li>

                        <li class="nav-item">
                            <router-link to="/org/tasks" class="nav-link">
                                <i class="fa fa-tasks nav-icon"></i>
                                <p>Tasks</p>
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
                        <a  class="nav-link" href="{{ route('org.logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="nav-icon fa fa-power-off"></i>

                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('org.logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
