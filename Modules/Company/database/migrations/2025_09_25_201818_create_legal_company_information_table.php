<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Company\Models\Company;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('legal_company_information', function (Blueprint $table) {
			$table->id();
			$table->foreignIdFor(Company::class)->constrained()->cascadeOnDelete();
			$table->string('company_name');
			$table->string('managment_mobile', 20)->unique();
			$table->string('brand')->nullable();
			$table->string('national_id', 20)->unique();
			$table->string('logo')->nullable();
			$table->text('address');
			$table->string('workshop_code')->nullable()->unique();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('legal_company_information');
	}
};
