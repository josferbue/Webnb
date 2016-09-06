@extends('adminlte.layouts.default')

{{-- Web site Title --}}
@section('title')
    Descripción :: @parent
@stop

@section('styles')

@stop

{{-- Content --}}
@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title">Descripción Del Apartamento</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    {{ Form::model(Descripcion::first(), array('action' => 'AdminDescripcionLTEController@store', 'method' => 'post', 'id' => 'formAnfitrion')) }}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <!-- Título -->

                                {{ Form::label('titulo', 'Título') }}
                                {{ Form::text('titulo', null, array('class' => 'form-control')) }}
                                {{ $errors->first('titulo', '<span class="help-block">:message</span>') }}

                                <!-- ./ Fin Título -->
                            </div>
                            <div class="form-group">
                                <!-- Descripción -->

                                {{ Form::label('descripcion', 'Descripción') }}
                                {{ Form::textarea('descripcion', null, array('class' => 'form-control')) }}
                                {{ $errors->first('descripcion', '<span class="help-block">:message</span>') }}

                                <!-- ./ Fin Descripción -->
                            </div>
                            <div class="form-group">
                                <!-- Capacidad -->

                                {{ Form::label('capacidad', 'Capacidad') }}
                                {{ Form::selectRange('capacidad', 1, 25, null, array('class' => 'form-control')) }}
                                {{ $errors->first('capacidad', '<span class="help-block">:message</span>') }}

                                <!-- ./  Fin Capacidad -->
                            </div>
                            <div class="form-group">
                                <!-- Dormitorios -->

                                {{ Form::label('dormitorios', 'Dormitorios') }}
                                {{ Form::selectRange('dormitorios', 1, 10, null, array('class' => 'form-control')) }}
                                {{ $errors->first('dormitorios', '<span class="help-block">:message</span>') }}

                                <!-- ./ Fin Dormitorios -->
                            </div>
                            <div class="form-group">
                                <!-- Baños -->

                                {{ Form::label('banyos', 'Baños') }}
                                {{ Form::selectRange('banyos', 1, 10, null, array('class' => 'form-control')) }}
                                {{ $errors->first('banyos', '<span class="help-block">:message</span>') }}

                                <!-- ./ Fin Baños -->
                            </div>
                            <div class="form-group">
                                <!-- Camas -->

                                {{ Form::label('camas', 'Camas') }}
                                {{ Form::selectRange('camas', 1, 25, null, array('class' => 'form-control')) }}
                                {{ $errors->first('camas', '<span class="help-block">:message</span>') }}

                                <!-- ./ Fin Camas -->
                            </div>
                            <div class="form-group">
                                <!-- Servicios Habituales -->

                                <p><strong>Servicios Habituales</strong></p>

                                <div class="checkbox">
                                    <label for="elementos_basicos">
                                        {{ Form::checkbox('elementos_basicos', null, null, array('id' => 'elementos_basicos')) }}
                                        Elementos básicos
                                    </label>
                                </div>

                                <div class="checkbox">
                                    <label for="tv">
                                        {{ Form::checkbox('tv', null, null, array('id' => 'tv')) }}
                                        TV
                                    </label>
                                </div>

                                <div class="checkbox">
                                    <label for="tv_satelite">
                                        {{ Form::checkbox('tv_satelite', null, null, array('id' => 'tv_satelite')) }}
                                        TV por satélite
                                    </label>
                                </div>

                                <div class="checkbox">
                                    <label for="aire_acondicionado">
                                        {{ Form::checkbox('aire_acondicionado', null, null, array('id' => 'aire_acondicionado')) }}
                                        Aire acondicionado
                                    </label>
                                </div>

                                <div class="checkbox">
                                    <label for="calefaccion">
                                        {{ Form::checkbox('calefaccion', null, null, array('id' => 'calefaccion')) }}
                                        Calefacción
                                    </label>
                                </div>

                                <div class="checkbox">
                                    <label for="cocina">
                                        {{ Form::checkbox('cocina', null, null, array('id' => 'cocina')) }}
                                        Cocina
                                    </label>
                                </div>

                                <div class="checkbox">
                                    <label for="internet">
                                        {{ Form::checkbox('internet', null, null, array('id' => 'internet')) }}
                                        Internet
                                    </label>
                                </div>

                                <div class="checkbox">
                                    <label for="wifi">
                                        {{ Form::checkbox('wifi', null, null, array('id' => 'wifi')) }}
                                        Internet inalámbrico (wifi)
                                    </label>
                                </div>

                                <div class="checkbox">
                                    <label for="llegada_cualquier_hora">
                                        {{ Form::checkbox('llegada_cualquier_hora', null, null, array('id' => 'llegada_cualquier_hora')) }}
                                        Llegada a cualquier hora
                                    </label>
                                </div>

                                <!-- ./ Fin Servicios Habituales -->
                            </div>
                            <div class="form-group">
                                <!-- Servicios Adicionales -->

                                <p><strong>Servicios Adicionales</strong></p>

                                <div class="checkbox">
                                    <label for="jacuzzi">
                                        {{ Form::checkbox('jacuzzi', null, null, array('id' => 'jacuzzi')) }}
                                        Jacuzzi
                                    </label>
                                </div>

                                <div class="checkbox">
                                    <label for="lavadora">
                                        {{ Form::checkbox('lavadora', null, null, array('id' => 'lavadora')) }}
                                        Lavadora
                                    </label>
                                </div>

                                <div class="checkbox">
                                    <label for="piscina">
                                        {{ Form::checkbox('piscina', null, null, array('id' => 'piscina')) }}
                                        Piscina
                                    </label>
                                </div>

                                <div class="checkbox">
                                    <label for="secadora">
                                        {{ Form::checkbox('secadora', null, null, array('id' => 'secadora')) }}
                                        Secadora
                                    </label>
                                </div>

                                <div class="checkbox">
                                    <label for="desayuno">
                                        {{ Form::checkbox('desayuno', null, null, array('id' => 'desayuno')) }}
                                        Desayuno
                                    </label>
                                </div>

                                <div class="checkbox">
                                    <label for="aparcamiento">
                                        {{ Form::checkbox('aparcamiento', null, null, array('id' => 'aparcamiento')) }}
                                        Plaza de aparcamiento incluida
                                    </label>
                                </div>

                                <div class="checkbox">
                                    <label for="gimnasio">
                                        {{ Form::checkbox('gimnasio', null, null, array('id' => 'gimnasio')) }}
                                        Gimnasio
                                    </label>
                                </div>

                                <div class="checkbox">
                                    <label for="ascensor">
                                        {{ Form::checkbox('ascensor', null, null, array('id' => 'ascensor')) }}
                                        Edificio con ascensor
                                    </label>
                                </div>

                                <div class="checkbox">
                                    <label for="chimenea">
                                        {{ Form::checkbox('chimenea', null, null, array('id' => 'chimenea')) }}
                                        Chimenea interior
                                    </label>
                                </div>

                                <div class="checkbox">
                                    <label for="timbre">
                                        {{ Form::checkbox('timbre', null, null, array('id' => 'timbre')) }}
                                        Timbre / Interfono inalámbrico
                                    </label>
                                </div>

                                <div class="checkbox">
                                    <label for="portero">
                                        {{ Form::checkbox('portero', null, null, array('id' => 'portero')) }}
                                        Portero
                                    </label>
                                </div>

                                <div class="checkbox">
                                    <label for="champu">
                                        {{ Form::checkbox('champu', null, null, array('id' => 'champu')) }}
                                        Champú
                                    </label>
                                </div>

                                <div class="checkbox">
                                    <label for="perchas">
                                        {{ Form::checkbox('perchas', null, null, array('id' => 'perchas')) }}
                                        Perchas
                                    </label>
                                </div>

                                <div class="checkbox">
                                    <label for="secador_pelo">
                                        {{ Form::checkbox('secador_pelo', null, null, array('id' => 'secador_pelo')) }}
                                        Secador de pelo
                                    </label>
                                </div>

                                <div class="checkbox">
                                    <label for="plancha">
                                        {{ Form::checkbox('plancha', null, null, array('id' => 'plancha')) }}
                                        Plancha
                                    </label>
                                </div>

                                <div class="checkbox">
                                    <label for="zona_portatiles">
                                        {{ Form::checkbox('zona_portatiles', null, null, array('id' => 'zona_portatiles')) }}
                                        Zona para trabajar con portátiles
                                    </label>
                                </div>

                                <!-- ./ Fin Servicios Adicionales -->
                            </div>
                            <div class="form-group">
                                <!-- Características Especiales -->

                                <p><strong>Características Especiales</strong></p>

                                <div class="checkbox">
                                    <label for="propiedad_mascotas">
                                        {{ Form::checkbox('propiedad_mascotas', null, null, array('id' => 'propiedad_mascotas')) }}
                                        En esta propiedad viven mascotas
                                    </label>
                                </div>

                                <div class="checkbox">
                                    <label for="acceso_discapacitados">
                                        {{ Form::checkbox('acceso_discapacitados', null, null, array('id' => 'acceso_discapacitados')) }}
                                        Acceso para discapacitados
                                    </label>
                                </div>

                                <!-- ./ Fin Características Especiales -->
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            {{ Form::submit('Crear / Remplazar', array('class' => 'btn btn-success btn-lg', 'style' => 'margin-top: 1em; float: right;')) }}
                            {{ Form::button('Eliminar', array('class' => 'btn btn-danger btn-lg', 'style' => 'margin-top: 1em; float: right; margin-right: 5px;', 'id' => 'btnEliminar')) }}
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@stop

{{-- Scripts --}}
@section('scripts')
    <script type="text/javascript">
        $('#btnEliminar').click(function(){
            var jqAjax = $.ajax({
                url: '{{ URL::to('adminlte/descripcion/1') }}',
                type: 'DELETE',
                async: true,
                data: 'test',
                dataType: 'json'
            }).always(function(){
                if(jqAjax.responseText == 'success'){
                    window.location.href = window.location.href;
                }
                else if(jqAjax.responseText == 'error'){

                }
                else{

                }
            });
        });
    </script>
@stop