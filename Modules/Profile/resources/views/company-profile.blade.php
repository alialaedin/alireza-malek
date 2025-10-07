<x-dashboard::company.layout.master>

  <div class="page-header">
    <x-breadcrumb :items="config('company-breadcrumbs.profile.index')" />
  </div>

  @php
    $company = auth(Modules\Auth\Enums\GuardName::COMPANY->value)->user();
  @endphp

  <x-card title="بروزرسانی پروفایل">
    <x-form :action="route('company.profile.update')" method="PATCH" enctype="multipart/form-data">
      <div class="row">

        <x-col lg="6" xl="3">
          <x-form-group>
            <x-label :is-required="true" text="نام کاربری" />
            <x-input type="text" name="username" :default-value="$company->username" />
          </x-form-group>
        </x-col>

        <x-col lg="6" xl="3">
          <x-form-group>
            <x-label text="کلمه عبور فعلی" />
            <x-input type="password" name="current_password" />
          </x-form-group>
        </x-col>

        <x-col lg="6" xl="3">
          <x-form-group>
            <x-label text="کلمه عبور جدید" />
            <x-input type="password" name="password" />
          </x-form-group>
        </x-col>

        <x-col lg="6" xl="3">
          <x-form-group>
            <x-label text="تکرار کلمه عبور" />
            <x-input type="password" name="password_confirmation" />
          </x-form-group>
        </x-col>

        @if ($company->type === Modules\Company\Enums\CompanyType::LEGAL)
          <x-profile::legal-company-inputs :company="$company" />
        @elseif ($company->type === Modules\Company\Enums\CompanyType::REAL)
          <x-profile::real-company-inputs :company="$company" />
        @endif

      </div class="row">
    </x-form>
  </x-card>

</x-dashboard::company.layout.master>