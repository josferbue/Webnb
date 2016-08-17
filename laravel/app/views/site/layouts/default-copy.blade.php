<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <title>
        @yield('title')
    </title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Hermandad de Valme - Dos Hermanas">
    <meta name="author" content="10Code - Desarrollo Software en Sevilla">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{{ asset('assets/img/favicon.ico')}}}">

    <!-- Web Fonts -->
    <link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600&amp;subset=cyrillic,latin'>

    <!-- CSS Global Compulsory -->
    <link rel="stylesheet" href="{{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}}">
    <link rel="stylesheet" href="{{{ asset('assets/css/style.css')}}}">

    <!-- CSS Header and Footer -->
    <link rel="stylesheet" href="{{{ asset('assets/css/headers/header-v4-centered.css')}}}">
    <link rel="stylesheet" href="{{{ asset('assets/css/footers/footer-v2.css')}}}">

    <link rel="stylesheet" href="{{{ asset('assets/plugins/sky-forms-pro/skyforms/css/sky-forms.css')}}}">
    <link rel="stylesheet" href="{{{ asset('assets/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css')}}}">
    <!--[if lt IE 9]><link rel="stylesheet" href="{{{ asset('assets/plugins/sky-forms-pro/skyforms/css/sky-forms-ie8.css')}}}"><![endif]-->

    <link rel="stylesheet" href="{{{ asset('assets/plugins/fancybox/source/jquery.fancybox.css')}}}">
    

    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="{{{ asset('assets/plugins/animate.css')}}}">
    <link rel="stylesheet" href="{{{ asset('assets/plugins/line-icons/line-icons.css')}}}">
    <link rel="stylesheet" href="{{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css')}}}">

    <link href="{{{ asset('assets/css/pages/blog_masonry_3col.css')}}}" rel="stylesheet">
    <link rel="stylesheet" href="{{{ asset('assets/css/pages/shortcode_timeline1.css')}}}">
    
    <link rel="stylesheet" href="{{{ asset('assets/plugins/owl-carousel/owl-carousel/owl.carousel.css')}}}">
    
    <!-- CSS Page Style -->
    <link rel="stylesheet" href="{{{ asset('assets/css/pages/blog_magazine.css')}}}">

    <!-- CSS Theme -->
    <link rel="stylesheet" href="{{{ asset('assets/css/theme-colors/dark-blue.css')}}}">

    <!-- CSS Customization -->
    <link rel="stylesheet" href="{{{ asset('assets/css/custom.css')}}}">
    @yield('styles')
</head>

<body>
<div class="wrapper">
    <!--=== Header v4 ===-->
    <div class="header-v4">
        <!-- Topbar -->
        <div class="topbar-v1">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <ul class="list-inline top-v1-contacts">
                            <li>
                                <i class="fa fa-envelope"></i> <a>info@hermandaddevalme.es</a>
                            </li>
                            <li>
                                <i class="fa fa-phone"></i> 955 664 264
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-6 top-v1-data">
                        <ul class="social-icons">
                            <li><a target="_blank" href="https://www.facebook.com/profile.php?id=100009778356899&fref=ts" data-original-title="Facebook" class="rounded-x social_facebook"></a></li>
                            <li><a target="_blank" href="https://twitter.com/hdad_valme" data-original-title="Twitter" class="rounded-x social_twitter"></a></li>
                            <li><a target="_blank" href="https://plus.google.com/109968252071810241265/about" data-original-title="Goole Plus" class="rounded-x social_googleplus"></a></li>
                        </ul>
                    <!--<ul class="list-inline top-v1-data">
                            <li><a href="#"><img src="assets/img/banderas/es.gif" ></a></li>
                            <li><a href="#"><img src="assets/img/banderas/uk.gif" ></a></li>
                            <li><a href="#"><img src="assets/img/banderas/it.gif" ></a></li>
                        </ul>-->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Topbar -->

        <!-- Navbar -->
        <div class="navbar navbar-default mega-menu" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <div class="row">
                        <a class="navbar-brand" href="index.html">
                            <img class="img-responsive" id="logo-header" src="{{{ asset('assets/img/cabecera.png')}}}" alt="Logo">
                        </a>
                    </div>
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                        <span class="full-width-menu">Menu</span>
                        <span class="icon-toggle">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </span>
                    </button>
                </div>
            </div>

            <div class="clearfix"></div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-responsive-collapse">
                <div class="container">
                    <ul class="nav navbar-nav">
                        <!-- Home -->
                        <li class="active">
                            <a href="{{URL::to('Inicio')}}">Inicio</a>
                        </li>
                        <!-- End Home -->

                        <!-- Pages -->
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                                Váleme Señora
                            </a>
                            <ul class="dropdown-menu">
                                <!-- About Pages -->
                                <li><a href="{{URL::to('Origen-de-la-Advocacion')}}">Origen de la Advocación</a></li>
                                <li><a href="{{URL::to('La-Virgen-de-Valme')}}">La Virgen de Valme</a></li>
                                <li><a href="{{URL::to('San-Fernando')}}">San Fernando</a></li>
                                <li><a href="{{URL::to('El-Pendon')}}">El Pendón</a></li>
                                <li><a href="{{URL::to('La-Ermita-de-Cuarto')}}">La Ermita de Cuarto</a></li>
                                <li><a href="{{URL::to('La-Capilla-Sacramental')}}">La Capilla Sacramental</a></li>
                                <li><a href="{{URL::to('Indulgencia-Perpetua')}}">Indulgencia Perpetua</a></li>
                                <li><a href="{{URL::to('Coronacion-Canonica')}}">Coronación Canónica</a></li>                                
                                <li><a href="{{URL::to('Valme-y-Dos-Hermanas')}}">Valme y Dos Hermanas</a></li>
                                <li><a href="{{URL::to('Valme-en-Sevilla')}}">Valme en Sevilla</a></li>
                                <li><a href="{{URL::to('Valme-en-Roma')}}">Valme en Roma</a></li>
                                <!-- End About Pages -->
                                <!-- End Sub Level Menu -->
                            </ul>
                        </li>
                        <!-- End Pages -->

                        <!-- Blog -->
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                                Hermandad
                            </a>
                            <ul class="dropdown-menu">
                                <!-- About Pages -->
                                <li><a href="{{URL::to('Origen-e-Historia')}}">Origen e Historia</a></li>
                                <li><a href="{{URL::to('Reglas')}}">Reglas</a></li>
                                <li><a href="{{URL::to('Sede')}}">Sede</a></li>
                                <li><a href="{{URL::to('El-Director-Espiritual')}}">El Director Espiritual</a></li>
                                <li><a href="{{URL::to('Hermano-Mayor')}}">Hermano Mayor</a></li>
                                <li><a href="{{URL::to('Junta-de-Gobierno')}}">Junta de Gobierno</a></li>
                                <li class="dropdown-submenu">
                                    <a href="javascript:void(0);">Grupos</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{URL::to('Carreteros-y-Galeristas')}}">Carreteros y Galeristas</a></li>
                                        <li><a href="{{URL::to('Coro')}}">Coro</a></li>
                                        <li><a href="{{URL::to('Grupo-Inicial')}}">Grupo Inicial</a></li>
                                    </ul>
                                </li>
                                <!-- End About Pages -->
                                <!-- End Sub Level Menu -->
                            </ul>

                        </li>
                        <!-- End Blog -->
                        
                        <li class="">
                            <a href="{{URL::to('Romeria')}}">
                               La Romería
                            </a>

                        </li>
                        
                        <!-- Pages -->
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                                Fines
                            </a>
                            <ul class="dropdown-menu">
                                <!-- About Pages -->
                                <li><a href="{{URL::to('Cultos')}}">Cultos</a></li>
                                <li><a href="{{URL::to('Obras-Sociales')}}">Obras Sociales</a></li>
                                <li><a href="{{URL::to('Memoria-Anual')}}">Memoria Anual</a></li>
                                <!-- End About Pages -->
                                <!-- End Sub Level Menu -->
                            </ul>
                        </li>
                        <!-- End Pages -->

                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                                Patrimonio
                            </a>
                            <ul class="dropdown-menu">
                                <!-- About Pages -->
                                <li><a href="{{URL::to('Titulos-y-Privilegios')}}">Títulos y Privilegios</a></li>
                                <li><a href="{{URL::to('Artistico')}}">Artístico</a></li>
                                <li><a href="{{URL::to('Literario')}}">Literario</a></li>
                                <li><a href="{{URL::to('Musical')}}">Musical</a></li>
                                <li><a href="{{URL::to('Archivo-Historico')}}">Archivo Histórico</a></li>
                                <!-- End About Pages -->
                                <!-- End Sub Level Menu -->
                            </ul>
                        </li>
                        <!-- End Pages -->

                        <!-- Blog -->
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                                Publicaciones
                            </a>
                            <ul class="dropdown-menu">
                                <!-- About Pages -->
                                <li><a href="{{URL::to('Hoja-Informativa-Valeme')}}">Hoja Informativa Váleme</a></li>
                                <li><a href="{{URL::to('Diario-del-Ave-Maria')}}">Diario del Ave María</a></li>
                                <li><a href="{{URL::to('Pregones')}}">Pregones</a></li>
                                <li><a href="{{URL::to('Carteles-de-Romeria')}}">Carteles de Romería</a></li>
                                <li class="dropdown-submenu">
                                    <a href="javascript:void(0);">Galería Multimedia</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{URL::to('Imagenes')}}">Imágenes</a></li>
                                        <li><a href="{{URL::to('Videos')}}">Vídeos</a></li>
                                    </ul>
                                </li>
                                <!-- End About Pages -->
                                <!-- End Sub Level Menu -->
                            </ul>

                        </li>
                        <!-- End Blog -->

                        <li class="">
                            <a href="{{URL::to('Vida-de-Hermandad')}}">
                                Vida de Hermandad
                            </a>

                        </li>
                        <!--<li class="">
                            <a href="{{URL::to('Contacto')}}">
                                Contacto
                            </a>

                        </li>-->
                        <!-- End Misc Pages -->
                    </ul>

                </div><!--/end container-->
            </div><!--/navbar-collapse-->
        </div>
        <!-- End Navbar -->
    </div>
    <!--=== End Header v4 ===-->

    <!--=== Content Part ===-->
    <div class="container content">
       @yield('content')
    </div><!--/container-->
    <!-- End Content Part -->

    <!--=== Footer v2 ===-->
    <div id="footer-v2" class="footer-v2">
        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 md-margin-bottom-40">
                        <div class="headline"><h2 class="heading-sm">Sobre la Hermandad</h2></div>
                        <ul class="list-unstyled link-list">
                            <li><a href="{{URL::to('Inicio')}}">Inicio</a><i class="fa fa-angle-right"></i></li>
                            <li><a href="{{URL::to('Reglas')}}">Reglas</a><i class="fa fa-angle-right"></i></li>
                            <li><a href="{{URL::to('Romeria')}}">Romeria</a><i class="fa fa-angle-right"></i></li>
                            <li><a href="{{URL::to('Contacto')}}">Contacto</a><i class="fa fa-angle-right"></i></li>
                            <li><a href="{{URL::to('Aviso-Legal')}}">Aviso Legal</a><i class="fa fa-angle-right"></i></li>
                        </ul>
                    </div>
                    
                    

                    <!-- About -->
                    <center>
                        <div class="col-md-3 md-margin-bottom-40" >
                            <a href="index.html"><img style="width: 95px; height: 110px;" id="logo-footer" class="footer-logo" src="{{{ asset('assets/img/sliders/romeria/escudo.png')}}}" alt=""></a>
                            <p class="margin-bottom-20">Pontificia, Real e Ilustre Hermandad de Nuestra Señora de Valme Coronada <br /> y San Fernando.</p>
                            <p class="margin-bottom-20"><i>C.I.F.: G-41.473.091 - Inscrita en el Registro de Entidades Religiosas, Nº 3268 - SE/C</i></p>
    
    
                        </div>
                    </center>
                    <!-- End About -->

                    <!-- Link List -->

                    <!-- End Link List -->

                    <!-- Latest Tweets -->

                    <!-- End Latest Tweets -->

                    <!-- Address -->
                    <div class="col-md-3 md-margin-bottom-40">
                        <div class="headline"><h2 class="heading-sm">Contacto</h2></div>
                        <address class="md-margin-bottom-40">
                            <i class="fa fa-home"></i>Avda. de Andalucía s/n<br />
                            Apartado de correos 254<br />
                            41700 | Dos Hermanas (Sevilla)<br />
                            <i class="fa fa-phone"></i> 955 664 264 <br />
                            <i class="fa fa-envelope"></i> <a>info@hermandaddevalme.es</a>
                        </address>

                        <!-- Social Links -->
                        <ul class="social-icons">
                            <li><a target="_blank" href="https://www.facebook.com/profile.php?id=100009778356899&fref=ts" data-original-title="Facebook" class="rounded-x social_facebook"></a></li>
                            <li><a target="_blank" href="https://twitter.com/hdad_valme" data-original-title="Twitter" class="rounded-x social_twitter"></a></li>
                            <li><a target="_blank" href="https://plus.google.com/109968252071810241265/about" data-original-title="Goole Plus" class="rounded-x social_googleplus"></a></li>
                        </ul>
                        <!-- End Social Links -->
                    </div>
                    <!-- End Address -->
                    
                    <div class="col-md-3 md-margin-bottom-40">
                        <div class="headline"><h2 class="heading-sm">Enlaces de interés</h2></div>
                        <ul class="list-unstyled link-list">
                            <li><a target="_blank" href="http://www.archisevilla.org/">Archidiócesis de Sevilla</a><i class="fa fa-angle-right"></i></li>
                            <li><a target="_blank" href="http://www.doshermanas.es/dher/opencms/dher/portal/">EXCMO. AYUNTAMIENTO de Dos Hermanas</a><i class="fa fa-angle-right"></i></li>
                            <li><a target="_blank" href="http://arciprestazgodoshermanas.es/">Arciprestazgo Dos Hermanas</a><i class="fa fa-angle-right"></i></li>                            
                            <li><a target="_blank" href="http://www.valme.net/">Nostra Signora di Valme</a><i class="fa fa-angle-right"></i></li>
                            <li><a target="_blank" href="http://cofdh.es/">COF Dos Hermanas</a><i class="fa fa-angle-right"></i></li>
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div><!--/footer-->

        <div class="copyright">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <p>
                            &copy; 2015 Hermandad de Valme | Developed By <a target="_blank" href="http://www.10code.es"><img src="http://10code.es/img/logo.png" style="max-width: 100px; max-height: 23px; "/></a>
                        </p>
                    </div>
                </div>
            </div>
        </div><!--/copyright-->
    </div>
    <!--=== End Footer Version 1 ===-->
</div><!--/wrapper-->

<script type="text/javascript">
document.oncontextmenu = function(){return false;}
</script>
<!-- JS Global Compulsory -->
<script type="text/javascript" src="{{{ asset('assets/plugins/jquery/jquery.min.js')}}}"></script>
<script type="text/javascript" src="{{{ asset('assets/plugins/jquery/jquery-migrate.min.js')}}}"></script>
<script type="text/javascript" src="{{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}}"></script>
<!-- JS Implementing Plugins -->
<script type="text/javascript" src="{{{ asset('assets/plugins/back-to-top.js')}}}"></script>
<script type="text/javascript" src="{{{ asset('assets/plugins/smoothScroll.js')}}}"></script>

<script type="text/javascript" src="{{{ asset('assets/plugins/owl-carousel/owl-carousel/owl.carousel.js')}}}"></script>
<script type="text/javascript" src="{{{ asset('assets/plugins/masonry/jquery.masonry.min.js')}}}"></script>

<!-- JS Customization -->
<script type="text/javascript" src="{{{ asset('assets/js/custom.js')}}}"></script>
<!-- JS Page Level -->
<script type="text/javascript" src="{{{ asset('assets/js/app.js')}}}"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        App.init();
    });
</script>
<!--[if lt IE 9]>
<script src="{{{ asset('assets/plugins/respond.js')}}}"></script>
<script src="{{{ asset('assets/plugins/html5shiv.js')}}}"></script>
<script src="{{{ asset('assets/plugins/placeholder-IE-fixes.js')}}}"></script>
<![endif]-->
@yield('scripts')
</body>
</html>
