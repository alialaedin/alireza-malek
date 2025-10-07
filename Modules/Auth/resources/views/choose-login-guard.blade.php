<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>

  <meta charset="UTF-8">
  <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>

  <title> ورود به پنل </title>

  <link href="{{ asset('assets/font/font.css' )}}" rel="stylesheet"/>
  <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.css' )}}" rel="stylesheet" />
  <link href="{{ asset('assets/css-rtl/style.css' )}}" rel="stylesheet" />
  <link href="{{ asset('assets/css/main.css' )}}" rel="stylesheet" >

  <style>
    h3 {
      font-family: Vazir, serif;
    }
  </style>

</head>

<body>

<div class="page login-bg">
  <div class="page-single">
    <div class="container">
      <x-row>
        <x-col class="mx-auto">
          <x-row class="justify-content-center">
            <x-col md="7" lg="5" xl="5">
              <x-card>
                <h3 class="text-center">انتخاب روش ورود</h3>
                <a href="{{ route('company.login-form') }}" class="mt-5 btn btn-primary btn-block">ورود شرکت</a>
                <a href="{{ route('employee.login-form') }}" class="btn btn-success btn-block">ورود کارمند</a>
              </x-card>
            </x-col>
          </x-row>
        </x-col>
        </x-col>
    </div>
  </div>
</div>

<script src="{{ asset('assets/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>

</body>
</html>
