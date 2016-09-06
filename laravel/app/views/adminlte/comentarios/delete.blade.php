@extends('adminlte.layouts.modal')

{{-- Content --}}
@section('content')

    <!-- ./ tabs -->
    {{-- Delete Post Form --}}

    {{ Form::open(array('action' => array('AdminComentariosLTEController@destroy', $comentario->id), 'method' => 'delete', 'id' => 'deleteForm')) }}
        <div class="form-group">
            <div class="controls">
                Va a proceder a borrar definitivamente el comentario, ¿está seguro?
                <button type="submit" class="btn btn-danger">Borrar</button>
            </div>
        </div>
    {{ Form::close() }}




@stop