@php($page_title = __('admin.category_movement'))
@extends('layouts.main')

@section('content')

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row mb-1">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">{{__('admin.category_movement')}}</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">{{__('admin.Dashboard')}}</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">{{__('admin.show')}}</a>
                                </li>
                                <li class="breadcrumb-item active">{{__('admin.category_movement')}}
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
                                class="text-muted">{{__('admin.category_movement')}}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body" id="app">
                @include('include.modal_loading_show')

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                {{--                                <h4 class="card-title" id="horz-layout-colored-controls">{{__('admin.units')}}</h4>--}}
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

                                    <form id="form" @submit.prevent="search" enctype="multipart/form-data" >
                                        @csrf
                                        <div class="form-body">
                                            <h4 class="form-section"><i class='bx bx-unite bx-tada' ></i> {{__('admin.category_movement')}} </h4>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control"
                                                               for="from_date">{{__('admin.from_date')}}</label>
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
                                                               for="to_date">{{__('admin.to_date')}}</label>
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
                                                               for="product_id">{{__('admin.products')}}  </label>
                                                        <div class="col-md-9 mx-auto position-relative has-icon-left">
                                                            <select class="select2 form-control border-primary" id="product_id" name="product_id">
                                                                <option value="">{{__('admin.select_option')}}</option>
                                                                @foreach($product as $products)
                                                                    <option value="{{$products->id}}">{{$products->name}}</option>
                                                                @endforeach

                                                            </select>
                                                            <div class="form-control-position">
                                                                <i class="bx bx-package" style="color: #b92c81"></i>
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
                                                               for="movement_type_id">{{__('admin.movement_type')}}  </label>
                                                        <div class="col-md-9 mx-auto position-relative has-icon-left">
                                                            <select class="select2 form-control border-primary" id="movement_type_id" name="movement_type_id">
                                                                <option value="">{{__('admin.select_option')}}</option>
                                                                @foreach($movement_type as $movement_types)
                                                                    <option value="{{$movement_types->id}}">{{$movement_types->name}}</option>
                                                                @endforeach

                                                            </select>
                                                            <div class="form-control-position">
                                                                <i class="ft-activity" style="color: #b92c81"></i>
                                                            </div>

                                                            <span class="error-message" style="color:red;">
                                                        <strong></strong>
                                                    </span>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                        <div class="form-actions text-right" id="app2">
                                            <button type="submit"  class="btn btn-outline-blue-grey btn-min-width btn-glow mr-1 mb-1">
                                                <i class="la la-search"></i>
                                                {{ __('admin.search') }}
                                            </button>



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
                                            <th>{{__('admin.date')}}</th>
                                            <th>{{__('admin.product')}}</th>
                                            <th>{{__('admin.quantity_system')}}</th>
                                            <th>{{__('admin.actual_quantity')}}</th>
                                            <th>{{__('admin.balance')}}</th>
                                            <th>{{__('admin.type')}}</th>

                                        </tr>
                                        </thead>




                                        <tbody>
                                        <tr v-if="rows.length === 0">
                                            <td colspan="5" class="text-center">{{__('admin.no_data')}}</td>
                                        </tr>

                                        <tr v-for="(row, index) in rows" :key="row.id">
                                            <td>@{{ formatDate(row.created_at) }}</td>
                                            <td>@{{ row.product ? row.product.name : '-' }}</td>
                                            <td class="text-success">@{{ row.quantity_in }}</td>
                                            <td class="text-danger">@{{ row.quantity_out }}</td>
                                            <td>
                                                <strong v-if="index === 0 && currentPage === 1">
                                                    @{{ calculateRunningBalance(index) }}
                                                </strong>
                                                <strong v-else>
                                                    @{{ calculateRunningBalance(index) }}
                                                </strong>
                                            </td>
                                            <td>@{{ row.movement_type_name }}</td>
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
                                       @click.prevent="loadCategoryManagement(currentPage - 1)">{{__('admin.Previous')}}</a>
                                </li>

                                <li class="page-item" v-for="page in lastPage" :key="page"
                                    :class="{ active: currentPage === page }">
                                    <a class="page-link" href="#" @click.prevent="loadCategoryManagement(page)">@{{
                                        page }}</a>
                                </li>

                                <li class="page-item" :class="{ disabled: currentPage === lastPage }">
                                    <a class="page-link" href="#"
                                       @click.prevent="loadCategoryManagement(currentPage + 1)">{{__('admin.Next')}}</a>
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

    @include('managements.stores.category_movement.js')

@endsection


