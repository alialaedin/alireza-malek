<?php

namespace Modules\Campaign\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\Campaign\Enums\CampaignDiscountType;
use Modules\Campaign\Http\Requests\Admin\CampaignStoreRequest;
use Modules\Campaign\Http\Requests\Admin\CampaignUpdateRequest;
use Modules\Campaign\Models\Campaign;

class CampaignController extends Controller
{
	public function index()
	{
		$filters = Campaign::getFilterInputs();
		$campaigns = Campaign::query()
			->select(['id', 'title', 'start_date', 'end_date', 'is_active', 'created_at', 'usage_limit', 'used_count'])
			->latest()
			->filters()
			->paginate()
			->withQueryString();

		return view('campaign::admin.index', compact(['campaigns', 'filters']));
	}

	public function create()
	{
		$discountTypes = CampaignDiscountType::getCasesWithLabel();

		return view('campaign::admin.create', compact('discountTypes'));
	}

	public function store(CampaignStoreRequest $request)
	{
		Campaign::create($request->validated());

		return to_route('admin.campaigns.index')->with('status', 'کمپین با موفقیت ایجاد شد');
	}

	public function show(Campaign $campaign)
	{
		return view('campaign::admin.show', compact('campaign'));
	}

	public function edit(Campaign $campaign)
	{
		$discountTypes = CampaignDiscountType::getCasesWithLabel();

		return view('campaign::admin.edit', compact(['discountTypes', 'campaign']));
	}

	public function update(CampaignUpdateRequest $request, Campaign $campaign)
	{
		$campaign->update($request->validated());

		return to_route('admin.campaigns.index')->with('status', 'کمپین با موفقیت بروزرسانی شد');
	}

	public function destroy(Campaign $campaign)
	{
		$campaign->delete();

		return to_route('admin.campaigns.index')->with('status', 'کمپین با موفقیت حذف شد');
	}
}
