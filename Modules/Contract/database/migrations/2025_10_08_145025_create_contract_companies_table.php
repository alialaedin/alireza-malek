<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Campaign\Models\Campaign;
use Modules\Company\Models\Company;
use Modules\Contract\Enums\ContractStatus;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('contract_companies', function (Blueprint $table) {
			$table->id();
			$table->foreignIdFor(Company::class)->constrained()->cascadeOnDelete();
			$table->foreignIdFor(Campaign::class)->nullable()->constrained()->cascadeOnDelete();
			$table->string('contract_number', 50)->unique();
			$table->string('subject', 100);
			$table->date('start_date');
			$table->date('end_date');
			$table->text('terms');
			$table->enum('status', ContractStatus::cases())->default(ContractStatus::PENDING);
			$table->text('payment_terms');
			$table->unsignedBigInteger('payment_amount');
			$table->date('signature_date_company')->nullable();
			$table->date('signature_date_webmaster')->nullable();
			$table->text('notes');
			$table->unsignedBigInteger('guarantee_amount');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('contract_companies');
	}
};
