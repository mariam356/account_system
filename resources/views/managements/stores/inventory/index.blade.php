@php($page_title = __('admin.inventory_management'))
@extends('layouts.main')

@section('content')

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row mb-1">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">{{__('admin.inventory_management')}}</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">{{__('admin.Dashboard')}}</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">{{__('admin.show')}}</a>
                                </li>
                                <li class="breadcrumb-item active">{{__('admin.inventory_management')}}
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
                                class="text-muted">{{__('admin.inventory_management')}}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body" id="app">
                @include('include.modal_loading_show')


                <!-- Table head options start -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">

                                    <div class="col-sm-12 col-md-12">

                                        <div class="row">
                                            @include('include.table_length_vue')
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <div class="col-md-9 mx-auto position-relative has-icon-left">
                                                        <input type="text" id="search"
                                                               v-model="searchQuery"
                                                               @keyup="searchInventoryManagement"
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
                                    <table id="table" class="table table-hover mb-0">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{__('admin.product')}}</th>
                                            <th>{{__('admin.unit')}}</th>
                                            <th>{{__('admin.quantity_system')}}</th>
                                            @can('update inventory_management')
                                            <th>{{__('admin.actual_quantity')}}</th>
                                            @endcan
                                            <th>{{__('admin.difference')}}</th>
                                            <th>{{__('admin.price')}}</th>
                                            {{--                                            @canany(['update inventory_management', 'delete inventory_management'])--}}
{{--                                            <th>{{__('admin.action')}}</th>--}}
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

                                        <tr v-for="(row, index) in rows" :key="row.product_id">
                                            <td>@{{ row.product_id }}</td>
                                            <td>@{{ row.name }}</td>
                                            <td>@{{ row.unit_name }}</td>

                                            <!-- الكمية بالنظام (محسوبة من السيرفر) -->
                                            <td>@{{ row.system_quantity }}</td>
                                            @can('update inventory_management')
                                            <!-- الكمية الفعلية -->
                                            <td>
                                                <input type="number"
                                                       v-model.number="row.actual_quantity"
                                                       @keyup.enter="saveRow(row, index)"
                                                       style="width: 200px;border-color: #d2e2e9"
                                                       class="form-control">
                                            </td>
                                            @endcan

                                            <!-- الفرق -->
                                            <td>
                                                @{{ row.actual_quantity - row.system_quantity }}
                                            </td>
                                            <td>@{{ row.price  ?? 0}}</td>
                                        </tr>



                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>


                        <nav v-if="lastPage > 1">
                            <ul class="pagination justify-content-end">
                                <li class="page-item" :class="{ disabled: currentPage === 1 }">
                                    <a class="page-link" href="#"
                                       @click.prevent="loadInventoryManagement(currentPage - 1)">{{__('admin.Previous')}}</a>
                                </li>

                                <li class="page-item" v-for="page in lastPage" :key="page"
                                    :class="{ active: currentPage === page }">
                                    <a class="page-link" href="#" @click.prevent="loadInventoryManagement(page)">@{{
                                        page }}</a>
                                </li>

                                <li class="page-item" :class="{ disabled: currentPage === lastPage }">
                                    <a class="page-link" href="#"
                                       @click.prevent="loadInventoryManagement(currentPage + 1)">{{__('admin.Next')}}</a>
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

    @include('managements.stores.inventory.js')

@endsection


