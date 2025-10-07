<x-dashboard::admin.layout.master>

	<div class="page-header">
		<x-breadcrumb :items="config('admin-breadcrumbs.provinces.create')" />
	</div>

	<x-card title="ویرایش استان">
		<x-form :action="route('admin.provinces.update', $province)" method="PATCH">
			<div class="row">
				<div class="col-xl-3">
					<x-form-group>
						<x-label :is-required="true" text="عنوان (فارسی)" />
						<x-input type="text" name="name" :default-value="$province->name" autofocus />
					</x-form-group>
				</div>
				<div class="col-12">
					<x-form-group>
						<x-checkbox name="status" title="وضعیت" :is-checked="$province->status" />
					</x-form-group>
				</div>
			</div class="row">
		</x-form>
	</x-card>

</x-dashboard::admin.layout.master>