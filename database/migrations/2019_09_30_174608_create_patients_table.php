<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration {
	/**
	 * Run the migrations.
	 * 
	 * @return void
	 */
	public function up() {
		Schema::create('patients', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('user_id');
			$table->foreign('user_id')->references('id')->on('users');
			$table->string('name1', 25);
			$table->string('name2', 25)->nullable();
			$table->string('surname1', 25);
			$table->string('surname2', 25)->nullable();
			$table->string('married_name', 25)->nullable();
			$table->enum('gender', ['M', 'F']);
			$table->string('birth', 25);
			$table->string('patient_code', 25);
			$table->string('document_type', 25)->nullable();
			$table->string('document', 25)->nullable();
			$table->enum('status', ['active', 'disabled'])->default('active');
			$table->string('name_relation', 50)->nullable();
			$table->string('kinship', 25)->nullable();
			$table->string('phone1', 25)->nullable();
			$table->string('phone2', 25)->nullable();
			$table->string('email', 50)->nullable();
			$table->text('address')->nullable();
			$table->string('country')->nullable();
			$table->string('city_town')->nullable();
			$table->softDeletes(); //Columna para soft delete
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('patients');
	}
}
