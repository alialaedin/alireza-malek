<x-dashboard::admin.layout.master>

  <div class="page-header">
    <x-breadcrumb :items="config('admin-breadcrumbs.profile.index')" />
  </div>

  @php
    $admin = auth(Modules\Auth\Enums\GuardName::ADMIN->value)->user();
  @endphp

  <x-card title="بروزرسانی پروفایل">
    <x-form :action="route('admin.profile.update')" method="PATCH" enctype="multipart/form-data">

      <div class="row">

        <x-col lg="6" xl="3">
          <x-form-group>
            <x-label :is-required="true" text="نام کامل" />
            <x-input type="text" name="name" :default-value="$admin->name" />
          </x-form-group>
        </x-col>

        <x-col lg="6" xl="3">
          <x-form-group>
            <x-label :is-required="true" text="موبایل" />
            <x-input type="text" name="mobile" :default-value="$admin->mobile" />
          </x-form-group>
        </x-col>

         <x-col lg="6" xl="3">
          <x-form-group>
            <x-label :is-required="true" text="ایمیل" />
            <x-input type="email" name="email" :default-value="$admin->email" />
          </x-form-group>
        </x-col>

      </div>

      <div class="row">

        <x-col lg="6" xl="3">
          <x-form-group>
            <x-label :is-required="true" text="نام کاربری" />
            <x-input type="text" name="username" :default-value="$admin->username" />
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

      </div class="row">

    </x-form>
  </x-card>

</x-dashboard::admin.layout.master>