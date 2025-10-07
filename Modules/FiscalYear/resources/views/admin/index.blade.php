<x-dashboard::admin.layout.master>

  <div class="page-header">
    <x-breadcrumb :items="config('admin-breadcrumbs.fiscal-years.index')" />
    <x-modal-create-button title="ثبت سال مالی جدید" modal-id="create-modal" />
  </div>

  <x-card title="سال های مالی">
    <x-table>
      <x-slot name="thead">
        <tr>
          <th>ردیف</th>
          <th>سال</th>
          <th>وضعیت</th>
          <th>تاریخ ثبت</th>
          <th>عملیات</th>
        </tr>
      </x-slot>
      <x-slot name="tbody">
        @forelse ($fiscalYears as $fiscalYear)
          <tr>
            <td class="font-weight-bold">{{ $loop->iteration }}</td>
            <td>{{ $fiscalYear->year }}</td>
            <td>
              <x-badge :type="$fiscalYear->status ? 'success' : 'danger'" :text="$fiscalYear->status ? 'فعال' : 'غیر فعال'" />
            </td>
            <td><x-jalali-date :date="$fiscalYear->created_at" /></td>
            <td>
              <x-edit-button :model="$fiscalYear" target="#edit-modal-{{ $fiscalYear->id }}" />
              <x-delete-button :model="$fiscalYear" route="admin.fiscal-years.destroy"
                :disabled="!$fiscalYear->isDeletable()" />
            </td>
          </tr>
        @empty
          <x-no-data :colspan="6" />
        @endforelse
      </x-slot>
    </x-table>
  </x-card>

  <x-modal id="create-modal" title="ثبت سال مالی جدید">
    <x-form :action="route('admin.fiscal-years.store')" method="POST">
      <div class="row">
        <div class="col-12">
          <x-form-group>
            <x-label :is-required="true" text="سال" />
            <x-input type="text" name="year" />
          </x-form-group>
        </div>
        <div class="col-12">
          <x-form-group>
            <x-checkbox name="status" title="وضعیت" :is-checked="1" />
          </x-form-group>
        </div>
      </div class="row">
    </x-form>
  </x-modal>

  @foreach ($fiscalYears as $fiscalYear)
    <x-modal id="edit-modal-{{ $fiscalYear->id }}" title="ویرایش سال مالی">
      <x-form :action="route('admin.fiscal-years.update', $fiscalYear)" method="PATCH">
        <div class="row">
          <div class="col-12">
            <x-form-group>
              <x-label :is-required="true" text="سال" />
              <x-input type="text" name="year" :default-value="$fiscalYear->year" id="year-{{ $fiscalYear->id }}" />
            </x-form-group>
          </div>
          <div class="col-12">
            <x-form-group>
              <x-checkbox name="status" title="وضعیت" :is-checked="$fiscalYear->status" id="status-{{ $fiscalYear->id }}" />
            </x-form-group>
          </div>
        </div class="row">
      </x-form>
    </x-modal>
  @endforeach

</x-dashboard::admin.layout.master>