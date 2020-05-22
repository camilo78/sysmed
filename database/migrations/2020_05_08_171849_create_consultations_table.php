<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsultationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('date-hour', 25);
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('setting_id');
            $table->foreign('setting_id')->references('id')->on('settings');
            $table->unsignedBigInteger('patient_id');
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->enum('insurace', ['no', 'yes'])->default('no');
            $table->string('company', 25)->nullable();
            $table->string('policy', 25)->nullable();
            $table->string('relation', 25)->nullable();
            $table->string('height', 25)->nullable();
            $table->string('height_unit', 25)->nullable();
            $table->string('weight', 25)->nullable();
            $table->string('weight_unit', 25)->nullable();
            $table->string('temp', 25)->nullable();
            $table->string('temp_unit', 25)->nullable();
            $table->string('cranial', 25)->nullable();
            $table->string('cranial_unit', 25)->nullable();
            $table->string('waist', 25)->nullable();
            $table->string('waist_unit', 25)->nullable();
            $table->string('pressure', 25)->nullable();
            $table->string('cardiac', 25)->nullable();
            $table->string('breathing', 25)->nullable();
            $table->text('measurements_note')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('consultations');
    }
}
