@props(['company'])

@php
  $information = $company->information;
@endphp

<div class="col-xl-3">
  <x-form-group>
    <x-label :is-required="true" text="نام و نام خانوادگی" />
    <x-input type="text" name="full_name" :default-value="$information->full_name" />
  </x-form-group>
</div>

<div class="col-xl-3">
  <x-form-group>
    <x-label :is-required="true" text="نام پدر" />
    <x-input type="text" name="father_name" :default-value="$information->father_name" />
  </x-form-group>
</div>

<div class="col-xl-3">
  <x-form-group>
    <x-label :is-required="true" text="کد ملی" />
    <x-input type="text" name="national_code" :default-value="$information->national_code" />
  </x-form-group>
</div>

<div class="col-xl-3">
  <x-form-group>
    <x-label :is-required="true" text="موبایل" />
    <x-input type="text" name="mobile" :default-value="$information->mobile" />
  </x-form-group>
</div>

<div class="col-12">
  <x-form-group>
    <x-label :is-required="true" text="آدرس" />
    <x-textarea name="address" rows="2" :default-value="$information->address" />
  </x-form-group>
</div>