<x-dashboard::admin.layout.master>

  <div class="page-header">
    <x-breadcrumb :items="config('admin-breadcrumbs.contract-companies.edit')" />
  </div>

  <x-card title="ویرایش قرارداد">
    <x-form :action="route('admin.contract-companies.update', $contractCompany)" method="PATCH"
      enctype="multipart/form-data">
      <div class="row">

        <div class="col-xl-3">
          <x-form-group>
            <x-label :is-required="true" text="شرکت" />
            <input hidden value="{{ $contractCompany->company_id }}" name="company_id">
            <input type="text" readonly class="form-control fs-12"
              value="{{ $contractCompany->company->name . ' - ' . $contractCompany->company->mobile }}" />
          </x-form-group>
        </div>

        <div class="col-xl-3">
          <x-form-group>
            <x-label :is-required="true" text="موضوع قرارداد" />
            <x-input type="text" name="subject" :default-value="$contractCompany->subject" />
          </x-form-group>
        </div>

        <div class="col-xl-3">
          <x-form-group>
            <x-label :is-required="true" text="مبلغ قرارداد (تومان)" />
            <x-input type="text" name="payment_amount" class="comma"
              :default-value="number_format($contractCompany->payment_amount)" />
          </x-form-group>
        </div>

        <div class="col-xl-3">
          <x-form-group>
            <x-label text="انتخاب کمپین" />
            <select name="campaign_id" id="campaign-id" class="form-control fs-12">
              <option value=""></option>
              @foreach ($campaigns as $campaign)
                <option value="{{ $campaign->id }}" @selected(old('campaign_id', $contractCompany->campaign_id) == $campaign->id)>
                  {{ $campaign->title }}
                </option>
              @endforeach
            </select>
          </x-form-group>
        </div>

        <div class="col-xl-3">
          <x-form-group>
            <x-label :is-required="true" text="تاریخ شروع" />
            <x-date-input id="start-date" name="start_date" :default-value="$contractCompany->start_date" />
          </x-form-group>
        </div>

        <div class="col-xl-3">
          <x-form-group>
            <x-label :is-required="true" text="تاریخ پایان" />
            <x-date-input id="end-date" name="end_date" :default-value="$contractCompany->end_date" />
          </x-form-group>
        </div>

        <div class="col-xl-3">
          <x-form-group>
            <x-label :is-required="true" text="شماره قرارداد" />
            <x-input type="text" name="contract_number" :default-value="$contractCompany->contract_number" />
          </x-form-group>
        </div>

        <div class="col-xl-3">
          <x-form-group>
            <x-label :is-required="true" text="مبلغ گارانتی (تومان)" />
            <x-input type="text" name="guarantee_amount" class="comma"
              :default-value="number_format($contractCompany->guarantee_amount)" />
          </x-form-group>
        </div>

        <div class="col-xl-6">
          <x-form-group>
            <x-label :is-required="true" text="شرایط و قوانین" />
            <x-textarea name="terms" rows="6" :default-value="$contractCompany->terms" />
          </x-form-group>
        </div>

        <div class="col-xl-6">
          <x-form-group>
            <x-label :is-required="true" text="شرایط پرداخت" />
            <x-textarea name="payment_terms" rows="6" :default-value="$contractCompany->payment_terms" />
          </x-form-group>
        </div>

        <div class="col-xl-3">
          <x-form-group>
            <x-label text="تاریخ امضا توسط شرکت" />
            <x-date-input id="signature-date-company" name="signature_date_company"
              :default-value="$contractCompany->signature_date_company" />
          </x-form-group>
        </div>

        <div class="col-xl-3">
          <x-form-group>
            <x-label text="تاریخ امضا توسط ادمین" />
            <x-date-input id="signature-date-webmaster" name="signature_date_webmaster"
              :default-value="$contractCompany->signature_date_webmaster" />
          </x-form-group>
        </div>

        <div class="col-xl-3">
          <x-form-group>
            <x-label :is-required="true" text="وضعییت" />
            <select name="status" id="status" class="form-control fs-12">
              <option value=""></option>
              @foreach ($statuses as $status)
                <option value="{{ $status['name'] }}" @selected(old('status', $contractCompany->status->value) == $status['name'])>
                  {{ $status['label'] }}
                </option>
              @endforeach
            </select>
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
            <x-label text="توضیحات" />
            <x-textarea name="notes" rows="10" :default-value="$contractCompany->notes" />
          </x-form-group>
        </div>

      </div>
    </x-form>
  </x-card>

  @push('scripts')
    @stack('dateInputScriptStack')
    <script>
      new CustomSelect('#status', 'یرای انتخاب وضعیت کلیلک کنید');
    </script>
  @endpush

</x-dashboard::admin.layout.master>