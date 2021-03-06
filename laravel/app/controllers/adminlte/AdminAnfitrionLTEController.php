<?php

class AdminAnfitrionLTEController extends \AdminController{

    public function __construct(){

        //Filtro para peticiones solo vía Ajax

        $this->beforeFilter('ajax',
            array('only' =>
                array(
                    'sustituirImagen',
                    'eliminarImagen'
                )
            )
        );
    }

	public function index(){
        return View::make('adminlte/anfitrion/index');
	}

	public function store(){

        //validaciones

        $validator = Anfitrion::validate(Input::all());

        if($validator->fails())
            return Redirect::to('adminlte/anfitrion')->withErrors($validator);


        DB::table('anfitrion')->truncate();

        $anfitrion              =   new Anfitrion;

        $anfitrion->id          =   1;
        $anfitrion->nombre      =   Input::get('nombre');
        $anfitrion->apellidos   =   (!Input::has('apellidos')  || Input::get('apellidos') == '')     ? NULL  : Input::get('apellidos');
        $anfitrion->email       =   (!Input::has('email')      || Input::get('email') == '')         ? NULL  : Input::get('email');
        $anfitrion->telefono    =   (!Input::has('telefono')   || Input::get('telefono') == '')      ? NULL  : Input::get('telefono');

        $anfitrion->save();

        return Redirect::to('adminlte/anfitrion')->with('success', 'El <b>Anfitrión</b> ha sido creado con éxito.');
	}

    public function sustituirImagen(){

            //Guardar nueva imagen

            if (Input::hasFile('imagenAnfitrion') && Input::file('imagenAnfitrion')->isValid())
                $imagen = Input::file('imagenAnfitrion');
            else
                return array('error', 'Hubo un error al subir el fichero.');

            $extension  = strtolower($imagen->getClientOriginalExtension());
            $name       = 'anfitrion.'.$extension;
            $destino    = public_path().'/template/anfitrion/';

            $extensiones_permitidas = array('jpg', 'png', 'jpeg');

            if(!in_array($extension, $extensiones_permitidas))
                return array('error', 'La extensión del archivo no está permitida. Por favor compruebe que está entre las siguientes: <b>jpg</b>, <b>jpeg</b>, <b>png</b>.');

            $this->eliminarTodasLasImagenesAnfitrion();

            $imagen->move($destino, $name);

            return array('good', $name);
    }

    public function eliminarImagen(){

            //Eliminar imagen

            $this->eliminarTodasLasImagenesAnfitrion();

            return array('good');
    }

    private function eliminarTodasLasImagenesAnfitrion(){

        $files = array(
            public_path().'/template/anfitrion/anfitrion.jpg',
            public_path().'/template/anfitrion/anfitrion.jpeg',
            public_path().'/template/anfitrion/anfitrion.png'
        );

        File::delete($files);
    }

    public function __call($method, $parameters){

        return Redirect::to('adminlte/anfitrion');
    }






}
