<x-dashboard::admin.layout.master>

  <div class="page-header">
    <x-breadcrumb :items="config('admin-breadcrumbs.companies.index')" />
    <x-link-create-button title="ثبت شرکت جدید" :route="route('admin.companies.create')" />
  </div>

  <x-core::filter-form :action="route('admin.companies.index')" :inputs="$filters" />

  <x-card title="لیست شرکت ها">
    <x-table :pagination="$companies">
      <x-slot name="thead">
        <tr>
          <th>ردیف</th>
          <th>نام شرکت / شخص</th>
          <th>نوع شرکت</th>
          <th>موبایل</th>
          <th>نام کاربری</th>
          <th>وضعیت لاگین</th>
          <th>تاریخ ثبت</th>
          <th>عملیات</th>
        </tr>
      </x-slot>
      <x-slot name="tbody">
        @forelse ($companies as $company)
          <tr>
            <td class="font-weight-bold">{{ $loop->iteration }}</td>
            <td>{{ $company->name }}</td>
            <td>
              <x-badge :type="$company->type->color()" :text="$company->type->label()" />
            </td>
            <td>{{ $company->mobile }}</td>
            <td>{{ $company->username }}</td>
            <td>
              <x-badge :type="$company->login_status ? 'success' : 'danger'" :text="$company->login_status ? 'فعال' : 'غیر فعال'" />
            </td>
            <td>@jalaliDateTimeFormat($company->created_at)</td>
            <td>
              <x-show-button :model="$company" route="admin.companies.show" />
              <x-edit-button :model="$company" route="admin.companies.edit" />
              <x-delete-button :model="$company" route="admin.companies.destroy" :disabled="!$company->isDeletable()" />
            </td>
          </tr>
        @empty
          <x-no-data :colspan="8" />
        @endforelse
      </x-slot>
    </x-table>
  </x-card>

  @push('scripts')
    @stack('filter-form-scripts')
  @endpush

</x-dashboard::admin.layout.master>