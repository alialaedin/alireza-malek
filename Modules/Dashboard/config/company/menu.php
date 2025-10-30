<?php

return [
  [
    'title' => 'داشبورد',
    'icon' => 'ti-dashboard',
    'route' => 'company.dashboard'
  ],
  [
    'title' => 'پروفایل',
    'icon' => 'fe fe-user',
    'route' => 'company.profile.index'
  ],
  [
    'title' => 'اموال و دارایی ها',
    'icon' => 'ti-archive',
    'route' => 'company.finances.index'
  ],
  [
    'title' => 'حساب های بانکی',
    'icon' => 'ti-credit-card',
    'route' => 'company.accounts.index'
  ],
  [
    'title' => 'نسبت های خانوادگی',
    'icon' => 'ti-link',
    'route' => 'company.relations.index'
  ],
  [
    'title' => 'محل های کار',
    'icon' => 'ti-map-alt',
    'route' => 'company.workplaces.index'
  ],
  [
    'title' => 'نرخ نامه ها',
    'icon' => 'ti-layers-alt',
    'route' => 'company.price-lists.index'
  ],
  [
    'title' => 'مشاغل و وظایف',
    'icon' => 'fe fe-briefcase',
    'children' => [
      ['title' => 'وظایف', 'route' => 'company.duties.index'],
      ['title' => 'مشاغل', 'route' => 'company.jobs.index']
    ]
  ],
  [
    'title' => 'فرم های استخدام',
    'icon' => 'ti-clipboard',
    'route' => 'company.employment-forms.index'
  ],
  [
    'title' => 'کارمندان',
    'icon' => 'fe fe-users',
    'route' => 'company.employees.index'
  ],
  // [
  //   'title' => 'قرارداد ها',
  //   'icon' => 'ti-files',
  //   'route' => 'company.price-lists.index'
  // ],
];
