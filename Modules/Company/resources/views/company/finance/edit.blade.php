<x-dashboard::company.layout.master>

	<div class="page-header">
		<x-breadcrumb :items="config('company-breadcrumbs.finances.edit')" />
	</div>

	<x-card title="ویرایش دارایی">
		<x-form :action="route('company.finances.update', $finance)" method="PATCH">
			<div class="row">

				<div class="col-xl-3">
					<x-form-group>
						<x-label :is-required="true" text="نام دارایی" />
						<x-input type="text" name="name" autofocus :default-value="$finance->name" />
					</x-form-group>
				</div>

				<div class="col-xl-3">
					<x-form-group>
						<x-label :is-required="true" text="کد" />
						<x-input type="text" name="code" :default-value="$finance->code" />
					</x-form-group>
				</div>

				<div class="col-12">
					<x-form-group>
						<x-checkbox name="status" title="وضعیت" :is-checked="$finance->status" />
					</x-form-group>
				</div>

			</div class="row">
		</x-form>
	</x-card>

</x-dashboard::company.layout.master>