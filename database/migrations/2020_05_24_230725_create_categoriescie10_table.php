<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriescie10Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categoriescie10', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('clave',10)->nullable();
            $table->string('descripcion',256)->nullable();
            $table->unsignedBigInteger('idSubgroups');
            $table->foreign('idSubgroups')->references('id')->on('subgroupscie10');
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
        Schema::dropIfExists('categoriescie10');
    }
}
