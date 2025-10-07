<x-dashboard::company.layout.master>

	<div class="page-header">
		<x-breadcrumb :items="config('company-breadcrumbs.workplaces.create')" />
	</div>

	<x-card title="محل کار جدید">
		<x-form :action="route('company.workplaces.store')" method="POST">
			<div class="row">

				<div class="col-xl-3">
					<x-form-group>
            <x-label for="title" text="عنوان" :is-required="true" />
            <x-input type="text" name="title" required autofocus />
					</x-form-group>
				</div>

				<div class="col-12">
					<x-form-group>
            <x-label for="address" text="آدرس" :is-required="true" />
            <x-textarea name="address" rows="3" required />
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