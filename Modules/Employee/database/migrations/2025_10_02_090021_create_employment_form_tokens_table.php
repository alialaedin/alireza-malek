<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Employee\Models\EmploymentForm;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('employment_form_tokens', function (Blueprint $table) {
			$table->id();
			$table->foreignIdFor(EmploymentForm::class)->constrained()->cascadeOnDelete();
			$table->string('token', 5);
			$table->timestamp('expired_at')->nullable();
			$table->timestamp('verified_at')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('employment_form_tokens');
	}
};
