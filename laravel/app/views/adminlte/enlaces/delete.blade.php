@extends('adminlte.layouts.modal')

{{-- Content --}}
@section('content')

    {{-- Delete Post Form --}}
    <form id="deleteForm" class="form-horizontal" method="post" action="@if (isset($enlace)){{ URL::to('adminlte/enlace/' . $enlace->id . '/delete') }}@endif" autocomplete="off">
        
        <!-- CSRF Token -->
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
        <input type="hidden" name="id" value="{{ $enlace->id }}" />
        <!-- <input type="hidden" name="_method" value="DELETE" /> -->
        <!-- ./ csrf token -->

        <!-- Form Actions -->
        <div class="form-group">
            <div class="controls">
                ¿Está seguro de que desea borrar el enlace de esta entrada?&nbsp;&nbsp;
                <button type="submit" class="btn btn-danger">Borrar</button>
            </div>
        </div>
        <!-- ./ form actions -->
    </form>
@stop