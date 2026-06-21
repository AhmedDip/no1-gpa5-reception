<!doctype html>

<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr"
    data-theme="theme-default" data-assets-path="{{ asset('template/assets/') }}/"
    data-template="vertical-menu-template" data-style="light">

<head>
    @include('backend.layouts.partials.head')
</head>

<body>
    <!-- Layout Wrapper Start -->
    <div class="layout-wrapper layout-content-navbar">
        @yield('page-body')
    </div>
    <!-- Layout Wrapper End -->


    <!-- Scripts Start -->
    @include('backend.layouts.partials.scripts')
    <!-- Scripts End -->



</body>

</html>
