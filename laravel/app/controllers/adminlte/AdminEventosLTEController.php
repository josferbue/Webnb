<?php

use Illuminate\Filesystem\Filesystem;

class AdminEventosLTEController extends AdminController{

    /**

     * Post Model

     * @var Post

     */

    protected $evento;



    /**

     * Inject the models.

     * @param Post $post

     */

    public function __construct(Evento $evento)

    {

        parent::__construct();

        $this->evento = $evento;

    }



    /**

     * Show a list of all the entrada posts.

     *

     * @return View

     */

    public function getIndex(){


        // titulo

        $title = 'Eventos';



        // Grab all the entrada posts

        $eventos = Evento::all();


        // Show the page

        return View::make('adminlte/eventos/index', compact('eventos', 'title'));

    }

    public function getUrl(){

        return URL::to('adminlte/eventos/'.Input::get('id').'/edit');
    }



    /**

     * Show the form for creating a new resource.

     *

     * @return Response

     */

    public function getCreate()

    {

        // titulo

        $title = Lang::get('adminlte/eventos/titulo.create_a_new_entry');





        // Show the page

        return View::make('adminlte/eventos/create_edit', compact('title'));

    }



    /**

     * Store a newly created resource in storage.

     *

     * @return Response

     */

    public function postCreate()

    {

        // Declare the rules for the form validation

        $rules = array(

            'titulo'   => 'required|min:3',
            'fechaInicio' => 'required|min:3',
            'fechaFin' => 'required|min:3'

        );



        // Validate the inputs

        $validator = Validator::make(Input::all(), $rules);



        // Check if the form validates with success

        if ($validator->passes())

        {

            // Create a new entrada post

            $user = Auth::user();



            // Update the entrada post data

            $this->evento->titulo            = Input::get('titulo');



            $this->evento->contenido         	= Input::get('contenido');

            $this->evento->fecha_inicio	       = Input::get('fechaInicio');

            $this->evento->fecha_fin	   	   = Input::get('fechaFin');

            $this->evento->user_id			   = $user->id;



            // Was the entrada post created?

            if($this->evento->save())

            {

                // Redirect to the new entrada post page

                return Redirect::to('adminlte/eventos/' . $this->evento->id . '/edit')->with('success', Lang::get('adminlte/entradas/messages.create.success'));

            }



            // Redirect to the entrada post create page

            return Redirect::to('adminlte/eventos/create')->with('error', Lang::get('adminlte/entradas/messages.create.error'));

        }



        // Form validation failed

        return Redirect::to('adminlte/eventos/create')->withInput()->withErrors($validator);

    }



    /**

     * Display the specified resource.

     *

     * @param $post

     * @return Response

     */

    public function getShow($evento)

    {

        // redirect to the frontend

    }



    /**

     * Show the form for editing the specified resource.

     *

     * @param $post

     * @return Response

     */

    public function getEdit(Evento $evento)

    {

        // titulo

        $title = 'Eventos';


        // Show the page

        return View::make('adminlte/eventos/create_edit', compact('evento', 'title'));

    }



    public function getDetails($date)

    {

        // titulo
        $dateTitle = new DateTime($date);
        $title = 'Eventos en '.$dateTitle->format('d-m-Y');
        $eventos = Evento::where('fecha_inicio','>=',$date)->where('fecha_fin','<=',$date)->get();

        // Show the page

        return View::make('adminlte/eventos/details', compact('eventos','title'));

    }



    /**

     * Update the specified resource in storage.

     *

     * @param $post

     * @return Response

     */

    public function postEdit(Evento $evento)

    {

        $evento->contenido = Input::get('contenido');

        if($evento->save())

        {

            // Redirect to the new entrada post page

            return Redirect::to('adminlte/eventos/' . $evento->id . '/edit')->with('success', '<b>Evento</b> actualizado correctamente');

        }


        return Redirect::to('adminlte/eventos/' . $evento->id . '/edit')->with('error', 'Ha habido un error al actualizar el evento.');


    }


    /**

     * Remove the specified resource from storage.

     *

     * @param $post

     * @return Response

     */

    public function postDelete()

    {

        Evento::where('id', Input::get('evento'))->delete();

        return 'success';
    }

    public function postSave(){

        $evento = new Evento;
        $input = json_decode(Input::get('evento'));

        $evento->titulo         = $input->titulo;
        $evento->color          = $input->color;
        $evento->fecha_inicio   = new DateTime($input->fecha_ini);
        $evento->fecha_fin      = new DateTime($input->fecha_fin);
        $evento->user_id        =  Auth::user()->id;

        $evento->save();

        return array($evento->id);
    }

    public function postUpdate(){

        $evento = json_decode(Input::get('evento'));

        $eventoUpdated = Evento::where('id', $evento->id)->first();

        $eventoUpdated->fecha_inicio    =   $evento->fecha_ini;
        $eventoUpdated->fecha_fin       =   $evento->fecha_fin;
        $eventoUpdated->save();

        return 'success';
    }

}