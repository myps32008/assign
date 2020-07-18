<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Admin | Registration Page</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{ asset('dist/css/AdminLTE.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="{{ asset('plugins/iCheck/square/blue.css') }}" rel="stylesheet" type="text/css" />
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="register-page">
    <div class="register-box">
      <div class="register-logo">
        <a href="#"><b>Quản lý trang Admin</b></a>
      </div>

      <div class="register-box-body">
        <p class="login-box-msg">Đăng ký thành viên</p>
        @isset($message)
            <div class="message">
            {{$message }}
            </div>
        @endisset
        <form action="{{ route('admin.register') }}" method="post" enctype="multipart/form-data">
         @csrf
          <div class="form-group has-feedback">
            <input type="text" name="txtUserName" id="txtUserName" class="form-control" placeholder="Tên đăng nhập" required/>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="text" name="txtFullName" id="txtFullName" class="form-control" placeholder="Họ và tên" required/>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="text" name="txtAddress" id="txtAddress" class="form-control" placeholder="Địa chỉ"/>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
           <div class="form-group has-feedback">
            <input type="email" name="txtEmail" id="txtEmail" class="form-control" placeholder="Email"/>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="number" name="txtPhone" id="txtPhone" class="form-control" placeholder="Số điện thoại"/>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
              <input type="password" name="txtPassword" id="txtPassword" class="form-control" placeholder="Mật khẩu" required/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" name="txtConfirmPassword" id="txtConfirmPassword" class="form-control" placeholder="Nhập lại mật khẩu"/>
            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
              <input type="file" name="txtImage" id="txtImage" class="form-control" placeholder="Ảnh đại diện"/>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">                            
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Đăng nhập</button>
            </div><!-- /.col -->
          </div>
        </form>        

        <a href="{{ route('admin.login') }}" class="text-center">Đăng nhập hệ thống</a>
      </div><!-- /.form-box -->
    </div><!-- /.register-box -->

    <!-- jQuery 2.1.3 -->
    <script src="{{ asset('plugins/jQuery/jQuery-2.1.3.min.js') }}"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="{{ asset('plugins/iCheck/icheck.min.js') }}" type="text/javascript"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>