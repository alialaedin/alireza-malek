<x-dashboard::admin.layout.master>

  @php
    $companyTypeReal = \Modules\Company\Enums\CompanyType::REAL;
    $companyTypeLegal = \Modules\Company\Enums\CompanyType::LEGAL;
  @endphp

  <div class="page-header">
    <x-breadcrumb :items="config('admin-breadcrumbs.contract-companies.index')"/>
    <div>
      <x-link-create-button title="قرارداد شرکت حقیقی" :route="route('admin.contract-companies.create', $companyTypeReal)"/>
      <x-link-create-button title="قرارداد شرکت حقوقی" :route="route('admin.contract-companies.create', $companyTypeLegal)"/>
    </div>
  </div>

  <x-core::filter-form :action="route('admin.contract-companies.index')" :inputs="$filters" />

  <x-card title="قرارداد ها">
    <x-table :pagination="$contracts">
      <x-slot name="thead">
        <tr>
          <th>ردیف</th>
          <th>شرکت / شخص حقیقی</th>
          <th>موبایل</th>
          <th>شماره قرارداد</th>
          <th>موضوع</th>
          <th>تاریخ شروع</th>
          <th>تاریخ پایان</th>
          <th>وضعیت</th>
          <th>تاریخ ثبت</th>
          <th>عملیات</th>
        </tr>
      </x-slot>
      <x-slot name="tbody">
        @forelse ($contracts as $contract)
          <tr>
            <td class="font-weight-bold">{{ $loop->iteration }}</td>
            <td>{{ $contract->company->name }}</td>
            <td>{{ $contract->company->mobile }}</td>

            <td>{{ $contract->contract_number }}</td>
            <td>{{ $contract->subject }}</td>

            <td>{{ verta($contract->start_date)->format('Y/m/d') }}</td>
            <td>{{ verta($contract->end_date)->format('Y/m/d') }}</td>
            <td>
              <x-badge :is-light="1" :type="$contract->status->color()" :text="$contract->status->label()"/>
            </td>
            <td>
              <x-jalali-date :date="$contract->created_at"/>
            </td>
            <td>
              @if($contract->hasMedia('contract_company_files'))
                <a href="{{ $contract->getMediaUrl('contract_company_files') }}"
                   class="btn btn-icon btn-sm btn-gray-dark" data-toggle="tooltip"
                   data-original-title="دانلود فایل" download>
                  <i class="fa fa-download"></i>
                </a>
              @endif
              <x-show-button :model="$contract" route="admin.contract-companies.show"/>
              <x-edit-button :model="$contract" route="admin.contract-companies.edit"/>
              <x-delete-button :model="$contract" route="admin.contract-companies.destroy"/>
            </td>
          </tr>
        @empty
          <x-no-data :colspan="10"/>
        @endforelse
      </x-slot>
    </x-table>
  </x-card>

  @push('scripts')
    @stack('filter-form-scripts')
  @endpush

</x-dashboard::admin.layout.master>
