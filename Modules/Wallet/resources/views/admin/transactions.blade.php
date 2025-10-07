<x-dashboard::admin.layout.master>

  <div class="page-header">
    <x-breadcrumb :items="config('admin-breadcrumbs.wallet-transactions.index')" />
  </div>

  <x-core::filter-form :action="route('admin.wallet-transactions.index')" :inputs="$filters" />

  <x-card title="تراکنش های کیف پول">
    <x-slot name="options">
      <div class="d-flex" style="gap: 5px;">
        <button data-target="#deposit" data-toggle="modal" class="btn btn-outline-success btn-sm">افزایش موجودی</button>
        <button data-target="#withdraw" data-toggle="modal" class="btn btn-outline-danger btn-sm">کاهش موجودی</button>
      </div>
    </x-slot>
    <x-table :pagination="$walletTransactions">
      <x-slot name="thead">
        <tr>
          <th>ردیف</th>
          <th>شناسه تراکنش</th>
          <th>مبلغ (تومان)</th>
          <th>نوع تراکنش</th>
          <th>شرکت</th>
          <th>موبایل</th>
          <th>توضیحات</th>
          <th>تاریخ تراکنش</th>
        </tr>
      </x-slot>
      <x-slot name="tbody">
        @forelse ($walletTransactions as $transaction)
          <tr>
            <td class="font-weight-bold">{{ $loop->iteration }}</td>
            <td>{{ $transaction->id }}</td>
            <td>{{ number_format($transaction->amount) }}</td>
            <td>
              <x-badge :type="$transaction->type->color()" :text="$transaction->type->label()" :is-light="true" />
            </td>
            <td>{{ $transaction->wallet->holder->holder_name }}</td>
            <td>{{ $transaction->wallet->holder->holder_mobile }}</td>
            <td style="text-wrap: wrap">{{ $transaction->description }}</td>
            <td><x-jalali-date :date="$transaction->created_at" /></td>
          </tr>
        @empty
          <x-no-data :colspan="8" />
        @endforelse
      </x-slot>
    </x-table>
  </x-card>

  <x-modal title="افزایش موجودی کیف پول" id="deposit">
    <x-form :action="route('admin.wallets.deposit')" method="POST">
      <x-row>

        <x-col>
          <x-form-group>
            <x-label :is-required="true" text="انتخاب شرکت" />
            <x-select name="company_id" :data="$companies" option-label="title" option-value="id" />
          </x-form-group>
        </x-col>

        <x-col>
          <x-form-group>
            <x-label :is-required="true" text="مبلغ (تومان)" />
            <x-input type="text" name="amount" class="comma" />
          </x-form-group>
        </x-col>

        <x-col>
          <x-form-group>
            <x-label :is-required="true" text="توضیحات" />
            <x-textarea type="text" name="description" rows="3" />
          </x-form-group>
        </x-col>

        <x-col>
          <x-form-group>
            <x-checkbox name="deposit_gift_balance" title="افزایش موجودی هدیه" />
            <x-checkbox name="send_sms" title="ارسال پیام به شرکت" />
          </x-form-group>
        </x-col>

      </x-row>
    </x-form>
  </x-modal>

  <x-modal title="کاهش موجودی کیف پول" id="withdraw">
    <x-form :action="route('admin.wallets.withdraw')" method="POST">
      <x-row>

        <x-col>
          <x-form-group>
            <x-label :is-required="true" text="انتخاب شرکت" />
            <x-select name="company_id" :data="$companies" option-label="title" option-value="id" />
          </x-form-group>
        </x-col>

        <x-col>
          <x-form-group>
            <x-label :is-required="true" text="مبلغ (تومان)" />
            <x-input type="text" name="amount" class="comma" />
          </x-form-group>
        </x-col>

        <x-col>
          <x-form-group>
            <x-label :is-required="true" text="توضیحات" />
            <x-textarea type="text" name="description" rows="3" />
          </x-form-group>
        </x-col>

        <x-col>
          <x-form-group>
            <x-checkbox name="withrdaw_gift_balance_too" title="از موجودی هدیه ام کم بشود" />
            <x-checkbox name="send_sms" title="ارسال پیام به شرکت" />
          </x-form-group>
        </x-col>

      </x-row>
    </x-form>
  </x-modal>

  @push('scripts')
    @stack('filter-form-scripts')
    @stack('SelectComponentScripts')
    @stack('dateInputScriptStack')
  @endpush

</x-dashboard::admin.layout.master>