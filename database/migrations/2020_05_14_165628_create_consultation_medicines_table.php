<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsultationMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultation_medicines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('consultations_id');
            $table->foreign('consultations_id')->references('id')->on('consultations');
            $table->unsignedBigInteger('medicines_id');
            $table->foreign('medicines_id')->references('id')->on('medicines');
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
        Schema::dropIfExists('consultation_medicines');
    }
}
