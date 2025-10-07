<x-dashboard::admin.layout.master>

	<div class="page-header">
		<x-breadcrumb :items="config('admin-breadcrumbs.languages.create')" />
	</div>

	<x-card title="زبان خارجه جدید">
		<x-form :action="route('admin.languages.store')" method="POST">
			<div class="row">

				<div class="col-xl-3">
					<x-form-group>
						<x-label :is-required="true" text="نام فارسی" />
						<x-input type="text" name="persian_name" placeholder="انگیلیسی, آلمانی,..." autofocus />
					</x-form-group>
				</div>

				<div class="col-xl-3">
					<x-form-group>
						<x-label :is-required="true" text="نام انگیلیسی" />
						<x-input type="text" name="english_name" placeholder="English, Germany,..." />
					</x-form-group>
				</div>

				<div class="col-xl-3">
					<x-form-group>
						<x-label :is-required="true" text="کد زبان" />
						<x-input type="text" name="code" placeholder="en, de,..."  />
					</x-form-group>
				</div>

				<div class="col-xl-3">
					<x-form-group>
						<x-label :is-required="true" text="نام زبان به زبان خودش" />
						<x-input type="text" name="native_name" placeholder="English, Deutsch, 中文, ..." />
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