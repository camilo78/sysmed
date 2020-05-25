<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubgroupscie10Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subgroupscie10', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('clave',8)->nullable();
            $table->string('descripcion',256)->nullable();
            $table->unsignedBigInteger('idGrupo');
            $table->foreign('idGrupo')->references('id')->on('groupscie10');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subgroupscie10');
    }
}
