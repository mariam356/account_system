@php($page_title = __('admin.balance_sheet'))
@extends('layouts.main')

@section('content')

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row mb-1">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">{{__('admin.balance_sheet')}}</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">{{__('admin.Dashboard')}}</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">{{__('admin.show')}}</a>
                                </li>
                                <li class="breadcrumb-item active">{{__('admin.balance_sheet')}}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>

            </div>
            <div class="content-body" id="app">
                @include('include.modal_loading_show')
                <!-- Form wizard with step validation section start -->

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                {{--                                <h4 class="card-title" id="horz-layout-colored-controls">{{__('admin.balance_sheet')}}</h4>--}}
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

                                    <form id="form" @submit.prevent="search" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-body">
                                            <h4 class="form-section"><i
                                                    class='la la-balance-scale'></i> {{__('admin.balance_sheet')}} </h4>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control"
                                                               for="from_date">{{__('admin.from_date')}}<span
                                                                class="danger">*</span></label>
                                                        <div class="col-md-9 mx-auto position-relative has-icon-left">
                                                            <input type="date" id="from_date"
                                                                   v-model="form.from_date"
                                                                   class="form-control border-primary" name="from_date">


                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control"
                                                               for="to_date">{{__('admin.to_date')}}<span
                                                                class="danger">*</span></label>
                                                        <div class="col-md-9 mx-auto position-relative has-icon-left">
                                                            <input type="date" id="to_date"
                                                                   v-model="form.to_date"
                                                                   class="form-control border-primary" name="to_date">


                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control"
                                                               for="currency_id">{{__('admin.currency')}} <span
                                                                class="danger">*</span></label>
                                                        <div class="col-md-9 mx-auto position-relative has-icon-left">
                                                            <select v-model="form.currency_id"
                                                                    class="form-control border-primary" id="currency_id"
                                                                    name="currency_id">
                                                                <option value="">{{__('admin.select_option')}}</option>
                                                                @foreach($currency as $currencies)
                                                                    <option
                                                                        value="{{$currencies->id}}"> {{$currencies->name}}</option>
                                                                @endforeach

                                                            </select>
                                                            <div class="form-control-position">
                                                                <i class='bx bx-coin' style="color: #b92c81"></i>

                                                            </div>

                                                            <span class="error-message" style="color:red;">
                                                        <strong></strong>
                                                    </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control"
                                                               for="curr_val">{{__('admin.curr_val')}} <span
                                                                class="danger">*</span></label>
                                                        <div class="col-md-9 mx-auto position-relative has-icon-left">
                                                            <input readonly class="form-control border-primary"
                                                                   type="text"
                                                                   name="curr_val" v-model="form.curr_val"
                                                                   id="curr_val">
                                                            <div class="form-control-position">
                                                                <i class='bx bx-money' style="color: #b92c81"></i>
                                                            </div>


                                                        </div>
                                                    </div>

                                                </div>


                                            </div>


                                        </div>

                                        <div class="form-actions text-right" id="app2">
                                            <button type="submit" :disabled="!hasFilters"
                                                    class="btn btn-outline-blue-grey btn-min-width btn-glow mr-1 mb-1">
                                                <i class="ft-search"></i> {{__('admin.search')}}
                                            </button>
                                            @can('report balance_sheet')
                                            <a @click="openReport" :disabled="!hasFilters"
                                               class="btn btn-outline-reddit btn-min-width btn-glow mr-1 mb-1"
                                            >
                                                <i class="icon-eye"></i> {{ __('admin.preview') }}
                                            </a>
                                                @endcan

                                        </div>

                                    </form>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Table head options start -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">

                                    <div class="col-sm-12 col-md-12">

                                        <div class="row">
                                            @include('include.table_length_vue')

                                        </div>
                                    </div>
                                </div>
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


                            <div class="card-content collapse show">
                                <div class="table-responsive">
                                    <table id="table" class="table table-hover mb-0">
                                        <thead>
                                        <tr>


                                            <th>{{__('admin.account')}}</th>
                                            <th>{{__('admin.debit')}}</th>
                                            <th>{{__('admin.creditor')}}</th>
                                            <th>{{__('admin.balance')}}</th>


                                        </tr>
                                        </thead>

                                        <tbody>


                                        <tr v-if="rows.length === 0" id="row-not-found">
                                            <td colspan="9" class="text-center">
                                                {{__('admin.no_data')}}
                                                <hr>
                                            </td>
                                        </tr>

                                        <tr v-for="(row, index) in rows"
                                            :key="row.id"
                                            v-if="searched && !loading"
                                            :class="{ 'tr-color-active': row.isActive }">

                                            <td>@{{ row.account_name }}</td>

                                            <td>@{{ form.curr_val ? (row.total_debit / form.curr_val) : row.total_debit }}</td>
                                            <td>@{{ form.curr_val ? (row.total_credit / form.curr_val) : row.total_credit }}</td>
                                            <td>@{{ form.curr_val ? (row.balance / form.curr_val) : row.balance }}</td>



                                        </tr>


                                        </tbody>
                                    </table>
                                </div>
                            </div>


                            <br> <br> <br>
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-3">
                                    </div>
                                    <div class="col-md-2">
                                        <div class="col-md-12">
                                            <div class="form-group ">
                                                <div class="input-group">
                                                    <label for="debit"
                                                           style="  margin-left: 10px; padding-top: 10px;">{{__('admin.total')}} {{__('admin.debit')}}</label>
                                                    <input
                                                        style="border: none;background-color: #ffffff; border-bottom: 1px solid #b92c81; border-radius: 0; outline: none;"
                                                        readonly type="text" id="debit"
                                                        class="form-control"
                                                        name="debit" autocomplete="debit"
                                                        v-model="debit"
                                                        :value="totalDebit">
                                                </div>


                                            </div>
                                        </div>


                                    </div>

                                    <div class="col-md-2">
                                        <div class="col-md-12">
                                            <div class="form-group ">
                                                <div class="input-group">
                                                    <label for="credit"
                                                           style="  margin-left: 10px; padding-top: 10px;">{{__('admin.total')}} {{__('admin.creditor')}}</label>
                                                    <input
                                                        style="border: none;background-color: #ffffff; border-bottom: 1px solid #b92c81; border-radius: 0; outline: none;"
                                                        readonly type="text" id="credit"
                                                        class="form-control"
                                                        name="credit" autocomplete="credit"
                                                        v-model="credit"
                                                        :value="totalCredit">
                                                </div>


                                            </div>
                                        </div>


                                    </div>
                                    <div class="col-md-2">


                                        <div class="col-md-12">
                                            <div class="form-group ">
                                                <div class="input-group">
                                                    <label for="balance"
                                                           style="  margin-left: 10px; padding-top: 10px;">{{__('admin.balance')}}</label>
                                                    <input
                                                        style="border: none;background-color: #ffffff; border-bottom: 1px solid #b92c81; border-radius: 0; outline: none;"
                                                        readonly type="text" id="balance"
                                                        class="form-control"

                                                        name="balance" autocomplete="balance"
                                                        :value="totalBalance"
                                                    >
                                                </div>

                                            </div>
                                        </div>


                                    </div>

                                    <div class="col-md-3">
                                    </div>


                                </div>
                            </div>
                            <br>
                        </div>


                    </div>
                </div>
                <!-- Table head options end -->

            </div>

        </div>
    </div>

    <!-- Form wizard with step validation section end -->

@endsection


@section('script')

    <script src="{{asset('app-assets/vendors/js/extensions/sweetalert.min.js')}}"></script>
    <script src="{{asset('app-assets/js/scripts/extensions/sweet-alerts.js')}}"></script>

    @include('managements.accounts.balance_sheet.js')

@endsection


