<x-dashboard::company.layout.master>

  <div class="page-header">
    <x-breadcrumb :items="config('company-breadcrumbs.employees.index')" />
  </div>

  <x-core::filter-form :action="route('company.employees.index')" :inputs="$filters" />

  <x-card title="لیست کارمندان">
    <x-table :pagination="$employees">
      <x-slot name="thead">
        <tr>
          <th>ردیف</th>
          <th>نام کامل</th>
          <th>موبایل</th>
          <th>وضعیت فرم استخدام</th>
          <th>وضعیت لاگین</th>
          <th>تاریخ ثبت</th>
          <th>عملیات</th>
        </tr>
      </x-slot>
      <x-slot name="tbody">
        @forelse ($employees as $employee)
          <tr>
            <td class="font-weight-bold">{{ $loop->iteration }}</td>
            <td>{{ $employee->full_name }}</td>
            <td>{{ $employee->mobile }}</td>
            <td>
              <x-badge>
                <x-slot name="type">{{ $employee->employmentForm->status->color() }}</x-slot>
                <x-slot name="text">{{ $employee->employmentForm->status->label() }}</x-slot>
              </x-badge>
            </td>
            <td>
              <x-badge :is-light="true">
                <x-slot name="type">{{ $employee->has_seen ? 'success' : 'danger' }}</x-slot>
                <x-slot name="text">{{ $employee->has_seen ? 'فعال' : 'غیر فعال' }}</x-slot>
              </x-badge>
            </td>
            <td>@jalaliDateTimeFormat($employee->created_at)</td>
            <td>
              <x-show-button route="company.employees.show" :model="$employee" />
              <x-edit-button route="company.employees.edit" :model="$employee" />
              <x-delete-button route="company.employees.destroy" :model="$employee" />
            </td>
          </tr>
        @empty
          <x-no-data :colspan="7" />
        @endforelse
      </x-slot>
    </x-table>
  </x-card>

</x-dashboard::company.layout.master>