<?php

class AdminCondicionesDeUsoLTEController extends \AdminController{



	public function index(){
        return View::make('adminlte/condiciones/index');
	}

	public function store(){
        //validaciones

        $validator = Condiciones::validate(Input::all());

        if($validator->fails())
            return Redirect::to('adminlte/condiciones-de-uso')->withErrors($validator);


        DB::table('condiciones')->truncate();

        $condiciones              =   new Condiciones;

        $condiciones->id          =   1;
        $condiciones->contenido   =   Input::get('contenido');

        $condiciones->save();

        return Redirect::to('adminlte/condiciones-de-uso')->with('success', 'Las <b>Condiciones</b> fueron creadas con éxito.');
	}


    public function __call($method, $parameters){

        return Redirect::to('adminlte/condiciones-de-uso');
    }


}
