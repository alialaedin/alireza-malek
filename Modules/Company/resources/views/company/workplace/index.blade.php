<x-dashboard::company.layout.master>

  <div class="page-header">
    <x-breadcrumb :items="config('company-breadcrumbs.workplaces.index')" />
    <x-link-create-button title="محل کار جدید" :route="route('company.workplaces.create')" />
  </div>

  <x-card title="محل های کار">
    <x-table>
      <x-slot name="thead">
        <tr>
          <th>ردیف</th>
          <th>عنوان</th>
          <th>آدرس</th>
          <th>وضعیعت</th>
          <th>تاریخ ثبت</th>
          <th>عملیات</th>
        </tr>
      </x-slot>
      <x-slot name="tbody">
        @forelse ($workplaces as $workplace)
          <tr>
            <td class="font-weight-bold">{{ $loop->iteration }}</td>
            <td>{{ $workplace->title }}</td>
            <td>{{ $workplace->address }}</td>
            <td>
              <x-badge :type="$workplace->status ? 'success' : 'danger'" :text="$workplace->status ? 'فعال' : 'غیر فعال'" />
            </td>
            <td>{{ verta($workplace->created_at)->format('Y/m/d H:i') }}</td>
            <td>
              <x-edit-button :model="$workplace" route="company.workplaces.edit" />
              <x-delete-button :model="$workplace" route="company.workplaces.destroy" />
            </td>
          </tr>
        @empty
          <x-no-data :colspan="6" />
        @endforelse
      </x-slot>
    </x-table>
  </x-card>

</x-dashboard::company.layout.master>