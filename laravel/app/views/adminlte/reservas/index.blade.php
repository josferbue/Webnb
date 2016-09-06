@extends('adminlte.layouts.default')

{{-- Web site Title --}}
@section('title')
    Reservas :: @parent
@stop

@section('styles')
    <style rel="stylesheet">
        .btn-app{
            padding: 5px !important;
            height: 25px !important;
            min-width: 30px !important;
            margin: 0 !important;
        }

        .btn-app i{
            position: relative;
            top: 1px;
            font-size: 1em !important;
        }

        li[data-dtr-index='5']{
            display: none !important;
        }

    </style>
@stop

{{-- Content --}}
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title">Reservas</h3>
                    <a href="{{ URL::to('adminlte/reservas/create') }}" type="button" style="margin-top: 1em;" class="iframe btn btn-success btn-lg pull-right">Crear</a>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="reservas_table" class="table table-bordered table-hover" style="width: 100%;">
                        <thead>
                        <tr>
                            <th>Llegada</th>
                            <th>Salida</th>
                            <th>Teléfono</th>
                            <th>Email</th>
                            <th>Nombre</th>
                            <th class="pagado">Pagado</th>
                            <th>{{{ Lang::get('table.actions') }}}</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                        <tr>
                            <th>Llegada</th>
                            <th>Salida</th>
                            <th>Teléfono</th>
                            <th>Email</th>
                            <th>Nombre</th>
                            <th class="pagado">Pagado</th>
                            <th>{{{ Lang::get('table.actions') }}}</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>

        <div class="col-xs-12">
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    <p style="color: red;"><i class="fa fa-times" aria-hidden="true"></i> Las filas con el fondo rojo pertenecen a las reservas <strong>NO</strong> PAGADAS.*</p>
                    <p style="color: green;"><i class="fa fa-check" aria-hidden="true"></i> Las filas con el fondo verde pertenecen a las reservas PAGADAS.*</p>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@stop

{{-- Scripts --}}

@section('scripts')
    <script type="text/javascript">
        var oTable;
        $(window).load(function(){
            oTable = $('#reservas_table').dataTable({
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
                "sAjaxSource": "{{ URL::to('adminlte/reservas/data') }}",
                "fnDrawCallback": function ( oSettings ){
                    $('span.pagado').parent().parent().css({backgroundColor : 'rgb(229, 251, 225)'});
                    $('span.no-pagado').parent().parent().css({backgroundColor : 'rgb(255, 201, 201)'});

                    $('span.pagado').parent().css({display : 'none'});
                    $('span.no-pagado').parent().css({display : 'none'});

                    $('th.pagado').css({display : 'none'});

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
    </script>
@stop