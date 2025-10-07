<x-dashboard::company.layout.master>

  <div class="page-header">
    <x-breadcrumb :items="config('company-breadcrumbs.finances.index')" />
    <x-link-create-button title="دارایی جدید" :route="route('company.finances.create')" />
  </div>

  <x-core::filter-form :action="route('company.finances.index')" :inputs="$filters" />

  <x-card title="لیست اموال و دارایی ها">
    <x-table>
      <x-slot name="thead">
        <tr>
          <th>ردیف</th>
          <th>نام دارایی</th>
          <th>شماره اموال</th>
          <th>وضعیت</th>
          <th>تاریخ</th>
          <th>ساعت</th>
          <th>عملیات</th>
        </tr>
      </x-slot>
      <x-slot name="tbody">
        @forelse ($finances as $finance)
          <tr>
            <td class="font-weight-bold">{{ $loop->iteration }}</td>
            <td>{{ $finance->name }}</td>
            <td>{{ $finance->code }}</td>
            <td>
              <x-badge :type="$finance->status ? 'success' : 'danger'" :text="$finance->status ? 'فعال' : 'غیر فعال'" />
            </td>
            <td>{{ verta($finance->created_at)->format('Y/m/d') }}</td>
            <td>{{ verta($finance->created_at)->format('H:i:s') }}</td>
            <td>
              <x-edit-button :model="$finance" route="company.finances.edit" />
              <x-delete-button :model="$finance" route="company.finances.destroy" />
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

</x-dashboard::company.layout.master>