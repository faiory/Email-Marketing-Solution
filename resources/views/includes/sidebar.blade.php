@section('sidebar')
<aside class="main-sidebar">
    <section class="sidebar">
        {{-- CHANGE FRON ADMIN TO DASHBOARD --}}
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Navigation</li>
            <li class="<?php echo 'dashboard' == Route::currentRouteName() ? 'active' : '' ?>"><a href="{{route("dashboard")}}"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
            <li class=""><a href="#"><i class="fa fa-address-book"></i><span>Clients</span></a></li>
            <li class=""><a href="#"><i class="fa fa-line-chart"></i> <span>Reports</span></a></li>
            <li class="<?php echo 'users' == Route::currentRouteName() ? 'active' : '' ?>"><a href="{{route("users")}}"><i class="fa fa-user"></i><span>Users</span></a></li>
            <li class=""><a href="#"><i class="fa fa-envelope"></i> <span>Newsletters</span></a></li>
            <li><a href=""><i class="fas fa-user-friends"></i> <span>Subscription Groups</span></a></li>
    </section>
</aside>