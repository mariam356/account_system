{{--@php(env('APP_NAME', __('admin.search')))--}}
@php(env('APP_NAME', 'admin.search'))
@php(!isset($is_morris) ? $is_morris = 0 : $is_morris = 1)
@php($page_title = !isset($page_title) ?app()->getLocale() == 'en' ? 'Account System' : 'نظام محاسبي' : $page_title)
    <!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<!-- BEGIN: Head-->
@include('layouts.head')

<!-- BEGIN: Body-->
<body class="horizontal-layout horizontal-menu 2-columns  " data-open="hover" data-menu="horizontal-menu" data-col="2-columns">

<!-- BEGIN: Main Nav-->
@include('layouts.nav')

<!-- BEGIN: Main Menu-->
@include('layouts.sidebar')

<!-- BEGIN: Content-->
<div class="app-content content" id="app">
    @yield('content')

    {{-- modal of loading beforeSend for show modal --}}

</div>
<!-- END: Content-->

<div class="sidenav-overlay"></div>
<div class="drag-target"></div>

@include('layouts.footer')

<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

@yield('script')
<!-- BEGIN: Vendor JS-->
<script src="{{asset('app-assets/vendors/js/vendors.min.js')}}"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{asset('app-assets/vendors/js/ui/jquery.sticky.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/charts/jquery.sparkline.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/charts/chart.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/charts/chartist.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/charts/chartist-plugin-tooltip.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/forms/extended/card/jquery.card.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/extensions/moment.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/extensions/underscore-min.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/extensions/clndr.min.js')}}"></script>
<!-- END: Page Vendor JS-->

<script src="{{asset('/app-assets/vendors/js/extensions/jquery.steps.min.js')}}"></script>
<script src="{{asset('/app-assets/vendors/js/pickers/dateTime/moment-with-locales.min.js')}}"></script>
<script src="{{asset('/app-assets/vendors/js/pickers/daterange/daterangepicker.js')}}"></script>
<script src="{{asset('/app-assets/vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('/app-assets/vendors/js/forms/icheck/icheck.min.js')}}"></script>
<!-- END: Page Vendor JS-->




<!-- BEGIN: Theme JS-->
<script src="{{asset('app-assets/js/core/app-menu.js')}}"></script>
<script src="{{asset('app-assets/js/core/app.js')}}"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="{{asset('app-assets/js/scripts/ui/breadcrumbs-with-stats.js')}}"></script>
<script src="{{asset('/app-assets/js/scripts/pages/bank-account.js')}}"></script>
<script src="{{asset('app-assets/js/scripts/pages/dashboard-bank.js')}}"></script>
<!-- END: Page JS-->

{{--<script src="{{asset('app-assets/js/scripts/tables/datatables/datatable-basic.min.js')}}"></script>--}}
<!-- END: Page JS-->
<script src="{{asset('app-assets/js/core/libraries/jquery_ui/jquery-ui.min.js')}}"></script>
<script src="{{asset('app-assets/js/scripts/ui/jquery-ui/navigations.min.js')}}"></script>


<style>
    .custom-btn {
        background-color: #345862;
        color: #fff; /* White text for contrast */
        border: none;
    }

    .custom-btn:hover {
        background-color: #2b4750; /* Slightly darker for hover */
    }

    .cancel-btn {
        background-color: #b92c81;
        color: #fff; /* White text for contrast */
        border: none;
    }
</style>

@include('include.ajax-CRUD')
@include('include.vue')
@include('include.table_length_js')
@include('layouts.notify-js')

</body>
<!-- END: Body-->

</html>
