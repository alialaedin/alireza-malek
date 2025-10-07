<x-dashboard::admin.layout.master>

	<div class="page-header">
		<x-breadcrumb :items="config('admin-breadcrumbs.expenses.create')"/>
	</div>
	
	<x-card title="هزینه جدید">
		<x-form :action="route('admin.expenses.store')" method="POST">
			<x-row>
				<x-col lg="6" xl="3">
					<x-form-group>
						<x-label :is-required="true" text="انتخاب سرفصل" />
						<x-select name="headline_id" :data="$headlines" option-value="id" option-label="title" />
					</x-form-group>
				</x-col>
				<x-col lg="6" xl="3">
					<x-form-group>
						<x-label :is-required="true" text="عنوان هزینه" />
						<x-input type="text" name="title" />
					</x-form-group>
				</x-col>
				<x-col lg="6" xl="3">
					<x-form-group>
						<x-label :is-required="true" text="مبلغ (تومان)" />
						<x-input type="text" name="amount" class="comma" />
					</x-form-group>
				</x-col>
				<x-col lg="6" xl="3">
					<x-form-group>
						<x-label :is-required="true" text="تاریخ پرداخت" />
						<x-date-input id="payment_date" name="payment_date" />
					</x-form-group>
				</x-col>
			</x-row>
		</x-form>
	</x-card>

  @push('scripts')
    @stack('dateInputScriptStack')
    @stack('SelectComponentScripts')
  @endpush

</x-dashboard::admin.layout.master>