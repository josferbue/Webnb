<?php



class AdminDashboardLTEController extends AdminController {



    /**

     * Admin dashboard

     *

     */

    public function getIndex()

    {

        $reservasPendientesDeConfirmar      =   Reserva::where('pendiente', '1')->count();
        $reservasConfirmadasEsteAnyo        =   Reserva::where('pagado', '1')->count();
        $comentariosPendientesDeConfirmar   =   Comentario::where('publicado', '0')->count();;
        $eventosParaHoy                     =   Evento::where('fecha_inicio', '<=', new DateTime)->where('fecha_fin', '>=', new DateTime)->count();


        return View::make('adminlte/dashboard', compact('reservasPendientesDeConfirmar', 'reservasConfirmadasEsteAnyo', 'comentariosPendientesDeConfirmar', 'eventosParaHoy'));

    }



}