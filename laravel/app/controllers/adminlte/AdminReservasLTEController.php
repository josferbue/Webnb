<?php

class AdminReservasLTEController extends \AdminController {


    public function __construct(){

        //Filtro para peticiones solo vía Ajax

        $this->beforeFilter('ajax',
            array('only' =>
                array(
                    'getData'
                )
            )
        );
    }

    public function index(){
        return View::make('adminlte.reservas.index');
    }

    public function create(){
        $unavailable = Reserva::unavailables();
        $unavailable_on = '';

        JavaScript::put([
            'unavailable' => $unavailable,
        ]);

        if($unavailable == null){
            return Redirect::to('adminlte/reservas');
        }

        $title = 'Crear Reserva';
        $text_button_submit = 'Crear';

        $horas = array();

        for($i=8; $i<=20; $i++){
            $horas[$i.':00'] = $i.':00';
            $horas[$i.':30'] = $i.':30';
        }

        array_pop($horas);

        return View::make('adminlte/reservas/create_edit', compact('title', 'text_button_submit', 'horas', 'unavailable_on'));
    }

    public function store(){
        //Cambiar fechas de formato

        Input::merge(array('fecha_ini' => date('Y-m-d', strtotime(Input::get('fecha_ini')))));
        Input::merge(array('fecha_fin' => date('Y-m-d', strtotime(Input::get('fecha_fin')))));
        Input::merge(array('fecha_nacimiento' => date('Y-m-d', strtotime(Input::get('fecha_nacimiento')))));
        Input::merge(array('fecha_expedicion' => date('Y-m-d', strtotime(Input::get('fecha_expedicion')))));

        $validator = Reserva::validate(Input::except('_token'));

        if($validator->fails()){

            Input::merge(array('fecha_ini' => date('d-m-Y', strtotime(Input::get('fecha_ini')))));
            Input::merge(array('fecha_fin' => date('d-m-Y', strtotime(Input::get('fecha_fin')))));
            Input::merge(array('fecha_nacimiento' => date('d-m-Y', strtotime(Input::get('fecha_nacimiento')))));
            Input::merge(array('fecha_expedicion' => date('d-m-Y', strtotime(Input::get('fecha_expedicion')))));

            return Redirect::action('AdminReservasLTEController@create')->withInput()->withErrors($validator);
        }


        $reserva_disponible     =   Reserva::validate_dates_reserva(Input::get('fecha_ini'), Input::get('fecha_fin'));

        if($reserva_disponible['success'] == 0){

            Input::merge(array('fecha_ini' => date('d-m-Y', strtotime(Input::get('fecha_ini')))));
            Input::merge(array('fecha_fin' => date('d-m-Y', strtotime(Input::get('fecha_fin')))));
            Input::merge(array('fecha_nacimiento' => date('d-m-Y', strtotime(Input::get('fecha_nacimiento')))));
            Input::merge(array('fecha_expedicion' => date('d-m-Y', strtotime(Input::get('fecha_expedicion')))));

            Input::flash();

            return Redirect::to('adminlte/reservas/create')->with('error', 'No puede haber una reserva existente entre el intervalo de las dos fechas seleccionadas.');

        }

        //Almacenar en la BBDD

        $nombre             =   Input::get('nombre');
        $email              =   Input::get('email');
        $dni                =   Input::get('dni');
        $adultos            =   Input::get('adultos');
        $ninos              =   Input::get('ninos');
        $fecha_ini          =   Input::get('fecha_ini');
        $fecha_fin          =   Input::get('fecha_fin');
        $precio             =   Reserva::precio_dates($fecha_ini,$fecha_fin);
        $pais               =   Input::get('pais_nacionalidad');
        $fecha_nacimiento   =   Input::get('fecha_nacimiento');
        $fecha_expedicion   =   Input::get('fecha_expedicion');
        $hora_llegada       =   Input::get('hora_llegada');

        DB::table('reservas')->insert(array(
            array(
                'nombre'            => $nombre,
                'email'             => $email,
                'telefono'          => Input::get('telefono'),
                'dni'               => $dni,
                'adultos'           => $adultos,
                'ninos'             => $ninos,
                'precio'            => $precio,
                'observaciones'     => Input::get('observaciones'),
                'fecha_ini'         => $fecha_ini,
                'fecha_fin'         => $fecha_fin,
                'fecha_nacimiento'  => $fecha_nacimiento,
                'fecha_expedicion'  => $fecha_expedicion,
                'pais_nacionalidad' => $pais,
                'hora_llegada'      => $hora_llegada
            )
        ));

        Input::merge(array('fecha_ini' => date('d-m-Y', strtotime(Input::get('fecha_ini')))));
        Input::merge(array('fecha_fin' => date('d-m-Y', strtotime(Input::get('fecha_fin')))));
        Input::merge(array('fecha_nacimiento' => date('d-m-Y', strtotime(Input::get('fecha_nacimiento')))));
        Input::merge(array('fecha_expedicion' => date('d-m-Y', strtotime(Input::get('fecha_expedicion')))));

        return Redirect::action('AdminReservasLTEController@create')->with('success', 'Reserva dada de alta correctamente.');
    }

    public function edit($id){
        $reserva = Reserva::find($id);
        $title = 'Editar Reserva';
        $text_button_submit = 'Actualizar';

        $horas = array();

        for($i=8; $i<=20; $i++){
            $horas[$i.':00'] = $i.':00';
            $horas[$i.':30'] = $i.':30';
        }

        array_pop($horas);

        return View::make('adminlte/reservas/create_edit', compact('reserva', 'title', 'text_button_submit', 'horas'));
    }


    public function update($id){

        Input::merge(array('fecha_nacimiento' => date('Y-m-d', strtotime(Input::get('fecha_nacimiento')))));
        Input::merge(array('fecha_expedicion' => date('Y-m-d', strtotime(Input::get('fecha_expedicion')))));

        $validator = Reserva::validate(Input::except('_token', 'fecha_ini', 'fecha_fin'));

        if($validator->fails())
            return Redirect::action('AdminReservasLTEController@edit', array($id))->withErrors($validator);

        //Almacenar en la BBDD

        $nombre             =   Input::get('nombre');
        $email              =   Input::get('email');
        $dni                =   Input::get('dni');
        $adultos            =   Input::get('adultos');
        $ninos              =   Input::get('ninos');
        $precio             =   Input::get('precio');
        $pais               =   Input::get('pais_nacionalidad');
        $fecha_nacimiento   =   Input::get('fecha_nacimiento');
        $fecha_expedicion   =   Input::get('fecha_expedicion');
        $hora_llegada       =   Input::get('hora_llegada');


        DB::table('reservas')
            ->where('id', $id)
            ->update(array(
                    'nombre'            => $nombre,
                    'email'             => $email,
                    'telefono'          => Input::get('telefono'),
                    'dni'               => $dni,
                    'adultos'           => $adultos,
                    'ninos'             => $ninos,
                    'precio'            => $precio,
                    'observaciones'     => Input::get('observaciones'),
                    'fecha_nacimiento'  => $fecha_nacimiento,
                    'fecha_expedicion'  => $fecha_expedicion,
                    'pais_nacionalidad' => $pais,
                    'hora_llegada'      => $hora_llegada
                )
            );

        return Redirect::to('adminlte/reservas/'.$id.'/edit')->with('success', 'Reserva actualizada correctamente.');
    }


    public function destroy(Reserva $reserva){

        $reserva->delete();

        return Redirect::action('AdminReservasLTEController@index');
    }

    public function getData(){
        $reservas = Reserva::select(array('reservas.id', 'reservas.fecha_ini', 'reservas.fecha_fin', 'reservas.telefono', 'reservas.email', 'reservas.nombre','reservas.pagado','reservas.pendiente'))->orderBy('created_at', 'ASC');

        return Datatables::of($reservas)

            ->add_column('actions',
                '
                <div>
                @if(!$pagado)
                <a href="{{{ URL::to(\'adminlte/reservas/\' . $id . \'/pago\' ) }}}" class="btn btn-success iframe">Pagar</a>
                @endif
                <a href="{{{ URL::to(\'adminlte/reservas/\' . $id . \'/edit\' ) }}}" class="btn btn-default iframe">Editar</a>
            	@if(!$pagado)
            	<a href="{{{ URL::to(\'adminlte/reservas/\' . $id . \'/delete\' ) }}}" class="btn btn-danger iframe">Borrar</a>
            	@endif
            	</div>'

            )
            ->edit_column('fecha_ini', '
                {{ date_format(new DateTime($fecha_ini), "d/m/Y") }}
            ')
            ->edit_column('fecha_fin', '
                {{ date_format(new DateTime($fecha_fin), "d/m/Y") }}
            ')
            ->edit_column('pagado', '{{ $pagado ? "<span class=\'pagado\'></span>" : "<span class=\'no-pagado\'></span>" }}')

            ->remove_column('pendiente')
            ->remove_column('id')

            ->make();
    }

    public function getDelete($reserva){
        // titulo

        $title = 'Borrar una reserva';

        // Show the page

        return View::make('adminlte/reservas/delete', compact('reserva', 'title'));
    }

    public function getPago($id)
    {
        $reserva = Reserva::find($id);
        $title = 'Solicitar pago reserva';
        $text_button_submit = 'Solicitar';

        return View::make('adminlte/reservas/solicitar_pago', compact('reserva', 'title', 'text_button_submit'));
    }

    public function postPago($reserva){


        Mail::send('emails.solicitud_pago', array('data' => $reserva), function ($message) use($reserva) {
            //$message->to('cristina@synergia.es')->subject('Synergia-resort. Nuevo Comentario.');
            $message->to( $reserva->email)->subject('Synergia-resort. Reserva confirmada.');
        });

        $reserva->pendiente = false;
        $reserva->save();

        return Redirect::to('adminlte/reservas/'.$reserva->id.'/edit')->with('success', 'Ha solicitado el pago correctamente.');
    }

    public function __call($method, $parameters){

        return Redirect::to('adminlte/reservas');
    }



}
