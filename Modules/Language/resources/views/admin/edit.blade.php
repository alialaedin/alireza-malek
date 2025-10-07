<x-dashboard::admin.layout.master>

	<div class="page-header">
		<x-breadcrumb :items="config('admin-breadcrumbs.languages.edit')" />
	</div>

	<x-card title="ویرایش زبان خارجه">
		<x-form :action="route('admin.languages.update', $language)" method="PATCH">
			<div class="row">

				<div class="col-xl-3">
					<x-form-group>
						<x-label :is-required="true" text="نام فارسی" />
						<x-input type="text" name="persian_name" :default-value="$language->persian_name"/>
					</x-form-group>
				</div>

				<div class="col-xl-3">
					<x-form-group>
						<x-label :is-required="true" text="نام انگیلیسی" />
						<x-input type="text" name="english_name" :default-value="$language->english_name" />
					</x-form-group>
				</div>

				<div class="col-xl-3">
					<x-form-group>
						<x-label :is-required="true" text="کد زبان" />
						<x-input type="text" name="code" :default-value="$language->code" />
					</x-form-group>
				</div>

				<div class="col-xl-3">
					<x-form-group>
						<x-label :is-required="true" text="نام زبان به زبان خودش" />
						<x-input type="text" name="native_name" :default-value="$language->native_name" />
					</x-form-group>
				</div>

				<div class="col-12">
					<x-form-group>
						<x-checkbox name="status" title="وضعیت" :is-checked="$language->status" />
					</x-form-group>
				</div>

			</div class="row">
		</x-form>
	</x-card>

</x-dashboard::admin.layout.master>