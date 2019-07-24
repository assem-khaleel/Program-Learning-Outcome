@php
    /**
     * Created by PhpStorm.
     * User: dura
     * Date: 7/1/19
     * Time: 3:07 PM
     */
@endphp
        <!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >
@include('layouts.head')


<body class="fix-header card-no-border logo-center">

<div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
</div>
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<div id="main-wrapper">
@include('layouts.header')
@include('layouts.sidebar')

<!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        @yield('wrapper')
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
    @include('layouts.footer')
</div>

<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
@stack("footer")
@stack('modals')
@include('layouts.custom-js')
@include('layouts.script')

</body>
</html>