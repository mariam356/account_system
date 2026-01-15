@extends('layouts.app')


<head>
    <link rel="icon" type="image/png" sizes="36x36" href="{{asset('accounting.png')}}">
    <title>{{__('admin.login')}}</title>
    @if( app()->getLocale() == 'en')

        <!-- BEGIN: Theme CSS-->
        <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/bootstrap.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/bootstrap-extended.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/colors.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/components.css')}}">
        <!-- END: Theme CSS-->

        <!-- BEGIN: Page CSS-->
        <link rel="stylesheet" type="text/css"
              href="{{asset('app-assets/css/core/menu/menu-types/horizontal-menu.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/core/colors/palette-gradient.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('app-assets/fonts/simple-line-icons/style.css')}}">

        <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/calendars/clndr.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/dashboard-bank.css')}}">
        <!-- END: Page CSS-->

        <!-- END: Vendor CSS-->
        <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/vendors.min.css')}}">


        <!-- BEGIN: Custom CSS-->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
        <!-- END: Custom CSS-->
    @else

        <!-- BEGIN: Theme CSS-->
        <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css-rtl/bootstrap.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css-rtl/bootstrap-extended.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css-rtl/colors.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css-rtl/components.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css-rtl/custom-rtl.css')}}">

        <!-- END: Theme CSS-->

        <!-- BEGIN: Page CSS-->
        <link rel="stylesheet" type="text/css"
              href="{{asset('app-assets/css-rtl/core/menu/menu-types/horizontal-menu.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css-rtl/core/colors/palette-gradient.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('app-assets/fonts/simple-line-icons/style.css')}}">

        <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css-rtl/plugins/calendars/clndr.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css-rtl/pages/dashboard-bank.css')}}">
        <!-- END: Page CSS-->

        <!-- END: Vendor CSS-->
        <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/vendors-rtl.min.css')}}">

        <!-- BEGIN: Custom CSS-->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style-rtl.css')}}">
        <!-- END: Custom CSS-->
    @endif



</head>
@section('content')


    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row mb-1">
            </div>
            <div class="content-body">
                <section class="flexbox-container">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="col-lg-4 col-md-8 col-10 box-shadow-2 p-0">
                            <div class="card border-grey border-lighten-3 m-0">
                                <div class="card-header border-0">
                                    <div class="card-title text-center">
                                        <div class="p-1"><img src="{{asset('logo/images.png')}}"
                                                              alt="Account system" style="width: 100px"></div>
                                    </div>
                                    <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                                        <span>Easily Using</span></h6>
                                </div>
                                <div class="card-content">
                                    <div class="card-body pt-0 text-center">
{{--                                        <a href="#" class="btn btn-social mb-1 mr-1 btn-outline-facebook"><i--}}
{{--                                                class="la la-facebook-f"></i> <span class="px-1">facebook</span> </a>--}}
                                        <a href="{{ url('/auth/google') }}" class="btn btn-social mb-1 mr-1 btn-outline-google"><span
                                                class="la la-google-plus font-medium-4"></span> <span class="px-1">google</span>
                                        </a>
                                    </div>
                                    <p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2">
                                        <span>OR Using Account Details</span></p>

                                    <div class="card-body pt-0">
                                        <form method="POST" action="{{ route('login') }}">
                                            @csrf

                                            <div class="form-group floating-label-form-group">
                                                <label for="branch">{{ __('admin.branch') }}</label>
                                                <input type="text" class="form-control" id="branch" name="branch"
                                                       value="{{ old('branch') }}" required placeholder="{{ __('admin.branch') }}">

                                                @error('branch')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group floating-label-form-group">
                                                <label for="email">{{ __('admin.email') }}</label>
                                                <input type="email" class="form-control" id="email" name="email"
                                                       value="{{ old('email') }}" required placeholder="{{ __('admin.email') }}">

                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group floating-label-form-group mb-1">
                                                <label for="user-password">{{ __('admin.password') }}</label>
                                                <input type="password" class="form-control" id="user-password"
                                                       name="password" value="{{ old('password') }}" required
                                                       placeholder="{{ __('admin.password') }}">

                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6 col-12 text-center text-sm-left">
                                                    <div>
                                                        <input type="checkbox" id="remember-me" class="chk-remember">
                                                        <label for="remember-me">  {{ __('admin.remember_me') }}</label>
                                                    </div>
                                                </div>
{{--                                                <div class="col-sm-6 col-12 float-sm-left text-center text-sm-right"><a--}}
{{--                                                        href="recover-password.html" class="card-link">Forgot--}}
{{--                                                        Password?</a></div>--}}
                                            </div>
                                            <button type="submit" class="btn btn-outline-reddit btn-block"><i
                                                    class="ft-unlock"></i>  {{ __('admin.login') }}
                                            </button>
                                        </form>
                                    </div>
{{--                                    <p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2 my-1">--}}
{{--                                        <span>New to Modern ?</span></p>--}}
{{--                                    <div class="card-body">--}}
{{--                                        <a href="register-with-bg.html" class="btn btn-outline-danger btn-block"><i--}}
{{--                                                class="ft-user"></i> Register</a>--}}
{{--                                    </div>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>

    <!-- END: Content-->
@endsection
