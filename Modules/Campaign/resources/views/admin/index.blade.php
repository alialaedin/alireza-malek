<x-dashboard::admin.layout.master>

  <div class="page-header">
    <x-breadcrumb :items="config('admin-breadcrumbs.campaigns.index')" />
    <x-link-create-button title="ثبت کمپین جدید" :route="route('admin.campaigns.create')" />
  </div>

  <x-core::filter-form :action="route('admin.campaigns.index')" :inputs="$filters" />

  <x-card title="کمپین ها">
    <x-table :pagination="$campaigns">
      <x-slot name="thead">
        <tr>
          <th>ردیف</th>
          <th>عنوان</th>
          <th>تاریخ شروع</th>
          <th>تاریخ پایان</th>
          <th>وضعیت</th>
          <th>حداکثر استفاده</th>
          <th>تعداد استفاده</th>
          <th>تاریخ ثبت</th>
          <th>عملیات</th>
        </tr>
      </x-slot>
      <x-slot name="tbody">
        @forelse ($campaigns as $campaign)
          <tr>
            <td class="font-weight-bold">{{ $loop->iteration }}</td>
            <td>{{ $campaign->title }}</td>
            <td>@jalaliDateFormat($campaign->start_date)</td>
            <td>@jalaliDateFormat($campaign->end_date)</td>
            <td>
              <x-badge :type="$campaign->is_active ? 'success' : 'danger'" :text="$campaign->is_active ? 'فعال' : 'غیر فعال'" />
            </td>
            <td>{{ $campaign->usage_limit }}</td>
            <td>{{ $campaign->used_count }}</td>
            <td>@jalaliDateTimeFormat($campaign->created_at)</td>
            <td>
              <x-show-button :model="$campaign" route="admin.campaigns.show" />
              <x-edit-button :model="$campaign" route="admin.campaigns.edit" />
              <x-delete-button :model="$campaign" route="admin.campaigns.destroy" />
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