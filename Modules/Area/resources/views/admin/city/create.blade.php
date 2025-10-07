<x-dashboard::admin.layout.master>

	<div class="page-header">
		<x-breadcrumb :items="config('admin-breadcrumbs.cities.create')" />
	</div>

	<x-card title="شهر جدید">
		<x-form :action="route('admin.cities.store')" method="POST">
			<div class="row">
				<div class="col-xl-3">
					<x-form-group>
						<x-label :is-required="true" text="انتخاب استان" />
						<x-select name="province_id" :data="$provinces" option-value="id" option-label="name" />
					</x-form-group>
				</div>
				<div class="col-xl-3">
					<x-form-group>
						<x-label :is-required="true" text="عنوان (فارسی)" />
						<x-input type="text" name="name" />
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
    @stack('SelectComponentScripts')
  @endpush

</x-dashboard::admin.layout.master>