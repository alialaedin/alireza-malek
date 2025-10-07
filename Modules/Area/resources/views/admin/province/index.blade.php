<x-dashboard::admin.layout.master>

  <div class="page-header">
    <x-breadcrumb :items="config('admin-breadcrumbs.provinces.index')" />
    <x-link-create-button title="ثبت استان جدید" :route="route('admin.provinces.create')" />
  </div>

  <x-core::filter-form :action="route('admin.provinces.index')" :inputs="$filters" />

  <x-card title="استان ها">
    <x-table>
      <x-slot name="thead">
        <tr>
          <th>ردیف</th>
          <th>استان</th>
          <th>تعداد شهر ها</th>
          <th>وضعیت</th>
          <th>تاریخ</th>
          <th>ساعت</th>
          <th>عملیات</th>
        </tr>
      </x-slot>
      <x-slot name="tbody">
        @forelse ($provinces as $province)
          <tr>
            <td class="font-weight-bold">{{ $loop->iteration }}</td>
            <td>{{ $province->name }}</td>
            <td>{{ $province->cities_count }}</td>
            <td>
              <x-badge :type="$province->status ? 'success' : 'danger'" :text="$province->status ? 'فعال' : 'غیر فعال'" />
            </td>
            <td><x-jalali-date :date="$province->created_at" format="date" /></td>
            <td><x-jalali-date :date="$province->created_at" format="time" /></td>
            <td>
              <x-show-button :model="$province" route="admin.provinces.show" />
              <x-edit-button :model="$province" route="admin.provinces.edit" />
              <x-delete-button :model="$province" route="admin.provinces.destroy" :disabled="!$province->isDeletable()" />
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
