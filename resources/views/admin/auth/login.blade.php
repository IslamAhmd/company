<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Appzia - Responsive Admin Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta content="Admin Dashboard" name="description"/>
    <meta content="ThemeDesign" name="author"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <link rel="shortcut icon" href="{{asset('admin/images/favicon.ico')}}">
    <link href="{{asset('admin/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/css/icons.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/css/style.css')}}" rel="stylesheet" type="text/css">
</head>
<body>
<div class="accountbg"></div>
<div class="wrapper-page">
    <div class="panel panel-color panel-primary panel-pages">
        <div class="panel-body"><h3 class="text-center m-t-0 m-b-15"><a href="index.html" class="logo"><img
                            src="{{asset('admin/images/logo_white.png')}}"></a></h3><h4 class="text-muted text-center m-t-0"><b>Sign In</b></h4>
            <form class="form-horizontal m-t-20" action="{{route('admin.login')}}" method="POST">
                {{csrf_field()}}
                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" type="text" required="" placeholder="Username" name="email">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12"><input class="form-control" type="password" required="" name="password"
                                                  placeholder="Password"></div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <div class="checkbox checkbox-primary"><input id="checkbox-signup" type="checkbox" checked>
                            <label for="checkbox-signup"> Remember me </label></div>
                    </div>
                </div>
                <div class="form-group text-center m-t-40">
                    <div class="col-xs-12">
                        <button class="btn btn-primary btn-block btn-lg waves-effect waves-light" type="submit">Log In
                        </button>
                    </div>
                </div>
                <div class="form-group m-t-30 m-b-0">
                    <div class="col-sm-7"><a href="pages-recoverpw.html" class="text-muted"><i
                                    class="fa fa-lock m-r-5"></i> Forgot your password?</a></div>
                    <div class="col-sm-5 text-right"><a href="pages-register.html" class="text-muted">Create an
                            account</a></div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="{{asset('admin/js/jquery.min.js')}}"></script>
<script src="{{asset('admin/js/bootstrap.min.js')}}"></script>
<script src="{{asset('admin/js/modernizr.min.js')}}"></script>
<script src="{{asset('admin/js/detect.js')}}"></script>
<script src="{{asset('admin/js/fastclick.js')}}"></script>
<script src="{{asset('admin/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('admin/js/jquery.blockUI.js')}}"></script>
<script src="{{asset('admin/js/waves.js')}}"></script>
<script src="{{asset('admin/js/wow.min.js')}}"></script>
<script src="{{asset('admin/js/jquery.nicescroll.js')}}"></script>
<script src="{{asset('admin/js/jquery.scrollTo.min.js')}}"></script>
<script src="{{asset('admin/js/app.js')}}"></script>
</body>
</html>