<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiagnosescie10Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diagnosescie10', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('clave',10)->nullable();
            $table->string('descripcion',256)->nullable();
            $table->unsignedBigInteger('idCategories');
            $table->foreign('idCategories')->references('id')->on('categoriescie10');
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
        Schema::dropIfExists('diagnosescie10');
    }
}
