@php(env('APP_NAME', 'admin.search'))
@php(!isset($is_morris) ? $is_morris = 0 : $is_morris = 1)
@php($page_title = !isset($page_title) ?app()->getLocale() == 'en' ? 'Ebhar Soft' : 'ابهار سوفت' : $page_title)
    <!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->
@include('layouts.head')

<!-- BEGIN: Body-->
<body class="vertical-layout vertical-menu-modern 2-columns fixed-navbar"
      data-open="click"
      data-menu="vertical-menu-modern"
      data-col="2-columns"
>

<!-- BEGIN: Main Nav-->
<!-- BEGIN: Header-->
<nav class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-dark">
    <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mobile-menu d-lg-none mr-auto"><a hidden class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i
                            class="ft-menu font-large-1"></i></a></li>
                <li class="nav-item mr-auto">
                    <a class="navbar-brand" href="{{url('/dashboard')}}">
                        <img class="brand-text custom-logo" alt="ebhar soft logo" src="{{asset('ebhar_soft.png')}}">
                    </a>
                </li>

                <li class="nav-item d-lg-none"><a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a></li>
            </ul>
        </div>
        <div class="navbar-container content">
            <div class="collapse navbar-collapse" id="navbar-mobile">
                <ul class="nav navbar-nav mr-auto float-left">
                    <li class="nav-item d-none d-lg-block"></li>
                </ul>

                <ul class="nav navbar-nav float-right">
                    <li class="dropdown dropdown-language nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ficon ft-globe" style="margin: 0"></i> <span class="font-default" style="font-size: 14px; font-weight: bold">{{ app()->getLocale() == 'en' ? 'EN' : 'AR'  }}</span>
                            <span class="selected-language"></span></a>
                        <div class="dropdown-menu" aria-labelledby="dropdown-flag">
                            <a class="dropdown-item" href="{{url('lang/en')}}"><i class="flag-icon flag-icon-gb"></i>{{__('admin.en')}} </a>
                            <a class="dropdown-item " href="{{url('lang/ar')}}"><i class="flag-icon flag-icon-ye "></i> {{__('admin.ar')}} </a>
                        </div>
                    </li>

                    <li class="dropdown dropdown-notification nav-item">
                        <a class="nav-link nav-link-label" href="{{$route.'?'.http_build_query(request()->all())}}" data-toggle="" title="{{__('admin.export')}}">
                            <i class="ficon ft-printer"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</nav>

<!-- END: Header-->


<!-- BEGIN: Content-->
<div class="app-content content" style="margin: auto 0">
    @yield('content')
</div>
<!-- END: Content-->

<div class="sidenav-overlay"></div>
<div class="drag-target"></div>

<!-- BEGIN: Footer-->
<footer class="footer footer-static footer-light navbar-border navbar-shadow" style="margin: auto 0;">
    <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2">
        <a class="infinitecloud-a" href="https://www.infinitecloud.co/" target="_blank" style="color: #505050;font-weight: 600;">
            <img width="85" src="{{asset('infinitecloud-black.png')}}">
            Built with <i class="la la-heart yellow" style="color: #ffc93b !important;"></i> by
        </a>
    </p>
</footer>
<!-- END: Footer-->

<!-- BEGIN: Vendor JS-->
<script src="{{asset('app-assets/vendors/js/vendors.min.js')}}"></script>
<!-- BEGIN Vendor JS-->

@yield('script')

<!-- BEGIN: Theme JS-->
<script src="{{asset('app-assets/js/core/app-menu.js')}}"></script>
<script src="{{asset('app-assets/js/core/app.js')}}"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{asset('app-assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Page JS-->
{{--<script src="{{asset('app-assets/js/scripts/pages/dashboard-ecommerce.js')}}"></script>--}}
<script src="{{asset('app-assets/js/scripts/customizer.min.js')}}"></script>
<script src="{{asset('app-assets/js/scripts/footer.min.js')}}"></script>
<!-- END: Page JS-->

<!-- BEGIN: Page JS-->
<script src="{{asset('app-assets/js/scripts/tables/datatables/datatable-basic.min.js')}}"></script>
<!-- END: Page JS-->
</body>
<!-- END: Body-->
</html>
