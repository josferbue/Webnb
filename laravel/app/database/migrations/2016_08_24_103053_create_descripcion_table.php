<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDescripcionTable extends Migration {

	public function up(){

        Schema::create('descripcion', function($table){

            $table->engine = 'InnoDB';
            $table->integer('id')->unsigned();
            $table->primary('id');
            $table->string('titulo');
            $table->longtext('descripcion');
            $table->integer('capacidad')->unsigned();
            $table->integer('dormitorios')->unsigned();
            $table->integer('banyos')->unsigned();
            $table->integer('camas')->unsigned();
            $table->boolean('elementos_basicos');
            $table->boolean('tv');
            $table->boolean('tv_satelite');
            $table->boolean('aire_acondicionado');
            $table->boolean('calefaccion');
            $table->boolean('cocina');
            $table->boolean('internet');
            $table->boolean('wifi');
            $table->boolean('llegada_cualquier_hora');
            $table->boolean('jacuzzi');
            $table->boolean('lavadora');
            $table->boolean('piscina');
            $table->boolean('secadora');
            $table->boolean('desayuno');
            $table->boolean('aparcamiento');
            $table->boolean('gimnasio');
            $table->boolean('ascensor');
            $table->boolean('chimenea');
            $table->boolean('timbre');
            $table->boolean('portero');
            $table->boolean('champu');
            $table->boolean('perchas');
            $table->boolean('secador_pelo');
            $table->boolean('plancha');
            $table->boolean('zona_portatiles');
            $table->boolean('propiedad_mascotas');
            $table->boolean('acceso_discapacitados');
        });
	}

	public function down(){

        Schema::drop('descripcion');
	}

}
