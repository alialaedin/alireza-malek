<?php

namespace Modules\Core\Traits;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Attributes\Scope;

trait BaseModelTrait
{
  public function initializeBaseModelTrait(): void
  {
    $this->perPage = 50;
  }

  #[Scope]
  protected function paginateOrAll(Builder $query, ?int $perPage = null, array $columns = ['*'])
  {
    return request()->has('all') ?
      $query->get($columns) :
      $query->paginate($perPage ?? $this->perPage, $columns)->withQueryString();
  }

  #[Scope]
  protected function paginateWithQueryString(Builder $query, ?int $perPage = null, array $columns = ['*'])
  {
    return $query->paginate($perPage ?? $this->perPage, $columns)->withQueryString();
  }

  #[Scope]
  protected function active(Builder $query, string $column = 'status'): void
  {
    $query->where($column, '=', 1);
  }

  #[Scope]
  protected function today(Builder $query, $column = 'created_at'): void
  {
    $query->whereDate($column, Carbon::today());
  }

  #[Scope]
  protected function filterByDates(Builder $query, $column = 'created_at'): void
  {
    $fromDateRequestKey = $this->fromDateRequestKey ?? 'start_date';
    $toDateRequestKey = $this->toDateRequestKey ?? 'end_date';

    $fromDate = request()->input($fromDateRequestKey);
    $toDate = request()->input($toDateRequestKey);

    if ($fromDate && $toDate) {
      $query->whereBetween($column, [
        Carbon::parse($fromDate)->startOfDay(),
        Carbon::parse($toDate)->endOfDay()
      ]);
    } elseif ($fromDate) {
      $query->whereDate($column, '>=', Carbon::parse($fromDate)->format('Y-m-d'));
    } elseif ($toDate) {
      $query->whereDate($column, '<=', Carbon::parse($toDate)->format('Y-m-d'));
    }
  }

  #[Scope]
  protected function filterByStatus(Builder $query, string $column = 'status'): void
  {
    $hasStatus = in_array(request()->status, ['1', '0']);
    $query->when($hasStatus, function ($q) use ($column) {
      $q->where($column, '=', request()->status);
    });
  }

  public function isDeletable(): bool
  {
    return true;
  }
}
