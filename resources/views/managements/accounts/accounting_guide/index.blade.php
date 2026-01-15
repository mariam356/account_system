@php($page_title = __('admin.accounting_guide'))
@extends('layouts.main')

@section('content')
    <style>

        /*----------------genealogy-scroll----------*/

        .genealogy-scroll::-webkit-scrollbar {
            width: 5px;
            height: 8px;
        }

        .genealogy-scroll::-webkit-scrollbar-track {
            border-radius: 10px;
            background-color: #e4e4e4;
        }

        .genealogy-scroll::-webkit-scrollbar-thumb {
            background: #3b52fb;
            border-radius: 10px;
            transition: 0.5s;
        }

        .genealogy-scroll::-webkit-scrollbar-thumb:hover {
            background: #3b52fb;
            transition: 0.5s;
        }


        /*----------------genealogy-tree----------*/
        .genealogy-body {
            white-space: nowrap;
            overflow-y: hidden;
            padding: 50px;
            min-height: 500px;
            padding-top: 10px;
        }

        .genealogy-tree ul {
            padding-top: 20px;
            position: relative;
            padding-left: 0px;
            display: flex;
        }

        .genealogy-tree li {
            float: left;
            text-align: center;
            list-style-type: none;
            position: relative;
            padding: 20px 5px 0 5px;
        }

        .genealogy-tree li::before, .genealogy-tree li::after {
            content: '';
            position: absolute;
            top: 0;
            right: 50%;
            border-top: 2px solid #ccc;
            width: 50%;
            height: 18px;
        }

        .genealogy-tree li::after {
            right: auto;
            left: 50%;
            border-left: 2px solid #ccc;
        }

        .genealogy-tree li:only-child::after, .genealogy-tree li:only-child::before {
            display: none;
        }

        .genealogy-tree li:only-child {
            padding-top: 0;
        }

        .genealogy-tree li:first-child::before, .genealogy-tree li:last-child::after {
            border: 0 none;
        }

        .genealogy-tree li:last-child::before {
            border-right: 2px solid #ccc;
            border-radius: 0 5px 0 0;
            -webkit-border-radius: 0 5px 0 0;
            -moz-border-radius: 0 5px 0 0;
        }

        .genealogy-tree li:first-child::after {
            border-radius: 5px 0 0 0;
            -webkit-border-radius: 5px 0 0 0;
            -moz-border-radius: 5px 0 0 0;
        }

        .genealogy-tree ul ul::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            border-left: 2px solid #ccc;
            width: 0;
            height: 20px;
        }

        .genealogy-tree li a {
            text-decoration: none;
            color: #666;
            font-family: arial, verdana, tahoma;
            font-size: 11px;
            display: inline-block;
            border-radius: 5px;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
        }

        .genealogy-tree li a:hover + ul li::after,
        .genealogy-tree li a:hover + ul li::before,
        .genealogy-tree li a:hover + ul::before,
        .genealogy-tree li a:hover + ul ul::before {
            border-color: #3b52fb;

        }

        /*--------------memeber-card-design----------*/
        .member-view-box {
            padding: 0px 20px;
            text-align: center;
            border-radius: 4px;
            position: relative;
        }

        .member-image {
            width: 60px;
            position: relative;
        }

        .member-image img {
            width: 60px;
            height: 60px;
            border-radius: 6px;
            background-color: #000;
            z-index: 1;
        }

        .account {
            border: 1px solid #ccc;
            /*text-decoration: none;*/
            font-weight: 500;
            color: #ffffff;
            padding: 5px 15px;
            /*font-family: arial, verdana, tahoma;*/
            font-size: 13px;
            display: inline-block;
            /*border-radius: 10px;*/
            /*border-bottom-right-radius: 15px !important;*/
            /*border-bottom-left-radius: 0 !important;*/
            /*border-top-left-radius: 15px !important;*/
            /*border-top-right-radius: 0 !important;*/
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            transition: all 0.5s;
            -webkit-transition: all 0.5s;
            background: #345862;

            -moz-transition: all 0.5s;
            margin-bottom: 3px;
            /*padding-right: 40px;*/
        }

        .span-accounting-guide {
            /*padding: 10px 15px;*/
        }

        .account:hover {
            background: #ffffff;
            color: #000;
            border: 1px solid #345862;
        }

        .position_ctgry {
            top: -39px;
            left: -8px;
            /* margin: 5px; */
            /* display: flow-root; */
            position: absolute;
        }

        button.btn.account.active {

            background: #ffffff;
            color: #000;
        }

        .plus:hover {
            background-image: linear-gradient(145deg, #3868b2, #6390d6);
            color: white;
        }

        .plus {
            padding: 0 8px 0 8px;
            border-radius: 0;
            height: 23px;
            background: #fab216;
            color: white;
            border: 1px solid #fab216;
        }

        .edit-sub-row {
            /*position: absolute;*/
            padding: 7px 10px;
            font-size: 10px;
            /*margin-top: 45px;*/
            margin-right: 5px;
        }

        .delete-sub-row {
            /*position: absolute;*/
            padding: 7px 10px;
            font-size: 10px;
            /*margin-top: 45px;*/
            margin-right: 5px;
            margin-left: 5px;
        }

        .add-sub-row {
            /*position: absolute;*/
            padding: 7px 10px;
            font-size: 10px;
            /*margin-top: 41px;*/
            margin-left: 5px;
        }

        .img-accounting_guide {
            margin-left: 8px;
            /*margin-left: 60px;*/
            /*position: absolute;*/
            height: 25px;
            /*margin-top: 6px;*/
        }

        .btn-success {
            border-color: #3b52fb !important;
            background-color: #3b52fb !important;
            color: #FFFFFF;
        }

        .btn-success:hover, .btn-success:active,
        .btn-success:active, .btn-success:focus {
            border-color: #3b52fb !important;
            background-color: #3b52fb !important;
            color: #FFFFFF;
        }

        .btn-blue {
            border-color: #fab216 !important;
            background-color: #fab216 !important;
            color: #FFFFFF !important;
        }

        .btn-blue:focus, .btn-blue:active, .btn-blue:hover {
            border-color: #ffc419 !important;
            background-color: #ffc419 !important;
            color: #FFFFFF !important;
        }
    </style>

    <div class="content-wrapper">
        <div class="content-detached">
            <div class="content-body">
                <div class="content-overlay"></div>
                <section class="row">
                    <div class="col-12">
                        <div class="content-header row mb-1">
                            <div class="content-header-left col-md-6 col-12 mb-2">
                                <h3 class="content-header-title">{{__('admin.accounting_guide')}}</h3>
                                <div class="row breadcrumbs-top">
                                    <div class="breadcrumb-wrapper col-12">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="/">{{__('admin.Dashboard')}}</a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="#">{{__('admin.show')}}</a>
                                            </li>
                                            <li class="breadcrumb-item active">{{__('admin.accounting_guide')}}
                                            </li>
                                        </ol>
                                    </div>
                                </div>
                            </div>


                            <div class="content-header-right col-md-6 col-12">
                                <br>
                                <div class="media width-250 float-right">
                                    @can('report account')
                                    <a href="{{ url('accounts/account/report')}}" class="btn btn-outline-blue-grey btn-min-width btn-glow mr-1 mb-1"
                                    style="color: #b92c81">
                                        <i class="ft-printer"></i> {{__('admin.report').' '.__('admin.accounting_guide')}} </a>
                                        @endcan


                                </div>
                            </div>

                        </div>

                    </div>
                </section>
                <section class="row all-contacts" dir="ltr">
                    <div class="col-12">
                        <div class="card">

                            <div class="card-body">
                                <div class="body genealogy-body genealogy-scroll">
                                    <div class="genealogy-tree" style="margin-top: 10px" id="min-tree">

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </section>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <section class="contact-form">
                    <form method="POST" id="form-accounting-guide" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header" style="padding-bottom: 0px;">
                            <h5 class="card-title"
                                id="basic-layout-form" style="padding-top: 5px;">{{__('admin.create')}} {{__('admin.accounting_guide')}}</h5>
                            {{--                            <div class="heading-elements" id="check_show">--}}
                            {{--                                <input type="checkbox" name="status" value="1"--}}
                            {{--                                       class="switchBootstrap" id="switchBootstrap18"--}}
                            {{--                                       data-on-color="primary" data-off-color="danger"--}}
                            {{--                                       data-on-text="{{__('admin.enable')}}"--}}
                            {{--                                       data-off-text="{{__('admin.disable')}}" data-color="primary"--}}
                            {{--                                       data-label-text="{{__('admin.status')}}"--}}
                            {{--                                       checked/>--}}
                            {{--                            </div>--}}
                            <div>
                                <button type="button" class="close"
                                        data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <a class="heading-elements-toggle"><i
                                    class="la la-ellipsis-v font-medium-3"></i></a>


                        </div>

                        <div class="card-content collapse show">
                            <div class="card-body">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-6 p-0">
                                            <row>

                                                <div class="col-md-12">
                                                    <div class="form-group">

                                                        <label for="activity_id">{{__('admin.account_number')}}<span
                                                                class="danger">*</span></label>
                                                        <input type="text" id="acc_code" required
                                                               value="{{ old('acc_code') }}"
                                                               class="form-control "
                                                               name="acc_code" autofocus>
                                                        <span class="error-massage" style="color: red">
                                                                     <strong></strong>
                                                                </span>


                                                    </div>

                                                </div>

                                                <fieldset class="col-md-12">
                                                    <div class="form-group ">

                                                        <label for="projectinput2">{{__('admin.name')}} (ar)<span
                                                                class="danger">*</span></label>
                                                        <input type="text" id="name_ar" required value="{{ old('name_ar') }}"
                                                               class="form-control"
                                                               name="name_ar" autocomplete="name_ar" autofocus>
                                                        <span class="error-massage" style="color: red">
                                                                     <strong></strong>
                                                                </span>


                                                    </div>

                                                </fieldset>


                                                <fieldset class="col-md-12">

                                                    <div class="form-group">

                                                        <label for="account_type">{{__('admin.balance')}}</label>
                                                        <input type="number" id="acc_balance" value="0"
                                                               class="form-control"
                                                               name="acc_balance" autofocus>

                                                        <span class="error-massage" style="color: red">
                                                                     <strong></strong>
                                                                </span>

                                                    </div>
                                                </fieldset>

                                                <fieldset class="col-md-12">

                                                    <div class="form-group">

                                                        <label for="account_type">{{__('admin.debit')}}</label>
                                                        <input type="number" id="acc_debit" value="0"
                                                               class="form-control"
                                                               name="acc_debit" autofocus>

                                                        <span class="error-massage" style="color: red">
                                                                     <strong></strong>
                                                                </span>

                                                    </div>
                                                </fieldset>


                                                <fieldset class="col-md-12">
                                                    <div class="form-group">

                                                        <label for="acc_type_id">{{__('admin.account_type')}}<span
                                                                class="danger">*</span></label>
                                                        <select class="form-control" id="acc_type_id" required name="acc_type_id">
                                                            <option value="">{{__('admin.select_option')}}</option>
                                                            @foreach($AccTypeQuery as $AccType)
                                                                <option value="{{$AccType->id}}">{{$AccType->name}}</option>
                                                            @endforeach


                                                        </select>

                                                        <span class="error-massage" style="color: red">
                                                                     <strong></strong>
                                                                </span>

                                                    </div>
                                                </fieldset>



                                            </row>

                                        </div>


                                        <div class="col-md-6 p-0">

                                            <fieldset class="col-md-12">
                                                <div class="form-group">

                                                    <label for="account_category_id">{{__('admin.level')}}<span
                                                            class="danger">*</span></label>

                                                    <input type="number" id="acc_level" required
                                                           value="{{ old('acc_level') }}"
                                                           class="form-control "
                                                           name="acc_level" autofocus>


                                                    <span class="error-massage" style="color: red">
                                                                     <strong></strong>
                                                                </span>
                                                </div>



                                            </fieldset>
                                            <fieldset class="col-md-12">
                                                <div class="form-group ">

                                                    <label for="projectinput2">{{__('admin.name')}} (en)<span
                                                            class="danger">*</span></label>
                                                    <input type="text" id="name_en" required
                                                           value="{{ old('en_name') }}"
                                                           class="form-control "
                                                           name="name_en" autocomplete="ar_name_B" autofocus>
                                                    <span class="error-massage" style="color: red">
                                                                     <strong></strong>
                                                                </span>

                                                </div>
                                            </fieldset>

                                            <fieldset class="col-md-12">
                                                <div class="form-group">

                                                    <label for="acc_report_type_id">{{__('admin.downstream_account')}}<span
                                                            class="danger">*</span></label>
                                                    <select class="form-control" id="acc_report_type_id" required name="acc_report_type_id">
                                                        <option value="">{{__('admin.select_option')}}</option>
                                                        @foreach($AccReportTypeQuery as $AccReportType)
                                                            <option value="{{$AccReportType->id}}">{{$AccReportType->name}}</option>
                                                        @endforeach


                                                    </select>

                                                    <span class="error-massage" style="color: red">
                                                                     <strong></strong>
                                                                </span>

                                                </div>
                                            </fieldset>

                                            <fieldset class="col-md-12">

                                                <div class="form-group">

                                                    <label for="account_type">{{__('admin.creditor')}}</label>
                                                    <input type="number" id="acc_credit" value="0"
                                                           class="form-control"
                                                           name="acc_credit" autofocus>

                                                    <span class="error-massage" style="color: red">
                                                                     <strong></strong>
                                                                </span>

                                                </div>
                                            </fieldset>

                                            <fieldset class="col-md-12">
                                                <div class="form-group">

                                                    <label for="status">{{__('admin.status')}}</label>
                                                    <select class="form-control" id="status" required name="status">
                                                        <option value="">{{__('admin.select_option')}}</option>
                                                        <option value="1">{{__('admin.available')}}</option>
                                                        <option value="0">{{__('admin.un_available')}}</option>


                                                    </select>

                                                    <span class="error-massage" style="color: red">
                                                                     <strong></strong>
                                                                </span>

                                                </div>
                                            </fieldset>


                                            <input type="hidden" name="account_id" id="account_id" value="{{ $account->id ?? '' }}">

                                        </div>


                                        <div id="inputHidden" hidden>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <fieldset id="button-container"
                                          class="form-group position-relative has-icon-left mb-0">
                                    <button type="submit" id="save" class="btn btn-outline-blue-grey btn-min-width btn-glow mr-1 mb-1">إضافة</button>
                                    <button type="button" id="edit" class="btn btn-outline-blue-grey btn-min-width btn-glow mr-1 mb-1" hidden>تعديل</button>
                                </fieldset>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="{{asset('app-assets/vendors/js/extensions/sweetalert.min.js')}}"></script>
    <script src="{{asset('app-assets/js/scripts/extensions/sweet-alerts.js')}}"></script>

    @include('managements.accounts.accounting_guide.js')
@endsection
