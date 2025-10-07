<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('languages', function (Blueprint $table) {
			$table->id();
			$table->string('persian_name', 100);
			$table->string('english_name', 100)->unique();
			$table->string('code', 10)->unique();
			$table->string('native_name', 100)->unique();
			$table->boolean('status')->default(1);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('languages');
	}
};
