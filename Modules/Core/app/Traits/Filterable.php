<?php

namespace Modules\Core\Traits;

use Exception;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Arr;

trait Filterable
{
  /**
   * @throws Exception
   */
  protected static function bootFilterable(): void
  {
    if (!property_exists(static::class, 'filterColumns')) {
      throw new Exception("filter columns are not defined.");
    }

    if (empty(static::$filterColumns)) {
      throw new Exception("filter columns property is empty.");
    }
  }

  #[Scope]
  protected function filters(Builder $query): void
  {
    $filterInputs = self::getFilterInputs();
    $inputs = Request::query();

    foreach (static::$filterColumns as $key) {

      $value = $inputs[$key] ?? null;
      if (is_null($value) || $value === '' || !isset($filterInputs[$key])) {
        continue;
      }

      $column = $filterInputs[$key]['column'] ?? $key;
      $type = $filterInputs[$key]['type'] ?? 'text';
      $operator = $filterInputs[$key]['operator'] ?? '=';
      $relation = $filterInputs[$key]['relation'] ?? null;

      if (isset($relation) && filled($relation)) {
        $query->whereHas($relation, function (Builder $q) use ($column, $operator, $value) {
          $q->where($column, $operator, $value);
        });
        continue;
      }

      if ($type === 'select' && in_array($value, ['on', 'off'])) {
        $value = $value == 'on' ? 1 : 0;
      }

      $this->applyFilter($query, $column, $type, $operator, $value);
    }
  }

  private function applyFilter(Builder $query, string $column, string $type, string $operator, $value): void
  {
    switch ($type) {
      case 'text':
      case 'email':
        $query->where($column, 'like', "%{$value}%");
        break;

      case 'date':
        $query->whereDate($column, $operator, $value);
        break;

      case 'select':
      case 'number':
      default:
        $query->where($column, $operator, $value);
        break;
    }
  }

  public static function getFilterInputs(): array
  {
    return Arr::only(config('core.filters'), self::$filterColumns);
  }
}
