@extends('backend.layouts.admin-template.primary')

@section('page-body')
    <div class="layout-container">
        <!-- Left Side Bar Start-->
        @include('backend.layouts.admin-template.left-sidebar')
        <!-- Left Side Bar End-->


        <!-- Layout Container  -->
        <div class="layout-page">
            <!-- Navbar Start -->
            @include('backend.layouts.admin-template.navbar')
            <!-- Navbar End -->

            <!-- Content wrapper -->
            <div class="content-wrapper">

                <!--Dynamic Content Start -->
                <div class="container-xxl flex-grow-1 container-p-y">
                    @include('backend.layouts.admin-template.breadcrumb')
                    @yield('main-content')
                </div>
                <!--Dynamic Content End -->


                <!-- Footer Start -->
                @include('backend.layouts.admin-template.footer')
                <!-- Footer End -->

                <div class="content-backdrop fade"></div>
            </div>
            <!-- Content wrapper End -->
        </div>
        <!-- Layout page End -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>

    <!-- Drag Target Area To SlideIn Menu On Small Screens -->
    <div class="drag-target"></div>
@endsection
