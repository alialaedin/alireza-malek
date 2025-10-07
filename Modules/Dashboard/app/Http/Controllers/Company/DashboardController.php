<?php

namespace Modules\Dashboard\Http\Controllers\Company;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
  public function index()
  {
    return view('dashboard::company.dashboard');
  }
}
