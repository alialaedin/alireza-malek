<x-dashboard::company.layout.master>

  <div class="page-header">
    <x-breadcrumb :items="config('company-breadcrumbs.price-lists.create')" />
  </div>

  <x-card title="ایجاد نرخ نامه">
    <x-form :action="route('company.price-lists.store')" method="POST">

      <div class="row">
        <div class="col-xl-3">
          <x-form-group>
            <x-label :is-required="true" text="انتخاب سال مالی" />
            <select name="fiscal_year_id" id="fiscal_year_id" class="form-control fs-12">
              <option value=""></option>
              @foreach ($fiscalYears as $fiscalYear)
                <option value="{{ $fiscalYear->id }}" @selected(old('fiscal_year_id') == $fiscalYear->id)>
                  {{ $fiscalYear->year }}
                </option>
              @endforeach
            </select>
          </x-form-group>
        </div>
      </div>

      <div class="row">

        <div class="col-xl-3">
          <x-form-group>
            <x-label for="salary" text="حقوق و دستمزد (ریال)" :is-required="true" />
            <x-input type="text" name="salary" class="comma" required autofocus />
          </x-form-group>
        </div>

        <div class="col-xl-3">
          <x-form-group>
            <x-label for="right_to_housing_and_food" text="حق مسکن و خواروبار (ریال)" :is-required="true" />
            <x-input type="text" name="right_to_housing_and_food" class="comma" required />
          </x-form-group>
        </div>

        <div class="col-xl-3">
          <x-form-group>
            <x-label for="worker_coupen_amount" text="بن کارگری (ریال)" :is-required="true" />
            <x-input type="text" name="worker_coupen_amount" class="comma" required />
          </x-form-group>
        </div>

        <div class="col-xl-3">
          <x-form-group>
            <x-label for="children_rights" text="حق اولاد (ریال)" :is-required="true" />
            <x-input type="text" name="children_rights" class="comma" required />
          </x-form-group>
        </div>

        <div class="col-xl-3">
          <x-form-group>
            <x-label for="marriage_rights" text="حق تاهل (ریال)" :is-required="true" />
            <x-input type="text" name="marriage_rights" class="comma" required />
          </x-form-group>
        </div>

        <div class="col-xl-3">
          <x-form-group>
            <x-label for="reward" text="عیدی و پاداش (ریال)" :is-required="true" />
            <x-input type="text" name="reward" class="comma" required />
          </x-form-group>
        </div>

        <div class="col-xl-3">
          <x-form-group>
            <x-label for="work_history_amount" text="پایه سنوات (ریال)" :is-required="true" />
            <x-input type="text" name="work_history_amount" class="comma" required />
          </x-form-group>
        </div>

        <div class="col-12">
          <x-form-group>
            <x-checkbox name="status" title="وضعیت" :is-checked="1" />
          </x-form-group>
        </div>

      </div class="row">
    </x-form>
  </x-card>

  @push('scripts')
    <script>
      new CustomSelect('#fiscal_year_id', 'یرای انتخاب سال مالی کلیلک کنید');
    </script>
  @endpush

</x-dashboard::company.layout.master>