<x-dashboard::company.layout.master>

  <div class="page-header">
    <x-breadcrumb :items="config('company-breadcrumbs.accounts.index')" />
    <x-link-create-button title="حساب بانکی جدید" :route="route('company.accounts.create')" />
  </div>

  <x-card title="حساب های بانکی">
    <x-table>
      <x-slot name="thead">
        <tr>
          <th>ردیف</th>
          <th>نام بانک</th>
          <th>مالک حساب</th>
          <th>شماره کارت</th>
          <th>شماره شبا</th>
          <th>وضعیعت</th>
          <th>تاریخ ثبت</th>
          <th>عملیات</th>
        </tr>
      </x-slot>
      <x-slot name="tbody">
        @forelse ($accounts as $account)
          <tr>
            <td class="font-weight-bold">{{ $loop->iteration }}</td>
            <td>{{ $account->bank_name }}</td>
            <td>{{ $account->card_owner }}</td>
            <td>{{ $account->card_number }}</td>
            <td>{{ $account->sheba_number }}</td>
            <td>
              <x-badge :type="$account->status ? 'success' : 'danger'" :text="$account->status ? 'فعال' : 'غیر فعال'" />
            </td>
            <td>{{ verta($account->created_at)->format('Y/m/d H:i') }}</td>
            <td>
              <x-edit-button :model="$account" route="company.accounts.edit" />
              <x-delete-button :model="$account" route="company.accounts.destroy" />
            </td>
          </tr>
        @empty
          <x-no-data :colspan="8" />
        @endforelse
      </x-slot>
    </x-table>
  </x-card>

</x-dashboard::company.layout.master>