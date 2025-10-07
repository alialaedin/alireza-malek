<x-dashboard::company.layout.master>

	<div class="page-header">
		<x-breadcrumb :items="config('company-breadcrumbs.duties.edit')" />
	</div>

	<x-card title="ویرایش وظیفه">
		<x-form :action="route('company.duties.update', $duty)" method="PATCH">
			<div class="row">

				<div class="col-xl-3">
					<x-form-group>
						<x-label :is-required="true" text="نوع وظیفه" />
						<x-select name="type" :data="$types" option-value="name" option-label="label"
							:default-value="$duty->type->value" />
					</x-form-group>
				</div>

				<div class="col-xl-3">
					<x-form-group>
						<x-label :is-required="true" text="عنوان" />
						<x-input type="text" name="title" :default-value="$duty->title" />
					</x-form-group>
				</div>

				<div class="col-12">
					<x-form-group>
						<x-label :is-required="true" text="توضیحات" />
						<x-textarea name="description" rows="3" :default-value="$duty->description" />
					</x-form-group>
				</div>

				<div class="col-12">
					<x-form-group>
						<x-checkbox name="status" title="وضعیت" :is-checked="$duty->status" />
					</x-form-group>
				</div>

			</div class="row">
		</x-form>
	</x-card>

	@push('scripts')
		@stack('SelectComponentScripts')
	@endpush

</x-dashboard::company.layout.master>