<x-dashboard::admin.layout.master>

  <div class="page-header">
    <x-breadcrumb :items="config('admin-breadcrumbs.legal-companies.index')" />
    <x-link-create-button title="ثبت شرکت حقوقی جدید" :route="route('admin.legal-companies.create')" />
  </div>

  <x-card title="شرکت های حقوقی">
    <x-table :pagination="$legalCompanies">
      <x-slot name="thead">
        <tr>
          <th>ردیف</th>
          <th>نام شرکت</th>
          <th>موبایل مدیریت</th>
          <th>برند</th>
          <th>شناسه ملی</th>
          <th>وضعیت لاگین</th>
          <th>وضعیت قرارداد</th>
          <th>تاریخ ثبت</th>
          <th>عملیات</th>
        </tr>
      </x-slot>
      <x-slot name="tbody">
        @forelse ($legalCompanies as $company)
          <tr>
            <td class="font-weight-bold">{{ $loop->iteration }}</td>
            <td>{{ $company->information->company_name }}</td>
            <td>{{ $company->information->managment_mobile }}</td>
            <td>{{ $company->information->brand ?? '-' }}</td>
            <td>{{ $company->information->national_id }}</td>
            <td>
              <x-badge :type="$company->login_status ? 'success' : 'danger'" :text="$company->login_status ? 'فعال' : 'غیر فعال'" />
            </td>
            <td>
              <x-badge :is-light="1" :type="$company->contract_status->color()"
                :text="$company->contract_status->label()" />
            </td>
            <td><x-jalali-date :date="$company->created_at" /></td>
            <td>
              <x-show-button :model="$company" route="admin.legal-companies.show" />
              <x-edit-button :model="$company" route="admin.legal-companies.edit" />
              <x-delete-button :model="$company" route="admin.legal-companies.destroy"
                :disabled="!$company->isDeletable()" />
            </td>
          </tr>
        @empty
          <x-no-data :colspan="9" />
        @endforelse
      </x-slot>
    </x-table>
  </x-card>

</x-dashboard::admin.layout.master>