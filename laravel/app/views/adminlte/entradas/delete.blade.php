@extends('adminlte.layouts.modal')

{{-- Content --}}
@section('content')


    {{-- Delete Post Form --}}
    <form id="deleteForm" class="form-horizontal" method="post" action="@if (isset($entrada)){{ URL::to('adminlte/blog/' . $entrada->id . '/delete') }}@endif" autocomplete="off">
        
        <!-- CSRF Token -->
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
        <input type="hidden" name="id" value="{{ $entrada->id }}" />
        <!-- <input type="hidden" name="_method" value="DELETE" /> -->
        <!-- ./ csrf token -->

        <!-- Form Actions -->
        <div class="form-group">
            <div class="controls">
                Va a proceder a borrar definitivamente la entrada, ¿está seguro?
                &nbsp;&nbsp;<button type="submit" class="btn btn-danger">Borrar</button>
            </div>
        </div>
        <!-- ./ form actions -->
    </form>
@stop