<x-dashboard::admin.layout.master>

	<div class="page-header">
		<x-breadcrumb :items="config('admin-breadcrumbs.legal-companies.show')" />

		<div class="d-flex align-items-center" style="gap: 8px">
			<x-link-create-button title="شرکت جدید" :route="route('admin.legal-companies.create')" />
			<x-edit-button :model="$legalCompany" route="admin.legal-companies.edit" title="ویرایش" />
			<x-delete-button :model="$legalCompany" route="admin.legal-companies.destroy" title="حذف"
				:disabled="!$legalCompany->isDeletable()" />
		</div>

	</div>

	@php

		$info = $legalCompany->information;

		$data = [
			'شناسه' => $legalCompany->id,
			'نام کاربری' => $legalCompany->username,
			'وضعیت لاگین' => $legalCompany->login_status ? 'فعال' : 'غیر فعال',
			'وضعیت قرارداد' => $legalCompany->contract_status->label(),
			'نام شرکت' => $info->company_name,
			'موبایل مدیریت' => $info->managment_mobile,
			'برند' => $info->brand ?? '-',
			'شناسه ملی' => $info->national_id,
			'تاریخ ثبت' => verta($legalCompany->created_at)->format('Y/m/d'),
			'آدرس' => $info->address
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
	</x-card>

	<x-card title="صاحبان امضا">
		<x-table>
			<x-slot name="thead">
				<tr>
					<th>ردیف</th>
					<th>نام و نام خانوادگی</th>
					<th>شماره تماس</th>
					<th>کد ملی</th>
					<th>نام پدر</th>
					<th>سمت شغلی</th>
				</tr>
			</x-slot>
			<x-slot name="tbody">
				@foreach ($legalCompany->signatureOwners as $owner)
					<tr>
						<td class="font-weight-bold">{{ $loop->iteration }}</td>
						<td>{{ $owner->full_name }}</td>
						<td>{{ $owner->mobile }}</td>
						<td>{{ $owner->national_code }}</td>
						<td>{{ $owner->father_name }}</td>
						<td>{{ $owner->position->title }}</td>
					</tr>
				@endforeach
			</x-slot>
		</x-table>
	</x-card>

</x-dashboard::admin.layout.master>