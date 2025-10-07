<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Company\Models\Company;
use Modules\FiscalYear\Models\FiscalYear;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('price_lists', function (Blueprint $table) {
			$table->id();
			$table->foreignIdFor(Company::class)->constrained()->cascadeOnDelete();
			$table->foreignIdFor(FiscalYear::class)->constrained()->cascadeOnDelete();
			$table->unsignedBigInteger('salary');
			$table->unsignedBigInteger('right_to_housing_and_food');
			$table->unsignedBigInteger('worker_coupen_amount');
			$table->unsignedBigInteger('children_rights');
			$table->unsignedBigInteger('marriage_rights');
			$table->unsignedBigInteger('reward');
			$table->unsignedBigInteger('work_history_amount');
			$table->boolean('status');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('price_lists');
	}
};
