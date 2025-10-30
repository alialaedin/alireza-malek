<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Employee\Models\Employee;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('education_certificates', function (Blueprint $table) {
			$table->id();
			$table->foreignIdFor(Employee::class)->constrained()->cascadeOnDelete();
			$table->string('degree');
			$table->string('field_of_study');
			$table->string('university');
			$table->date('degree_obtained_at');
			$table->date('place_of_obtaining_degree');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('education_certificates');
	}
};
