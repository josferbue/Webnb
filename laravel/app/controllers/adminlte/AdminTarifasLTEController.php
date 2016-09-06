<?php

class AdminTarifasLTEController extends \AdminController {

    public function __construct(){

        // Filtro para peticiones solo vía Ajax

        $this->beforeFilter('ajax',

            array('only' => array('getData')

            )
        );

        // Otros filtros

        // Este filtro impide la ELIMINACIÓN de la TARIFA ESTÁNDAR

        $this->beforeFilter('@estandar', array('only' => array('destroy', 'getDelete')));

        // Este filtro impide que se ELIMINE O EDITE una TARIFA CADUCADA

        $this->beforeFilter('@caducada', array('only' => array('update', 'destroy', 'edit', 'getDelete')));
    }

    /*
     * Funciones de filtros para el controlador
     * */

    public function estandar(){

        if(Route::input('tarifas')->id == 1)
            return $this->cerrarPopUp();
    }

    public function caducada(){

        if(new DateTime(Route::input('tarifas')->fecha_fin) < new DateTime)
            return $this->cerrarPopUp();
    }

    private function cerrarPopUp(){
        return '<script type=\'text/javascript\'>parent.$.colorbox.close();</script>';
    }

    /*
     * Fin de funciones de filtros para el controlador
     * */


    public function index(){

        return View::make('adminlte.tarifas.index');
    }


    public function create(){

        $text_button_submit =   'Crear';
        $title              =   'Crear Nueva Tarifa';
        return View::make('adminlte.tarifas.create_edit', compact('text_button_submit', 'title'));
    }

    public function store(){

        $validator  =   Configuracion::validate(Input::all());

        //Comprobar que el intervalo dado no pisa uno existente.

        $intervalos_pisados   = DB::table('configuraciones')
            ->select('alias', 'fecha_ini', 'fecha_fin')
            ->whereNotNull('fecha_ini')->whereNotNull('fecha_fin')
            ->where(function($query){
                $query  ->where('fecha_ini', '<=', Input::get('fecha_ini'))
                    ->where('fecha_fin', '>=', Input::get('fecha_ini'))

                    ->orWhere(function($query){
                        $query  ->where('fecha_ini', '<=', Input::get('fecha_fin'))
                            ->where('fecha_fin', '>=', Input::get('fecha_fin'));
                    })
                    ->orWhere(function($query){
                        $query  ->where('fecha_ini', '>=', Input::get('fecha_ini'))
                            ->where('fecha_fin', '<=', Input::get('fecha_fin'));
                    });
            })
            ->orderBy('fecha_ini', 'DESC')
            ->get();

        if(count($intervalos_pisados) > 0 && $validator->fails()){

            //Convertimos en cadena los intervalos pisados.

            $cadena =   '<p style="margin-bottom: 1em"><strong>Alguno de los siguientes intervalos ha sido superpuesto.</strong></p><ol>';
            foreach($intervalos_pisados as $item){
                $cadena .=  '<li><span style="display: inline-block; width: 300px;">'.$item->alias.'</span><strong>'.date_format(date_create($item->fecha_ini), "d/m/Y").'</strong> ~ <strong>'.date_format(date_create($item->fecha_fin), "d/m/Y").'</strong></li>';
            }
            $cadena .=  '</ol>';

            return Redirect::to('adminlte/tarifas/create')->withInput()->withErrors($validator)->with('warning', $cadena);
        }
        else{
            if($validator->fails()){
                return Redirect::to('adminlte/tarifas/create')->withInput()->withErrors($validator);
            }
            else if(count($intervalos_pisados) > 0){

                $cadena =   '<p style="margin-bottom: 1em"><strong>Alguno de los siguientes intervalos ha sido superpuesto.</strong></p><ol>';
                foreach($intervalos_pisados as $item){
                    $cadena .=  '<li><span style="display: inline-block; width: 300px;">'.$item->alias.'</span><strong>'.date_format(date_create($item->fecha_ini), "d/m/Y").'</strong> ~ <strong>'.date_format(date_create($item->fecha_fin), "d/m/Y").'</strong></li>';
                }
                $cadena .=  '</ol>';

                return Redirect::to('adminlte/tarifas/create')->withInput()->with('warning', $cadena);
            }
        }

        Input::merge(array('fecha_ini' => date('Y-m-d', strtotime(Input::get('fecha_ini')))));
        Input::merge(array('fecha_fin' => date('Y-m-d', strtotime(Input::get('fecha_fin')))));

        $configuracion  =   new Configuracion;

        $configuracion->fecha_ini                   =   Input::get('fecha_ini');
        $configuracion->fecha_fin                   =   Input::get('fecha_fin');
        $configuracion->alias                       =   Input::get('alias');
        $configuracion->tarifa_minima               =   Input::get('tarifa_minima');
        $configuracion->precio_noche_adicional      =   Input::get('precio_noche_adicional');
        $configuracion->precio_semana               =   Input::get('precio_semana');
        $configuracion->noches_minimas              =   Input::get('noches_minimas');

        $configuracion->save();

        return Redirect::to('adminlte/tarifas/create')->with('success', 'La <b>Tarifa</b> fue creada con éxito.');
    }

    public function edit(Configuracion $configuracion){

        $text_button_submit =   'Actualizar';
        $title              =   'Actualizar una Tarifa';
        return View::make('adminlte.tarifas.create_edit', compact('configuracion', 'text_button_submit', 'title'));
    }


    public function update(Configuracion $configuracion){

        if($configuracion->id != 1){
            Input::merge(array('fecha_ini' => date('Y-m-d', strtotime(Input::get('fecha_ini')))));
            Input::merge(array('fecha_fin' => date('Y-m-d', strtotime(Input::get('fecha_fin')))));
        }

        $validator  =   Configuracion::validate(Input::all());

        //Comprobar que el intervalo dado no pisa uno existente.

        if($configuracion->id != 1){
            $intervalos_pisados   = DB::table('configuraciones')
                ->select('alias', 'fecha_ini', 'fecha_fin')
                ->whereNotNull('fecha_ini')->whereNotNull('fecha_fin')
                ->where(function($query){
                    $query  ->where('fecha_ini', '<=', Input::get('fecha_ini'))
                        ->where('fecha_fin', '>=', Input::get('fecha_ini'))

                        ->orWhere(function($query){
                            $query  ->where('fecha_ini', '<=', Input::get('fecha_fin'))
                                ->where('fecha_fin', '>=', Input::get('fecha_fin'));
                        })
                        ->orWhere(function($query){
                            $query  ->where('fecha_ini', '>=', Input::get('fecha_ini'))
                                ->where('fecha_fin', '<=', Input::get('fecha_fin'));
                        });
                })
                ->where('id', '<>', $configuracion->id)
                ->orderBy('fecha_ini', 'DESC')
                ->get();


            if(count($intervalos_pisados) > 0 && $validator->fails()){

                //Convertimos en cadena los intervalos pisados.

                $cadena =   '<p style="margin-bottom: 1em"><strong>Alguno de los siguientes intervalos ha sido superpuesto.</strong></p><ol>';
                foreach($intervalos_pisados as $item){
                    $cadena .=  '<li><span style="display: inline-block; width: 300px;">'.$item->alias.'</span><strong>'.date_format(date_create($item->fecha_ini), "d/m/Y").'</strong> ~ <strong>'.date_format(date_create($item->fecha_fin), "d/m/Y").'</strong></li>';
                }
                $cadena .=  '</ol>';

                return Redirect::to('adminlte/tarifas/'.$configuracion->id.'/edit')->withErrors($validator)->with('warning', $cadena);
            }
            else{
                if($validator->fails()){
                    return Redirect::to('adminlte/tarifas/'.$configuracion->id.'/edit')->withErrors($validator);
                }
                else if(count($intervalos_pisados) > 0){

                    $cadena =   '<p style="margin-bottom: 1em"><strong>Alguno de los siguientes intervalos ha sido superpuesto.</strong></p><ol>';
                    foreach($intervalos_pisados as $item){
                        $cadena .=  '<li><span style="display: inline-block; width: 300px;">'.$item->alias.'</span><strong>'.date_format(date_create($item->fecha_ini), "d/m/Y").'</strong> ~ <strong>'.date_format(date_create($item->fecha_fin), "d/m/Y").'</strong></li>';
                    }
                    $cadena .=  '</ol>';

                    return Redirect::to('adminlte/tarifas/'.$configuracion->id.'/edit')->with('warning', $cadena);
                }
            }
        }

        if($validator->fails()){
            return Redirect::to('adminlte/tarifas/'.$configuracion->id.'/edit')->withErrors($validator);
        }

        $configuracion->fecha_ini                   =   Input::get('fecha_ini');
        $configuracion->fecha_fin                   =   Input::get('fecha_fin');
        $configuracion->alias                       =   Input::has('alias') ? Input::get('alias') : 'Estándar';
        $configuracion->tarifa_minima               =   Input::get('tarifa_minima');
        $configuracion->precio_noche_adicional      =   Input::get('precio_noche_adicional');
        $configuracion->precio_semana               =   Input::get('precio_semana');
        $configuracion->noches_minimas              =   Input::get('noches_minimas');

        $configuracion->save();

        return Redirect::to('adminlte/tarifas/'.$configuracion->id.'/edit')->with('success', 'La <b>Tarifa</b> fue actualizada con éxito');
    }

    public function destroy(Configuracion $configuracion){

        $configuracion->delete();
    }

    public function getData(){

        $configuraciones = Configuracion::select(array('configuraciones.id', 'configuraciones.alias', 'configuraciones.fecha_ini', 'configuraciones.fecha_fin', 'configuraciones.tarifa_minima', 'configuraciones.precio_noche_adicional', 'configuraciones.precio_semana', 'configuraciones.noches_minimas'))
            ->orderByRaw('fecha_ini IS NULL DESC')
            ->orderBy('fecha_fin', 'DESC');


        return Datatables::of($configuraciones)

            ->edit_column('fecha_ini',
                '@if($fecha_ini === NULL)
                    -
                @else
                    {{ date_format(new DateTime($fecha_ini), "d/m/Y") }}
                @endif')

            ->edit_column('fecha_fin',
                '@if($fecha_fin === NULL)
                    -
                @else
                    {{ date_format(new DateTime($fecha_fin), "d/m/Y") }}
                @endif')

            ->edit_column('tarifa_minima',
                '{{ number_format($tarifa_minima, 2) }}&euro;')

            ->edit_column('precio_noche_adicional',
                '{{ number_format($precio_noche_adicional, 2) }}&euro;')

            ->edit_column('precio_semana',
                '{{ number_format($precio_semana, 2) }}&euro;')

            ->add_column('actions',

                '
                <div>
                @if($fecha_fin == NULL || $fecha_ini == NULL)
                       <a href="{{{ URL::to(\'adminlte/tarifas/\' . $id . \'/edit\' ) }}}" class="btn btn-default iframe">Editar</a>
                @else
                    @if(new DateTime($fecha_fin) < new DateTime)
                        <span style="margin-top: 5px;" class="label label-danger">Caducado</span>
                    @else
                        <a href="{{{ URL::to(\'adminlte/tarifas/\' . $id . \'/edit\' ) }}}" class="btn btn-default iframe">Editar</a>
                        <a href="{{{ URL::to(\'adminlte/tarifas/\' . $id . \'/delete\' ) }}}" class="btn btn-danger iframe">Borrar</a>
                    @endif
                @endif
                </div>
            	')

            ->remove_column('id')

            ->make();
    }

    public function getDelete(Configuracion $configuracion){
        // titulo

        $title = 'Borrar una tarifa';

        // Show the page

        return View::make('adminlte/tarifas/delete', compact('configuracion', 'title'));
    }

    public function __call($method, $parameters){

        return Redirect::to('adminlte/tarifas');
    }


}
