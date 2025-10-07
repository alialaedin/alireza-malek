<x-dashboard::admin.layout.master>

	<div class="page-header">
		<x-breadcrumb :items="config('admin-breadcrumbs.provinces.create')" />
	</div>

	<x-card title="استان جدید">
		<x-form :action="route('admin.provinces.store')" method="POST">
			<div class="row">
				<div class="col-xl-3">
					<x-form-group>
						<x-label :is-required="true" text="عنوان (فارسی)" />
						<x-input type="text" name="name" autofocus />
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