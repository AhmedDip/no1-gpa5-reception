<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

<title>
    @yield('title') | {{ env('APP_NAME') }}
</title>

<meta name="description" content="" />

<link rel="icon" type="image/x-icon" href="{{ asset('images/no1-logo.png') }}" />


<link rel="stylesheet" href="{{ asset('template/assets/vendor/fonts/boxicons.css') }}" />
<link rel="stylesheet" href="{{ asset('template/assets/vendor/fonts/fontawesome.css') }}" />
<link rel="stylesheet" href="{{ asset('template/assets/vendor/fonts/flag-icons.css') }}" />


<!-- Core CSS -->
<link rel="stylesheet" href="{{ asset('template/assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
<link rel="stylesheet" href="{{ asset('template/assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
<link rel="stylesheet" href="{{ asset('template/assets/css/demo.css') }}" />

<!-- Vendors CSS -->
<link rel="stylesheet" href="{{ asset('template/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
<link rel="stylesheet" href="{{ asset('template/assets/vendor/libs/apex-charts/apex-charts.css') }}" />
<link rel="stylesheet" href="{{ asset('template/assets/vendor/libs/flatpickr/flatpickr.css') }}" />
<link rel="stylesheet" href="{{ asset('template/assets/vendor/libs/toastr/toastr.css') }}" />


<!-- Page CSS -->

<link rel="stylesheet" href="{{ asset('template/assets/vendor/css/pages/page-icons.css') }}" />



<!-- Custom CSS -->
<link href="{{ asset('css/custom_style.css') }}" rel="stylesheet" type="text/css" />

{{-- Custom Layout CSS --}}
<link href="{{ asset('css/custom_layout.css') }}" rel="stylesheet" type="text/css" />

<!-- Datatables CSS -->
<link rel="stylesheet" href="{{ asset('template/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
<link rel="stylesheet" href="{{ asset('template/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
<link rel="stylesheet" href="{{ asset('template/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}" />


<!-- Select2 CSS -->
<link rel="stylesheet" href="{{ asset('template/assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
<link rel="stylesheet" href="{{ asset('template/assets/vendor/libs/select2/select2.css') }}" />

<!-- Helpers -->
<script src="{{ asset('template/assets/vendor/js/helpers.js') }}"></script>

<script src="{{ asset('template/assets/js/config.js') }}"></script>

@stack('css')
