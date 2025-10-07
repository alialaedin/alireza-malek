<x-dashboard::company.layout.master>

	<div class="page-header">
		<x-breadcrumb :items="config('company-breadcrumbs.accounts.edit')" />
	</div>

	<x-card title="ویرایش نسبت خانوادگی">
		<x-form :action="route('company.accounts.update', $account)" method="PATCH">
			<div class="row">

				<div class="col-xl-3">
					<x-form-group>
						<x-label for="bank_name" text="نام بانک" :is-required="true" />
						<x-input type="text" name="bank_name" :default-value="$account->bank_name" />
					</x-form-group>
				</div>

				<div class="col-xl-3">
					<x-form-group>
						<x-label for="card_owner" text="نام صاحب بانک" :is-required="true" />
						<x-input type="text" name="card_owner" :default-value="$account->card_owner" />
					</x-form-group>
				</div>

				<div class="col-xl-3">
					<x-form-group>
						<x-label for="card_number" text="شماره کارت" :is-required="true" />
						<x-input type="text" name="card_number" :default-value="$account->card_number" />
					</x-form-group>
				</div>

				<div class="col-xl-3">
					<x-form-group>
						<x-label for="sheba_number" text="شماره شبا" :is-required="true" />
						<x-input type="text" name="sheba_number" :default-value="$account->sheba_number" />
					</x-form-group>
				</div>

				<div class="col-12">
					<x-form-group>
						<x-checkbox name="status" title="وضعیت" :is-checked="$account->status" />
					</x-form-group>
				</div>

			</div class="row">
		</x-form>
	</x-card>

</x-dashboard::company.layout.master>