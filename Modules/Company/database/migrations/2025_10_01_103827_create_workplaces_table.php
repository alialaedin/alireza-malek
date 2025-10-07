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
		Schema::create('workplaces', function (Blueprint $table) {
			$table->id();
			$table->foreignIdFor(Company::class)->constrained()->cascadeOnDelete();
			$table->string('title');
			$table->text('address');
			$table->boolean('status');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('workplaces');
	}
};
