@extends('admin.layouts.modal2'){{-- Content --}}@section('content')    <div id="main-page-content" class="section-container main-page-content clearfix">        <div class="section-content clearfix">           <h3>Solicitud de tutoría</h3>            <br>            <p>                <b>Para</b>: {{$historico_tutorias->email_receptor}}            </p>            <p>                <b>Solicitada por el padre/madre/tutor de</b>: {{$historico_tutorias->nombre}}            </p>            <p>                <b>El día y hora</b>: {{$historico_tutorias->fecha_solicitud}}            </p>            <p>                <b>Teléfono de contacto</b>: {{$historico_tutorias->telefono}}            </p>            <p>                <b>Email de contacto</b>: {{$historico_tutorias->email_emisor}}            </p>            <br>            <p>                <b>MOTIVO DE LA CITA</b>:            </p>            <p style="padding: 1em; border: 1px solid #333333;">                {{$historico_tutorias->mensaje}}            </p>        </div>    </div>@stop