@extends('adminlte.layouts.default')

{{-- Web site Title --}}
@section('title')
    Condiciones de uso :: @parent
@stop

@section('styles')

@stop

{{-- Content --}}
@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title">Condiciones de uso</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    {{ Form::model(Condiciones::first(), array('action' => 'AdminCondicionesDeUsoLTEController@store', 'method' => 'post', 'id' => 'formAnfitrion')) }}
                    <div class="row">

                        <!-- contenido -->

                        <div class="form-group {{{ $errors->has('contenido') ? 'has-error' : '' }}}">
                            <div class="col-md-12">
                                {{ Form::textarea('contenido', null, array('class' => 'form-control full-width ckeditor', 'rows' => '10')) }}
                                {{ $errors->first('contenido', '<span class="help-block">:message</span>') }}
                            </div>
                        </div>

                        <!-- ./ contenido -->

                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            {{ Form::submit('Crear / Remplazar', array('class' => 'btn btn-success btn-lg', 'style' => 'margin-top: 1em; float: right;')) }}
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@stop

{{-- Scripts --}}
@section('scripts')
    <script type="text/javascript" src="{{ URL::asset('template/adminLTE/plugins/ckeditor/ckeditor.js') }}"></script>
@stop