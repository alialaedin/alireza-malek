<x-dashboard::admin.layout.master>

	<div class="page-header">
		<x-breadcrumb :items="config('admin-breadcrumbs.positions.edit')" />
	</div>

	<x-card title="ویرایش سمت شغلی">
		<x-form :action="route('admin.positions.update', $position)" method="PATCH">
			<div class="row">

				<div class="col-xl-3">
					<x-form-group>
						<x-label :is-required="true" text="عنوان انگیلیسی" />
						<x-input type="text" name="en_title" autofocus :default-value="$position->en_title" />
					</x-form-group>
				</div>

				<div class="col-xl-3">
					<x-form-group>
						<x-label :is-required="true" text="نام فارسی" />
						<x-input type="text" name="title" :default-value="$position->title" />
					</x-form-group>
				</div>

				<div class="col-12">
					<x-form-group>
						<x-checkbox name="status" title="وضعیت" :is-checked="$position->status" />
					</x-form-group>
				</div>

			</div class="row">
		</x-form>
	</x-card>

</x-dashboard::admin.layout.master>