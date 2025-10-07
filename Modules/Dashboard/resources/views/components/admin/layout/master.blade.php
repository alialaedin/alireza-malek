@props([
	'title' => env('APP_NAME'),
	'id'
])

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>

	<meta charset="UTF-8">
	<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ $title }}</title>

	<x-dashboard::public.styles />
	<x-dashboard::admin.includes.styles />

	@stack('styles')

</head>

<body class="app sidebar-mini">

	<div id="global-loader">
		<img src="{{ asset('assets/images/svgs/loader.svg') }}" alt="loader">
	</div>

	<div class="page">
		<div class="page-main">

			<x-dashboard::admin.includes.sidebar />
			<x-dashboard::admin.includes.header />

			<div
				{{ $attributes->merge([
					'class' => 'app-content py-1',
					'id' => $id ?? 'app-content',
					'style' => 'padding-left: 20px; padding-right: 20px;'
				]) }}
			>
			
				<x-erros />

				@session('status')
					@php
						toastr()->success($value);
					@endphp
				@endsession

				{{ $slot }}
				
			</div>

		</div>
	</div>

	<a href="#" id="back-to-top"><span class="feather feather-chevrons-up"></span></a>

	<x-dashboard::public.scripts />
	<x-dashboard::admin.includes.scripts />

	@stack('scripts')

</body>
</html>
