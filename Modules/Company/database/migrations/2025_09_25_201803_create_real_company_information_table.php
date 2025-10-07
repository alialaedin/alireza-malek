<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Company\Enums\ActivityLicense;
use Modules\Company\Models\Company;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('real_company_information', function (Blueprint $table) {
			$table->id();
			$table->foreignIdFor(Company::class)->constrained()->cascadeOnDelete();
			$table->string('full_name');
			$table->string('father_name');
			$table->string('national_code', 20)->unique();
			$table->string('mobile', 20)->unique();
			$table->text('address');
			$table->enum('activity_license', ActivityLicense::cases());
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('real_company_information');
	}
};
