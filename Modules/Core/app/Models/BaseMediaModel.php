<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\BaseModelTrait;
use Modules\Core\Traits\HasFile;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class BaseMediaModel extends Model implements HasMedia
{
  use BaseModelTrait, InteractsWithMedia, HasFile;

  public function registerMediaCollections(): void
  {
    $this->registerCustomMediaCollections();
  }
}
