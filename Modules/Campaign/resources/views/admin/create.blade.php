<x-dashboard::admin.layout.master>

  <div class="page-header">
    <x-breadcrumb :items="config('admin-breadcrumbs.campaigns.create')" />
  </div>

  <x-card title="ایجاد کمپین">
    <x-form :action="route('admin.campaigns.store')" method="POST">
      <div class="row">

        <div class="col-xl-3">
          <x-form-group>
            <x-label :is-required="true" text="عنوان" />
            <x-input type="text" name="title" />
          </x-form-group>
        </div>

        <div class="col-xl-3">
          <x-form-group>
            <x-label :is-required="true" text="حداکثر استفاده" />
            <x-input type="number" name="usage_limit" />
          </x-form-group>
        </div>

        <div class="col-xl-3">
          <x-form-group>
            <x-label :is-required="true" text="تاریخ شروع" />
            <x-date-input id="start-date" name="start_date" />
          </x-form-group>
        </div>

        <div class="col-xl-3">
          <x-form-group>
            <x-label :is-required="true" text="تاریخ پایان" />
            <x-date-input id="end-date" name="end_date" />
          </x-form-group>
        </div>

        <div class="col-xl-3">
          <x-form-group>
            <x-label :is-required="true" text="نوع تخفیف" />
            <select name="discount_type" id="discount-type" class="form-control fs-12">
              <option value=""></option>
              @foreach ($discountTypes as $discountType)
                <option value="{{ $discountType['name'] }}" @selected(old('discount_type') == $discountType['name'])>
                  {{ $discountType['label'] }}
                </option>
              @endforeach
            </select>
          </x-form-group>
        </div>

        <div class="col-xl-3">
          <x-form-group>
            <x-label :is-required="true" text="میزان تخفیف" />
            <x-input type="text" name="discount_amount" class="comma" />
          </x-form-group>
        </div>

        <div class="col-12">
          <x-form-group>
            <x-label text="توضیحات" />
            <x-textarea name="description" rows="4" />
          </x-form-group>
        </div>

        <div class="col-12">
          <x-form-group>
            <x-checkbox name="is_active" :is-checked="1" title="وضعیت" />
          </x-form-group>
        </div>

      </div>
    </x-form>
  </x-card>

  @push('scripts')
    @stack('dateInputScriptStack')
    <script>
      new CustomSelect('#discount-type', 'یرای انتخاب نوع تخفیف کلیلک کنید');
    </script>
  @endpush

</x-dashboard::admin.layout.master>