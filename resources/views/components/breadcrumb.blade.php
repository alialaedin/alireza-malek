@php

  $routes = [
    'admin' => 'admin.dashboard',
    'company' => 'company.dashboard',
    'employee' => 'employee.dashboard',
  ];

  $guard = collect(array_keys($routes))->first(fn($g) => auth($g)->check());
  $dashboardRoute = $guard ? route($routes[$guard]) : '#';

@endphp

@props([
  'items' => []
])

<ol class="breadcrumb align-items-center fs-12">
  <li class="breadcrumb-item">
    <a href="{{ $dashboardRoute }}">داشبورد</a>
</li>
@if (!empty($items))
  @foreach ($items as $item)
    @isset ($item['route'])
      <li class="breadcrumb-item mt-0 pl-0"><a href="{{ route($item['route']) }}">{{ $item['title'] }}</a></li>
    @else
      <li class="breadcrumb-item active mt-0">{{ $item['title'] }}</li>
    @endisset
  @endforeach
@endif
</ol>