<?php

namespace Modules\Company\Services;

use Illuminate\Http\Request;
use Modules\Company\Models\Company;
use Modules\Core\Helpers\File;

class LogoService
{
	public function upload(Company $company, Request $request): void
	{
		if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
			$path = File::uploadSingle($request->file('logo'), 'legal-company-logos');
			$company->update(['logo' => $path]);
		}
	}

	public function sync(Company $company, Request $request): void
	{
		if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
			if ($company->logo) {
				File::delete($company->logo);
			}

			$path = File::uploadSingle($request->file('logo'), 'legal-company-logos');
			$company->update(['logo' => $path]);
		}
	}
}
