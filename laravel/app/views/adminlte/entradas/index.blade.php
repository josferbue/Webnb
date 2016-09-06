@extends('adminlte.layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ $title }}} :: @parent
@stop

{{-- Content --}}
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title">Blog</h3>
                    <a href="{{ URL::to('adminlte/blog/create') }}" type="button" style="margin-top: 1em;" class="iframe btn btn-success btn-lg pull-right">Crear</a>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="blog_table" class="table table-bordered table-hover" style="width: 100%;">
                        <thead>
                        <tr>
                            <th>Título</th>
                            <th>Categoría</th>
                            <th>Tags</th>
                            <th>Creado el</th>
                            <th>{{{ Lang::get('table.actions') }}}</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                        <tr>
                            <th>Título</th>
                            <th>Categoría</th>
                            <th>Tags</th>
                            <th>Creado el</th>
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
            oTable = $('#blog_table').dataTable({
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
                "sAjaxSource": "{{ URL::to('adminlte/blog/data') }}",
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