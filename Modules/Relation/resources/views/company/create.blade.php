<x-dashboard::company.layout.master>

	<div class="page-header">
		<x-breadcrumb :items="config('company-breadcrumbs.relations.create')" />
	</div>

	<x-card title="نسبت خانوادگی جدید">
		<x-form :action="route('company.relations.store')" method="POST">
			<div class="row">

				<div class="col-xl-3">
					<x-form-group>
						<x-label :is-required="true" text="نام" />
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

</x-dashboard::company.layout.master>