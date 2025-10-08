<x-dashboard::admin.layout.master>

	<div class="page-header">
		<x-breadcrumb :items="config('admin-breadcrumbs.real-companies.show')" />

		<div class="d-flex align-items-center" style="gap: 8px">
			<x-link-create-button title="شرکت جدید" :route="route('admin.real-companies.create')" />
			<x-edit-button :model="$realCompany" route="admin.real-companies.edit" title="ویرایش" />
			<x-delete-button :model="$realCompany" route="admin.real-companies.destroy" title="حذف"
				:disabled="!$realCompany->isDeletable()" />
		</div>

	</div>

	@php

		$info = $realCompany->information;

		$data = [
			'شناسه' => $realCompany->id,
			'نام کاربری' => $realCompany->username,
			'وضعیت لاگین' => $realCompany->login_status ? 'فعال' : 'غیر فعال',
			'وضعیت قرارداد' => $realCompany->contract_status->label(),
			'نام و نام خانوادگی' => $info->full_name,
			'نام پدر' => $info->father_name,
			'کد ملی' => $info->national_code,
			'موبایل' => $info->mobile,
			'مجوز فعالیت' => $info->activity_license->label(),
			'تاریخ ثبت' => verta($realCompany->created_at)->format('Y/m/d'),
		];
	@endphp

	<x-card title="اطلاعات شرکت">
		<div class="row">
			@foreach (array_chunk($data, 5, true) as $chunkedData)
				<div class="col-xl-6">
					<ul class="list-group">
						@foreach ($chunkedData as $title => $value)
							<li class="list-group-item"><b>{{ $title }} : </b> {{ $value }}</li>
						@endforeach
					</ul>
				</div>
			@endforeach
		</div>
		<ul class="list-group mt-4">
			<li class="list-group-item"><b>آدرس : </b> {{ $info->address }}</li>
		</ul>
	</x-card>

</x-dashboard::admin.layout.master>