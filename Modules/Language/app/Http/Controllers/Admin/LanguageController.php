<?php

namespace Modules\Language\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\Language\Http\Requests\Admin\LanguageStoreRequest;
use Modules\Language\Http\Requests\Admin\LanguageUpdateRequest;
use Modules\Language\Models\Language;

class LanguageController extends Controller
{
	public function index()
	{
		$languages = Language::getAll();

		return view('language::admin.index', compact('languages'));
	}

	public function create()
	{
		return view('language::admin.create');
	}

	public function store(LanguageStoreRequest $request)
	{
		Language::create($request->validated());

		return to_route('admin.languages.index')->with('status', 'زبان خارجه با موفقیت ایجاد شد');
	}

	public function edit(Language $language)
	{
		return view('language::admin.edit', compact('language'));
	}

	public function update(LanguageUpdateRequest $request, Language $language)
	{
		$language->update($request->validated());

		return to_route('admin.languages.index')->with('status', 'زبان خارجه با موفقیت بروزرسانی شد');
	}

	public function destroy(Language $language)
	{
		$language->delete();

		return to_route('admin.languages.index')->with('status', 'زبان خارجه با موفقیت حذف شد');
	}
}
