@section('header')
<header class="main-header">
    <a href="https://maroonfrog.com/" class="logo">
          <span class="logo-mini"><b>M</b>F</span>
          <span class="logo-lg"><b>Maroon</b>Frog</span>
        </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" id="navbar-static-top" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="mdl-tooltip" data-mdl-for="navbar-static-top">
            Toggle navigation
        </div>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="bower_components/admin-lte/dist/img/avatar.png" class="user-image" alt="User Image">
                        <span class="hidden-xs">{{ Auth::user()->email }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- The user image in the menu -->
                        <li class="user-header">
                            <img src="bower_components/admin-lte/dist/img/avatar.png" class="img-circle" alt=" Image">
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">
                            <div class="row">
                                <div class="col-xs-4 text-center">
                                    <a href="#">Followers</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#">Sales</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#">Friends</a>
                                </div>
                            </div>
                            <!-- /.row -->
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ route('logout') }}" class="btn btn-default btn-flat" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        {{ __('Logout')}}</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                            <div class="pull-right">
                            </div>

                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>