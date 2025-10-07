<x-dashboard::company.layout.master>

	<div class="page-header">
		<x-breadcrumb :items="config('company-breadcrumbs.duties.create')" />
	</div>

	<x-card title="ایجاد وظیفه">
		<x-form :action="route('company.duties.store')" method="POST">
			<div class="row">

				<div class="col-xl-3">
					<x-form-group>
						<x-label :is-required="true" text="نوع وظیفه" />
						<x-select name="type" :data="$types" option-value="name" option-label="label" />
					</x-form-group>
				</div>

				<div class="col-xl-3">
					<x-form-group>
						<x-label :is-required="true" text="عنوان" />
						<x-input type="text" name="title" />
					</x-form-group>
				</div>

				<div class="col-12">
					<x-form-group>
						<x-label :is-required="true" text="توضیحات" />
						<x-textarea name="description" rows="3" />
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

</x-dashboard::company.layout.master>