<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Company\Models\Company;
use Modules\Position\Models\Position;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('signature_owners', function (Blueprint $table) {
			$table->id();
			$table->foreignIdFor(Company::class)->constrained()->cascadeOnDelete();
			$table->foreignIdFor(Position::class)->constrained()->cascadeOnDelete();
			$table->string('full_name');
			$table->string('national_code');
			$table->string('mobile');
			$table->string('father_name');
			$table->boolean('has_right_to_sign');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('signature_owners');
	}
};
