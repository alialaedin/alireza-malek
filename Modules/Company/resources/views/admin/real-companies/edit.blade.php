<x-dashboard::admin.layout.master>

	<div class="page-header">
		<x-breadcrumb :items="config('admin-breadcrumbs.real-companies.edit')" />
	</div>

	<x-card title="ویرایش شرکت حقیقی">
		<x-form :action="route('admin.real-companies.update', $realCompany)" method="PATCH">
			<div class="row">

				@php
					$information = $realCompany->information;
				@endphp

				<div class="col-xl-3">
					<x-form-group>
						<x-label :is-required="true" text="نام و نام خانوادگی" />
						<x-input type="text" name="full_name" autofocus :default-value="$information->full_name" />
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

				<x-col lg="6" xl="3">
					<x-form-group>
						<x-label :is-required="true" text="نام کاربری" />
						<x-input type="text" name="username" :default-value="$information->username" />
					</x-form-group>
				</x-col>

				<x-col lg="6" xl="3">
					<x-form-group>
						<x-label text="کلمه عبور" />
						<x-input type="password" name="password" />
					</x-form-group>
				</x-col>

				<x-col lg="6" xl="3">
					<x-form-group>
						<x-label text="تکرار کلمه عبور" />
						<x-input type="password" name="password_confirmation" />
					</x-form-group>
				</x-col>

				<div class="col-xl-3">
					<x-form-group>
						<x-label :is-required="true" text="مجوز فعالیت" />
						<x-select name="activity_license" :data="$activityLicenses"
							:default-value="$information->activity_license->value" option-value="name" option-label="label" />
					</x-form-group>
				</div>

				<div class="col-12">
					<x-form-group>
						<x-label :is-required="true" text="آدرس" />
						<x-textarea name="address" rows="2" :default-value="$information->address" />
					</x-form-group>
				</div>

				<div class="col-12">
					<x-form-group>
						<x-checkbox name="login_status" title="وضعیت لاگین" :is-checked="$realCompany->login_status" />
					</x-form-group>
				</div>

			</div class="row">
		</x-form>
	</x-card>

	@push('scripts')
		@stack('SelectComponentScripts')
	@endpush

</x-dashboard::admin.layout.master>