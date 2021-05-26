<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Denuncias extends Migration
{

    public function up()
    {
        Schema::create('denuncias', function (Blueprint $table) {
            $table->bigIncrements('den_id');
            $table->string('den_observacao')->nullable();
            $table->string('den_geoposicao');
            $table->integer('den_quantidade_pessoas');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('denuncias');

    }
}
