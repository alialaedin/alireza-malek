<x-dashboard::admin.layout.master id="app">

	<div class="page-header">
		<x-breadcrumb :items="config('admin-breadcrumbs.legal-companies.edit')" />
	</div>

	<x-card title="اطلاعات شرکت حقوقی">
		<div class="row">

			<div class="col-xl-3">
				<x-form-group>
					<x-label :is-required="true" text="نام شرکت" />
					<x-input type="text" name="company_name" v-model="company.company_name" />
				</x-form-group>
			</div>

			<div class="col-xl-3">
				<x-form-group>
					<x-label :is-required="true" text="موبایل مدیریت" />
					<x-input type="text" name="managment_mobile" v-model="company.managment_mobile" />
				</x-form-group>
			</div>

			<div class="col-xl-3">
				<x-form-group>
					<x-label :is-required="true" text="شناسه ملی" />
					<x-input type="text" name="national_id" v-model="company.national_id" />
				</x-form-group>
			</div>

			<div class="col-xl-3">
				<x-form-group>
					<x-label text="برند" />
					<x-input type="text" name="brand" v-model="company.brand" />
				</x-form-group>
			</div>

			<x-col lg="6" xl="3">
				<x-form-group>
					<x-label :is-required="true" text="نام کاربری" />
					<x-input type="text" name="username" v-model="company.username" />
				</x-form-group>
			</x-col>

			<x-col lg="6" xl="3">
				<x-form-group>
					<x-label text="کلمه عبور" />
					<x-input type="password" name="password" v-model="company.password" />
				</x-form-group>
			</x-col>

			<x-col lg="6" xl="3">
				<x-form-group>
					<x-label text="تکرار کلمه عبور" />
					<x-input type="password" name="password_confirmation" v-model="company.password_confirmation" />
				</x-form-group>
			</x-col>

			<x-col lg="6" xl="3">
				<x-form-group>
					<x-label text="کد کارگاه" />
					<x-input type="text" name="workshop_code" v-model="company.workshop_code" />
				</x-form-group>
			</x-col>

			<x-col lg="6" xl="3">
				<x-form-group>
					<x-label :is-required="true" text="وضعیت قرارداد" />
					<multiselect dir="rtl" class="custom-multiselect form-control-sm p-0" v-model="company.contract_status"
						label="label" placeholder="وضعیت قرارداد" track-by="name" :options="contractStatuses"
						:close-on-select="true" open-direction="bottom" :show-labels="false" required />
				</x-form-group>
			</x-col>

			<x-col lg="6" xl="3">
				<x-form-group>
					<x-label text="لوگو" />
					<x-input type="file" name="logo" @change="uploadLogo" />
				</x-form-group>
			</x-col>

			<div class="col-12">
				<x-form-group>
					<x-label :is-required="true" text="آدرس" />
					<x-textarea name="address" rows="2" v-model="company.address" />
				</x-form-group>
			</div>

			<div class="col-12 mt-2">
				<x-form-group>
					<label class="custom-switch fs-12">
						<input type="checkbox" class="custom-switch-input" v-model="company.login_status">
						<span class="custom-switch-indicator"></span>
						<span class="custom-switch-description">وضعیت لاگین</span>
					</label>
				</x-form-group>
			</div>

		</div class="row">
	</x-card>

	<x-card title="صاحبان امضا">

		<x-slot name="options">
			<button @click="addSignatureOwner" class="btn btn-sm btn-outline-primary px-3">
				<i class="fa fa-plus"></i>
			</button>
		</x-slot>

		<div v-if="company.signature_owners.length"
			class="table-responsive attendance_table mt-4 border-top text-center fs-12 table-sm">
			<table class="table mb-0 text-nowrap">
				<thead>
					<tr>
						<th>ردیف</th>
						<th>نام و نام خانوادگی <span class="text-danger">&starf;</span></th>
						<th>شماره تماس <span class="text-danger">&starf;</span></th>
						<th>کد ملی <span class="text-danger">&starf;</span></th>
						<th>نام پدر <span class="text-danger">&starf;</span></th>
						<th>سمت شغلی <span class="text-danger">&starf;</span></th>
						<th>عملیات</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="(signatureOwner, index) in company.signature_owners" class="border-bottom" :key="index">
						<td class="font-weight-bold">
							<span class="avatar avatar-sm brround">@{{ index + 1 }}</span>
						</td>
						<td><input type="text" class="form-control fs-12" v-model="signatureOwner.full_name" /></td>
						<td><input type="text" class="form-control fs-12" v-model="signatureOwner.mobile" /></td>
						<td><input type="text" class="form-control fs-12" v-model="signatureOwner.national_code" /></td>
						<td><input type="text" class="form-control fs-12" v-model="signatureOwner.father_name" /></td>
						<td>
							<multiselect dir="rtl" class="custom-multiselect form-control-sm p-0" v-model="signatureOwner.position"
								label="title" placeholder="انتخاب سمت شغلی" track-by="id" :options="positions" :close-on-select="true"
								open-direction="bottom" :show-labels="false" required />
						</td>
						<td><button @click="removeSignatureOwner(index)" class="btn btn-outline-danger btn-sm">حذف</button></td>
					</tr>
				</tbody>
			</table>
		</div>

		<div v-if="company.signature_owners.length" class="row justify-content-center align-items-center"
			style="gap: 8px; margin-top: 50px;">
			<button class="btn btn-sm btn-warning" type="button" @click="submit" :disabled="disabled">بروزرسانی</button>
			<button class="btn btn-sm btn-danger" type="button" @click="reset">ریست فرم</button>
		</div>

	</x-card>

	@push('scripts')

		<script src="{{ asset('assets/vue/vue3/vue.global.prod.js') }}"></script>
		<script src="{{ asset('assets/vue/multiselect/vue-multiselect.umd.min.js') }}"></script>
		<script src="{{ asset('assets/vue/treeselect/vue-treeselect.umd.min.js') }}"></script>

		<script>
			const { createApp } = Vue;

			createApp({
				components: {
					'multiselect': window['vue-multiselect'].default,
				},
				mounted() {
					const company = @json($legalCompany);

					this.company.company_name = company.information.company_name;
					this.company.managment_mobile = company.information.managment_mobile;
					this.company.national_id = company.information.national_id;
					this.company.brand = company.information.brand;
					this.company.address = company.information.address;
					this.company.workshop_code = company.information.workshop_code;

					this.company.username = company.username;
					this.company.login_status = 1;
					this.company.contract_status = this.contractStatuses.find(c => c.name == company.contract_status);
					this.company.signature_owners = company.signature_owners;

				},
				data() {
					return {
						disabled: false,
						positions: @json($positions),
						contractStatuses: @json($contractStatuses),
						company: {
							company_name: '',
							logo: null,
							managment_mobile: '',
							national_id: '',
							brand: '',
							username: '',
							password: '',
							password_confirmation: '',
							address: '',
							login_status: '',
							workshop_code: '',
							signature_owners: [],
							contract_status: ''
						},
					}
				},
				methods: {

					showValidationError(errors) {

						const list = document.createElement('ul');
						list.className = 'list-group';

						for (const key in errors) {
							if (errors.hasOwnProperty(key)) {
								const errorsArray = errors[key];
								errorsArray.forEach((errorMessage) => {
									const listItem = document.createElement('li');
									listItem.className = 'list-group-item';
									listItem.textContent = errorMessage;
									list.appendChild(listItem);
								});
							}
						}

						Swal.fire({
							title: "<b>خطا های زیر رخ داده است</b>",
							html: list.outerHTML,
							icon: "error",
							confirmButtonText: "بستن",
						});
					},
					popup(type, title, message) {
						Swal.fire({
							title: title,
							text: message,
							icon: type,
							confirmButtonText: "بستن",
						});
					},
					uploadLogo(event) {
						this.logo = event.target.files[0];
					},
					addSignatureOwner() {
						this.company.signature_owners.push({
							id: null,
							full_name: '',
							mobile: '',
							national_code: '',
							father_name: '',
							position: null
						});
					},
					removeSignatureOwner(index) {
						this.company.signature_owners.splice(index, 1);
					},

					reset() {
						window.location.reload();
					},
					async submit() {

						const data = JSON.parse(JSON.stringify(this.company));

						data['contract_status'] = this.company.contract_status?.name;

						data.signature_owners = data.signature_owners?.map(s => {

							if (!s.id) {
								s.position_id = s.position?.id ?? '';
							}

							return {
								id: s.id,
								position_id: s.position_id,
								full_name: s.full_name,
								national_code: s.national_code,
								mobile: s.mobile,
								father_name: s.father_name,
							};
						});

						const url = @json(route('admin.legal-companies.update', $legalCompany));
						const options = {
							method: 'PATCH',
							headers: {
								'Accept': 'application/json',
								'Content-Type': 'application/json',
								'X-CSRF-TOKEN': @json(csrf_token())
							},
							body: JSON.stringify(data)
						};

						this.disabled = true;

						const response = await fetch(url, options);
						const result = await response.json();

						this.disabled = false;

						if (!response.ok) {
							switch (response.status) {
								case 422:
									this.showValidationError(result.errors);
									break;
								case 404:
									this.popup('error', 'خطای 404', 'چنین چیزی وجود ندارد');
									break;
								case 409:
									this.popup('error', '', result.message);
									break;
								case 500:
									this.popup('error', 'خطای سرور', result.message);
									break;
								default:
									this.popup('error', 'خطای نا شناخته');
									break;
							}
							return;
						}

						this.popup('success', result.message);
						window.location.replace(@json(route('admin.legal-companies.index')));
					}
				}
			}).mount('#app');

		</script>
	@endpush

	@push('styles')
		<link rel="stylesheet" href="{{ asset('assets/vue/multiselect/vue-multiselect.min.css') }}" />
		<link rel="stylesheet" href="{{ asset('assets/vue/multiselect/custom-styles.css') }}" />
	@endpush

</x-dashboard::admin.layout.master>