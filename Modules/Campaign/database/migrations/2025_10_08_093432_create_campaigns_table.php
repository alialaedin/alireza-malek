<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Campaign\Enums\CampaignDiscountType;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('campaigns', function (Blueprint $table) {
			$table->id();
			$table->string('title');
			$table->date('start_date');
			$table->date('end_date');
			$table->text('description')->nullable();
			$table->enum('discount_type', CampaignDiscountType::cases());
			$table->unsignedBigInteger('discount_amount');
			$table->boolean('is_active');
			$table->unsignedInteger('usage_limit')->nullable();
			$table->unsignedInteger('used_count')->default(0);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('campaigns');
	}
};
