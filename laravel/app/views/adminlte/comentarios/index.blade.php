@extends('adminlte.layouts.default')

{{-- Web site Title --}}
@section('title')
    Comentarios :: @parent
@stop


@section('styles')
@stop
{{-- Content --}}
@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title">Comentarios</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="comentarios_table" class="table table-bordered table-hover" style="width: 100%;">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Valoración</th>
                            <th>Publicado</th>
                            <th>{{{ Lang::get('table.actions') }}}</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Valoración</th>
                            <th>Publicado</th>
                            <th>{{{ Lang::get('table.actions') }}}</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>

    <div id="message_comentarios">

    </div>
@stop

{{-- Scripts --}}
@section('scripts')
    <script type="text/javascript">

        var oTable;
        $(window).load(function(){
            oTable = $('#comentarios_table').dataTable({
                "oLanguage": {
                    "sLengthMenu": "_MENU_ registros por página.",
                    'sInfo': 'Mostrando de _START_ a _END_ de _TOTAL_ registros.',
                    'sLoadingRecords': 'Espere por favor - cargando...',
                    'sProcessing': '<div class="overlay"> <i class="fa fa-refresh fa-spin"></i></div>',
                    'sInfoEmpty': 'No hay registros que mostrar.'
                },
                responsive: true,
                "bProcessing": true,
                "bServerSide": true,
                "sAjaxSource": "{{ URL::to('adminlte/comentarios/data') }}",
                "fnDrawCallback": function ( oSettings ){
                    $("input[type=checkbox]").change(publicar);

                    $(".iframe").colorbox({
                        iframe: true,
                        width:'80%',
                        height:'80%',
                        maxWidth:'80%',
                        maxHeight:'80%',
                        overlayClose: false,
                        onLoad: function(){
                            $('#cboxClose').remove();
                            $.colorbox.resize();
                        }
                    });

                    $(".dataTable").on('click','.iframe', function(){
                        $(this).colorbox({
                            iframe: true,
                            width:'80%',
                            height:'80%',
                            maxWidth:'80%',
                            maxHeight:'80%',
                            overlayClose: false,
                            onLoad: function(){
                                $('#cboxClose').remove();
                                $.colorbox.resize();
                            }
                        });
                    });
                }
            });
        });

        //Publicaciones vía AJAX

        function publicar(){

            var iPublicado = 0;
            var sCadena = 'despublicado';

            if($(this).prop('checked')){
                sCadena = 'publicado';
                iPublicado = 1;
            }

            var jqAjax = $.ajax({
                            url: '{{ URL::to('adminlte/comentarios/publicar') }}',
                            type: 'GET',
                            async: true,
                            data: 'comentario='+$(this).val()+'&publicado='+iPublicado,
                            dataType: 'json'
                        }).always(function(){
                            if(jqAjax.responseText == 'success'){
                                if(iPublicado == 1)
                                    $('#message_comentarios').prepend(
                                            $('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button> <strong>¡Hecho!</strong> El comentario fue <strong>'+sCadena+'</strong> satisfactoriamente. </div>').queue('fx', function(){
                                                $(this).delay(3000).fadeOut(500, 'linear', function(){
                                                    $(this).remove();
                                                });
                                            }
                                    )).find('div:first-child').dequeue('fx');
                                else
                                    $('#message_comentarios').prepend(
                                            $('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button> <strong>¡Hecho!</strong> El comentario fue <strong>'+sCadena+'</strong> satisfactoriamente. </div>').queue('fx', function(){
                                                $(this).delay(3000).fadeOut(500, 'linear', function(){
                                                     $(this).remove();
                                                });
                                            }
                                    )).find('div:first-child').dequeue('fx');
                            }
                            else if(jqAjax.responseText == 'error'){
                                $('#message_comentarios').prepend(
                                        $('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button> <strong>¡Error!</strong> El comentario no existe. </div>')
                                );
                            }
                            else{
                                $('#message_comentarios').prepend(
                                        $('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button> <strong>¡Error!</strong> Ha sucedido un error inesperado. </div>')
                                );
                            }
                        });
        }

    </script>
@stop