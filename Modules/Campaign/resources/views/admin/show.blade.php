<x-dashboard::admin.layout.master>

  <div class="page-header">
    <x-breadcrumb :items="config('admin-breadcrumbs.campaigns.show')" />

    <div class="d-flex align-items-center" style="gap: 8px">
      <x-link-create-button title="کمپین جدید" :route="route('admin.campaigns.create')" />
      <x-edit-button :model="$campaign" route="admin.campaigns.edit" title="ویرایش" />
      <x-delete-button :model="$campaign" route="admin.campaigns.destroy" title="حذف" />
    </div>

  </div>

  @php
    $data = [
      'شناسه' => $campaign->id,
      'عنوان' => $campaign->title,
      'حداکثر استفاده' => $campaign->usage_limit,
      'تعداد استفاده' => $campaign->used_count,
      'تاریخ ثبت' => verta($campaign->created_at)->format('Y/m/d'),
      'تاریخ شروع' => verta($campaign->start_date)->format('Y/m/d'),
      'تاریخ پایان' => verta($campaign->end_date)->format('Y/m/d'),
      'نوع تخفیف' => $campaign->discount_type->label(),
      'میزان تخفیف' => number_format($campaign->discount_amount),
      'وضعیت' => $campaign->is_active ? 'فعال' : 'غیر فعال',
    ];
  @endphp

  <x-card title="اطلاعات کمپین">
    <div class="row">
      @foreach (array_chunk($data, 5, true) as $chunkedData)
        <div class="col-xl-6">
          <ul class="list-group">
            @foreach ($chunkedData as $title => $value)
              <li class="list-group-item"><b>{{ $title }} : </b> {{ $value }}</li>
            @endforeach
          </ul>
        </div>
      @endforeach
    </div>
    <ul class="list-group mt-4">
      <li class="list-group-item"><b>توضیحات : </b> {{ $campaign->description }}</li>
    </ul>
  </x-card>

</x-dashboard::admin.layout.master>