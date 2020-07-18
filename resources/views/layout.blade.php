<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>AdminLTE 2 | Dashboard</title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <!-- Bootstrap 3.3.2 -->
  <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
  <!-- Font Awesome Icons -->
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <!-- Ionicons -->
  <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
  <!-- Morris chart -->
  <link href="{{ asset('plugins/morris/morris.css') }}" rel="stylesheet" type="text/css" />
  <!-- jvectormap -->
  <link href="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css" />
  <!-- Daterange picker -->
  <link href="{{ asset('plugins/daterangepicker/daterangepicker-bs3.css') }}" rel="stylesheet" type="text/css" />
  <!-- Theme style -->
  <link href="{{ asset('dist/css/AdminLTE.min.css') }}" rel="stylesheet" type="text/css" />
  <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
  <link href="{{ asset('dist/css/skins/_all-skins.min.css') }}" rel="stylesheet" type="text/css" />

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js') }}"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js') }}"></script>
    <![endif]-->
</head>

<body class="skin-blue">
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      @php
      $user = Auth::user();
      $fullname = $user->fullname;
      $imagepath = $user->image;
      @endphp
      <a href="index2.html" class="logo"><b>T1906E-Admin</b></a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top" role="navigation">
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="{{ asset($imagepath) }}" class="user-image" alt="User Image" />
                <span class="hidden-xs">{{ $fullname }}</span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <img src="{{ asset($imagepath) }}" class="img-circle" alt="User Image" />
                  <p>
                    {{ $fullname }}
                  </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="#" class="btn btn-default btn-flat">Tài khoản</a>
                  </div>
                  <div class="pull-right">
                    <a href="{{ route('admin.logout') }}" class="btn btn-default btn-flat">Đăng xuất</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="{{ asset($imagepath) }}" class="img-circle" alt="User Image" />
          </div>
          <div class="pull-left info">
            <p>{{ $fullname }}</p>

            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
          <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search..." />
            <span class="input-group-btn">
              <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
            </span>
          </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
          <li class="header">Danh sách chức năng</li>
          @php
          $menu = session('menu');  
          @endphp
          @foreach($menu as $route)
          @if($route->object_level > 1 || $route->show_menu == false || $route->status == false)
          @continue
          @endif
          <li class="active treeview">
            <a href="#">
              <i class="fa fa-dashboard"></i> <span>$route->object_name</span> <i class="fa fa-angle-left pull-right"></i>
            </a>
            @if($route->childMenu->count() > 0)
            <ul class="treeview-menu">
              @foreach($route->childMenu as $childMenu)
              @if($childMenu->show_menu == false || $childMenu->status == false)
              @continue
              @endif
              <li><a href="{{ $childMenu->object_url }}"><i class="fa fa-circle-o"></i> {{$childMenu->object_name}}</a></li>
              @endforeach
            </ul>
            @endif
          </li>
          @endforeach
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>

    <!-- Right side column. Contains the navbar and content of the page -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      @yield('content_layout')


    </div><!-- /.content-wrapper -->

    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        <b>Version</b> 1.0
      </div>
      <strong>Copyright &copy; 2020 <a href="http://almsaeedstudio.com">Dung Phạm</a>.</strong> T1906E.
    </footer>

  </div><!-- ./wrapper -->

  <!-- jQuery 2.1.3 -->
  <script src="{{ asset('plugins/jQuery/jQuery-2.1.3.min.js') }}"></script>
  <!-- Bootstrap 3.3.2 JS -->
  <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
  <!-- FastClick -->
  <script src="{{ asset('plugins/fastclick/fastclick.min.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('dist/js/app.min.js') }}" type="text/javascript"></script>
  <!-- Sparkline -->
  <script src="{{ asset('plugins/sparkline/jquery.sparkline.min.js') }}" type="text/javascript"></script>
  <!-- jvectormap -->
  <script src="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}" type="text/javascript"></script>
  <!-- daterangepicker -->
  <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}" type="text/javascript"></script>
  <!-- datepicker -->
  <script src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}" type="text/javascript"></script>
  <!-- iCheck -->
  <script src="{{ asset('plugins/iCheck/icheck.min.js') }}" type="text/javascript"></script>
  <!-- SlimScroll 1.3.0 -->
  <script src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
  <!-- ChartJS 1.0.1 -->
  <script src="{{ asset('plugins/chartjs/Chart.min.js') }}" type="text/javascript"></script>

  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="{{ asset('dist/js/pages/dashboard2.js') }}" type="text/javascript"></script>

  <!-- AdminLTE for demo purposes -->
  <script src="{{ asset('dist/js/demo.js') }}" type="text/javascript"></script>
  <script src="{{ asset('ckeditor/ckeditor.js') }}" type="text/javascript"></script>

  <script>
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1', {
      filebrowserBrowseUrl: "{{ asset('ckfinder/ckfinder.html') }}",
      filebrowserImageBrowseUrl: "{{ asset('ckfinder/ckfinder.html?type=Images') }}",
      filebrowserFlashBrowseUrl: "{{ asset('ckfinder/ckfinder.html?type=Flash') }}",
      filebrowserUploadUrl: "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}",
      filebrowserImageUploadUrl: "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}",
      filebrowserFlashUploadUrl: "{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}"
    });
  </script>

</body>

</html>