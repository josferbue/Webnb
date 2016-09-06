<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCondicionesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('condiciones', function($table) {

            $table->engine = 'InnoDB';
            $table->integer('id')->unsigned();
            $table->primary('id');
            $table->longtext('contenido');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(){

        Schema::drop('condiciones');
	}

}
