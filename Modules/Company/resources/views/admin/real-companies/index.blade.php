<x-dashboard::admin.layout.master>

  <div class="page-header">
    <x-breadcrumb :items="config('admin-breadcrumbs.real-companies.index')" />
    <x-link-create-button title="ثبت شرکت حقیقی جدید" :route="route('admin.real-companies.create')" />
  </div>z

  <x-card title="شرکت های حقیقی">
    <x-table :pagination="$realCompanies">
      <x-slot name="thead">
        <tr>
          <th>ردیف</th>
          <th>نام و نام خانوادگی</th>
          <th>موبایل</th>
          <th>وضعیت لاگین</th>
          <th>وضعیت قرارداد</th>
          <th>تاریخ ثبت</th>
          <th>عملیات</th>
        </tr>
      </x-slot>
      <x-slot name="tbody">
        @forelse ($realCompanies as $company)
          <tr>
            <td class="font-weight-bold">{{ $loop->iteration }}</td>
            <td>{{ $company->information->full_name }}</td>
            <td>{{ $company->information->mobile }}</td>
            <td>
              <x-badge :type="$company->login_status ? 'success' : 'danger'" :text="$company->login_status ? 'فعال' : 'غیر فعال'" />
            </td>
            <td>
              <x-badge :is-light="1" :type="$company->contract_status->color()"
                :text="$company->contract_status->label()" />
            </td>
            <td><x-jalali-date :date="$company->created_at" /></td>
            <td>
              <x-show-button :model="$company" route="admin.real-companies.show" />
              <x-edit-button :model="$company" route="admin.real-companies.edit" />
              <x-delete-button :model="$company" route="admin.real-companies.destroy"
                :disabled="!$company->isDeletable()" />
            </td>
          </tr>
        @empty
          <x-no-data :colspan="7" />
        @endforelse
      </x-slot>
    </x-table>
  </x-card>

</x-dashboard::admin.layout.master>
