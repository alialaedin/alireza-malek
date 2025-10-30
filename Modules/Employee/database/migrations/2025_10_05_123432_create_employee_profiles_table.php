<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Area\Models\City;
use Modules\Employee\Enums\CarType;
use Modules\Employee\Enums\DriverLicenseType;
use Modules\Employee\Enums\MilitaryStatus;
use Modules\Employee\Enums\ResidenceStatus;
use Modules\Employee\Models\Employee;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('employee_profiles', function (Blueprint $table) {
      $table->id();
      $table->foreignIdFor(Employee::class)->constrained()->cascadeOnDelete();
      $table->string('father_name', 100);
      $table->boolean('login_status')->default(0);
      $table->string('identity_card_number')->unique()->nullable();
      $table->string('identity_card_serial_number')->unique()->nullable();
      $table->string('birth_place');
      $table->date('birth_date');
      $table->string('national_code', 20)->unique();
      $table->string('nationality');
      $table->string('religion');
      $table->boolean('is_married');
      $table->string('spouse_job')->nullable();
      $table->unsignedInteger('children_count')->default(0);
      $table->string('custody_of_children')->nullable();
      $table->string('telephone', 20)->nullable();
      $table->enum('residence_status', ResidenceStatus::cases());
      $table->foreignIdFor(City::class)->constrained()->cascadeOnDelete();
      $table->string('postal_code', 20);
      $table->text('address');
      $table->enum('military_status', MilitaryStatus::cases());
      $table->string('reason_for_exemption')->nullable();
      $table->boolean('has_own_car')->default(0);
      $table->enum('car_type', CarType::cases())->nullable();
      $table->boolean('has_driver_license')->default(0);
      $table->enum('driver_license_type', DriverLicenseType::cases())->nullable();
      $table->string('driver_license_number')->nullable();
      $table->boolean('health_status')->default(1);
      $table->text('disease')->nullable();
      $table->boolean('has_surgery')->default(0);
      $table->string('cause_of_surgery')->nullable();
      $table->boolean('has_other_income')->default(0);
      $table->string('other_income_source')->nullable();
      $table->unsignedBigInteger('other_income_amount')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('employee_profiles');
  }
};
