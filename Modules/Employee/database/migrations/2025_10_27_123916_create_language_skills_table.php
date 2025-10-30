<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Employee\Enums\LanguageSkillsStatus;
use Modules\Employee\Models\Employee;
use Modules\Language\Models\Language;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('language_skills', function (Blueprint $table) {
			$table->id();
			$table->foreignIdFor(Employee::class)->constrained()->cascadeOnDelete();
			$table->foreignIdFor(Language::class)->constrained()->cascadeOnDelete();
			$table->enum('conversation', LanguageSkillsStatus::cases());
			$table->enum('reading', LanguageSkillsStatus::cases());
			$table->enum('writing', LanguageSkillsStatus::cases());
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('language_skills');
	}
};
