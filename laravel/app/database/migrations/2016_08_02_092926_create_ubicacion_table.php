<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUbicacionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('ubicacion', function($table) {
            //
            $table->engine = 'InnoDB';
            $table->integer('id')->unsigned();
            $table->primary('id');
            $table->string('titulo')->nullable();
            $table->string('descripcion')->nullable();
            $table->longtext('iframe');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('ubicacion');
	}

}
