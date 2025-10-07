<x-dashboard::admin.layout.master>

	<div class="page-header">
		<x-breadcrumb :items="config('admin-breadcrumbs.positions.create')" />
	</div>

	<x-card title="سمت شغلی جدید">
		<x-form :action="route('admin.positions.store')" method="POST">
			<div class="row">

				<div class="col-xl-3">
					<x-form-group>
						<x-label :is-required="true" text="عنوان انگیلیسی" />
						<x-input type="text" name="en_title" autofocus />
					</x-form-group>
				</div>

				<div class="col-xl-3">
					<x-form-group>
						<x-label :is-required="true" text="نام فارسی" />
						<x-input type="text" name="title" />
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

</x-dashboard::admin.layout.master>