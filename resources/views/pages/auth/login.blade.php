<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Đăng nhập vào hệ thống</title>

    @include('layouts.components.link')

</head>
<body class="white-bg">
    <div class="loginColumns animated fadeInDown">
        <div class="row">

            <div class="col-md-6">
                <h2 class="font-bold">Quản lý hệ thống BH</h2>
                <p>
                    <small>Truy cập đường link hạn chế.</small>
                </p>

            </div>
            <div class="col-md-6">
                <div class="ibox-content">
                    <form class="m-t" role="form" action="index.html">
                        <div class="form-group">
                            <input type="username" class="form-control" placeholder="Tên đăng nhập" required="">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Mật khẩu" required="">
                        </div>
                        <button type="submit" class="btn btn-primary block full-width m-b">Đăng nhập</button>

                        <a href="#">
                            <small>Quên mật khẩu</small>
                        </a>
                      
                    </form>
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-md-6">
                Copyright Example Company
            </div>
            <div class="col-md-6 text-right">
               <small>© 2014-2015</small>
            </div>
        </div>
    </div>

</body>

</html>
