<x-dashboard::admin.layout.master>

	<div class="page-header">
		<x-breadcrumb :items="config('admin-breadcrumbs.real-companies.create')" />
	</div>

	<x-card title="شرکت حقیقی جدید">
		<x-form :action="route('admin.real-companies.store')" method="POST">
			<div class="row">

				<div class="col-xl-3">
					<x-form-group>
						<x-label :is-required="true" text="نام و نام خانوادگی" />
						<x-input type="text" name="full_name" autofocus />
					</x-form-group>
				</div>

				<div class="col-xl-3">
					<x-form-group>
						<x-label :is-required="true" text="نام پدر" />
						<x-input type="text" name="father_name" />
					</x-form-group>
				</div>

				<div class="col-xl-3">
					<x-form-group>
						<x-label :is-required="true" text="کد ملی" />
						<x-input type="text" name="national_code" />
					</x-form-group>
				</div>

				<div class="col-xl-3">
					<x-form-group>
						<x-label :is-required="true" text="موبایل" />
						<x-input type="text" name="mobile" />
					</x-form-group>
				</div>

				<x-col lg="6" xl="3">
          <x-form-group>
            <x-label :is-required="true" text="نام کاربری" />
            <x-input type="text" name="username" required />
          </x-form-group>
        </x-col>

				<x-col lg="6" xl="3">
          <x-form-group>
            <x-label :is-required="true" text="کلمه عبور" />
            <x-input type="password" name="password" required />
          </x-form-group>
        </x-col>

        <x-col lg="6" xl="3">
          <x-form-group>
            <x-label :is-required="true" text="تکرار کلمه عبور" />
            <x-input type="password" name="password_confirmation" required />
          </x-form-group>
        </x-col>

				<div class="col-xl-3">
					<x-form-group>
						<x-label :is-required="true" text="مجوز فعالیت" />
						<x-select name="activity_license" :data="$activityLicenses" option-value="name" option-label="label" />
					</x-form-group>
				</div>

				<div class="col-12">
					<x-form-group>
						<x-label :is-required="true" text="آدرس" />
						<x-textarea name="address" rows="2" />
					</x-form-group>
				</div>

				<div class="col-12">
					<x-form-group>
						<x-checkbox name="login_status" title="وضعیت لاگین" :is-checked="1" />
					</x-form-group>
				</div>

			</div class="row">
		</x-form>
	</x-card>

	@push('scripts')
		@stack('SelectComponentScripts')
	@endpush

</x-dashboard::admin.layout.master>