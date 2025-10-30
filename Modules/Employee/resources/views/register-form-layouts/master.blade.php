<!DOCTYPE html>
<html lang="en" dir="rtl">
	<head>

		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta content="DayOne - It is one of the Major Dashboard Template which includes - HR, Employee and Job Dashboard. This template has multipurpose HTML template and also deals with Task, Project, Client and Support System Dashboard." name="description">
		<meta content="Spruko Technologies Private Limited" name="author">
		<meta name="keywords" content="admin dashboard, admin panel template, html admin template, dashboard html template, bootstrap 4 dashboard, template admin bootstrap 4, simple admin panel template, simple dashboard html template,  bootstrap admin panel, task dashboard, job dashboard, bootstrap admin panel, dashboards html, panel in html, bootstrap 4 dashboard"/>

		<title>فرم استخدام</title>

    <link href="{{ asset('assets/font/font.css')}}" rel="stylesheet"/>
    <link href="{{ asset('assets/plugins/sweet-alert/sweetalert.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/sweet-alert/jquery.sweet-modal.min.css')}}" rel="stylesheet" >
    <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet" />
    <link href="{{ asset('assets/css-rtl/style.css')}}" rel="stylesheet" />
    <link href="{{ asset('assets/css-rtl/dark.css')}}" rel="stylesheet" />
    <link href="{{ asset('assets/css-rtl/skin-modes.css')}}" rel="stylesheet" />
    <link href="{{ asset('assets/css-rtl/sidemenu.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/p-scrollbar/p-scrollbar.css')}}" rel="stylesheet" />
    <link href="{{ asset('assets/css-rtl/icons.css')}}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/sidebar/sidebar.css')}}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/select2/select2.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/jvectormap/jqvmap.css')}}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap4.min-rtl.css')}}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/time-picker/jquery.timepicker.css')}}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/jQuery-countdowntimer/jQuery.countdownTimer.css')}}" rel="stylesheet" />
    <link href="{{ asset('assets/css-rtl/style-rtl.css')}}" rel="stylesheet" />
    <link href="{{ asset('assets/PersianDateTimePicker-bs4/src/jquery.md.bootstrap.datetimepicker.style.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/select2/dist/css/select2.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('assets/vue/multiselect/vue-multiselect.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vue/multiselect/custom-styles.css') }}" rel="stylesheet" />

    @yield('styles')

	</head>

	<body>

		<div id="global-loader" >
			<img src="../../assets/images/svgs/loader.svg" alt="loader">
		</div>

		<div class="page">
			<div class="page-main">

				<div id="main-content" class="main-content">
					<div class="container mt-5">

            @yield('content')

					</div>
        </div>

			</div>
		</div>

		<a href="#top" id="back-to-top"><span class="feather feather-chevrons-up"></span></a>

		<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap/popper.min.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/plugins/sidemenu/sidemenu.js')}}"></script>
    {{-- <script src="{{asset('assets/plugins/p-scrollbar/p-scrollbar.js')}}"></script> --}}
    {{-- <script src="{{asset('assets/plugins/p-scrollbar/p-scroll1.js')}}"></script> --}}
    {{-- <script src="{{asset('assets/plugins/sidebar/sidebar.js')}}"></script> --}}
    <script src="{{asset('assets/plugins/select2/select2.full.min.js')}}"></script>
    {{-- <script src="{{asset('assets/plugins/peitychart/jquery.peity.min.js')}}"></script> --}}
    {{-- <script src="{{asset('assets/plugins/vertical-scroll/vertical-scroll.js')}}"></script> --}}
    {{-- <script src="{{asset('assets/plugins/date-picker/jquery-ui.js')}}"></script> --}}
    {{-- <script src="{{asset('assets/plugins/time-picker/jquery.timepicker.js')}}"></script> --}}
    {{-- <script src="{{asset('assets/plugins/time-picker/toggles.min.js')}}"></script> --}}
    {{-- <script src="{{asset('assets/plugins/jQuery-countdowntimer/jQuery.countdownTimer.js')}}"></script> --}}
    <script src="{{asset('assets/js/index1.js')}}"></script>
    <script src="{{asset('assets/js/custom.js')}}"></script>
    {{-- <script src="{{asset('assets/PersianDateTimePicker-bs4/src/jquery.md.bootstrap.datetimepicker.js') }}"></script> --}}
    {{-- <script src="{{asset('assets/select2/dist/js/select2.min.js')}}"></script> --}}
    <script src="{{asset('assets/custom/custom.js')}}"></script>
    <script src="{{asset('assets/vue/vue3/vue.global.prod.js')}}"></script>
    <script src="{{asset('assets/sweetalert2/sweetalert2.js')}}"></script>
    <script src="{{asset('assets/vue/multiselect/vue-multiselect.umd.min.js') }}"></script>
    <script src="{{asset('assets/vue/moment/moment.js') }}"></script>
    <script src="{{asset('assets/vue/moment/moment-jalaali.js') }}"></script>
    <script src="{{asset('assets/vue/date-time-picker/vue3-persian-datetime-picker.umd.min.js') }}"></script>

    @yield('scripts')

	</body>
</html>