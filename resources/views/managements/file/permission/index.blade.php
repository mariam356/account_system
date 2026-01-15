@php($page_title = __('admin.permission'))
@extends('layouts.main')

@section('content')

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row mb-1">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">{{__('admin.permission')}}</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">{{__('admin.Dashboard')}}</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">{{__('admin.show')}}</a>
                                </li>
                                <li class="breadcrumb-item active">{{__('admin.permission')}}
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
                            <h3 class="m-0">@{{ currentCount }}</h3><span class="text-muted">{{__('admin.permission')}}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body"  id="app">
                @include('include.modal_loading_show')
                <!-- Form wizard with step validation section start -->


                <!-- Table head options start -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-head">
                                <div class="card-header">
                                    <h4 class="card-title float-left">
                                        <i class='bx bxs-lock bx-tada' ></i> {{__('admin.permission')}}
                                    </h4>
                                    <div class="float-right">
                                        <a class="btn btn-sm btn-blue-grey box-shadow-2 round btn-min-width pull-right white"
                                           href="{{route('permission.create')}}">
                                            <i class="ft-plus white"></i>{{__('admin.create').' '.__('admin.permission')}}
                                        </a>

                                    </div>
                                </div>


                            </div>
                            <div class="card-header">
                                <div class="row">

                                    <div class="col-sm-12 col-md-12">

                                        <div class="row">
                                            @include('include.table_length_vue')
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <div class="col-md-9 mx-auto position-relative has-icon-left">
                                                        <input type="text"  id="search"
                                                               v-model="searchQuery"
                                                               @keyup="searchPermission"
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

                            </div>


                            <div class="card-content collapse show">
                                <div class="table-responsive">
                                    <table id="table" class="table table-hover mb-0">
                                        <thead>
                                        <tr>

                                            <th>{{__('admin.roles')}}</th>
                                            <th>{{__('admin.created_at')}}</th>
                                            <th>{{__('admin.updated_at')}}</th>

                                            {{--                                            @canany(['update permission', 'delete permission'])--}}
                                            <th>{{__('admin.action')}}</th>
                                            {{--                                            @endcanany--}}
                                        </tr>
                                        </thead>

                                        <tbody>



                                        <tr v-if="rows.length === 0" id="row-not-found">
                                            <td colspan="9" class="text-center">
                                                {{__('admin.no_data')}}
                                                <hr>
                                            </td>
                                        </tr>

                                        <tr v-for="(row, index) in rows" :key="row.id"  :class="{ 'tr-color-active': row.isActive }" >


                                            <td>@{{ row.name }}</td>
                                            <td>@{{ row.created_at }}</td>
                                            <td>@{{ row.updated_at }}</td>
                                            {{--                                            @canany(['update permission', 'delete permission'])--}}


                                            <td>
                                                <a :href="`/file/permission/edit/${row.id}`">
                                                    <i class="la la-pencil-square success"></i>
                                                </a>
                                                <a @click.prevent="deletePermission(row.id, index)" class="delete">
                                                    <i class="la la-trash danger"></i>
                                                </a>
                                                <a :href="`/file/permission/show/${row.id}`">
                                                    <i class="la la-eye warning"></i>
                                                </a>


                                            </td>
                                            {{--                                            @endcanany--}}
                                        </tr>




                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>


                        <nav v-if="lastPage > 1">
                            <ul class="pagination justify-content-end">
                                <li class="page-item" :class="{ disabled: currentPage === 1 }">
                                    <a class="page-link" href="#" @click.prevent="loadPermission(currentPage - 1)">{{__('admin.Previous')}}</a>
                                </li>

                                <li class="page-item" v-for="page in lastPage" :key="page" :class="{ active: currentPage === page }">
                                    <a class="page-link" href="#" @click.prevent="loadPermission(page)">@{{ page }}</a>
                                </li>

                                <li class="page-item" :class="{ disabled: currentPage === lastPage }">
                                    <a class="page-link" href="#" @click.prevent="loadPermission(currentPage + 1)">{{__('admin.Next')}}</a>
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
            adding:"{{__('admin.adding')}}",
            add:"{{__('admin.add')}}",
            updating:"{{__('admin.updating')}}",
            edit:"{{__('admin.edit')}}",
            ok:"{{__('admin.ok')}}",
            Are_you_sure:"{{__('admin.are_you_sure_you_want_to_remove_this_data')}}",
            Data_will_be_permanently_deleted:"{{__('admin.the_data_will_be_permanently_deleted')}}",
            yes:"{{__('admin.yes')}}",
            no:"{{__('admin.no')}}",
            canceled:"{{__('admin.canceled')}}"
        };

        const { createApp } = Vue;

        createApp({

            data() {
                return {


                    // بيانات الجدول
                    PermissionId: 0,
                    editRowIndex: null,
                    rows: [],
                    searchQuery: "",
                    searchTimer: null,

                    // نموذج
                    form: {
                        conversion_factor: "",
                        name_ar: "",
                        name_en: "",


                    },

                    errors: {
                        conversion_factor: "",
                        name_ar: "",
                        name_en: "",

                    },


                    loadingMessage: '',
                    showModal: false,
                    total: 0,
                    perPage: 10,
                    currentPage: 1,
                    lastPage: 1
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

            mounted() { // الحاجة إلى الوصول للعناصر داخل الصفحة

                this.loadPermission();


            },

            methods: {


                async searchPermission() {
                    clearTimeout(this.searchTimer);
                    this.searchTimer = setTimeout(async () => {
                        try {
                            let url = "/file/permission/search";
                            this.rows = await window.apiService.responseEditOrShowData2(url + "?query=" + this.searchQuery, this);
                        } catch (e) {
                            console.error("Search error:", e);
                        }
                    }, 300);
                },

                async loadPermission(page = 1) {
                    try {
                        const res = await axios.get(`/file/permission/display?page=${page}&table_length=${this.perPage}`);
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






                async deletePermission(id, index) {
                    const route = `/file/permission/destroy/${id}`;

                    // اجعل الصف مميزًا (بدل jQuery)
                    this.rows[index].isActive = true;

                    try {
                        await window.apiService.deletedItems2(id, route,this);

                        // احذف الصف من Vue array
                        this.rows.splice(index, 1);

                    } catch (e) {
                        // رجّع لون الصف إذا فشل الحذف
                        this.rows[index].isActive = false;
                        console.error(e);
                    }
                },



            }

        }).mount("#app");


    </script>

@endsection


