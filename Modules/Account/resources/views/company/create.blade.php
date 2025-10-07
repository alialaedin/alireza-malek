<x-dashboard::company.layout.master>

	<div class="page-header">
		<x-breadcrumb :items="config('company-breadcrumbs.accounts.create')" />
	</div>

	<x-card title="حساب بانکی جدید">
		<x-form :action="route('company.accounts.store')" method="POST">
			<div class="row">

				<div class="col-xl-3">
					<x-form-group>
            <x-label for="bank_name" text="نام بانک" :is-required="true" />
            <x-input type="text" name="bank_name" required autofocus />
					</x-form-group>
				</div>

				<div class="col-xl-3">
					<x-form-group>
            <x-label for="card_owner" text="نام صاحب بانک" :is-required="true" />
            <x-input type="text" name="card_owner" required />
					</x-form-group>
				</div>

				<div class="col-xl-3">
					<x-form-group>
            <x-label for="card_number" text="شماره کارت" :is-required="true" />
            <x-input type="text" name="card_number" required />
					</x-form-group>
				</div>

				<div class="col-xl-3">
					<x-form-group>
            <x-label for="sheba_number" text="شماره شبا" :is-required="true" />
            <x-input type="text" name="sheba_number" required />	
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