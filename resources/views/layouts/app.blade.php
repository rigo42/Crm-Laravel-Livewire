<html lang="es">
	<!--begin::Head-->
	<head>
		<meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>@yield('title')</title>
     
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" defer />
        
		<!--begin::Page Vendors Styles(used by this page)-->
		<link href="{{ asset('assets') }}/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />

		<!--begin::Global Theme Styles(used by all pages)-->
		<link href="{{ asset('assets') }}/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets') }}/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets') }}/css/style.bundle.css" rel="stylesheet" type="text/css" />
	
		<!--begin::Layout Themes(used by all pages)-->
		<link href="{{ asset('assets') }}/css/themes/layout/header/base/light.css" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets') }}/css/themes/layout/header/menu/light.css" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets') }}/css/themes/layout/brand/light.css" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets') }}/css/themes/layout/aside/light.css" rel="stylesheet" type="text/css" />

		<!--end::Layout Themes-->
		<link rel="shortcut icon" href="{{ asset('assets') }}/media/logos/favicon.ico" />

		@yield('head')

		@livewireStyles
	</head>

	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
		<!--begin::Main-->
		
	   @include('layouts.header_mobile')
       @include('layouts.header')
       
		<!--begin::Scrolltop-->
		<div id="kt_scrolltop" class="scrolltop">
			<i class="fas fa-angle-double-up"></i>
		</div>
		<!--end::Scrolltop-->
		
		<script>var HOST_URL = "https://brandbean.mx";</script>
		<!--begin::Global Config(global config for global JS scripts)-->
		<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1200 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#6993FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#F3F6F9", "dark": "#212121" }, "light": { "white": "#ffffff", "primary": "#E1E9FF", "secondary": "#ECF0F3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#212121", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#ECF0F3", "gray-300": "#E5EAEE", "gray-400": "#D6D6E0", "gray-500": "#B5B5C3", "gray-600": "#80808F", "gray-700": "#464E5F", "gray-800": "#1B283F", "gray-900": "#212121" } }, "font-family": "Poppins" };</script>
		
		<!--begin::Global Theme Bundle(used by all pages)-->
		<script src="{{ asset('assets') }}/plugins/global/plugins.bundle.js"></script>
		<script src="{{ asset('assets') }}/plugins/custom/prismjs/prismjs.bundle.js"></script>
		<script src="{{ asset('assets') }}/js/scripts.bundle.js"></script>
		<!--end::Global Theme Bundle-->
		<!--begin::Page Vendors(used by this page)-->
		<script src="{{ asset('assets') }}/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
		<!--end::Page Vendors-->
		<!--begin::Page Scripts(used by this page)-->
		<script src="{{ asset('assets') }}/js/pages/widgets.js"></script>
		<!--end::Page Scripts-->

		@yield('footer')

		@livewireScripts
	</body>
	<!--end::Body-->
</html>