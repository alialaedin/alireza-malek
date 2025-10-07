<x-dashboard::admin.layout.master>

  <div class="page-header">
    <x-breadcrumb :items="config('admin-breadcrumbs.provinces.show')" />
  </div>

  <x-card title="شهر های استان {{ $province->name }} ({{ $province->cities_count }})">
    <x-table>
      <x-slot name="thead">
        <tr>
          <th>ردیف</th>
          <th>نام شهر</th>
          <th>وضعیت</th>
          <th>تاریخ</th>
          <th>ساعت</th>
          <th>عملیات</th>
        </tr>
      </x-slot>
      <x-slot name="tbody">
        @forelse ($province->cities as $city)
          <tr>
            <td class="font-weight-bold">{{ $loop->iteration }}</td>
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
          <x-no-data :colspan="6" />
        @endforelse
      </x-slot>
    </x-table>
  </x-card>

</x-dashboard::admin.layout.master>