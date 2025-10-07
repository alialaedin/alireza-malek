<x-dashboard::admin.layout.master>

  <div class="page-header">
    <x-breadcrumb :items="config('admin-breadcrumbs.cities.edit')" />
  </div>

  <x-card title="ویرایش شهر">
    <x-form :action="route('admin.cities.update', $city)" method="PATCH">
      <div class="row">
        <div class="col-xl-3">
          <x-form-group>
            <x-label :is-required="true" text="انتخاب استان" />
            <x-select name="province_id" :data="$provinces" option-value="id" option-label="name"
              :default-value="$city->province_id" />
          </x-form-group>
        </div>
        <div class="col-xl-3">
          <x-form-group>
            <x-label :is-required="true" text="عنوان (فارسی)" />
            <x-input type="text" name="name" :default-value="$city->name" />
          </x-form-group>
        </div>
        <div class="col-12">
          <x-form-group>
            <x-checkbox name="status" title="وضعیت" :is-checked="$city->status" />
          </x-form-group>
        </div>
      </div class="row">
    </x-form>
  </x-card>

  @push('scripts')
    @stack('SelectComponentScripts')
  @endpush

</x-dashboard::admin.layout.master>