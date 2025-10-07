<x-dashboard::admin.layout.master>

  <div class="page-header">
    <x-breadcrumb :items="config('admin-breadcrumbs.positions.index')" />
    <x-link-create-button title="ثبت سمت شغلی جدید" :route="route('admin.positions.create')" />
  </div>

  <x-card title="سمت های شغلی">
    <x-table>
      <x-slot name="thead">
        <tr>
          <th>ردیف</th>
          <th>عنوان انگیلیسی</th>
          <th>نام فارسی</th>
          <th>وضعیت</th>
          <th>تاریخ ثبت</th>
          <th>عملیات</th>
        </tr>
      </x-slot>
      <x-slot name="tbody">
        @forelse ($positions as $position)
          <tr>
            <td class="font-weight-bold">{{ $loop->iteration }}</td>
            <td>{{ $position->en_title }}</td>
            <td>{{ $position->title }}</td>
            <td>
              <x-badge :type="$position->status ? 'success' : 'danger'" :text="$position->status ? 'فعال' : 'غیر فعال'" />
            </td>
            <td><x-jalali-date :date="$position->created_at" /></td>
            <td>
              <x-edit-button :model="$position" route="admin.positions.edit" />
              <x-delete-button :model="$position" route="admin.positions.destroy" :disabled="!$position->isDeletable()" />
            </td>
          </tr>
        @empty
          <x-no-data :colspan="6" />
        @endforelse
      </x-slot>
    </x-table>
  </x-card>

</x-dashboard::admin.layout.master>