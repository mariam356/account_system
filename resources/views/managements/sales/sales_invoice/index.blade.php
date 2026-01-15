@php($page_title = __('admin.sales_invoice'))
@extends('layouts.main')

@section('content')
    <div class="content-wrapper">


        <div class="content-header row mb-1">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">{{__('admin.sales_invoice')}}</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">{{__('admin.Dashboard')}}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">{{__('admin.show')}}</a>
                            </li>
                            <li class="breadcrumb-item active">{{__('admin.sales_invoice')}}
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
                        <h3 class="m-0">@{{ currentCount }}</h3><span
                            class="text-muted">{{__('admin.sales_invoice')}}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-head">
                <div class="card-header">
                    <h4 class="card-title float-left">
                        <i class='bx bxs-file bx-tada'></i> {{__('admin.sales_invoice')}}
                    </h4>
                    <div class="float-right">
                        @can('create sales_invoice')
                            <a class="btn btn-sm btn-blue-grey box-shadow-2 round btn-min-width pull-right white"
                               href="{{route('sales_invoice.create')}}">
                                <i class="ft-plus white"></i>{{__('admin.create').' '.__('admin.sales_invoice')}}
                            </a>
                        @endcan
                    </div>
                </div>


            </div>
            <div class="card-content collapse show" id="app">


                @include('include.modal_loading_show')

                <div class="card-body card-dashboard">


                    <div class="row">


                        <div class="col-sm-12 col-md-12">
                            <div class="row">
                                @include('include.table_length_vue')
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <div class="col-md-9 mx-auto position-relative has-icon-left">
                                            <input type="text" id="search"
                                                   v-model="searchQuery"
                                                   @keyup="searchSalesInvoice"
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
                    <br>
                    <div class="table-responsive">
                        <table width="200" id="table" class="table zero-configuration">
                            <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>{{__('admin.sale_representatives')}}</th>
                                <th>{{__('admin.customers')}}</th>
                                <th>{{__('admin.date')}}</th>
                                <th>{{__('admin.post')}}</th>

                                <th>{{__('admin.bill_type')}}</th>
                                <th>{{__('admin.note')}}</th>


                                @canany(['update sales_invoice', 'delete sales_invoice'])
                                    <th>{{__('admin.action')}}</th>
                                @endcanany
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
                                <td>@{{ row.id }}</td>
                                <td>@{{ row.sale_representative_name ?? '' }}</td>
                                <td>@{{ row.customer_name ?? '' }}</td>
                                <td>@{{ row.date }}</td>
                                <td>
                                    <div class="fonticon-wrap" v-if="row.post == 1">
                                        <i class="ft-check-circle" style="color:#20C997"></i>
                                    </div>
                                    <div class="fonticon-wrap" v-else>
                                        <i class="ft-x-circle" style="color:#FC0021"></i>
                                    </div>
                                </td>

                                <td>@{{ row.bill_type_name ?? '' }}</td>
                                <td>@{{ row.note }}</td>


                                @canany(['update sales_invoice', 'delete sales_invoice'])

                                    <td>
                                        <a :href="'/sales/sales_invoice/edit/' + row.id"><i
                                                class="la la-pencil-square success"></i></a>
                                        <a class="delete" :id="row.id"
                                           @click.prevent="deleteSalesInvoice(row.id, index)"><i
                                                class="la la-trash danger"></i></a>

                                    </td>

                                @endcanany


                            </tr>
                            </tbody>
                        </table>

                    </div>
                    <nav v-if="lastPage > 1">
                        <ul class="pagination justify-content-end">
                            <li class="page-item" :class="{ disabled: currentPage === 1 }">
                                <a class="page-link" href="#"
                                   @click.prevent="loadSalesInvoice(currentPage - 1)">{{__('admin.Previous')}}</a>
                            </li>

                            <li class="page-item" v-for="page in lastPage" :key="page"
                                :class="{ active: currentPage === page }">
                                <a class="page-link" href="#" @click.prevent="loadSalesInvoice(page)">@{{ page }}</a>
                            </li>

                            <li class="page-item" :class="{ disabled: currentPage === lastPage }">
                                <a class="page-link" href="#"
                                   @click.prevent="loadSalesInvoice(currentPage + 1)">{{__('admin.Next')}}</a>
                            </li>
                        </ul>
                    </nav>


                    <span>
        {{ __('admin.show') }}
        <span class="rows-count-current font-default text-bold-600">@{{ currentCount }}</span>
        {{ __('admin.out_of') }}
        <span class="rows-count-current font-default text-bold-600">@{{ totalCount }}</span>
        {{ __('admin.record') }}
    </span>
                </div>
            </div>

        </div>
    </div>


    @include('include.message-don-delete')
@endsection
@section('script')

    <script src="{{asset('app-assets/vendors/js/extensions/sweetalert.min.js')}}"></script>
    <script src="{{asset('app-assets/js/scripts/extensions/sweet-alerts.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        window.translations = {
            loading: '{{ __("admin.loading") }}',
            loading_failed: '{{ __("admin.loading_failed") }}',
            ok: "{{__('admin.ok')}}",
            Are_you_sure: "{{__('admin.are_you_sure_you_want_to_remove_this_data')}}",
            Data_will_be_permanently_deleted: "{{__('admin.the_data_will_be_permanently_deleted')}}",
            yes: "{{__('admin.yes')}}",
            no: "{{__('admin.no')}}",
            canceled: "{{__('admin.canceled')}}"

        };
        const {createApp, mounted} = Vue;

        var rows = @json($data->items()); // البيانات من السيرفر

        createApp({
            data() {
                return {
                    rows: rows,
                    searchQuery: "",
                    searchTimer: null,
                    loadingMessage: '',
                    showModal: false,
                    total: 0,
                    perPage: 10,
                    currentPage: 1,
                    lastPage: 1,
                    showModalSave: false,
                    successMessage: window.successMessage
                };
            },
            computed: {
                currentCount() {
                    return this.rows.length; // عدد الصفوف الحالي في الصفحة
                },
                totalCount() {
                    return this.total || this.rows.length; // إجمالي عدد الصفوف في قاعدة البيانات
                }
            },
            mounted() {

                this.loadSalesInvoice();
            },
            methods: {
                async loadSalesInvoice(page = 1) {
                    try {
                        const res = await axios.get(`/sales/sales_invoice/show?page=${page}&table_length=${this.perPage}`);
                        const data = res.data;

                        this.rows = data.data;          // بيانات الجدول
                        this.currentPage = data.current_page;
                        this.lastPage = data.last_page;
                        this.perPage = data.per_page;
                        this.total = data.total;

                    } catch (err) {
                        console.error("Error loading data:", err);
                    }
                },
                async deleteSalesInvoice(id, index) {
                    const route = `/sales/sales_invoice/destroy/${id}`;

                    try {
                        await window.apiService.deletedItems2(id, route, this);
                        this.rows.splice(index, 1); // إزالة الصف من Vue array تلقائياً
                    } catch (e) {
                        console.error(e);
                    }
                },
                async searchSalesInvoice() {
                    clearTimeout(this.searchTimer);
                    this.searchTimer = setTimeout(async () => {
                        try {
                            let url = "/sales/sales_invoice/search";
                            this.rows = await window.apiService.responseEditOrShowData2(url + "?query=" + this.searchQuery, this);
                        } catch (e) {
                            console.error("Search error:", e);
                        }
                    }, 300);
                }
            }
        }).mount("#app");
    </script>
    @if(session()->has('success'))
        <script>
            $(document).ready(function () {
                $('#messageSave').modal('show');
            });
        </script>
    @endif
@endsection
