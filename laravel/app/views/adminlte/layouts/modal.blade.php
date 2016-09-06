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
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ URL::asset('template/adminLTE/dist/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->

    <link rel="stylesheet" href="{{ URL::asset('template/adminLTE/dist/css/skins/skin-blue.min.css') }}">

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
<body>
<div style="font-size: 1.2em">
    <!-- Content Wrapper. Contains page content -->
    <div class="container">
        <section class="content-header" style="margin-top: 2em; margin-bottom: 1em;">
            <h1>
                {{ $title }}
                <div class="pull-right">
                    <button class="btn btn-default close_popup"><span class="glyphicon glyphicon-circle-arrow-left"></span> Atrás</button>
                </div>
                <hr>
            </h1>
        </section>
        <section class="notifications" style="margin-top: 1em; margin-bottom: 1em;">
            @include('notifications')
        </section>
        <!-- Main content -->
        <section class="content">

            <!-- Your Page Content Here -->
            @yield('content')

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

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
<script src="{{ URL::asset('assets/js/datatables.fnReloadAjax.js') }}"></script>

<!-- AdminLTE App -->
<script type="text/javascript" src="{{ URL::asset('template/adminLTE/dist/js/app.min.js') }}"></script>

<!-- Cierra Popup, recarga datatable, elimina items... -->
<script type="text/javascript">
    $('.close_popup').click(function(){
        parent.oTable.fnReloadAjax();
        parent.jQuery.fn.colorbox.close();
        return false;
    });

    $('#deleteForm').submit(function(event){
        var form = $(this);
        $.ajax({
            type: form.attr('method'),
            url: form.attr('action'),
            data: form.serialize()
        }).done(function() {
            parent.jQuery.colorbox.close();
            parent.oTable.fnReloadAjax();
        }).fail(function(){
        });
        event.preventDefault();
    });

</script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->

@yield('scripts')

</body>
</html>