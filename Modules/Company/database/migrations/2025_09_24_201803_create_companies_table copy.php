<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Company\Enums\ActivityLicense;
use Modules\Company\Enums\CompanyType;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('companies', function (Blueprint $table) {
			$table->id();
			$table->string('username', 20)->unique()->index();
			$table->string('password');
			$table->enum('type', CompanyType::cases());
			$table->boolean('login_status')->default(0);
			$table->string('name');
			$table->string('national_code', 20)->unique();
			$table->string('mobile', 20)->unique();
			$table->text('address');
			$table->enum('activity_license', ActivityLicense::cases());
			$table->string('brand')->nullable();
			$table->string('workshop_code')->nullable()->unique();
			$table->rememberToken();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('companies');
	}
};
