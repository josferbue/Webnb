<?phpuse Illuminate\Filesystem\Filesystem;//use Facebook\Facebook;class AdminEntradasLTEController extends AdminController{    /*    |--------------------------------------------------------------------------    | FUNCIONES PÚBLICAS DEL CONTROLADOR DE ENTRADAS.    |--------------------------------------------------------------------------    */	/**	 * Post Model	 * @var Post	 */	protected $entrada;		/**	 * Inject the models.	 * @param Post $post	 */	public function __construct(Entrada $entrada)	{		parent::__construct();		$this->entrada = $entrada;        //Definir Filtro para NO-Shares	}	/**	 * Show a list of all the entrada posts.	 *	 * @return View	 */	public function getIndex()	{		// titulo		$title = Lang::get('adminlte/entradas/title.entry_management');			// Grab all the entrada posts		$entradas = $this->entrada;			// Show the page		return View::make('adminlte/entradas/index', compact('entradas', 'title'));	}		/**	 * Show the form for creating a new resource.	 *	 * @return Response	 */	public function getCreate()	{		// titulo		$title = 'Crear una entrada';		$categoria = Entrada::distinct('categoria')->lists('categoria');		JavaScript::put([			'categorias' => $categoria,		]);		// Show the page		return View::make('adminlte/entradas/create_edit', compact('title'));	}		/**	 * Store a newly created resource in storage.	 *	 * @return Response	 */	public function postCreate(){		// Declare the rules for the form validation		$rules = array(				'titulo'        =>  'required|min:3',				'categoria'     =>  'required|min:3',		);		// Validate the inputs		$validator = Validator::make(Input::all(), $rules);			// Check if the form validates with success		if ($validator->passes()){			// Create a new entrada post			$user = Auth::user();				// Update the entrada post data			$this->entrada->titulo            = Input::get('titulo');			$this->entrada->subtitulo         = Input::get('subtitulo');			$this->entrada->contenido         = Input::get('contenido');			$this->entrada->categoria         = Input::get('categoria');            $this->entrada->tags              = Input::has('tags') ? implode('&%', Input::get('tags')) : null;			$this->entrada->user_id			  = $user->id;				// Was the entrada post created?			if($this->entrada->save()){                //Creamos un directorio para las imágenes de esta entrada                if(!Directorio::create(public_path().'/entradas', $this->entrada->id))                    return Redirect::to('adminlte/blog/create')->with('error', 'Hubo un error al crear el directorio para esta entrada.');				// Redirect to the new entrada post page				return Redirect::to('adminlte/blog/' . $this->entrada->id . '/edit')->with('success', 'La <b>Entrada</b> fue creada con éxito.');			}				// Redirect to the entrada post create page			return Redirect::to('adminlte/blog/create')->with('error', 'Hubo un error inesperado.');		}			// Form validation failed		return Redirect::to('adminlte/blog/create')->withInput()->withErrors($validator);	}		/**	 * Display the specified resource.	 *	 * @param $post	 * @return Response	 */	public function getShow($entrada)	{		// redirect to the frontend	}	public function getDetails($entrada)	{		return View::make('adminlte/entradas/details', compact('entrada'));	}        public function getDetailsGaleria($entrada)	{		return View::make('adminlte/galerias/details', compact('entrada'));	}		/**	 * Show the form for editing the specified resource.	 *	 * @param $post	 * @return Response	 */	public function getEdit($entrada)	{		// titulo		$title = 'Actualizar una entrada';		$enlaces = $entrada->enlaces;        $tags = explode('&%', $entrada->tags);        $tags_return = array();        for($i = 0; $i < count($tags); $i++){            $tags_return[]  =   array('id' => $tags[$i], 'text' => $tags[$i]);        }		$files = array();        foreach($enlaces as $enlace){            if($enlace->tipo == 'jpg' or $enlace->tipo == 'jpeg' or $enlace->tipo == 'png'){                $array = array(                    "name" => $enlace->nombre,                    "size" => filesize(public_path().'/entradas/'.$enlace->entrada_id.'/'.$enlace->nombre),                    "url"  => URL::asset($enlace->url),                    "url2" => $enlace->url                );                array_push($files,$array);            }        }        //$categoria = Entrada::distinct('categoria')->lists('categoria');		JavaScript::put([		'files' => $files,        'tags' => $tags_return		]);		// Show the page		return View::make('adminlte/entradas/create_edit', compact('entrada', 'title'));	}		/**	 * Update the specified resource in storage.	 *	 * @param $post	 * @return Response	 */	public function postEdit($entrada){			// Declare the rules for the form validation		$rules = array(				'titulo'   => 'required|min:3',                'categoria' => 'required|min:3'		);			// Validate the inputs		$validator = Validator::make(Input::all(), $rules);		$categoria = Entrada::lists('categoria');		JavaScript::put([			'categorias' => $categoria,		]);		// Check if the form validates with success		if ($validator->passes())		{			// Update the entrada post data			$entrada->titulo            = Input::get('titulo');			$entrada->subtitulo         = Input::get('subtitulo');			$entrada->contenido         = Input::get('contenido');            $entrada->tags              = Input::has('tags') ? implode('&%', Input::get('tags')) : null;            $entrada->categoria         = Input::get('categoria');				// Was the entrada post updated?			if($entrada->save())			{				// Redirect to the new entrada post page				return Redirect::to('adminlte/blog/' . $entrada->id . '/edit')->with('success', Lang::get('<b>Entrada</b> actualizada con éxito.'));			}				// Redirect to the entradas post management page			return Redirect::to('adminlte/blog/' . $entrada->id . '/edit')->with('error', 'Hubo un error inesperado.');		}			// Form validation failed		return Redirect::to('adminlte/blog/' . $entrada->id . '/edit')->withInput()->withErrors($validator);	}			/**	 * Remove the specified resource from storage.	 *	 * @param $post	 * @return Response	 */	public function getDelete($entrada)	{		// titulo		$title = 'Borrar una entrada';			// Show the page		return View::make('adminlte/entradas/delete', compact('entrada', 'title'));	}	public function getEnlacesIndex($entrada){		$title = "Enlaces";		$cadenaData = 'adminlte/enlace/'.$entrada->id.'/data';		return View::make('adminlte/enlaces/index', compact('entrada','title','cadenaData'));	}	public function getAddLink($entrada){		$title = "Añadir enlace";        $tipos = array();        $tipos['video'] = 'Video';		return View::make('adminlte/enlaces/create_edit', compact('entrada','title','tipos'));	}	public function postCreateEnlace(){		$rules = array(			'nombre'   => 'required|min:3',			'url' => 'required|min:3'		);		// Validate the inputs		$validator = Validator::make(Input::all(), $rules);        // Valida si la entrada existe		$entrada = Entrada::find(Input::get('entrada'));        if($entrada === NULL){            return Redirect::back()->withInput()->with('error', 'La entrada especificada no existe.');        }		// Check if the form validates with success        $patron = '%^ (?:https?://)? (?:www\.)? (?: youtu\.be/ | youtube\.com (?: /embed/ | /v/ | /watch\?v= ) ) ([\w-]{10,12}) $%x';        $array = preg_match($patron, Input::has('url') ? Input::get('url') : NULL, $parte);        if (0 !== $array) {            $idyoutube =  $parte[1];        }        else{            $idyoutube =  false;        }        		// Check if the form validates with success        if($idyoutube === false){                Session::flash('url-error', '');            	return Redirect::to('adminlte/blog/' . $entrada->id . '/addLink')->withInput()->with('error', 'Enlace de vídeo incorrecto, debe ser un video de youtube.');        }		if ($validator->passes()){			$enlace = new Enlace;			$enlace->nombre         = Input::get('nombre');			$enlace->url            = $idyoutube;			$enlace->carpeta_id     = NULL;			$enlace->tipo           = 'video';            $enlace->entrada_id     = Input::get('entrada');			$enlace->local          = 0;			$enlace->save();			return Redirect::to('adminlte/enlace/' . $enlace->id . '/edit')->with('success', 'El <b>Enlace</b> fue adjuntado a la entrada correctamente.')->with('entrada', $entrada);		}		else{			return Redirect::to('adminlte/blog/' . $entrada->id . '/addLink')->withInput()->withErrors($validator);		}	}	public function getEditEnlace($enlace)	{		// titulo		$title = "Editar enlace";        $tipos = array();        $tipos['video'] = 'Video';		return View::make('adminlte/enlaces/create_edit', compact('enlace','title','tipos'));	}	public function postEditEnlace($enlace){		$rules = array(			'nombre'   => 'required|min:3',			'url' => 'required|min:3'		);		// Validate the inputs		$validator = Validator::make(Input::all(), $rules);        $patron = '%^ (?:https?://)? (?:www\.)? (?: youtu\.be/ | youtube\.com (?: /embed/ | /v/ | /watch\?v= ) ) ([\w-]{10,12}) $%x';        $array = preg_match($patron, Input::get('url'), $parte);        if (0 !== $array){            $idyoutube =  $parte[1];        }else{            $idyoutube =  false;        }             		// Check if the form validates with success        if($idyoutube === false){            Session::flash('url-error', '');            return Redirect::to('adminlte/enlace/' . $enlace->id . '/edit')->withInput()->with('error','Enlace de vídeo incorrecto, debe ser un video de youtube.');        }		if ($validator->passes()) {			$enlace->nombre = Input::get('nombre');			$enlace->url = $idyoutube;			$enlace->save();			return Redirect::to('adminlte/enlace/' . $enlace->id . '/edit')->with('success', 'El <b>Enlace</b> fue editado con éxito.');		}		else{			return Redirect::to('adminlte/enlace/' . $enlace->id . '/edit')->withInput()->withErrors($validator);		}	}    /**    * Extraer url de video de youtube    *    *    *    */	/**	 * Remove the specified resource from storage.	 *	 * @param $post	 * @return Response	 */	public function postDelete(Entrada $entrada)	{		// Declare the rules for the form validation		$rules = array(				'id' => 'required|integer'		);			// Validate the inputs		$validator = Validator::make(Input::all(), $rules);		// Check if the form validates with success		if ($validator->passes())		{			$id = $entrada->id;			$entrada->delete();			// Was the entrada post deleted?			$entrada = Entrada::find($id);			if(empty($entrada))			{                // Borramos el directorio asociado a esta entrada                if(!Directorio::delete(public_path().'/entradas', $id))                    return Redirect::to('adminlte/blog')->with('error', 'Hubo un error al borrar el directorio asociado a esta entrada.');				// Redirect to the entrada posts management page				return Redirect::to('adminlte/blog')->with('success', Lang::get('adminlte/entradas/messages.delete.success'));			}		}		// There was a problem deleting the entrada post		return Redirect::to('adminlte/blog')->with('error', Lang::get('adminlte/entradas/messages.delete.error'));	}	public function getDeleteEnlace($enlace)	{		// titulo		$title = 'Borrar enlace';		// Show the page		return View::make('adminlte/enlaces/delete', compact('enlace', 'title'));	}	public function postDeleteEnlace($enlace)	{		$rules = array(			'id' => 'required|integer'		);		// Validate the inputs		$validator = Validator::make(Input::all(), $rules);		// Check if the form validates with success		if ($validator->passes()){			$id = $enlace->id;			$enlace->delete();			// Was the entrada post deleted?			$enlace = Enlace::find($id);			if (empty($enlace)) {				// Redirect to the entrada posts management page				return Redirect::to('adminlte/enlaces')->with('success', Lang::get('<b>Enlace</b> borrado con éxito.'));			}		}	}	public function getDataEnlace(Entrada $entrada){		$enlaces = Enlace::select(array('enlaces.id','enlaces.nombre', 'enlaces.url', 'enlaces.tipo'))->where('entrada_id', $entrada->id)->where('tipo', 'video');		return Datatables::of($enlaces)            ->edit_column('url', 'https://www.youtube.com/embed/{{ $url }}')			->add_column('actions', '<div><a href="{{{ URL::to(\'adminlte/enlace/\' . $id . \'/edit\' ) }}}" class="btn btn-default iframe" >Editar</a>                <a href="{{{ URL::to(\'adminlte/enlace/\' . $id . \'/delete\' ) }}}" class="btn btn-danger iframe">Borrar</a></div>				')			->remove_column('id')			->make();	}		/**	 * Show a list of all the entrada posts formatted for Datatables.	 *	 * @return Datatables JSON	 */         public function getShare(Entrada $entrada){		//$urls = $entrada->urls;        // Con mis cambios.        $urls = $entrada->enlaces;        //		$count = 0;		$array = array();        $title = Lang::get('adminlte/entradas/title.entry_management');        $entradas = $this->entrada;        foreach($urls as $url){			if($count<3){				if(Str::lower($url->tipo)=='jpg'){					//$uploaded_media = Twitter::uploadMedia(['media' => File::get( public_path() . '/entradas/'.$url->url)]);                    // Con mis cambios.                    $uploaded_media = Twitter::uploadMedia(['media' => File::get( public_path() . '/'.$url->url)]);                    //                    //$picture =  URL::to('/entradas/'.$url->url);                    //$picture =  File::get( public_path() . '/entradas/'.$url->url); ESTA VARIABLE NO SE USA.					$array[] = $uploaded_media->media_id_string;				}			}		}		$tweet = ' '.$entrada->titulo.'  '.URL::to('entradas/'.$entrada->id.'/details/').' ';		if(empty($array))		{			Twitter::postTweet(['status' => $tweet]);		}		else		{			Twitter::postTweet(['status' => $tweet, 'media_ids' => $array]);		}        try {        $message = html_entity_decode(strip_tags($entrada->titulo)).':' ;        $message = $message.' '.URL::to('entradas/'.$entrada->id.'/details/');        Facebook::fqb()->setAccessToken(Config::get('packages/facebook/config.access_token'));        $status_update = ['message' => $message];                $response = Facebook::fqb()->object(Config::get('packages/facebook/config.id_page').'/feed')->with($status_update)->post();        }catch (Exception $e){            $error = "No se ha podido compartir";            //die($e);            return View::make('adminlte/entradas/index', compact('entradas', 'title'))->with('error',$e);        }        // Show the page        return View::make('adminlte/entradas/index', compact('entradas', 'title'))->with('success','Compartido correctamente');;	} 	public function getData(){		//$entradas = Entrada::select(array('entradas.id', 'entradas.titulo', 'entradas.categoria', 'entradas.tags', 'entradas.created_at'));        $entradas = Entrada::select(DB::raw('entradas.id, entradas.titulo, entradas.categoria, REPLACE(entradas.tags, \'&%\', \',\'), entradas.created_at'));        //DB::raw('comentarios.id, comentarios.nombre, comentarios.email, comentarios.valoracion, comentarios.publicado')        return Datatables::of($entradas)			->add_column('actions', '')        ->edit_column('actions', '            <div><a href="{{{ URL::to(\'adminlte/blog/\' . $id . \'/edit\' ) }}}" class="btn btn-default iframe" >{{{ Lang::get(\'button.edit\') }}}</a>            <a href="{{{ URL::to(\'adminlte/enlace/\' . $id ) }}}" class="btn btn-default">Enlaces</a>            <a href="{{{ URL::to(\'adminlte/blog/\' . $id . \'/delete\' ) }}}" class="btn btn-danger iframe">{{{ Lang::get(\'button.delete\') }}}</a>            <a href="{{{ URL::to(\'adminlte/blog/\' . $id . \'/share\' ) }}}" class="btn btn-primary">{{{ Lang::get(\'button.share\') }}}</a>            </div>        ')	     ->remove_column('id')		     ->make();	}    public function postUpload($entrada){        $dirname =  $entrada->id;        if(Input::hasFile('file') && Input::file('file')->isValid()){            // Subir una imagen            $patron     =   Input::has('patron') ? Input::get('patron') : null;            $imagen     =   Input::file('file');            $extension          =   strtolower($imagen->getClientOriginalExtension());            if(!in_array($extension, array('jpg', 'jpeg', 'png'))){                return 'error';            }            $item   =   new Enlace;            $item->nombre           = $patron === null ? uniqid().'.'.$extension : null;            $item->entrada_id       = $entrada->id;            $item->carpeta_id       = null;            $item->tipo             = $extension;            $item->url              = '%&%&%&';            if(!$item->save()){                return 'error';            }            if($item->nombre === null){                $item->nombre = $patron.'-'.$item->id.'.'.$extension;            }            $item->url  = 'entradas/'.$dirname.'/'.$item->nombre;            $item->save();            $path   =   public_path().'/entradas/'.$dirname;            if(!$imagen->move($path, $item->nombre)){                $item->delete();                return 'error';            }            return 'good';        }        else{            return 'error';        }    }    public function delete_image(){        $files = array(public_path().'/'.Input::get('url'));        File::delete($files);        // Borrar imagen de BBDD        DB::table('enlaces')->where('nombre', Input::get('file'))->delete();        return 'good';    }    /*    |--------------------------------------------------------------------------    | FUNCIONALIDADES AÑADIDAS PARA FILTRO POR DIA, MES, AÑO Y CATEGORÍA.    |--------------------------------------------------------------------------    */    // <-- Función que muestra una entrada CONCRETA -->    public function getEntradaConcreta($anyo, $mes, $dia, $categoria, $titulo){        $entrada    =  Entrada::whereRaw('\''.$this->formarDate($anyo, $mes, $dia).'\''.' = '.'DATE_FORMAT(created_at, \'%Y-%m-%d\')')            ->where('categoria', $categoria)            ->where('titulo', $this->formatearTitulo($titulo))            ->first();        if(!$entrada)            return Redirect::to('adminlte/blog');        $cadena     =   '<ul>';        $cadena     .=  '<li>'.$entrada->titulo.'</li>';        $cadena     .=  '<li>'.$entrada->subtitulo.'</li>';        $cadena     .=  '<li>'.$entrada->categoria.'</li>';        $cadena     .=  '<li>'.$entrada->created_at.'</li>';        $cadena     .=  '<li>'.$entrada->updated_at.'</li>';        $cadena     .=  '</ul>';        return $cadena;    }    // </-- FIN -->    // <-- Funciones que muestran entradas por DIA o DIA Y CATEGORIA -->    public function getEntradasPorDia($anyo, $mes, $dia){        $entradas   =   Entrada::whereRaw('\''.$this->formarDate($anyo, $mes, $dia).'\''.' = '.'DATE_FORMAT(created_at, \'%Y-%m-%d\')')            ->get();        if($entradas->count() == 0)            return Redirect::to('adminlte/blog');        return $this->listarEntradasParaTesteo($entradas);    }    public function getEntradasPorDiaCategoria($anyo, $mes, $dia, $categoria){        $entradas   =   Entrada::whereRaw('\''.$this->formarDate($anyo, $mes, $dia).'\''.' = '.'DATE_FORMAT(created_at, \'%Y-%m-%d\')')            ->where('categoria', $categoria)            ->get();        if($entradas->count() == 0)            return Redirect::to('adminlte/blog');        return $this->listarEntradasParaTesteo($entradas);    }    // </-- FIN -->    // <-- Funciones que muestran entradas por MES o MES Y CATEGORIA -->    public function getEntradasPorMes($anyo, $mes){        $entradas   =   Entrada::whereRaw('\''.$this->formarDate($anyo, $mes).'\''.' = '.'DATE_FORMAT(created_at, \'%Y-%m\')')            ->get();        if($entradas->count() == 0)            return Redirect::to('adminlte/blog');        return $this->listarEntradasParaTesteo($entradas);    }    public function getEntradasPorMesCategoria($anyo, $mes, $categoria){        $entradas   =   Entrada::whereRaw('\''.$this->formarDate($anyo, $mes).'\''.' = '.'DATE_FORMAT(created_at, \'%Y-%m\')')            ->where('categoria', $categoria)            ->get();        if($entradas->count() == 0)            return Redirect::to('adminlte/blog');        return $this->listarEntradasParaTesteo($entradas);    }    // </-- FIN -->    // <-- Funciones que muestran entradas por AÑO o AÑO Y CATEGORIA -->    public function getEntradasPorAnyo($anyo){        $entradas   =   Entrada::whereRaw('\''.$this->formarDate($anyo).'\''.' = '.'DATE_FORMAT(created_at, \'%Y\')')            ->get();        if($entradas->count() == 0)            return Redirect::to('adminlte/blog');        return $this->listarEntradasParaTesteo($entradas);    }    public function getEntradasPorAnyoCategoria($anyo, $categoria){        $entradas   =   Entrada::whereRaw('\''.$this->formarDate($anyo).'\''.' = '.'DATE_FORMAT(created_at, \'%Y\')')            ->where('categoria', $categoria)            ->get();        if($entradas->count() == 0)            return Redirect::to('adminlte/blog');        return $this->listarEntradasParaTesteo($entradas);    }    // </-- FIN -->    /*    |--------------------------------------------------------------------------    | FUNCIONES PRIVADAS DEL CONTROLADOR DE ENTRADAS.    |--------------------------------------------------------------------------    */    // Forma una fecha a través de los parámetros día, mes y año de una URL.    private function formarDate($anyo, $mes = null, $dia = null){        $fecha  =   $anyo;        if($mes != null){            $fecha.=    '-'.$mes;            if($dia != null){                $fecha.=    '-'.$dia;            }        }        return $fecha;    }    // Remplaza los guiones por espacios para buscar la entrada en la Base de Datos.    private function formatearTitulo($titulo){        return str_replace('-', ' ', $titulo);    }    // Devuelve una cadena formateada de las entradas consultadas. ESTA FUNCIÓN ES SOLO PARA TESTEO. SUSTITUIR EN CADA PUBLIC FUNCTION POR UNA VIEW O VARIAS VIEWS.    private function listarEntradasParaTesteo($entradas){        $cadena = '<ul>';        foreach($entradas as $entrada){            $cadena     .=  '<li>====================================</li>';            $cadena     .=  '<li>'.$entrada->titulo.'</li>';            $cadena     .=  '<li>'.$entrada->subtitulo.'</li>';            $cadena     .=  '<li>'.$entrada->categoria.'</li>';            $cadena     .=  '<li>'.$entrada->created_at.'</li>';            $cadena     .=  '<li>'.$entrada->updated_at.'</li>';            $cadena     .=  '<li>====================================</li>';        }        $cadena .= '</ul>';        return $cadena;    }}