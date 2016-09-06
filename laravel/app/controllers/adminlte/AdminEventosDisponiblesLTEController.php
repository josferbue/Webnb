<?php

class AdminEventosDisponiblesLTEController extends \AdminController {

    public function __construct(){

        //Filtro para Ajax para el controlador

        $this->beforeFilter('ajax');
    }

    public function postSave(){
        $title  =   Input::get('evento');
        $color  =   Input::get('color');

        $evento_disponible = new EventoDisponible;

        $evento_disponible->titulo      =   $title;
        $evento_disponible->color       =   $color;

        if($evento_disponible->save())
            return json_encode(array('success', $evento_disponible->id));

        return 'error';
    }

    public function postDelete(){

        $evento =   Input::get('evento');

        if(EventoDisponible::find($evento)->delete())
            return 'success';

        return 'error';
    }

}