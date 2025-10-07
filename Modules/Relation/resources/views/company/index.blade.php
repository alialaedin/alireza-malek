<x-dashboard::company.layout.master>

  <div class="page-header">
    <x-breadcrumb :items="config('company-breadcrumbs.relations.index')" />
    <x-link-create-button title="ثبت نسبت خانوادگی جدید" :route="route('company.relations.create')" />
  </div>

  <x-card title="نسبت های خانوادگی">
    <x-table>
      <x-slot name="thead">
        <tr>
          <th>ردیف</th>
          <th>عنوان</th>
          <th>وضعیت</th>
          <th>تاریخ</th>
          <th>ساعت</th>
          <th>عملیات</th>
        </tr>
      </x-slot>
      <x-slot name="tbody">
        @forelse ($relations as $relation)
          <tr>
            <td class="font-weight-bold">{{ $loop->iteration }}</td>
            <td>{{ $relation->name }}</td>
            <td>
              <x-badge :type="$relation->status ? 'success' : 'danger'" :text="$relation->status ? 'فعال' : 'غیر فعال'" />
            </td>
            <td>{{ verta($relation->created_at)->format('Y/m/d') }}</td>
            <td>{{ verta($relation->created_at)->format('H:i:s') }}</td>
            <td>
              <x-edit-button :model="$relation" route="company.relations.edit" />
              <x-delete-button :model="$relation" route="company.relations.destroy" :disabled="!$relation->isDeletable()" />
            </td>
          </tr>
        @empty
          <x-no-data :colspan="6" />
        @endforelse
      </x-slot>
    </x-table>
  </x-card>

</x-dashboard::company.layout.master>