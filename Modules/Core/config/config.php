<?php

use Modules\Campaign\Enums\CampaignDiscountType;

return [
  'name' => 'Core',

  'filters' => [
    'id' => [
      'column' => 'id',
      'type' => 'number',
      'placeholder' => 'شناسه را اینجا وارد کنید',
      'operator' => '=',
    ],
    'code' => [
      'column' => 'code',
      'type' => 'text',
      'placeholder' => 'کد را اینجا وارد کنید',
      'operator' => '=',
    ],
    'title' => [
      'column' => 'title',
      'type' => 'text',
      'placeholder' => 'عنوان را اینجا وارد کنید',
      'operator' => 'like',
    ],
    'first_name' => [
      'column' => 'first_name',
      'type' => 'text',
      'placeholder' => 'نام را اینجا وارد کنید',
      'operator' => 'like',
    ],
    'last_name' => [
      'column' => 'last_name',
      'type' => 'text',
      'placeholder' => 'نام خانوادگی را اینجا وارد کنید',
      'operator' => 'like',
    ],
    'name' => [
      'column' => 'name',
      'type' => 'text',
      'placeholder' => 'عنوان را اینجا وارد کنید',
      'operator' => 'like',
    ],
    'username' => [
      'column' => 'username',
      'type' => 'text',
      'placeholder' => 'نام کاربری را اینجا وارد کنید',
      'operator' => 'like',
    ],
    'description' => [
      'column' => 'description',
      'type' => 'text',
      'placeholder' => 'بخشی از جزئیات را اینجا وارد کنید',
      'operator' => 'like',
    ],
    'mobile' => [
      'column' => 'mobile',
      'type' => 'text',
      'placeholder' => 'شماره موبایل را اینجا وارد کنید',
      'operator' => 'like',
    ],
    'national_code' => [
      'column' => 'national_code',
      'type' => 'text',
      'placeholder' => 'کد ملی را اینجا وارد کنید',
      'operator' => '=',
    ],
    'workshop_code' => [
      'column' => 'workshop_code',
      'type' => 'text',
      'placeholder' => 'کد کارگاه را اینجا وارد کنید',
      'operator' => '=',
    ],
    'subject' => [
      'column' => 'subject',
      'type' => 'text',
      'placeholder' => 'موضوع را اینجا وارد کنید',
      'operator' => 'like',
    ],
    'contract_number' => [
      'column' => 'contract_number',
      'type' => 'text',
      'placeholder' => 'شماره قرارداد را اینجا وارد کنید',
      'operator' => '=',
    ],
    'status' => [
      'column' => 'status',
      'type' => 'select',
      'placeholder' => 'وضعیت را انتخاب کنید',
      'options' => [
        'on' => 'فعال',
        'off' => 'غیرفعال',
      ],
      'operator' => '=',
    ],
    'discount_type' => [
      'column' => 'discount_type',
      'type' => 'select',
      'placeholder' => 'نوع تخفیف را انتخاب کنید',
      'options' => collect(CampaignDiscountType::getCasesWithLabel())->pluck('label', 'name'),
      'operator' => '=',
    ],
    'has_seen' => [
      'column' => 'has_seen',
      'type' => 'select',
      'placeholder' => 'وضعیت مشاهده را انتخاب کنید',
      'options' => [
        'on' => 'مشاهده شده',
        'off' => 'مشاهده نشده',
      ],
      'operator' => '=',
    ],
    'is_filled' => [
      'column' => 'is_filled',
      'type' => 'select',
      'placeholder' => 'وضعیت پر شدن را انتخاب کنید',
      'options' => [
        'on' => 'پر شده',
        'off' => 'پر نشده',
      ],
      'operator' => '=',
    ],
    'type' => [
      'column' => 'type',
      'type' => 'select',
      'placeholder' => 'نوع را انتخاب کنید',
      'options' => [],
      'operator' => '=',
    ],
    'holder_id' => [
      'column' => 'holder_id',
      'type' => 'select',
      'placeholder' => 'شرکت را انتخاب کنید',
      'options' => [],
      'operator' => '=',
      'relation' => 'wallet',
    ],
    'holder_type' => [
      'column' => 'holder_type',
      'type' => 'hidden',
      'value' => '',
      'operator' => '=',
      'relation' => 'wallet',
    ],
    'headline_id' => [
      'column' => 'headline_id',
      'type' => 'select',
      'placeholder' => 'سرفصل را انتخاب کنید',
      'options' => [],
      'operator' => '=',
    ],
    'province_id' => [
      'column' => 'id',
      'type' => 'select',
      'placeholder' => 'استان را انتخاب کنید',
      'options' => [],
      'operator' => '=',
      'relation' => 'province',
    ],
    'company_id' => [
      'column' => 'id',
      'type' => 'select',
      'placeholder' => 'شرکت را انتخاب کنید',
      'options' => [],
      'operator' => '=',
      'relation' => 'company',
    ],
    'fiscal_year_id' => [
      'column' => 'id',
      'type' => 'select',
      'placeholder' => 'سال مالی را انتخاب کنید',
      'options' => [],
      'operator' => '=',
      'relation' => 'fiscalYear',
    ],
    'from_date' => [
      'column' => 'created_at',
      'type' => 'date',
      'placeholder' => 'از تاریخ',
      'operator' => '>=',
    ],
    'to_date' => [
      'column' => 'created_at',
      'type' => 'date',
      'placeholder' => 'تا تاریخ',
      'operator' => '<=',
    ],
  ]
];
