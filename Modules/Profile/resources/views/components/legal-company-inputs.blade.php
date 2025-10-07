@props(['company'])

@php
  $information = $company->information;
@endphp

<div class="col-xl-3">
  <x-form-group>
    <x-label :is-required="true" text="نام شرکت" />
    <x-input type="text" name="company_name" :default-value="$information->company_name" />
  </x-form-group>
</div>

<div class="col-xl-3">
  <x-form-group>
    <x-label :is-required="true" text="موبایل" />
    <x-input type="text" name="managment_mobile" :default-value="$information->managment_mobile" />
  </x-form-group>
</div>

<div class="col-xl-3">
  <x-form-group>
    <x-label :is-required="true" text="شناسه ملی" />
    <x-input type="text" name="national_id" :default-value="$information->national_id" />
  </x-form-group>
</div>

<div class="col-xl-3">
  <x-form-group>
    <x-label text="برند" />
    <x-input type="text" name="brand" :default-value="$information->brand" />
  </x-form-group>
</div>

<x-col lg="6" xl="3">
  <x-form-group>
    <x-label text="کد کارگاه" />
    <x-input type="text" name="workshop_code" :default-value="$information->workshop_code" />
  </x-form-group>
</x-col>

<x-col lg="6" xl="3">
  <x-form-group>
    <x-label text="لوگو" />
    <x-input type="file" name="logo" />
  </x-form-group>
</x-col>

<div class="col-12">
  <x-form-group>
    <x-label :is-required="true" text="آدرس" />
    <x-textarea name="address" rows="2" :default-value="$information->address" />
  </x-form-group>
</div>