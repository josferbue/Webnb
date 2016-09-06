@extends('adminlte.layouts.default')

{{-- Web site Title --}}
@section('title')
    Ubicación :: @parent
@stop

@section('styles')
<style rel="stylesheet">
    iframe{
        width: 100% !important;
    }
</style>
@stop

{{-- Content --}}
@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title">Ubicación</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">

                    {{ Form::model(Ubicacion::first(), array('action' => 'AdminUbicacionLTEController@store', 'method' => 'post')) }}
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group {{{ $errors->has('titulo') ? 'has-error' : '' }}}">
                                {{ Form::label('titulo', 'Título', array('class' => 'control-label')) }}
                                {{ Form::text('titulo', null, array('class' => 'form-control')) }}
                                <p>
                                    <span class="help-block">Campo opcional.</span>
                                </p>
                                {{ $errors->first('titulo', '<span class="help-block">:message</span>') }}
                            </div>
                            <div class="form-group {{{ $errors->has('descripcion') ? 'has-error' : '' }}}">
                                {{ Form::label('descripcion', 'Descripción', array('class' => 'control-label')) }}
                                {{ Form::text('descripcion', null, array('class' => 'form-control')) }}
                                <p>
                                    <span class="help-block">Campo opcional.</span>
                                </p>
                                {{ $errors->first('descripcion', '<span class="help-block">:message</span>') }}
                            </div>
                            <div class="form-group">
                                {{ Ubicacion::first() ? Ubicacion::first()->iframe : null }}
                            </div>
                            <div class="form-group {{{ $errors->has('iframe') ? 'has-error' : '' }}}">
                                {{ Form::label('iframe', 'Iframe', array('class' => 'control-label')) }}
                                {{ Form::textarea('iframe', null, array('class' => 'form-control')) }}
                                {{ $errors->first('iframe', '<span class="help-block">:message</span>') }}
                            </div>
                            <div class="form-group">
                                {{ Form::submit('Crear / Remplazar', array('class' =>  'btn btn-success btn-lg')) }}
                            </div>
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

@stop