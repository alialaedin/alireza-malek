<?php

namespace Modules\Core\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Modules\Core\Traits\BaseModelTrait;
use Modules\Core\Traits\HasFile;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class BaseAuthMediaModel extends Authenticatable implements HasMedia
{
  use BaseModelTrait, InteractsWithMedia, HasFile;
}
