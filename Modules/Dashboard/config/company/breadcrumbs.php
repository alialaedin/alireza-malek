<?php

return [

  'profile' => [
    'index' => [
      ['title' => 'پروفایل']
    ],
  ],

  'finances' => [
    'index' => [
      ['title' => 'دارایی ها']
    ],
    'create' => [
      ['title' => 'دارایی ها', 'route' => 'company.finances.index'],
      ['title' => 'ثبت دارایی جدید'],
    ],
    'edit' => [
      ['title' => 'دارایی ها', 'route' => 'company.finances.index'],
      ['title' => 'ویرایش دارایی'],
    ],
  ],

  'accounts' => [
    'index' => [
      ['title' => 'حساب های بانکی']
    ],
    'create' => [
      ['title' => 'حساب های بانکی', 'route' => 'company.accounts.index'],
      ['title' => 'ثبت حساب بانکی جدید'],
    ],
    'edit' => [
      ['title' => 'حساب های بانکی', 'route' => 'company.accounts.index'],
      ['title' => 'ویرایش حساب بانکی'],
    ],
  ],

  'relations' => [
    'index' => [
      ['title' => 'نسبت های خانوادگی']
    ],
    'create' => [
      ['title' => 'نسبت های خانوادگی', 'route' => 'company.relations.index'],
      ['title' => 'ثبت نسبت خانوادگی جدید'],
    ],
    'edit' => [
      ['title' => 'نسبت های خانوادگی', 'route' => 'company.relations.index'],
      ['title' => 'ویرایش نسبت خانوادگی'],
    ],
  ],

  'workplaces' => [
    'index' => [
      ['title' => 'محل های کار']
    ],
    'create' => [
      ['title' => 'محل های کار', 'route' => 'company.workplaces.index'],
      ['title' => 'ثبت محل کار جدید'],
    ],
    'edit' => [
      ['title' => 'محل های کار', 'route' => 'company.workplaces.index'],
      ['title' => 'ویرایش محل کار'],
    ],
  ],

  'price-lists' => [
    'index' => [
      ['title' => 'نرخ نامه ها']
    ],
    'create' => [
      ['title' => 'نرخ نامه ها', 'route' => 'company.price-lists.index'],
      ['title' => 'ثبت نرخ نامه جدید'],
    ],
    'edit' => [
      ['title' => 'نرخ نامه ها', 'route' => 'company.price-lists.index'],
      ['title' => 'ویرایش نرخ نامه'],
    ],
  ],

  'jobs' => [
    'index' => [
      ['title' => 'مشاغل']
    ],
    'create' => [
      ['title' => 'مشاغل', 'route' => 'company.jobs.index'],
      ['title' => 'ثبت شغل جدید'],
    ],
    'edit' => [
      ['title' => 'مشاغل', 'route' => 'company.jobs.index'],
      ['title' => 'ویرایش شغل'],
    ],
  ],

  'duties' => [
    'index' => [
      ['title' => 'وظایف']
    ],
    'create' => [
      ['title' => 'وظایف', 'route' => 'company.jobs.index'],
      ['title' => 'ثبت وظیفه جدید'],
    ],
    'edit' => [
      ['title' => 'وظایف', 'route' => 'company.jobs.index'],
      ['title' => 'ویرایش وظیفه'],
    ],
  ],

  'employment-forms' => [
    'index' => [
      ['title' => 'فرم های استخدام']
    ],
  ],

  'employees' => [
    'index' => [
      ['title' => 'کارمندان']
    ],
    'create' => [
      ['title' => 'کارمندان', 'route' => 'company.employees.index'],
      ['title' => 'ثبت کارمند جدید'],
    ],
    'edit' => [
      ['title' => 'کارمندان', 'route' => 'company.employees.index'],
      ['title' => 'ویرایش کارمند'],
    ],
  ],
];
