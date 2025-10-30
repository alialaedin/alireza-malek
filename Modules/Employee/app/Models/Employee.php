<?php

namespace Modules\Employee\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Modules\Company\Traits\BelongsToCompany;
use Modules\Core\Models\BaseAuthModel;
use Modules\Core\Traits\Filterable;

class Employee extends BaseAuthModel
{
	use BelongsToCompany, Filterable;

	protected $fillable = ['employment_form_id', 'mobile', 'first_name', 'last_name', 'can_login', 'password', 'remember_token'];
	protected $appends = ['full_name'];
	protected $hidden = ['password', 'remember_token'];
	protected $casts = ['can_login' => 0];
	protected static array $filterColumns = ['mobile', 'first_name', 'last_name', 'can_login', 'from_date', 'to_date'];

	protected function fullName(): Attribute
	{
		return Attribute::make(
			get: fn(): string => $this->first_name . ' ' . $this->last_name
		);
	}

	protected function password(): Attribute
	{
		return Attribute::make(
			set: fn($pass): string => bcrypt($pass)
		);
	}

	public function profile(): HasOne
	{
		return $this->hasOne(EmployeeProfile::class);
	}

	public function employmentForm(): BelongsTo
	{
		return $this->belongsTo(EmploymentForm::class);
	}

	public function languageSkills(): HasMany
	{
		return $this->hasMany(LanguageSkill::class);
	}

	public function educationCertificates(): HasMany
	{
		return $this->hasMany(EducationCertificate::class);
	}

	public function experiences(): HasMany
	{
		return $this->hasMany(Experience::class);
	}

	public function referencePeople(): HasMany
	{
		return $this->hasMany(ReferencePerson::class);
	}
}
