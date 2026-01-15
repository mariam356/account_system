@php($page_title = __('admin.receive_bond'))
@extends('layouts.main')

@section('content')
    <div class="content-wrapper">



        <div class="content-header row mb-1">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">{{__('admin.receive_bond')}}</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">{{__('admin.Dashboard')}}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">{{__('admin.show')}}</a>
                            </li>
                            <li class="breadcrumb-item active">{{__('admin.receive_bond')}}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="content-header-right col-md-6 col-12">
                <div class="media width-250 float-right">
                    @can('report receive_bond')
                    <div class="mb-2">
                        <button @click="printSelectedReports"
                                class="btn btn-glow btn-round btn-outline-reddit btn-min-width"
                                :disabled="selectedRows.length === 0"
                                style="padding: 10px 25px; transition: all 0.3s ease; display: flex; align-items: center;">

                            <i class="la la-print" style="font-size: 1.4rem; margin-left: 10px;"></i>
                            <span style="font-weight: 600;">{{ __('admin.report') }} {{__('admin.receive_bond')}}</span>

                            <span v-if="selectedRows.length > 0"
                                  class="badge badge-pill badge-warning"
                                  style="margin-right: 15px; font-size: 0.9rem; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">
                             @{{ selectedRows.length }}
                            </span>
                        </button>
                    </div>
                        @endcan
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-head">
                <div class="card-header">
                    <h4 class="card-title float-left">
                        <i class='bx bxs-receipt bx-tada' ></i> {{__('admin.receive_bond')}}
                    </h4>
                    <div class="float-right">
                        @can('create receive_bond')
                        <a class="btn btn-sm btn-blue-grey box-shadow-2 round btn-min-width pull-right white"
                           href="{{route('receive_bond.create')}}">
                            <i class="ft-plus white"></i>{{__('admin.create').' '.__('admin.receive_bond')}}
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
                                                   @keyup="searchReceiveBond"
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
                                <th><input type="checkbox" @change="selectAll($event)"></th>
                                <th style="width: 10px">#</th>

                                <th>{{__('admin.date')}}</th>
                                <th>{{__('admin.post')}}</th>
                                <th>{{__('admin.fund')}} / {{__('admin.bank')}}</th>
                                <th>{{__('admin.amount')}}</th>
                                <th>{{__('admin.note')}}</th>



                                                                                                                        @canany(['update receive_bond', 'delete receive_bond'])
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
                                <td>
                                    <input type="checkbox" :value="row.id" v-model="selectedRows">
                                </td>
                                <td>@{{ row.check_no }}</td>
                                <td>@{{ row.date }}</td>



                                <td>
                                    <div class="fonticon-wrap" v-if="row.post == 1">
                                        <i class="ft-check-circle" style="color:#20C997"></i>
                                    </div>
                                    <div class="fonticon-wrap" v-else>
                                        <i class="ft-x-circle" style="color:#FC0021"></i>
                                    </div>
                                </td>

                                <td>@{{ row.fund_name ? row.fund_name :  row.bank_name}}</td>
                                <td>@{{ row.amount }}</td>
                                <td>@{{ row.note }}</td>

                                                                @canany(['update receive_bond', 'delete receive_bond'])

                                <td>
                                    <a :href="'/accounts/receive_bond/edit/' + row.id"><i
                                            class="la la-pencil-square success"></i></a>
                                    <a class="delete" :id="row.id" @click.prevent="deleteReceiveBond(row.id, index)"><i
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
                                <a class="page-link" href="#" @click.prevent="loadReceiveBond(currentPage - 1)">{{__('admin.Previous')}}</a>
                            </li>

                            <li class="page-item" v-for="page in lastPage" :key="page" :class="{ active: currentPage === page }">
                                <a class="page-link" href="#" @click.prevent="loadReceiveBond(page)">@{{ page }}</a>
                            </li>

                            <li class="page-item" :class="{ disabled: currentPage === lastPage }">
                                <a class="page-link" href="#" @click.prevent="loadReceiveBond(currentPage + 1)">{{__('admin.Next')}}</a>
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
        const {createApp ,mounted} = Vue;

        var rows = @json($data->items()); // البيانات من السيرفر

        createApp({
            data() {
                return {
                    rows: rows || [],
                    selectedRows: [],
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

                this.loadReceiveBond();
            },
            methods: {
                selectAll(event) {
                    if (event.target.checked) {
                        // نضمن أننا نتعامل مع مصفوفة فقط
                        const items = Array.isArray(this.rows) ? this.rows : [];
                        this.selectedRows = items.map(row => row.id);
                    } else {
                        this.selectedRows = [];
                    }
                },
                printSelectedReports() {
                    if (this.selectedRows.length === 0) return;

                    // تحويل المحددة إلى رابط
                    const idsParam = this.selectedRows.join(',');
                    window.open(`/accounts/receive_bond/report?ids=${idsParam}`, '_blank');
                },
                async loadReceiveBond(page = 1) {
                    try {
                        const res = await axios.get(`/accounts/receive_bond/show?page=${page}&table_length=${this.perPage}`);

                        // فحص أين توجد المصفوفة الفعلية (هذا السطر يحل مشكلة اختلاف الهياكل)
                        const responseData = res.data.data ? res.data.data : res.data;

                        // إذا كانت البيانات تأتي من Pagination لارافيل مباشرة:
                        if (res.data.data && Array.isArray(res.data.data)) {
                            this.rows = res.data.data; // الحالة الطبيعية للـ Pagination
                            this.currentPage = res.data.current_page;
                            this.lastPage = res.data.last_page;
                            this.total = res.data.total;
                        } else if (Array.isArray(res.data)) {
                            this.rows = res.data; // حالة إرجاع مصفوفة بسيطة
                            this.total = res.data.length;
                        }

                        this.selectedRows = [];
                    } catch (err) {
                        console.error("Error loading receive_bond:", err);
                        // لا تفرغ المصفوفة هنا لكي لا تختفي البيانات القديمة في حال فشل الاتصال
                    }
                },

                async deleteReceiveBond(id, index) {
                    const route = `/accounts/receive_bond/destroy/${id}`;

                    try {
                        await window.apiService.deletedItems2(id, route, this);
                        this.rows.splice(index, 1); // إزالة الصف من Vue array تلقائياً
                    } catch (e) {
                        console.error(e);
                    }
                },
                async searchReceiveBond() {
                    clearTimeout(this.searchTimer);
                    this.searchTimer = setTimeout(async () => {
                        try {
                            let url = "/accounts/receive_bond/search";
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
