<?php

class AdminDescripcionLTEController extends \AdminController {

	public function index(){
        return View::make('adminlte.descripcion.index');
	}

	public function store(){

        $validator  =   Descripcion::validate(Input::all());

        if($validator->fails())
            return Redirect::to('adminlte/descripcion')->withInput()->withErrors($validator);

        DB::table('descripcion')->truncate();

        $descripcion = new Descripcion;

        $descripcion->id                        = 1;
        $descripcion->titulo                    = Input::get('titulo');
        $descripcion->descripcion               = Input::get('descripcion');
        $descripcion->capacidad                 = Input::get('capacidad');
        $descripcion->dormitorios               = Input::get('dormitorios');
        $descripcion->banyos                    = Input::get('banyos');
        $descripcion->camas                     = Input::get('camas');
        $descripcion->elementos_basicos         = Input::get('elementos_basicos') !== null ? 1 : 0;
        $descripcion->tv                        = Input::get('tv') !== null ? 1 : 0;
        $descripcion->tv_satelite               = Input::get('tv_satelite') !== null ? 1 : 0;
        $descripcion->aire_acondicionado        = Input::get('aire_acondicionado') !== null ? 1 : 0;
        $descripcion->calefaccion               = Input::get('calefaccion') !== null ? 1 : 0;
        $descripcion->cocina                    = Input::get('cocina') !== null ? 1 : 0;
        $descripcion->internet                  = Input::get('internet') !== null ? 1 : 0;
        $descripcion->wifi                      = Input::get('wifi') !== null ? 1 : 0;
        $descripcion->llegada_cualquier_hora    = Input::get('llegada_cualquier_hora') !== null ? 1 : 0;
        $descripcion->jacuzzi                   = Input::get('jacuzzi') !== null ? 1 : 0;
        $descripcion->lavadora                  = Input::get('lavadora') !== null ? 1 : 0;
        $descripcion->piscina                   = Input::get('piscina') !== null ? 1 : 0;
        $descripcion->secadora                  = Input::get('secadora') !== null ? 1 : 0;
        $descripcion->desayuno                  = Input::get('desayuno') !== null ? 1 : 0;
        $descripcion->aparcamiento              = Input::get('aparcamiento') !== null ? 1 : 0;
        $descripcion->gimnasio                  = Input::get('gimnasio') !== null ? 1 : 0;
        $descripcion->ascensor                  = Input::get('ascensor') !== null ? 1 : 0;
        $descripcion->chimenea                  = Input::get('chimenea') !== null ? 1 : 0;
        $descripcion->timbre                    = Input::get('timbre') !== null ? 1 : 0;
        $descripcion->portero                   = Input::get('portero') !== null ? 1 : 0;
        $descripcion->champu                    = Input::get('champu') !== null ? 1 : 0;
        $descripcion->perchas                   = Input::get('perchas') !== null ? 1 : 0;
        $descripcion->secador_pelo              = Input::get('secador_pelo') !== null ? 1 : 0;
        $descripcion->plancha                   = Input::get('plancha') !== null ? 1 : 0;
        $descripcion->zona_portatiles           = Input::get('zona_portatiles') !== null ? 1 : 0;
        $descripcion->propiedad_mascotas        = Input::get('propiedad_mascotas') !== null ? 1 : 0;
        $descripcion->acceso_discapacitados     = Input::get('acceso_discapacitados') !== null ? 1 : 0;

        if(!$descripcion->save())
            return Redirect::to('adminlte/descripcion')->withInput()->with('error', 'Hubo un error inesperado al crear la <b>Descripción</b>.');

        return Redirect::to('adminlte/descripcion')->with('success', 'La nueva <b>Descripción</b> fue creada con éxito.');
	}

	public function destroy($id)
	{
        DB::table('descripcion')->truncate();
        Session::flash('success', '<b>Descripción</b> eliminada con éxito.');
        return 'success';
	}

    public function __call($method, $parameters){

        return Redirect::to('adminlte/descripcion');
    }
}
