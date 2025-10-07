<x-dashboard::company.layout.master>

  <div class="page-header">
    <x-breadcrumb :items="config('company-breadcrumbs.price-lists.index')" />
    <x-link-create-button title="نرخ نامه جدید" :route="route('company.price-lists.create')" />
  </div>

  <x-core::filter-form :action="route('company.price-lists.index')" :inputs="$filters" />

  <x-card title="نرخ نامه ها">
    <x-table>
      <x-slot name="thead">
        <tr>
          <th>ردیف</th>
          <th>سال مالی</th>
          <th>حقوق پایه</th>
          <th>حق مسکن و خواروبار</th>
          <th>بن کارگری</th>
          <th>حق اولاد</th>
          <th>حق تاهل</th>
          <th>عیدی و پاداش</th>
          <th>پایه سنوات</th>
          <th>وضعیت</th>
          <th>عملیات</th>
        </tr>
      </x-slot>
      <x-slot name="tbody">
        @forelse ($priceLists as $priceList)
          <tr>
            <td class="font-weight-bold">{{ $loop->iteration }}</td>
            <td>{{ $priceList->fiscalYear->year }}</td>
            <td>{{ number_format($priceList->salary) }}</td>
            <td>{{ number_format($priceList->right_to_housing_and_food) }}</td>
            <td>{{ number_format($priceList->worker_coupen_amount) }}</td>
            <td>{{ number_format($priceList->children_rights) }}</td>
            <td>{{ number_format($priceList->marriage_rights) }}</td>
            <td>{{ number_format($priceList->reward) }}</td>
            <td>{{ number_format($priceList->work_history_amount) }}</td>
            <td>
              <x-badge :type="$priceList->status ? 'success' : 'danger'" :text="$priceList->status ? 'فعال' : 'غیر فعال'" />
            </td>
            <td>
              <x-edit-button :model="$priceList" route="company.price-lists.edit" />
              <x-delete-button :model="$priceList" route="company.price-lists.destroy" />
            </td>
          </tr>
        @empty
          <x-no-data :colspan="11" />
        @endforelse
      </x-slot>
    </x-table>
  </x-card>

  @push('scripts')
    @stack('filter-form-scripts')
  @endpush

</x-dashboard::company.layout.master>