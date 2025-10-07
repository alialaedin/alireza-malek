<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>

	<!-- Meta data -->
	<meta charset="UTF-8">
	<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>

	<title>صفحه ورود</title>

	<link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet" />
	<link href="{{ asset('assets/plugins/summernote/summernote-bs4.css')}}" rel="stylesheet" />
	<link href="{{ asset('assets/css-rtl/style.css')}}" rel="stylesheet" />
	<link href="{{ asset('assets/css-rtl/skin-modes.css')}}" rel="stylesheet" />
	<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap4.min-rtl.css')}}" rel="stylesheet" />
	<link href="{{ asset('assets/css-rtl/style-rtl.css')}}" rel="stylesheet" />
	<link href="{{ asset('assets/font/font.css')}}" rel="stylesheet" />

</head>

<body>
	<div class="page login-bg">
		<div class="page-single">
			<div class="container">
				<x-row>
					<x-col class="mx-auto">
						<x-row class="justify-content-center">
							<x-col md="7" lg="6" xl="6">
								<x-card class="card">
                  
									<div class="p-4 pt-6 text-center">
										<p class="mb-2" style="font-size: 30px">ورود</p>
										<p class="text-muted">به اکانت خود وارد شوید</p>
									</div>

									<x-erros />

									@if(session()->has('success'))
										@php
											toastr()->success(session()->get('success'));
										@endphp
									@endif

                  {{ $slot }}
									
								</x-card>
							</x-col>
						</x-row>
					</x-col>
				</x-row>
			</div>
		</div>
	</div>

	<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
	<script src="{{asset('assets/plugins/bootstrap/popper.min.js')}}"></script>
	<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('assets/plugins/select2/select2.full.min.js')}}"></script>
	<script src="{{asset('assets/plugins/p-scrollbar/p-scrollbar.js')}}"></script>

	<script>
		$(document).ready(() => {
			$('.disableable').click((event) => {
				$(event.target).prop('disabled', true);
				$('#login').submit();
			});
		});
	</script>

</body>

</html>