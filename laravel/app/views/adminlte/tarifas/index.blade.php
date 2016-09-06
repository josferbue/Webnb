@extends('adminlte.layouts.default')

{{-- Web site Title --}}
@section('title')
    Tarifas :: @parent
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
    </style>
@stop

{{-- Content --}}
@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title">Tarifas</h3>
                    <a href="{{ URL::to('adminlte/tarifas/create') }}" type="button" style="margin-top: 1em;" class="iframe btn btn-success btn-lg pull-right">Crear</a>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="tarifas_table" class="table table-bordered table-hover" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Alias</th>
                                <th>Fecha&nbsp;Inicio</th>
                                <th>Fecha&nbsp;Fin</th>
                                <th>Tarifa&nbsp;Mínima</th>
                                <th>Precio Noche</th>
                                <th>Precio Semana</th>
                                <th>Noches&nbsp;Mínimas</th>
                                <th>{{{ Lang::get('table.actions') }}}</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                            <tr>
                                <th>Alias</th>
                                <th>Fecha&nbsp;Inicio</th>
                                <th>Fecha&nbsp;Fin</th>
                                <th>Tarifa&nbsp;Mínima</th>
                                <th>Precio Noche</th>
                                <th>Precio Semana</th>
                                <th>Noches&nbsp;Mínimas</th>
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
@stop

{{-- Scripts --}}

@section('scripts')
    <script type="text/javascript">
        var oTable;
        $(window).load(function(){
            oTable = $('#tarifas_table').dataTable({
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
                "sAjaxSource": "{{ URL::to('adminlte/tarifas/data') }}",
                "fnDrawCallback": function ( oSettings ){
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