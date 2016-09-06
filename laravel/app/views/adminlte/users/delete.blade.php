@extends('adminlte.layouts.modal')

{{-- Content --}}
@section('content')

    {{-- Delete User Form --}}
    <form id="deleteForm" class="form-horizontal" method="post" action="@if (isset($user)){{ URL::to('admin/users/' . $user->id . '/delete') }}@endif" autocomplete="off">
        <!-- CSRF Token -->
        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
        <input type="hidden" name="id" value="{{ $user->id }}" />
        <!-- ./ csrf token -->

        <!-- Form Actions -->
        <div class="form-group">
            <div class="controls">
                &nbsp;&nbsp;<button type="submit" class="btn btn-danger">Borrar</button>
            </div>
        </div>
        <!-- ./ form actions -->
    </form>
@stop