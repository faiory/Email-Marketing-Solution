{{-- THE FILE WILL CHANGE AND WILL BE KEPT IN THE  --}}
<!DOCTYPE html>
<html>

<head>
  @include('includes.head')
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
  @include('includes.header')
  @include('includes.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <section class="content-header">
        <h3>@yield('contentHeader')</h3>
      </section>

      <!-- Main content -->
      <section class="content container-fluid">
        <!--------------------------
        | Your Page Content Here |
        -------------------------->
        @yield('content')
        <!--------------------------
        | Your Page Content Here |
        -------------------------->
      </section>
    </div>
    <!-- /.content-wrapper -->
  @include('includes.footer')
  @include('includes.recents')


    <!-- REQUIRED JS SCRIPTS -->
    <!-- jQuery 3 -->
    {{-- <script src="bower_components/jquery/dist/jquery.min.js"></script> --}}
    <!-- Bootstrap 3.3.7 -->
    {{-- <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script> --}}
    <!-- AdminLTE App -->
    {{-- <script src="bower_components/admin-lte/dist/js/adminlte.min.js"></script> --}}
</body>

</html>