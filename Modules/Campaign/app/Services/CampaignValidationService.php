<?php

namespace Modules\Campaign\Services;

use Carbon\Carbon;
use Modules\Campaign\Models\Campaign;
use Modules\Core\Exceptions\ValidationException;

class CampaignValidationService
{
	public static function validate(int $campaignId)
	{
		$campaign = Campaign::findOrFail($campaignId);

		if (!$campaign->is_active) {
			throw new ValidationException('کمپین در وضعیت قابل استفاده ای نیست');
		}

		if ($campaign->usage_limit === $campaign->used_count) {
			throw new ValidationException('سقف استفاده از کمپین پر شده است');
		}

		if (Carbon::now()->lt($campaign->start_date)) {
			throw new ValidationException('کمپین هنوز شروع نشده است');
		}

		if ($campaign->is_expired) {
			throw new ValidationException('تاریخ استفاده از کمپین منقضی شده است');
		}
	}
}
