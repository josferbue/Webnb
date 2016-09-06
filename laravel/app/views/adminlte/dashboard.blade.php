@extends('adminlte.layouts.default')

@section('content')
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{ $reservasPendientesDeConfirmar }}</h3>

                    <p>Reservas pendientes de confirmar</p>
                </div>
                <div class="icon">
                    <i class="fa fa-question" aria-hidden="true"></i>
                </div>
                <a href="{{ URL::to('adminlte/reservas') }}" class="small-box-footer">
                    Ver <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{ $reservasConfirmadasEsteAnyo }}</h3>

                    <p>Reservas confirmadas este año en curso</p>
                </div>
                <div class="icon">
                    <i class="fa fa-check-square-o" aria-hidden="true"></i>
                </div>
                <a href="{{ URL::to('adminlte/reservas') }}" class="small-box-footer">
                    Ver <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{ $comentariosPendientesDeConfirmar }}</h3>

                    <p>Comentarios pendientes de validar</p>
                </div>
                <div class="icon">
                    <i class="fa fa-comments" aria-hidden="true"></i>
                </div>
                <a href="{{ URL::to('adminlte/comentarios') }}" class="small-box-footer">
                    Ver <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>{{ $eventosParaHoy }}</h3>

                    <p>Eventos para hoy</p>
                </div>
                <div class="icon">
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                </div>
                <a href="{{ URL::to('adminlte/eventos') }}" class="small-box-footer">
                    Ver <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
    </div>
@stop