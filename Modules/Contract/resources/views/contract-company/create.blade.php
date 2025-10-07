<x-dashboard::admin.layout.master>

  <div class="page-header">
    <x-breadcrumb :items="config('admin-breadcrumbs.contract-companies.create')" />
  </div>

  <x-card title="ایجاد قرارداد">
    <x-form :action="route('admin.contract-companies.store')" method="POST" enctype="multipart/form-data">
      <div class="row">

        <div class="col-xl-3">
          <x-form-group>
            <x-label :is-required="true" text="انتخاب شرکت" />
            <select name="company_id" id="company-id" class="form-control fs-12">
              <option value=""></option>
              @foreach ($companies as $company)
                <option value="{{ $company->id }}" @selected(old('company_id') == $company->id)>
                  {{ $company->getName() . ' - ' . $company->getMobile() }}
                </option>
              @endforeach
            </select>
          </x-form-group>
        </div>

        <div class="col-xl-3">
          <x-form-group>
            <x-label :is-required="true" text="شماره قرارداد" />
            <x-input type="text" name="contract_number" />
          </x-form-group>
        </div>

        <div class="col-xl-3">
          <x-form-group>
            <x-label :is-required="true" text="موضوع قرارداد" />
            <x-input type="text" name="subject" />
          </x-form-group>
        </div>

        <div class="col-xl-3">
          <x-form-group>
            <x-label :is-required="true" text="مبلغ قرارداد (تومان)" />
            <x-input type="text" name="payment_terms" class="comma" />
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
            <x-label :is-required="true" text="وضعییت" />
            <select name="status" id="status" class="form-control fs-12">
              <option value=""></option>
              @foreach ($statuses as $status)
                <option value="{{ $status['name'] }}" @selected(old('status') == $status['name'])>
                  {{ $status['label'] }}
                </option>
              @endforeach
            </select>
          </x-form-group>
        </div>

        <div class="col-xl-3">
          <x-form-group>
            <x-label :is-required="true" text="مبلغ گارانتی (تومان)" />
            <x-input type="text" name="guarantee_amount" class="comma" />
          </x-form-group>
        </div>

        <div class="col-xl-6">
          <x-form-group>
            <x-label text="شرایط و قوانین" />
            <x-textarea name="terms" rows="4" />
          </x-form-group>
        </div>

        <div class="col-xl-6">
          <x-form-group>
            <x-label text="شرایط پرداخت" />
            <x-textarea name="payment_terms" rows="4" />
          </x-form-group>
        </div>

        <div class="col-xl-3">
          <x-form-group>
            <x-label text="تاریخ امضا توسط شرکت" />
            <x-date-input id="signature-date-company" name="signature_date_company" />
          </x-form-group>
        </div>

        <div class="col-xl-3">
          <x-form-group>
            <x-label text="تاریخ امضا توسط ادمین" />
            <x-date-input id="signature-date-webmaster" name="signature_date_webmaster" />
          </x-form-group>
        </div>

        <x-col lg="6" xl="3">
          <x-form-group>
            <x-label text="فایل قرارداد" />
            <x-input type="file" name="file" />
          </x-form-group>
        </x-col>

        <div class="col-12">
          <x-form-group>
            <x-label :is-required="true" text="توضیحات" />
            <x-textarea name="notes" rows="10" />
          </x-form-group>
        </div>

      </div>
    </x-form>
  </x-card>

  @push('scripts')
    @stack('dateInputScriptStack')
    <script>
      new CustomSelect('#company-id', 'یرای انتخاب شرکت کلیلک کنید');
      new CustomSelect('#status', 'یرای انتخاب وضعیت کلیلک کنید');
    </script>
  @endpush

</x-dashboard::admin.layout.master>
