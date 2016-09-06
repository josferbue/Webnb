@extends('adminlte.layouts.modal')

{{-- Content --}}
@section('content')

    {{-- Delete Post Form --}}

    {{ Form::open(array('action' => array('AdminTarifasLTEController@destroy', $configuracion->id), 'method' => 'delete', 'id' => 'deleteForm')) }}
        <div class="form-group">
            <div class="controls">
                Va a proceder a borrar definitivamente la tarifa, ¿está seguro?&nbsp;&nbsp;
                <button type="submit" class="btn btn-danger">Borrar</button>
            </div>
        </div>
    {{ Form::close() }}




@stop