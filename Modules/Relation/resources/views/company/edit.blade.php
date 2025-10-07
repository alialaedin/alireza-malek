<x-dashboard::company.layout.master>

	<div class="page-header">
		<x-breadcrumb :items="config('company-breadcrumbs.relations.edit')" />
	</div>

	<x-card title="ویرایش نسبت خانوادگی">
		<x-form :action="route('company.relations.update', $relation)" method="PATCH">
			<div class="row">

				<div class="col-xl-3">
					<x-form-group>
						<x-label :is-required="true" text="نام" />
						<x-input type="text" name="name" :default-value="$relation->name" />
					</x-form-group>
				</div>

				<div class="col-12">
					<x-form-group>
						<x-checkbox name="status" title="وضعیت" :is-checked="$relation->status" />
					</x-form-group>
				</div>

			</div class="row">
		</x-form>
	</x-card>

</x-dashboard::company.layout.master>