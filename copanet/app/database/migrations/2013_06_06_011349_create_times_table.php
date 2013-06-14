<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTimesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('times', function(Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 100);
            $table->string('slug')->unique();
            $table->integer('departamento_id')->index();
            $table->integer('gols')->default(0);
            #$table->foreign('departamento_id')->references('id')->on('departamentos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('times');
    }

}
