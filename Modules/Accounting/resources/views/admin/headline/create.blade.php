<x-dashboard::admin.layout.master>

	<div class="page-header">
		<x-breadcrumb :items="config('admin-breadcrumbs.headlines.create')" />
	</div>

	<x-card title="سرفصل جدید">
		<x-form :action="route('admin.headlines.store')" method="POST">
			<x-row>
				<x-col lg="6" xl="3">
					<x-form-group>
						<x-label :is-required="true" text="عنوان" />
						<x-input type="text" name="title" required autofocus />
					</x-form-group>
				</x-col>
				<x-col lg="6" xl="3">
					<x-form-group>
						<x-label :is-required="true" text="نوع سرفصل" />
						<x-select name="type" :data="$types" option-value="name" option-label="label" required />
					</x-form-group>
				</x-col>
				<x-col>
					<x-form-group>
						<x-checkbox name="status" title="وضعیت" :is-checked="1" />
					</x-form-group>
				</x-col>
			</x-row>
		</x-form>
	</x-card>

	@push('scripts')
		@stack('SelectComponentScripts')
	@endpush

</x-dashboard::admin.layout.master>