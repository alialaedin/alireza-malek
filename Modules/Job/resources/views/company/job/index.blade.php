<x-dashboard::company.layout.master>

  <div class="page-header">
    <x-breadcrumb :items="config('company-breadcrumbs.jobs.index')" />
    <x-link-create-button title="ثبت شغل جدید" :route="route('company.jobs.create')" />
  </div>

  <x-card title="لیست مشاغل">
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
        @forelse ($companyJobs as $job)
          <tr>
            <td class="font-weight-bold">{{ $loop->iteration }}</td>
            <td>{{ $job->name }}</td>
            <td>{{ $job->label }}</td>
            <td>
              <x-badge :type="$job->status_color" :text="$job->status_label" />
            </td>
            <td>{{ verta($job->created_at) }}</td>
            <td>
              <x-show-button route="company.jobs.show" :model="$job" />
              <x-edit-button route="company.jobs.edit" :model="$job" />
              <x-delete-button route="company.jobs.destroy" :model="$job" />
            </td>
          </tr>
        @empty
          <x-no-data :colspan="6" />
        @endforelse
      </x-slot>
    </x-table>
  </x-card>

</x-dashboard::company.layout.master>