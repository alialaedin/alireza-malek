<?php

namespace Modules\Position\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\Position\Http\Requests\Admin\PositionStoreRequest;
use Modules\Position\Http\Requests\Admin\PositionUpdateRequest;
use Modules\Position\Models\Position;

class PositionController extends Controller
{
	public function index()
	{
		$positions = Position::getAll(false);

		return view('position::admin.index', compact('positions'));
	}

	public function create()
	{
		return view('position::admin.create');
	}

	public function store(PositionStoreRequest $request)
	{
		Position::create($request->validated());

		return to_route('admin.positions.index')->with('status', 'سمت شغلی با موفقیت ایجاد شد');
	}

	public function edit(Position $position)
	{
		return view('position::admin.edit', compact('position'));
	}

	public function update(PositionUpdateRequest $request, Position $position)
	{
		$position->update($request->validated());

		return to_route('admin.positions.index')->with('status', 'سمت شغلی با موفقیت بروزرسانی شد');
	}

	public function destroy(Position $position)
	{
		$position->delete();

		return to_route('admin.positions.index')->with('status', 'سمت شغلی با موفقیت حذف شد');
	}
}
