<x-dashboard::company.layout.master>

  <div class="page-header">
    <x-breadcrumb :items="config('company-breadcrumbs.finances.create')" />
  </div>

  <x-card title="ایجاد دارایی جدید">

    <x-slot name="options">
      <button @click="addFinance" class="btn btn-sm btn-success px-3">افزودن</button>
    </x-slot>

    <x-form action="{{ route('company.finances.store') }}" method="POST" :has-default-buttons="0">
      <x-table>
        <x-slot name="thead">
          <tr>
            <th>ردیف</th>
            <th>نام دارایی</th>
            <th>شماره اموال</th>
            <th>وضعیت</th>
            <th>عملیات</th>
          </tr>
        </x-slot>
        <x-slot name="tbody">
          <tr v-for="(finance, index) in finances" :key="index">
            <td><span class="font-weight-bold btn btn-sm btn-dark px-4">@{{ index + 1 }}</span></td>
            <td><input type="text" :name="'finances[' + index + '][name]'" v-model="finance.name" class="form-control" /></td>
            <td><input type="text" :name="'finances[' + index + '][code]'" v-model="finance.code" class="form-control" /></td>
            <td>
              <label class="custom-switch">
                <input type="checkbox" :name="'finances[' + index + '][status]'" class="custom-switch-input" v-model="finance.status">
                <span class="custom-switch-indicator"></span>
                <span class="custom-switch-description"></span>
              </label>
            </td>
            <td>
              <button @click="removeFinance(index)" class="btn btn-outline-danger btn-sm" type="button"
                :disabled="finances.length === 1">
                حذف
              </button>
            </td>
          </tr>
        </x-slot>
      </x-table>

      <x-row>
        <x-col class="d-flex align-items-center justify-content-center" style="gap: 8px">
          <button class="btn btn-sm btn-primary" type="submit">ثبت اطلاعات</button>
          <a class="btn btn-danger btn-sm" onclick="window.location.reload()">ریست فرم</a>
        </x-col>
      </x-row>

    </x-form>

  </x-card>

  @push('scripts')
    <script src="{{ asset('assets/vue/vue3/vue.global.prod.js') }}"></script>
    <script>
      const { createApp } = Vue;
      createApp({
        data() {
          return {
            finances: [{ name: '', code: '', status: true }]
          }
        },
        methods: {
          addFinance() {
            this.finances.push({ name: '', code: '', status: true });
          },
          removeFinance(index) {
            this.finances.splice(index, 1);
          }
        }
      }).mount('#app-content');
    </script>
  @endpush

</x-dashboard::company.layout.master>