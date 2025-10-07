<?php

namespace Modules\Auth\Enums;

use Illuminate\Database\Eloquent\Model;
use Modules\Admin\Models\Admin;
use Modules\Company\Models\Company;
use Modules\Employee\Models\Employee;

enum GuardName: string
{
  case ADMIN = 'admin';
  case COMPANY = 'company';
  case EMPLOYEE = 'employee';

  public function getModel(): Model
  {
    return match ($this) {
      self::ADMIN => new Admin(),
      self::COMPANY => new Company(),
      self::EMPLOYEE => new Employee(),
    };
  }
}
