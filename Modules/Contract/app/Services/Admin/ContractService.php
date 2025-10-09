<?php

namespace Modules\Contract\Services\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Modules\Campaign\Enums\CampaignDiscountType;
use Modules\Contract\Models\ContractCompany;
use Modules\Campaign\Models\Campaign;

class ContractService
{
	public static function calculateFinalAmount(ContractCompany $contract): int
	{
		$baseAmount = $contract->payment_amount;
		$campaign = $contract->campaign;

		if (!$campaign) {
			return $baseAmount;
		}

		$discount = match ($campaign->discount_type) {
			CampaignDiscountType::PERCENTAGE => ($baseAmount * $campaign->discount_amount) / 100,
			CampaignDiscountType::FLAT => $campaign->discount_amount,
			default => 0,
		};

		$finalAmount = $baseAmount - $discount;

		return max(0, (int) $finalAmount);
	}

	public static function store(Request $request): ContractCompany
	{
		$contractModel = new ContractCompany;
		$fillable = $contractModel->getFillable();

		$attributes = Arr::only($request->validated(), $fillable);
		$contract = ContractCompany::query()->create($attributes);

		if ($request->filled('campaign_id')) {
			self::assignCampaign($contract, $request->input('campaign_id'));
		}

		$contract->uploadFiles($request);

		return $contract;
	}

	public static function update(ContractCompany $contract, Request $request): ContractCompany
	{
		$contractModel = new ContractCompany;
		$fillable = $contractModel->getFillable();

		$attributes = Arr::only($request->validated(), $fillable);
		$contract->update($attributes);

		$contract->uploadFiles($request);

		if ($request->filled('campaign_id')) {
			if ($contract->campaign) {
				$contract->campaign->disuse();
			}
			self::assignCampaign($contract, $request->input('campaign_id'));
		}

		return $contract;
	}

	private static function assignCampaign(ContractCompany $contract, int $campaignId): void
	{
		$campaign = Campaign::find($campaignId);

		if (!$campaign) {
			return;
		}

		$contract->campaign()->associate($campaign);
		$contract->save();

		$campaign->use();
	}
}
