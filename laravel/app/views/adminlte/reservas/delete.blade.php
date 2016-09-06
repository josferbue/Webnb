@extends('adminlte.layouts.modal')

{{-- Content --}}
@section('content')

    {{-- Delete Post Form --}}

    {{ Form::open(array('action' => array('AdminReservasLTEController@destroy', $reserva->id), 'method' => 'delete', 'id' => 'deleteForm')) }}
        <div class="form-group">
            <div class="controls">
                Va a proceder a borrar definitivamente la reserva, ¿está seguro?
                <button type="submit" class="btn btn-danger">Borrar</button>
            </div>
        </div>
    {{ Form::close() }}




@stop