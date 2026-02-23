<!DOCTYPE html>
<html lang="en">

<head>

	<!-- Meta Tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Dashboard | SmartHR - Advanced Bootstrap 5 Multipurpose Admin Dashboard Template for HRM, Payroll & CRM</title>
	
	<meta name="description" content="SmartHR - An advanced Bootstrap 5 admin dashboard template for HRM and CRM. Ideal for managing employee records, payroll, attendance, recruitment, and team performance with an intuitive and responsive design. Perfect for HR teams and business managers looking to streamline workforce management.">
	<meta name="keywords" content="HR dashboard template, HRM admin template, Bootstrap 5 HR dashboard, workforce management dashboard, employee management system, payroll dashboard, HR analytics, admin dashboard, CRM admin template, human resources management, HR admin template, team management dashboard, recruitment dashboard, employee attendance system, performance management, HR CRM, HR dashboard HTML, Bootstrap HR template, employee engagement, HR software, project management dashboard">
	<meta name="author" content="Dreams Technologies">
	<meta name="robots" content="index, follow">

    @include('partials.css')
    @stack('css')
</head>

<body class="antialiased bg-light text-default">

	<div id="global-loader">
		<div class="page-loader"></div>
	</div>

	<!-- Main Wrapper -->
	<div class="main-wrapper">

		@include('partials.header')

		@include('partials.sidebar')

		

		<!-- Page Wrapper -->
		<div class="page-wrapper relative pt-[50px] ml-[252px]">
			<div class="content p-6 pb-0">
				@yield('content')
				{{ $slot ??'' }}
			</div>

			{{-- @include('partials.footer') --}}

		</div>
		<!-- /Page Wrapper -->		

	</div>
	<!-- /Main Wrapper -->

	@include('partials.js')
    @stack('scripts')
</body>

</html>