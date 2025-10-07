<x-dashboard::company.layout.master>

	<div class="page-header">
		<x-breadcrumb :items="config('company-breadcrumbs.jobs.create')" />
	</div>

	<x-card title="ایجاد شغل">
		<x-form :action="route('company.jobs.store')" method="POST">
			<div class="row">

				<div class="col-xl-3">
					<x-form-group>
						<x-label :is-required="true" text="عنوان انگیلیسی" />
						<x-input type="text" name="name" />
					</x-form-group>
				</div>

				<div class="col-xl-3">
					<x-form-group>
						<x-label :is-required="true" text="نام فارسی" />
						<x-input type="text" name="label" />
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