<x-dashboard::admin.layout.master>

  <div class="page-header">
    <x-breadcrumb :items="config('admin-breadcrumbs.contract-companies.show')" />
  </div>

  @php
    $contract = $contractCompany;
    $company = $contract->company;
  @endphp

  <x-card title="اطلاعات شرکت">
    <div class="row">
      <div class="col-xl-6">
        <ul class="list-group">
          <li class="list-group-item"><b>شناسه : </b> {{ $company->id }}</li>
          <li class="list-group-item"><b>نام کاربری : </b> {{ $company->username }}</li>
          <li class="list-group-item"><b>نام شرکت / شخص حقیقی : </b> {{ $company->name }}</li>
        </ul>
      </div>
      <div class="col-xl-6">
        <ul class="list-group">
          <li class="list-group-item"><b>کد ملی : </b> {{ $company->national_code }}</li>
          <li class="list-group-item"><b>موبایل : </b> {{ $company->mobile }}</li>
          <li class="list-group-item"><b>مجوز فعالیت : </b> {{ $company->activity_license->label() }}</li>
        </ul>
      </div>
    </div>
  </x-card>

  <x-card title="اطلاعات قرارداد">
    <div class="row">
      <div class="col-xl-6">
        <ul class="list-group">
          <li class="list-group-item"><b>موضوع : </b> {{ $contract->subject }}</li>
          <li class="list-group-item"><b>شماره قرارداد : </b> {{ $contract->contract_number }}</li>
          <li class="list-group-item"><b>تاریخ شروع : </b> {{ verta($contract->start_date)->format('Y/m/d') }}</li>
          <li class="list-group-item"><b>تاریخ پایان : </b> {{ verta($contract->end_date)->format('Y/m/d') }}</li>
          <li class="list-group-item"><b>وضعیت : </b> {{ $contract->status->label() }}</li>
        </ul>
      </div>
      <div class="col-xl-6">
        <ul class="list-group">
          <li class="list-group-item"><b>تاریخ ثبت : </b> {{ verta($contract->created_at)->format('Y/m/d H:i') }}</li>
          <li class="list-group-item"><b>مبلغ قرارداد : </b> {{ number_format($contract->final_amount) }} تومان</li>
          <li class="list-group-item"><b>وجه التزام : </b> {{ number_format($contract->guarantee_amount) }} تومان</li>
          <li class="list-group-item"><b>تاریخ امضا توسط ادمین : </b>
            {{ $contract->signature_date_webmaster ? verta($contract->signature_date_webmaster)->format('Y/m/d') : '-' }}
          </li>
          <li class="list-group-item"><b>تاریخ امضا توسط شرکت : </b>
            {{ $contract->signature_date_company ? verta($contract->signature_date_company)->format('Y/m/d') : '-' }}
          </li>
        </ul>
      </div>
    </div>
  </x-card>

  <x-card title="شرایط و قوانین">
    <div class="row">
      <div class="col-12">
        <p>{{ $contract->terms }}</p>
      </div>
    </div>
  </x-card>

  <x-card title="شرایط پرداخت">
    <div class="row">
      <div class="col-12">
        <p>{{ $contract->payment_terms }}</p>
      </div>
    </div>
  </x-card>

  <x-card title="نوت">
    <div class="row">
      <div class="col-12">
        <p>{{ $contract->notes }}</p>
      </div>
    </div>
  </x-card>

  @push('styles')
    <style>
      b {
        font-size: 12px;
      }

      .list-group-item {
        font-size: 13px;
        padding: 10px 20px;
      }
    </style>
  @endpush

</x-dashboard::admin.layout.master>