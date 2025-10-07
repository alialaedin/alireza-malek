<x-dashboard::company.layout.master>

  <div class="page-header">
    <x-breadcrumb :items="config('company-breadcrumbs.duties.index')" />
    <x-link-create-button title="ثبت وظیفه جدید" :route="route('company.duties.create')" />
  </div>

  <x-core::filter-form :action="route('company.duties.index')" :inputs="$filters" />

  <x-card title="لیست وظایف">
    <x-table>
      <x-slot name="thead">
        <tr>
          <th>ردیف</th>
          <th>نوع وظیفه</th>
          <th>عنوان</th>
          <th>توضیحات</th>
          <th>وضعیت</th>
          <th>تاریخ ثبت</th>
          <th>عملیات</th>
        </tr>
      </x-slot>
      <x-slot name="tbody">
        @forelse ($duties as $duty)
          <tr>
            <td class="font-weight-bold">{{ $loop->iteration }}</td>
            <td>
              <x-badge :type="$duty->type->color()" :text="$duty->type->label()" />
            </td>
            <td>{{ $duty->title }}</td>
            <td style="white-space: wrap ">{{ $duty->description }}</td>
            <td>
              <x-badge :type="$duty->status_color" :text="$duty->status_label" />
            </td>
            <td>{{ verta($duty->created_at) }}</td>
            <td>
              <x-edit-button route="company.duties.edit" :model="$duty" />
              <x-delete-button route="company.duties.destroy" :model="$duty" />
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