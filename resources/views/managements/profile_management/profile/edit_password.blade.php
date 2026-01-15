@php($page_title = __('admin.Edit_Profile'))
<?php
$delete_success = 'تم حذف تعديل كلمة المرور بنجاح';

?>
@extends('layouts.main')
@section('content')
    <div class="content-wrapper">
        <div class="content-detached">
            <div class="content-body">

                <div class="content-wrapper">
                    <div class="content-header row mb-1">
                        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                            <h3 class="content-header-title mb-0 d-inline-block">{{__('admin.profile')}}</h3>
                            <div class="row breadcrumbs-top d-inline-block">
                                <div class="breadcrumb-wrapper col-12">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item span"><a href="{{ url('profile')}}">{{__('admin.profile')}}</a></li>
                                        <li class="breadcrumb-item span active">{{__('admin.edit_password')}}</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <div class="content-header-right col-md-6 col-12">
                        </div>
                        @if(session('success'))
                            <div id="messageSave" class="modal fade text-left" role="dialog">
                                <div class="modal-dialog">
                                    <div class="card-content collapse show">
                                        <div class="card-body">
                                            <div class="alert bg-info alert-icon-left mb-2" role="alert">
                                                <span class="alert-icon"><i class="la la-pencil-square"></i></span>
                                                <strong class="span">{{__('admin.successfully_done')}}!</strong>
                                                <p>{{session('success')}}.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title span" id="from-actions-top-bottom-center">{{__('admin.profile')}}</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a href="{{ url('/profile_management/profile')}}" data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form" action="{{ route('profile.update_password',['id'=>$profile->id])}}"
                                              method="POST" id="my_form_id">
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-2 col-md-12"></div>

                                                <div class="col-lg-7 col-md-12">
                                                    <div class="form-group row">
                                                        <label for="password"
                                                               class="col-md-3 col-form-label text-md-right span">{{__('admin.current_password')}}</label>
                                                        <div class=" input-group col-md-9">
                                                            <input id="password_Present" type="password"
                                                                   class="form-control @error('password_Present') is-invalid @enderror"
                                                                   name="password_Present" required autocomplete="off">
                                                            <div class="input-group-append"> <span style="background: #ffffff" class="input-group-text font-default"><i class="la la-eye-slash" id="togglePassword"></i></span>
                                                            </div>
                                                            @error('password_Present')
                                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="password"
                                                               class="col-md-3 col-form-label text-md-right span">{{__('admin.new_password')}}</label>
                                                        <div class="input-group col-md-9">
                                                            <input id="password" type="password"
                                                                   class="form-control @error('password') is-invalid @enderror"
                                                                   name="password" required autocomplete="new-password">
                                                            <div class="input-group-append"> <span style="background: #ffffff" class="input-group-text font-default"><i class="la la-eye-slash" id="togglePassword1"></i></span>
                                                            </div>
                                                            @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="password_confirm"
                                                               class="col-md-3 col-form-label text-md-right span">{{__('admin.confirm_password')}}</label>
                                                        <div class="input-group col-md-9">
                                                            <input id="password_confirm" type="password" class="form-control"
                                                                   name="password_confirmation" required
                                                                   autocomplete="new-password">
                                                            <div class="input-group-append"> <span style="background: #ffffff" class="input-group-text font-default"><i class="la la-eye-slash" id="togglePassword2"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-actions">
                                                        <button type="submit" class="col-md-4 btn btn-outline-primary pull-right span">
                                                            <i class="la la-check-square-o"></i> {{__('admin.edit')}}
                                                        </button>
                                                        <a href="{{ url('/profile_management/profile')}}" class="col-md-2 btn btn-outline-dark pull-right span"
                                                           style="margin-right: 5px; margin-left: 5px">
                                                            <i class="ft-x"></i> {{__('admin.cancel')}}
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-12"></div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </section>
                    <!-- // Form actions layout section end -->
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        /*start message save*/
        $('#messageSave').modal('show');
        setTimeout(function () {
            $('#messageSave').modal('hide');
        }, 3000);
        /*end  message save*/
    </script>

    <script>

        window.addEventListener("DOMContentLoaded", function () {
            const togglePassword = document.querySelector("#togglePassword");

            togglePassword.addEventListener("click", function (e) {
                // toggle the type attribute
                const type =
                    password_Present.getAttribute("type") === "password" ? "text" : "password";
                password_Present.setAttribute("type", type);
                e.target.classList.toggle("la-eye");
                e.target.classList.toggle("la-eye-slash");
            });
        });


        window.addEventListener("DOMContentLoaded", function () {
            const togglePassword = document.querySelector("#togglePassword1");

            togglePassword.addEventListener("click", function (e) {
                // toggle the type attribute
                const type =
                    password.getAttribute("type") === "password" ? "text" : "password";
                password.setAttribute("type", type);
                e.target.classList.toggle("la-eye");
                e.target.classList.toggle("la-eye-slash");
            });
        });


        window.addEventListener("DOMContentLoaded", function () {
            const togglePassword = document.querySelector("#togglePassword2");

            togglePassword.addEventListener("click", function (e) {
                // toggle the type attribute
                const type =
                    password_confirm.getAttribute("type") === "password" ? "text" : "password";
                password_confirm.setAttribute("type", type);
                e.target.classList.toggle("la-eye");
                e.target.classList.toggle("la-eye-slash");
            });
        });


    </script>
@endsection
