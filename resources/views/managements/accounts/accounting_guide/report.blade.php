@php($page_title = __('admin.accounting_guide'))
@extends('layouts.main')

@section('content')

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row mb-1">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">{{__('admin.accounting_guide')}}</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">{{__('admin.Dashboard')}}</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">{{__('admin.report')}}</a>
                                </li>
                                <li class="breadcrumb-item active"><a href="{{route('account')}}">{{__('admin.accounting_guide')}}</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>

                <div class="content-header-right col-md-6 col-12">
                    <br>
                    <div class="media width-250 float-right">
                        <a href="{{ url('accounts/account/report_export')}}" target="_blank" class="btn btn-outline-reddit btn-min-width btn-glow mr-1 mb-1"
                          >
                            <i class="icon-eye"></i> {{ __('admin.preview') }} </a>




                    </div>
                </div>
            </div>
            <div class="content-body" id="app">
                @include('include.modal_loading_show')

                <!-- Form wizard with step validation section start -->



                <!-- Table head options start -->
                <div class="row" >
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">

                                    <div class="col-sm-12 col-md-12">

                                        <div class="row">
                                            @include('include.table_length')
                                           <div class="col-md-6">
                                                <div class="form-group row">
                                                    <div class="col-md-9 mx-auto position-relative has-icon-left">
                                                        <input type="text"  id="search"
                                                               v-model="searchQuery"
                                                               @keyup="searchAccount"
                                                               class="form-control round border-primary"
                                                               placeholder="{{__('admin.Type_to_search')}}"
                                                               autocomplete="off">

                                                        <div class="form-control-position">
                                                            <i class="ft-search" style="color: #b92c81"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
                                <table id="table" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>{{__('admin.account_number')}}</th>
                                        <th>{{__('admin.parent_account')}}</th>
                                        <th>{{__('admin.name')}}</th>
                                        <th>{{__('admin.level')}}</th>
                                        <th>{{__('admin.account_type')}}</th>
                                        <th>{{__('admin.downstream_account')}}</th>
                                        <th>{{__('admin.balance')}}</th>
                                        <th>{{__('admin.debit')}}</th>
                                        <th>{{__('admin.creditor')}}</th>
                                        <th>{{__('admin.status')}}</th>

                                    </tr>
                                    </thead>

                                    <tbody>


                                    <tr v-if="Array.isArray(rows) && rows.length === 0" id="row-not-found">
                                        <td colspan="9" class="text-center">
                                            {{__('admin.no_data')}}
                                            <hr>
                                        </td>
                                    </tr>

                                    <tr v-for="(row, index) in rows" :key="row.id || index">
                                        <td>@{{ row.acc_code }}</td>
                                        <td>@{{ row.account?.name ?? '' }}</td>
                                        <td>@{{ row.name }}</td>
                                        <td>@{{ row.acc_level }}</td>
                                        <td>@{{ row.acc_type?.name ?? '' }}</td>
                                        <td>@{{ row.acc_report_type?.name ?? '' }}</td>


                                        <td>@{{ row.acc_balance }}</td>
                                        <td>@{{ row.acc_debit }}</td>
                                        <td>@{{ row.acc_credit }}</td>
                                        <td>
                                            <div class="fonticon-wrap" v-if="row.status == 1">
                                                <i class="ft-unlock" style="color:#20C997"></i>
                                            </div>
                                            <div class="fonticon-wrap" v-else>
                                                <i class="ft-lock" style="color:#FC0021"></i>
                                            </div>
                                        </td>

                                    </tr>



                                    </tbody>
                                </table>
                                </div>
                            </div>

                        </div>


                             {{ $data->appends($pagination_links)->links() }}


                        <span>
                                                {{__('admin.show')}}
                                                <span class="rows-count-current font-default text-bold-600"
                                                      id="table-show">{{$data->count()}}</span>
                                                {{__('admin.out_of')}}
                                                <span class="rows-count-current font-default text-bold-600"
                                                      id="table-count">{{$data_count}}</span>
                                                {{__('admin.record')}}
                                            </span>
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
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        window.translations = {
            loading: '{{ __("admin.loading") }}',
            loading_failed: '{{ __("admin.loading_failed") }}',

        };
        const { createApp } = Vue;
        var rows = @json($data->items());
        createApp({

            data() {
                return {


                    rows: rows,
                    searchQuery: "",
                    searchTimer: null,

                    loadingMessage: '',
                    showModal: false
                };
            },

            mounted() { // الحاجة إلى الوصول للعناصر داخل الصفحة

                this.loadAccount();

            },

            methods: {


                async searchAccount() {
                    clearTimeout(this.searchTimer);
                    this.searchTimer = setTimeout(async () => {
                        try {
                            let url = "/accounts/account/search";
                            this.rows = await window.apiService.responseEditOrShowData2(url + "?query=" + this.searchQuery, this);
                        } catch (e) {
                            console.error("Search error:", e);
                        }
                    }, 300);
                },

                async loadAccount() {
                    try {
                        let res = await fetch("/accounts/account/show");

                        let data = await res.json();

                        console.log("Rows from server:", data); // مهم جداً للتأكد
                        this.rows = data;


                    } catch (e) {
                        console.error("Error loading Account", e);
                    }
                },



            }

        }).mount("#app");
    </script>

@endsection


