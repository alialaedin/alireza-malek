<x-dashboard::admin.layout.master>

  <div class="page-header">
    <x-breadcrumb :items="config('admin-breadcrumbs.cities.index')" />
    <x-link-create-button title="ثبت شهر جدید" :route="route('admin.cities.create')" />
  </div>

  <x-core::filter-form :action="route('admin.cities.index')" :inputs="$filters" />

  <x-card title="شهر ها">
    <x-table :pagination="$cities">
      <x-slot name="thead">
        <tr>
          <th>ردیف</th>
          <th>استان</th>
          <th>شهر</th>
          <th>وضعیت</th>
          <th>تاریخ</th>
          <th>ساعت</th>
          <th>عملیات</th>
        </tr>
      </x-slot>
      <x-slot name="tbody">
        @forelse ($cities as $city)
          <tr>
            <td class="font-weight-bold">{{ $loop->iteration }}</td>
            <td>{{ $city->province->name }}</td>
            <td>{{ $city->name }}</td>
            <td>
              <x-badge :type="$city->status ? 'success' : 'danger'" :text="$city->status ? 'فعال' : 'غیر فعال'" />
            </td>
            <td><x-jalali-date :date="$city->created_at" format="date" /></td>
            <td><x-jalali-date :date="$city->created_at" format="time" /></td>
            <td>
              <x-edit-button :model="$city" route="admin.cities.edit" />
              <x-delete-button :model="$city" route="admin.cities.destroy" :disabled="!$city->isDeletable()" />
            </td>
          </tr>
        @empty
          <x-no-data :colspan="7" />
        @endforelse
      </x-slot>
    </x-table>
  </x-card>

  @push('scripts')
    @stack('filter-form-scripts')
  @endpush

</x-dashboard::admin.layout.master>
