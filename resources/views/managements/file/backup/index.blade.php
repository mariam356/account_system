@php($page_title = __('admin.backup'))
@extends('layouts.main')

@section('content')

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row mb-1">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">{{__('admin.backup')}}</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">{{__('admin.Dashboard')}}</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">{{__('admin.show')}}</a>
                                </li>
                                <li class="breadcrumb-item active">{{__('admin.backup')}}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12">
                    <div class="media width-250 float-right">
                        <media-left class="media-middle">
                            <div id="sp-bar-total-sales"></div>
                        </media-left>
                        <div class="media-body media-right text-right">
                            <h3 class="m-0"></h3><span class="text-muted">{{__('admin.backup')}}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body"  id="app">

                <!-- Form wizard with step validation section start -->
                @canany(['update backup', 'create backup'])
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                {{--                                <h4 class="card-title" id="horz-layout-colored-controls">{{__('admin.backup')}}</h4>--}}
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collpase show">
                                <div class="card-body">

                                    <form id="form" action="{{ route('backup.store') }}" method="post" enctype="multipart/form-data" >
                                        @csrf
                                        <div class="form-body">
                                            <h4 class="form-section"><i class='bx bx-download bx-tada' ></i> {{__('admin.backup')}} </h4>
                                            <div class="row">

                                                <div class="col-md-12">
                                                    <div class="form-group row align-items-center">
                                                        <label class="col-md-3 label-control font-weight-bold text-uppercase" for="name" style="color: #444;">
                                                            {{__('admin.name')}} <span class="danger">*</span>
                                                        </label>

                                                        <div class="col-md-9 mx-auto position-relative has-icon-left">
                                                            <div class="select-wrapper">
                                                                <select class="form-control border-primary custom-select-styled"
                                                                        id="name"
                                                                        name="name[]"
                                                                        multiple
                                                                        required
                                                                        style="min-height: 250px; border-radius: 10px; padding: 10px;">

                                                                    <option value="user">- {{__('admin.user')}}</option>
                                                                    <option value="permission">- {{__('admin.permission')}}</option>
                                                                    <option value="branch">- {{__('admin.branch')}}</option>
                                                                    <option value="fund">- {{__('admin.fund')}}</option>
                                                                    <option value="bank">- {{__('admin.bank')}}</option>
                                                                    <option value="currency">- {{__('admin.currency')}}</option>
                                                                    <option value="accounting_guide">- {{__('admin.accounting_guide')}}</option>
                                                                    <option value="journal">- {{__('admin.journal')}}</option>
                                                                    <option value="exchange_bond">- {{__('admin.exchange_bond')}}</option>
                                                                    <option value="receive_bond">- {{__('admin.receive_bond')}}</option>
                                                                    <option value="account_statement">- {{__('admin.account_statement')}}</option>
                                                                    <option value="trial_balance">- {{__('admin.trial_balance')}}</option>
                                                                    <option value="balance_sheet">- {{__('admin.balance_sheet')}}</option>
                                                                    <option value="profit_loss">- {{__('admin.profit_loss')}}</option>
                                                                    <option value="stores">- {{__('admin.stores')}}</option>
                                                                    <option value="inventory_groups">- {{__('admin.inventory_groups')}}</option>
                                                                    <option value="units">- {{__('admin.units')}}</option>
                                                                    <option value="products">- {{__('admin.products')}}</option>
                                                                    <option value="inventory_management">- {{__('admin.inventory_management')}}</option>
                                                                    <option value="category_movement">- {{__('admin.category_movement')}}</option>
                                                                    <option value="suppliers">- {{__('admin.suppliers')}}</option>
                                                                    <option value="purchases_invoice">- {{__('admin.purchases_invoice')}}</option>
                                                                    <option value="customer">- {{__('admin.customer')}}</option>
                                                                    <option value="sale_representative">- {{__('admin.sale_representatives')}}</option>
                                                                    <option value="sales_invoice">- {{__('admin.sales_invoice')}}</option>
                                                                </select>


                                                            </div>
                                                            <small class="text-muted mt-1 d-block"><i class="ft-info"></i> {{__('admin.Press_Ctrl_or_Command_to_select_more_than_one_item')}}</small>
                                                        </div>
                                                    </div>
                                                </div>



                                            </div>

                                        </div>

                                        <div class="form-actions text-right" id="app2">

                                            <button id="btn-save"

                                                    class="btn btn-outline-blue-grey btn-min-width btn-glow mr-1 mb-1">
                                                <i class='bx bx-down-arrow-alt'></i>
                                                {{__('admin.download')}}
                                            </button>


                                        </div>

                                    </form>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endcanany


            </div>

        </div>
    </div>

    <!-- Form wizard with step validation section end -->

@endsection


@section('script')

    <script src="{{asset('app-assets/vendors/js/extensions/sweetalert.min.js')}}"></script>
    <script src="{{asset('app-assets/js/scripts/extensions/sweet-alerts.js')}}"></script>



@endsection


