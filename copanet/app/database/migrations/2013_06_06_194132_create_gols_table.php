<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGolsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gols', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('departamento_id')->nullable();
            $table->integer('time_id')->nullable();
            $table->integer('artilheiro_id')->nullable();
            $table->integer('gols');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('gols');
    }

}
