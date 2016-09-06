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
            {{-- Edit entrada Form --}}
            <form class="form-horizontal" method="post" action="{{ URL::to('adminlte/eventos/' . $evento->id . '/edit') }}" autocomplete="off">
                <!-- CSRF Token -->
                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                <!-- ./ csrf token -->

                <!-- Tabs contenido -->
                <div class="tab-content">
                    <!-- General tab -->
                    <div class="tab-pane active" id="tab-general">

                        <!-- entrada titulo -->
                        <div class="form-group {{{ $errors->has('titulo') ? 'error' : '' }}}">
                            <div class="col-md-12">
                                <label class="control-label" for="titulo">Titulo</label>
                                <input class="form-control" disabled="disabled" type="text" name="titulo" id="titulo" value="{{{ Input::old('titulo', isset($evento) ? $evento->titulo : null) }}}" />
                                {{ $errors->first('titulo', '<span class="help-block">:message</span>') }}
                            </div>
                        </div>
                        <!-- ./ entrada titulo -->

                        <!-- contenido -->
                        <div class="form-group {{{ $errors->has('contenido') ? 'has-error' : '' }}}">
                            <div class="col-md-12">
                                <label class="control-label" for="contenido">Contenido</label>
                                <textarea class="form-control full-width ckeditor" name="contenido" value="contenido" rows="10">{{{ Input::old('contenido', isset($evento) ? $evento->contenido : null) }}}</textarea>
                                {{ $errors->first('contenido', '<span class="help-block">:message</span>') }}
                            </div>
                        </div>
                        <!-- ./ contenido -->

                    </div>
                    <!-- ./ general tab -->


                </div>
                <!-- ./ tabs contenido -->

                <!-- Form Actions -->

                <button type="submit" class="btn btn-success">Actualizar</button>

                <!-- ./ form actions -->
            </form>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

</div>

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.2.3 -->
<script type="text/javascript" src="{{ URL::asset('template/adminLTE/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<!-- ColorBox Plugin -->
<script type="text/javascript" src="{{ URL::asset('assets/js/jquery.colorbox.js') }}"></script>
<!-- Bootstrap 3.3.6 -->
<script type="text/javascript" src="{{ URL::asset('template/adminLTE/bootstrap/js/bootstrap.min.js') }}"></script>

<!-- AdminLTE App -->
<script type="text/javascript" src="{{ URL::asset('template/adminLTE/dist/js/app.min.js') }}"></script>
<script type="text/javascript">
    $('.close_popup').click(function(){
        parent.jQuery.fn.colorbox.close();
        return false;
    });
</script>
