<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Employee\Models\Employee;
use Modules\Relation\Models\Relation;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('reference_people', function (Blueprint $table) {
			$table->id();
			$table->foreignIdFor(Employee::class)->constrained()->cascadeOnDelete();
			$table->foreignIdFor(Relation::class)->constrained()->cascadeOnDelete();
			$table->string('first_name');
			$table->string('last_name');
			$table->string('job');
			$table->text('address');
			$table->string('mobile', 20);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('reference_people');
	}
};
