<x-dashboard::company.layout.master>

  <div class="page-header">
    <x-breadcrumb :items="config('company-breadcrumbs.employment-forms.index')" />
    <x-modal-create-button title="ارسال فرم استخدام" modal-id="create-employment-form-modal" />
  </div>

  <x-core::filter-form :action="route('company.employment-forms.index')" :inputs="$filters" />

  <x-card title="لیست فرم های ارسال شده">
    <x-table>
      <x-slot name="thead">
        <tr>
          <th>ردیف</th>
          <th>نام کامل</th>
          <th>موبایل</th>
          <th>وضعیت</th>
          <th>وضعیت مشاهده</th>
          <th>وضعیت پر کردن</th>
          <th>وضعیت احراز</th>
          <th>تاریخ ثبت</th>
          <th>عملیات</th>
        </tr>
      </x-slot>
      <x-slot name="tbody">
        @forelse ($employmentForms as $employmentForm)
          <tr>
            <td class="font-weight-bold">{{ $loop->iteration }}</td>
            <td>{{ $employmentForm->full_name }}</td>
            <td>{{ $employmentForm->mobile }}</td>
            <td>
              <x-badge>
                <x-slot name="type">{{ $employmentForm->status->color() }}</x-slot>
                <x-slot name="text">{{ $employmentForm->status->label() }}</x-slot>
              </x-badge>
            </td>
            <td>
              <x-badge :is-light="true">
                <x-slot name="type">{{ $employmentForm->has_seen ? 'success' : 'danger' }}</x-slot>
                <x-slot name="text">{{ $employmentForm->has_seen ? 'مشاهده شده' : 'مشاهده نشده' }}</x-slot>
              </x-badge>
            </td>
            <td>
              <x-badge :is-light="true">
                <x-slot name="type">{{ $employmentForm->is_filled ? 'success' : 'danger' }}</x-slot>
                <x-slot name="text">{{ $employmentForm->is_filled ? 'پر شده' : 'پر نشده' }}</x-slot>
              </x-badge>
            </td>
            <td>
              <x-badge :is-light="true">
                <x-slot name="type">{{ $employmentForm->is_authenticated ? 'success' : 'danger' }}</x-slot>
                <x-slot name="text">{{ $employmentForm->is_authenticated ? 'احراز هویت شده' : 'احراز هویت نشده' }}</x-slot>
              </x-badge>
            </td>
            <td>@jalaliDateTimeFormat($employmentForm->created_at)</td>
            <td>
              <x-delete-button route="company.employment-forms.destroy" :model="$employmentForm" />
            </td>
          </tr>
        @empty
          <x-no-data :colspan="9" />
        @endforelse
      </x-slot>
    </x-table>
  </x-card>

  <x-modal title="ارسال فرم استخدام" id="create-employment-form-modal">
    <x-form :action="route('company.employment-forms.store')" method="POST" :has-default-buttons="0">
      <div class="row">
        <div class="col-12">
          <x-form-group>
            <x-input type="text" name="first_name" placeholder="نام" required />
          </x-form-group>
        </div>
        <div class="col-12">
          <x-form-group>
            <x-input type="text" name="last_name" placeholder="نام خانوادگی" required />
          </x-form-group>
        </div>
        <div class="col-12">
          <x-form-group>
            <x-input type="text" name="mobile" placeholder="موبایل" minlength="11" maxlength="11" required />
          </x-form-group>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <button class="btn btn-block btn-primary disableable">ارسال</button>
        </div>
      </div>
    </x-form>
  </x-modal>

  @push('scripts')
    @stack('filter-form-scripts')
  @endpush

</x-dashboard::company.layout.master>