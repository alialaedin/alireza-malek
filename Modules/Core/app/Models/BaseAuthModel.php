<?php

namespace Modules\Core\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Modules\Core\Traits\BaseModelTrait;

class BaseAuthModel extends Authenticatable
{
  use BaseModelTrait;
}
