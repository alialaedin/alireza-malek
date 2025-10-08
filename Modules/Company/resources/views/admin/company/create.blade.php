<x-dashboard::admin.layout.master id="app">

	<div class="page-header">
		<x-breadcrumb :items="config('admin-breadcrumbs.companies.create')" />
	</div>

	<x-card title="اطلاعات شرکت جدید">
		<div class="row">

			<div class="col-xl-3">
				<x-form-group>
					<x-label :is-required="true" text="نوع شرکت" />
					<multiselect dir="rtl" class="custom-multiselect form-control-sm p-0" v-model="company.type" label="label"
						placeholder="انتخاب نوع شرکت" track-by="name" :options="types" :close-on-select="true"
						open-direction="bottom" :show-labels="false" required />
				</x-form-group>
			</div>

			<div class="col-xl-3">
				<x-form-group>
					<x-label :is-required="true" text="نام شرکت / شخص" />
					<x-input type="text" name="name" v-model="company.name" />
				</x-form-group>
			</div>

			<div class="col-xl-3">
				<x-form-group>
					<x-label :is-required="true" text="موبایل" />
					<x-input type="text" name="mobile" v-model="company.mobile" />
				</x-form-group>
			</div>

			<div class="col-xl-3">
				<x-form-group>
					<x-label :is-required="true" text="شناسه ملی" />
					<x-input type="text" name="national_code" v-model="company.national_code" />
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
					<x-input type="text" name="username" v-model="company.username" autocomplete="off" />
				</x-form-group>
			</x-col>

			<x-col lg="6" xl="3">
				<x-form-group>
					<x-label :is-required="true" text="کلمه عبور" />
					<x-input type="password" name="password" v-model="company.password" autocomplete="off" />
				</x-form-group>
			</x-col>

			<x-col lg="6" xl="3">
				<x-form-group>
					<x-label :is-required="true" text="تکرار کلمه عبور" />
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
					<x-label text="لوگو" />
					<x-input type="file" name="logo" @change="uploadLogo" />
				</x-form-group>
			</x-col>

			<div class="col-xl-3">
				<x-form-group>
					<x-label :is-required="true" text="مجوز فعالیت" />
					<multiselect dir="rtl" class="custom-multiselect form-control-sm p-0" v-model="company.activity_license" label="label"
						placeholder="انتخاب مجوز فعالیت" track-by="name" :options="activityLicenses" :close-on-select="true"
						open-direction="bottom" :show-labels="false" required />
				</x-form-group>
			</div>

			<div class="col-12">
				<x-form-group>
					<x-label :is-required="true" text="آدرس" />
					<x-textarea name="address" rows="2" v-model="company.address" />
				</x-form-group>
			</div>

			<div class="col-12">
				<x-form-group>
					<x-checkbox name="login_status" title="وضعیت لاگین" v-model="company.login_status" />
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

		<div v-if="signatureOwners.length"
			class="table-responsive attendance_table mt-4 border-top text-center fs-12 table-sm">
			<table class="table mb-0 text-nowrap">
				<thead>
					<tr>
						<th>ردیف</th>
						<th>نام و نام خانوادگی</th>
						<th>شماره تماس</th>
						<th>کد ملی</th>
						<th>نام پدر</th>
						<th>سمت شغلی</th>
						<th>حق امضا</th>
						<th>عملیات</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="(signatureOwner, index) in signatureOwners" class="border-bottom" :key="index">
						<td class="font-weight-bold">
							<span class="avatar avatar-sm brround">@{{ index + 1 }}</span>
						</td>
						<td><x-input type="text" v-model="signatureOwner.full_name" name="full_name" /></td>
						<td><x-input type="text" v-model="signatureOwner.mobile" name="mobile" /></td>
						<td><x-input type="text" v-model="signatureOwner.national_code" name="national_code" /></td>
						<td><x-input type="text" v-model="signatureOwner.father_name" name="father_name" /></td>
						<td>
							<multiselect dir="rtl" class="custom-multiselect form-control-sm p-0" v-model="signatureOwner.position"
								label="title" placeholder="انتخاب سمت شغلی" track-by="id" :options="positions" :close-on-select="true"
								open-direction="bottom" :show-labels="false" required />
						</td>
						<td>
							<label class="custom-switch">
								<input type="checkbox" class="custom-switch-input" v-model="signatureOwner.has_right_to_sign">
								<span class="custom-switch-indicator"></span>
								<span class="custom-switch-description"></span>
							</label>
						</td>
						<td><button @click="removeSignatureOwner(index)" class="btn btn-outline-danger btn-sm">حذف</button></td>
					</tr>
				</tbody>
			</table>
		</div>

		<div v-if="signatureOwners.length" class="row justify-content-center align-items-center"
			style="gap: 8px; margin-top: 50px;">
			<button class="btn btn-sm btn-primary" type="button" @click="submit" :disabled="disabled">ثبت و دخیره</button>
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
				data() {
					return {
						disabled: false,
						positions: @json($positions),
						types: @json($types),
						activityLicenses: @json($activityLicenses),
						company: {
							name: '',
							mobile: '',
							logo: null,
							national_code: '',
							brand: '',
							username: '',
							password: '',
							password_confirmation: '',
							address: '',
							login_status: true,
							workshop_code: '',
							type: null,
							activity_license: null,
						},
						signatureOwners: [],
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
						this.signatureOwners.push({
							full_name: '',
							mobile: '',
							national_code: '',
							father_name: '',
							position: null,
							has_right_to_sign: false
						});
					},
					removeSignatureOwner(index) {
						this.signatureOwners.splice(index, 1);
					},

					reset() {
						window.location.reload();
					},
					async submit() {

						const data = JSON.parse(JSON.stringify(this.company));

						this.signatureOwners?.forEach(signatureOwner => {
							signatureOwner.position_id = signatureOwner.position?.id;
						});

						data['signature_owners'] = this.signatureOwners ?? [];
						data['type'] = this.company.type?.name ?? null;
						data['activity_license'] = this.company.activity_license?.name ?? null;

						const url = @json(route('admin.companies.store'));
						const options = {
							method: 'POST',
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
						window.location.replace(@json(route('admin.companies.index')));
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