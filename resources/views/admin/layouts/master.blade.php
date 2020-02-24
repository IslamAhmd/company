<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta content="Admin Dashboard" name="description"/>
    <meta content="ThemeDesign" name="author"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <link rel="shortcut icon" href="{{asset('admin/images/favicon.ico')}}">

    @if(App::getLocale() == 'ar')
        <link href="https://fonts.googleapis.com/css?family=Cairo:400,600,700,900&display=swap" rel="stylesheet">
        <link href="{{asset('admin/css/bootstrap_rtl.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('admin/css/icons.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('admin/css/ar_style.css')}}" rel="stylesheet" type="text/css">
    @else
        <link href="{{asset('admin/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('admin/css/icons.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('admin/css/style.css')}}" rel="stylesheet" type="text/css">
    @endif
    @yield('head')
</head>
<body class="fixed-left">
<div id="wrapper">
    <div class="topbar">
        <div class="topbar-left">
            <div class="text-center">
                <a href="{{route('admin.index')}}" class="logo"><img src="{{asset('admin/images/logo.png')}}"></a>
                <a href="{{route('admin.index')}}" class="logo-sm"><img src="{{asset('admin/images/logo_sm.png')}}"></a>
            </div>
        </div>
        <div class="navbar navbar-default" role="navigation">
            <div class="container">
                <div class="">
                    <div class="pull-left">
                        <button type="button" class="button-menu-mobile open-left waves-effect waves-light"><i
                                    class="ion-navicon"></i></button>
                        <span class="clearfix"></span>
                    </div>
                    <form class="navbar-form pull-left" role="search">
                        <div class="form-group"><input type="text" class="form-control search-bar"
                                                       placeholder="{{__('admin.general.search')}}..."></div>
                        <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
                    </form>
                    <ul class="nav navbar-nav navbar-right pull-right">
                        <li class="hidden-xs"><a
                                    @if(App::getLocale() == 'ar')
                                    href="{{ LaravelLocalization::getLocalizedURL('en') }}"
                                    @else
                                    href="{{ LaravelLocalization::getLocalizedURL('ar') }}"
                                    @endif
                                    class="waves-effect waves-light notification-icon-box">
                                @if(App::getLocale() == 'ar')
                                    en
                                @else
                                    ar
                                @endif
                            </a>
                        </li>
                        <li class="dropdown hidden-xs"><a href="#" data-target="#"
                                                          class="dropdown-toggle waves-effect waves-light notification-icon-box"
                                                          data-toggle="dropdown" aria-expanded="true"> <i
                                        class="fa fa-bell"></i>
                                <span class="badge badge-xs badge-danger"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-lg noti-list-box">
                                <li class="text-center notifi-title">Notification
                                    <span
                                            class="badge badge-xs badge-success">3
                                    </span>
                                </li>
                                <li class="list-group"><a href="javascript:void(0);" class="list-group-item">
                                        <div class="media">
                                            <div class="media-heading">Your order is placed</div>
                                            <p class="m-0">
                                                <small>Dummy text of the printing and typesetting industry.</small>
                                            </p>
                                        </div>
                                    </a> <a href="javascript:void(0);" class="list-group-item">
                                        <div class="media">
                                            <div class="media-body clearfix">
                                                <div class="media-heading">New Message received</div>
                                                <p class="m-0">
                                                    <small>You have 87 unread messages</small>
                                                </p>
                                            </div>
                                        </div>
                                    </a> <a href="javascript:void(0);" class="list-group-item">
                                        <div class="media">
                                            <div class="media-body clearfix">
                                                <div class="media-heading">Your item is shipped.</div>
                                                <p class="m-0">
                                                    <small>It is a long established fact that a reader will</small>
                                                </p>
                                            </div>
                                        </div>
                                    </a> <a href="javascript:void(0);" class="list-group-item">
                                        <small class="text-primary">See all notifications</small>
                                    </a></li>
                            </ul>
                        </li>
                        <li class="hidden-xs"><a href="#" id="btn-fullscreen"
                                                 class="waves-effect waves-light notification-icon-box"><i
                                        class="mdi mdi-fullscreen"></i></a></li>
                        <li class="dropdown"><a href="#" class="dropdown-toggle profile waves-effect waves-light"
                                                data-toggle="dropdown" aria-expanded="true"> <img
                                        src="{{asset('admin/images/users/avatar-1.jpg')}}" alt="user-img"
                                        class="img-circle"> </a>
                            <ul class="dropdown-menu">
                                <li><a href="javascript:void(0)"> {{__('admin.general.profile')}}</a></li>
                                <li><a href="javascript:void(0)">
                                        <span class="badge badge-success pull-right">5</span>
                                        {{__('admin.general.settings')}} </a></li>
                                <li class="divider"></li>
                                <li>
                                    <form id="logout-form" method="post" action="{{route('admin.logout')}}">
                                        {{csrf_field()}}
                                    </form>
                                    <a href="javascript:void(0)" onclick="$('#logout-form').submit();"> {{__('admin.general.logout')}}</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="left side-menu">
        <div class="sidebar-inner slimscrollleft">
            <div id="sidebar-menu">
                <ul>
                    <li class="menu-title">{{__('admin.general.menu')}}</li>
                    <li><a href="{{route('admin.index')}}" class="waves-effect"><i class="mdi mdi-home"></i>
                            <span> {{__('admin.general.dashboard')}}
                            </span>
                        </a></li>
                    @if(Auth::user()->can('viewAny', App\Models\User::class))
                    <li>
                        <a href="{{route('admin.users.index')}}" class="waves-effect">
                            <i class="mdi mdi-diamond"></i>
                            <span> {{__('admin.general.users')}}</span>
                        </a>
                    </li>
                    @endif
                    @if(Auth::user()->can('viewAny', App\Models\Project::class))
                    <li>
                        <a href="{{route('admin.projects.index')}}" class="waves-effect">
                            <i class="mdi mdi-diamond"></i>
                            <span> {{__('admin.general.projects')}}</span>
                        </a>
                    </li>
                    @endif
                    <li class="has_sub"><a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-album"></i>
                            <span> UI Elements</span>
                            <span class="pull-right"><i class="mdi mdi-plus"></i></span>
                        </a>
                        <ul class="list-unstyled">
                            <li><a href="ui-components.html">Components</a></li>
                            <li><a href="ui-buttons.html">Buttons</a></li>
                            <li><a href="ui-panels.html">Panels</a></li>
                            <li><a href="ui-tabs-accordions.html">Tabs &amp; Accordions</a></li>
                            <li><a href="ui-modals.html">Modals</a></li>
                            <li><a href="ui-progressbars.html">Progress Bars</a></li>
                            <li><a href="ui-alerts.html">Alerts</a></li>
                            <li><a href="ui-sweet-alert.html">Sweet-Alert</a></li>
                            <li><a href="ui-grid.html">Grid</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="content-page">
        <div class="content">
            @yield('content')
        </div>
    </div>
</div>


<script src="{{asset('admin/js/jquery.min.js')}}"></script>
@if(App::getLocale() == 'ar')
    <script src="{{asset('admin/js/bootstrap_rtl.min.js')}}"></script>
@else
    <script src="{{asset('admin/js/bootstrap.min.js')}}"></script>
@endif
<script src="{{asset('admin/js/modernizr.min.js')}}"></script>
<script src="{{asset('admin/js/detect.js')}}"></script>
<script src="{{asset('admin/js/fastclick.js')}}"></script>
<script src="{{asset('admin/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('admin/js/jquery.blockUI.js')}}"></script>
<script src="{{asset('admin/js/waves.js')}}"></script>
<script src="{{asset('admin/js/wow.min.js')}}"></script>
<script src="{{asset('admin/js/jquery.nicescroll.js')}}"></script>
<script src="{{asset('admin/js/jquery.scrollTo.min.js')}}"></script>
<script src="{{asset('admin/plugins/morris/morris.min.js')}}"></script>
<script src="{{asset('admin/plugins/raphael/raphael-min.js')}}"></script>
{{--<script src="{{asset('admin/pages/dashborad.js')}}"></script>--}}
<script src="{{asset('admin/js/app.js')}}"></script>
@yield('scripts')
</body>
</html>