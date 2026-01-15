@php($page_title = __('admin.receive_bond'))
@extends('layouts.main')

@section('content')

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row mb-1">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">{{__('admin.receive_bond')}}</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">{{__('admin.Dashboard')}}</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">{{__('admin.report')}}</a>
                                </li>
                                <li class="breadcrumb-item active"><a href="{{route('receive_bond')}}">{{__('admin.receive_bond')}}</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>

                <div class="content-header-right col-md-6 col-12">
                    <br>
                    <div class="media width-250 float-right">
                        <button @click="openReport"
                                class="btn btn-outline-reddit btn-min-width btn-glow mr-1 mb-1"
                                >
                            <i class="icon-eye"></i> {{ __('admin.preview') }}
                        </button>


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
                                        <th>{{__('admin.account_name')}}</th>

                                        <th>{{__('admin.amount')}}</th>

                                        <th>{{__('admin.currency')}}</th>

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

                                        <td>@{{ row.account_number }}</td>
                                        <td>@{{ row.account_name }}</td>
                                        <td>@{{ row.amount }}</td>

                                        <td>@{{ row.currency_name }}</td>

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


                    rows: rows || [],
                    loadingMessage: '',
                    showModal: false
                };
            },

            mounted() { // الحاجة إلى الوصول للعناصر داخل الصفحة

                this.loadAccount();

            },

            methods: {
                openReport() {
                    // 1. استخراج الـ ids الموجودة في رابط الصفحة الحالي (URL)
                    const urlParams = new URLSearchParams(window.location.search);
                    const currentIds = urlParams.get('ids');

                    // 2. إذا وجد IDs في الرابط، نستخدمها هي فقط
                    if (currentIds) {
                        const url = `/accounts/receive_bond/report_export?ids=${currentIds}`;
                        window.open(url, '_blank');
                    }
                    // 3. إذا لم يوجد (مثلاً صفحة عامة)، نستخدم IDs الجدول كما كنت تفعل سابقاً
                    else {
                        let items = Array.isArray(this.rows) ? this.rows : (this.rows.data || []);
                        if (items.length === 0) return alert("لا توجد بيانات");

                        const ids = items.map(row => row.id).join(',');
                        window.open(`/accounts/receive_bond/report_export?ids=${ids}`, '_blank');
                    }
                },
                async loadAccount() {
                    try {
                        // 1. استخراج الـ ids من رابط المتصفح الحالي
                        const urlParams = new URLSearchParams(window.location.search);
                        const ids = urlParams.get('ids');

                        // 2. إرسال المعرفات في الطلب إلى السيرفر
                        // ملاحظة: الرابط يجب أن يطابق الدالة التي أرسلتها أنت في الـ Controller
                        let response = await axios.get(`/accounts/receive_bond/show`, {
                            params: { ids: ids }
                        });

                        // 3. تحديث المصفوفة بالبيانات القادمة
                        this.rows = response.data;

                        console.log("البيانات المستلمة:", this.rows);
                    } catch (e) {
                        console.error("خطأ في تحميل التقرير:", e);
                    }
                }



            }

        }).mount("#app");
    </script>

@endsection


