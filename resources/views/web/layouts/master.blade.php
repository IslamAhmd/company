<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="{{asset('css/bootstrap.min.css')}}" type="text/css" rel="stylesheet"/>
    <link href="{{asset('css/styles.css')}}" type="text/css" rel="stylesheet"/>
    <link href="{{asset('css/slick.css')}}" type="text/css" rel="stylesheet"/>
    <link href="{{asset('css/slick-theme.css')}}" type="text/css" rel="stylesheet"/>
    <link href="{{asset('css/styles.css')}}" type="text/css" rel="stylesheet"/>
    <link href="{{asset('css/sidebar.css')}}" type="text/css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">

</head>
<body>
<div id="base" class="page-wrapper chiller-theme" style="height: 5000px">
    <nav id="sidebar-left" class="sidebar-wrapper left">
        <div class="sidebar-content">

        </div>
    </nav>
    <nav id="sidebar-right" class="sidebar-wrapper right">
        <div class="sidebar-content">
        </div>
    </nav>
    <div class="container-fluid page-content">
        @yield('content')
    </div>
</div>

<script src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
<script src="{{asset('js/jquery-ui.min.js')}}"></script>
<script src="{{asset('js/slick.min.js')}}"></script>


<script>
    function showHideSidebars (){
        var pageHeight = window.innerHeight * 0.8;
        var currentScrollPos = window.pageYOffset;
        if (currentScrollPos < pageHeight) {
            $('#sidebar-left').hide();
            $('#sidebar-right').hide();
            $('.page-wrapper').removeClass('toggled');
        } else {
            $('#sidebar-left').show();
            $('#sidebar-right').show();
            $('.page-wrapper').addClass('toggled');
        }
    }
    window.onscroll = function() {
        showHideSidebars()
    };
    $(document).ready(function() {
        showHideSidebars();
    });
</script>

@yield('scripts')
</body>
</html>
