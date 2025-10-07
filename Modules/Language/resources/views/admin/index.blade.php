<x-dashboard::admin.layout.master>

  <div class="page-header">
    <x-breadcrumb :items="config('admin-breadcrumbs.languages.index')" />
    <x-link-create-button title="ثبت زبان خارجه جدید" :route="route('admin.languages.create')" />
  </div>

  <x-card title="زبان های خارجه">
    <x-table>
      <x-slot name="thead">
        <tr>
          <th>ردیف</th>
          <th>نام فارسی</th>
          <th>نام لاتین</th>
          <th>کد زبان</th>
          <th>نام زبان</th>
          <th>وضعیت</th>
          <th>تاریخ ثبت</th>
          <th>عملیات</th>
        </tr>
      </x-slot>
      <x-slot name="tbody">
        @forelse ($languages as $language)
          <tr>
            <td class="font-weight-bold">{{ $loop->iteration }}</td>
            <td>{{ $language->persian_name }}</td>
            <td>{{ $language->english_name }}</td>
            <td>{{ $language->code }}</td>
            <td>{{ $language->native_name }}</td>
            <td>
              <x-badge :type="$language->status ? 'success' : 'danger'" :text="$language->status ? 'فعال' : 'غیر فعال'" />
            </td>
            <td><x-jalali-date :date="$language->created_at" /></td>
            <td>
              <x-edit-button :model="$language" route="admin.languages.edit" />
              <x-delete-button :model="$language" route="admin.languages.destroy" :disabled="!$language->isDeletable()" />
            </td>
          </tr>
        @empty
          <x-no-data :colspan="8" />
        @endforelse
      </x-slot>
    </x-table>
  </x-card>

</x-dashboard::admin.layout.master>