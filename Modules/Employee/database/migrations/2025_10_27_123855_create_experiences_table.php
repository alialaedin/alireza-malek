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
		Schema::create('experiences', function (Blueprint $table) {
			$table->id();
			$table->foreignIdFor(Employee::class)->constrained()->cascadeOnDelete();
			$table->string('workplace');
			$table->string('post');
			$table->date('start_date');
			$table->date('end_date');
			$table->unsignedBigInteger('basic_salary');
			$table->unsignedBigInteger('last_salary');
			$table->string('reason_for_leaving');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('experiences');
	}
};
