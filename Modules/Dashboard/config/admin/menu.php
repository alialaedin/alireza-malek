<?php

return [
  [
    'title' => 'داشبورد',
    'icon' => 'ti-dashboard',
    'route' => 'admin.dashboard'
  ],
  [
    'title' => 'پروفایل',
    'icon' => 'fe fe-user',
    'route' => 'admin.profile.index'
  ],
  [
    'title' => 'زبان های خارجه',
    'icon' => 'ti-flag-alt-2',
    'route' => 'admin.languages.index'
  ],
  [
    'title' => 'مدیریت مناطق',
    'icon' => 'ti-map-alt',
    'children' => [
      ['title' => 'استان ها', 'route' => 'admin.provinces.index'],
      ['title' => 'شهر ها', 'route' => 'admin.cities.index']
    ]
  ],
  [
    'title' => 'سال مالی',
    'icon' => 'ti-bar-chart',
    'route' => 'admin.fiscal-years.index'
  ],
  [
    'title' => 'سمت های شغلی',
    'icon' => 'ti-id-badge',
    'route' => 'admin.positions.index'
  ],
  [
    'title' => 'کیف پول',
    'icon' => 'ti-wallet',
    'route' => 'admin.wallet-transactions.index'
  ],
  [
    'title' => 'مدیریت اشخاص',
    'icon' => 'ti-harddrives',
    'children' => [
      ['title' => 'اشخاص حقیقی', 'route' => 'admin.real-companies.index'],
      ['title' => 'اشخاص حقوقی', 'route' => 'admin.legal-companies.index']
    ]
  ],
  [
    'title' => 'قرارداد ها',
    'icon' => 'ti-files',
    'route' => 'admin.contract-companies.index'
  ],
  [
    'title' => 'مدیریت هزینه و درامد',
    'icon' => 'ti-credit-card',
    'children' => [
      ['title' => 'سرفصل ها', 'route' => 'admin.headlines.index'],
      ['title' => 'هزینه ها', 'route' => 'admin.expenses.index'],
      ['title' => 'درامد ها', 'route' => 'admin.revenues.index'],
    ]
  ],
  [
    'title' => 'تنظیمات',
    'icon' => 'ti-settings',
    'route' => 'admin.settings.index'
  ],
];
