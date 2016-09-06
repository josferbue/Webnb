<?php

class AdminComentariosLTEController extends \AdminController{

    public function __construct(){

        //Filtro para peticiones solo vía Ajax

        $this->beforeFilter('ajax',
            array('only' =>
                array(
                    'getData',
                    'publicar'
                )
            )
        );
    }

	public function index(){

        return View::make('adminlte/comentarios/index');
	}

	public function show(Comentario $comentario){

        if($comentario === null)
            return Redirect::action('AdminComentariosLTEController@index');

        $title          =   'Comentario';
        return View::make('adminlte/comentarios/show', compact('comentario', 'title'));
	}


	public function destroy(Comentario $comentario){

        $comentario->delete();
	}

    public function getData(){

        $comentarios = Comentario::select(array('comentarios.id', 'comentarios.nombre', 'comentarios.email', 'comentarios.valoracion', 'comentarios.publicado'));

        return Datatables::of($comentarios)

            ->edit_column('publicado',
                '@if($publicado == 1)
                    <input type="checkbox" name="comentarios[]" value="{{ $id }}" checked="checked"/>
                @else
                    <input type="checkbox" name="comentarios[]" value="{{ $id }}"/>
                @endif')

            ->edit_column('valoracion',
                '@if($valoracion === null)
                    X
                @else
                    {{ $valoracion }}
                @endif')

            ->add_column('actions',
                '<div><a href="{{{ URL::to(\'adminlte/comentarios/\' . $id ) }}}" class="btn btn-default iframe" >Ver</a>
            	<a href="{{{ URL::to(\'adminlte/comentarios/\' . $id . \'/delete\' ) }}}" class="btn btn-danger iframe">{{{ Lang::get(\'button.delete\') }}}</a></div>'
            )

            ->remove_column('id')

            ->make();
    }

    public function getDelete($comentario){
        // titulo

        $title = 'Borrar un comentario';

        // Show the page

        return View::make('adminlte/comentarios/delete', compact('comentario', 'title'));
    }

    public function publicar(){
        $comentario =  Comentario::find(Input::get('comentario'));

        if($comentario === null){
            return 'error';
        }

        $comentario->publicado = Input::get('publicado');
        $comentario->save();

        return 'success';


        return Redirect::to('adminlte/comentarios');
    }

    public function __call($method, $parameters){

        return Redirect::to('adminlte/comentarios');
    }
}
