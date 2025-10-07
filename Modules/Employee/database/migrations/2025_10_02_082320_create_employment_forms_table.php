<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Company\Models\Company;
use Modules\Employee\Enums\EmploymentFormStatus;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('employment_forms', function (Blueprint $table) {
			$table->id();
			$table->foreignIdFor(Company::class)->nullable()->constrained()->cascadeOnDelete();
			$table->string('first_name', 30);
			$table->string('last_name', 50);
			$table->string('mobile', 11);
			$table->boolean('has_seen')->default(0);
			$table->boolean('is_authenticated')->default(0);
			$table->boolean('is_filled')->default(0);
			$table->enum('status', EmploymentFormStatus::cases());
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('employment_forms');
	}
};
