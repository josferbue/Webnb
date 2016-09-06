<!DOCTYPE html>
<html lang="es">
    <head>
        <title>
            @yield('title')Administración
        </title>
        <meta charset='utf-8'>

        <!-- This is the traditional favicon.
         - size: 16x16 or 32x32
         - transparency is OK
         - see wikipedia for info on browser support: http://mky.be/favicon/ -->
        <link rel="shortcut icon" href="{{{ URL::asset('assets/ico/favicon.png') }}}">

        <!-- iOS favicons. -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{{ URL::asset('assets/ico/apple-touch-icon-144-precomposed.png') }}}">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{{ URL::asset('assets/ico/apple-touch-icon-114-precomposed.png') }}}">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{{ URL::asset('assets/ico/apple-touch-icon-72-precomposed.png') }}}">
        <link rel="apple-touch-icon-precomposed" href="{{{ URL::asset('assets/ico/apple-touch-icon-57-precomposed.png') }}}">

        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <!-- Styles -->

        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="{{ URL::asset('template/adminLTE/bootstrap/css/bootstrap.min.css') }}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- DataTables -->
        <link rel="stylesheet" href="{{ URL::asset('template/adminLTE/plugins/datatables/dataTables.bootstrap.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('template/adminLTE/plugins/datatables/extensions/Responsive/css/dataTables.responsive.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ URL::asset('template/adminLTE/dist/css/AdminLTE.min.css') }}">
        <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
              page. However, you can choose any other skin. Make sure you
              apply the skin class to the body tag so the changes take effect.
        -->

        <link rel="stylesheet" href="{{ URL::asset('template/adminLTE/dist/css/skins/skin-blue.min.css') }}">

        <!-- Styles ColorBox Plugin -->

        <link rel="stylesheet" href="{{ URL::asset('assets/css/colorbox.css') }}">

        <!-- Custom Styles -->

        <link rel="stylesheet" href="{{ URL::asset('template/adminLTE/dist/css/custom.css') }}">

        @yield('styles')

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script type="text/javascript" src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script type="text/javascript" src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <!-- Main Header -->
        <header class="main-header">

            <!-- Logo -->
            <a href="{{ URL::to('adminlte') }}" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>W</b>B</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>We</b>BnB</span>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account Menu -->
                        <li class="dropdown user user-menu">
                            <!-- Menu Toggle Button -->
                            <a target="_blank" href="{{ URL::to('/') }}" class="dropdown-toggle" data-toggle="dropdown">
                                <!-- The user image in the navbar-->
                                <img src="{{ URL::asset('template/adminLTE/dist/img/custom/admin.png') }}" class="user-image" alt="User Image">
                                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                <span class="hidden-xs">{{ Auth::check() ? ucwords(Auth::user()->username) : null }}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- The user image in the menu -->
                                <li class="user-header">
                                    <img src="{{ URL::asset('template/adminLTE/dist/img/custom/admin.png') }}" class="img-circle" alt="User Image">
                                    <p>
                                        {{ Auth::check() ? ucwords (Auth::user()->username) : null }}
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="{{ URL::to('user/logout') }}" class="btn btn-default btn-flat">Salir</a>
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

                <!-- Sidebar Menu -->
                <ul class="sidebar-menu">
                    <li class="header">MENÚ</li>
                    <!-- Optionally, you can add icons to the links -->

                    @include('adminlte.include.menu')

                </ul>
                <!-- /.sidebar-menu -->
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div style="min-height: 583px;" class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header" style="margin-bottom: 20px;">
                <h1>
                    Panel de Administración <span style="color: #3c8dbc;"><strong>WeBnB</strong></span>
                </h1>
            </section>

            <!-- Main content -->
            <section class="content">

                <!-- Your Page Content Here -->
                @yield('content')

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="pull-right hidden-xs">
                <a href="http://10code.es/">
                    <img src="{{ URL::asset('template/adminLTE/dist/img/custom/logo10.png') }}" style="width: 94.33px; height: 32.27px;">
                </a>
            </div>
            <!-- Default to the left -->
            <strong>Copyright © {{ date('Y') }}. Un producto de <a href="http://10code.es/">10Code</a>.</strong> All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.2.3 -->
    <script type="text/javascript" src="{{ URL::asset('template/adminLTE/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
    <!-- ColorBox Plugin -->
    <script type="text/javascript" src="{{ URL::asset('assets/js/jquery.colorbox.js') }}"></script>

    <!-- Bootstrap 3.3.6 -->
    <script type="text/javascript" src="{{ URL::asset('template/adminLTE/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- DataTables -->
    <script type="text/javascript" src="{{ URL::asset('template/adminLTE/plugins/datatables/jquery.dataTables.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('template/adminLTE/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('template/adminLTE/plugins/datatables/extensions/Responsive/js/dataTables.responsive.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/js/datatables.fnReloadAjax.js') }}"></script>

    <!-- AdminLTE App -->
    <script type="text/javascript" src="{{ URL::asset('template/adminLTE/dist/js/app.min.js') }}"></script>


    <script type="text/javascript">
        $(window).load(function(){

            // RESPONSIVE POPUP

            // ColorBox resize function
            var resizeTimer;
            function resizeColorBox(){
                if (resizeTimer) clearTimeout(resizeTimer);
                resizeTimer = setTimeout(function(){
                    if($('#cboxOverlay').is(':visible')){
                        $.colorbox.resize({width: '80%', height: '80%'});
                    }
                }, 300);
            }

            // Resize ColorBox when resizing window or changing mobile device orientation
            jQuery(window).resize(resizeColorBox);
            window.addEventListener('orientationchange', resizeColorBox, false);
        });

    </script>

    <!-- Optionally, you can add Slimscroll and FastClick plugins.
         Both of these plugins are recommended to enhance the
         user experience. Slimscroll is required when using the
         fixed layout. -->

    @yield('scripts')

    </body>
</html>