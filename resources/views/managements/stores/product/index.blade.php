@php($page_title = __('admin.product'))
@extends('layouts.main')

@section('content')

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row mb-1">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">{{__('admin.products')}}</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">{{__('admin.Dashboard')}}</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">{{__('admin.show')}}</a>
                                </li>
                                <li class="breadcrumb-item active">{{__('admin.product')}}
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
                            <h3 class="m-0">@{{ currentCount }}</h3><span class="text-muted">{{__('admin.products')}}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body"  id="app">
                @include('include.modal_loading_show')
                <!-- Form wizard with step validation section start -->
                @canany(['update product', 'create product'])
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                {{--                                <h4 class="card-title" id="horz-layout-colored-controls">{{__('admin.products')}}</h4>--}}
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

                                    <form id="form" @submit.prevent="saveProduct" enctype="multipart/form-data" >
                                        @csrf
                                        <div class="form-body">
                                            <h4 class="form-section"><i class='bx bx-package bx-tada' ></i> {{__('admin.products')}} </h4>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control"
                                                               for="name_ar">{{__('admin.name')}}  (ar)<span
                                                                class="danger">*</span></label>
                                                        <div class="col-md-9 mx-auto position-relative has-icon-left">
                                                            <input type="text" id="name_ar"
                                                                   v-model="form.name_ar"
                                                                   class="form-control border-primary" name="name_ar">
                                                            <div class="form-control-position">
                                                                <i class="ft-user" style="color: #b92c81"></i>
                                                            </div>

                                                            <span class="text-danger" v-if="errors.name_ar">@{{ errors.name_ar }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control"
                                                               for="name_en">{{__('admin.name')}}  (en)<span
                                                                class="danger">*</span></label>
                                                        <div class="col-md-9 mx-auto position-relative has-icon-left">
                                                            <input type="text" id="name_en"
                                                                   v-model="form.name_en"
                                                                   class="form-control border-primary" name="name_en">
                                                            <div class="form-control-position">
                                                                <i class="ft-user" style="color: #b92c81"></i>
                                                            </div>

                                                            <span class="text-danger" v-if="errors.name_en">@{{ errors.name_en }}</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control"
                                                               for="category_id">{{__('admin.categories')}}  <span
                                                                class="danger">*</span></label>
                                                        <div class="col-md-9 mx-auto position-relative has-icon-left">
                                                            <select class="select2 form-control border-primary"   v-model="form.category_id" id="category_id" required name="category_id">
                                                                <option value="">{{__('admin.select_option')}}</option>
                                                                @foreach($category as $categories)
                                                                    <option value="{{$categories->id}}">{{$categories->name}}</option>
                                                                @endforeach

                                                            </select>
                                                            <div class="form-control-position">
                                                                <i class="bx bxs-category-alt" style="color: #b92c81"></i>
                                                            </div>

                                                            <span class="text-danger" v-if="errors.category_id">@{{ errors.category_id }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control"
                                                               for="unit_id">{{__('admin.units')}}  <span
                                                                class="danger">*</span></label>
                                                        <div class="col-md-9 mx-auto position-relative has-icon-left">
                                                            <select class="select2 form-control border-primary"   v-model="form.unit_id" id="unit_id" required name="unit_id">
                                                                <option value="">{{__('admin.select_option')}}</option>
                                                                @foreach($unit as $units)
                                                                    <option value="{{$units->id}}">{{$units->name}}</option>
                                                                @endforeach

                                                            </select>
                                                            <div class="form-control-position">
                                                                <i class="bx bx-unite" style="color: #b92c81"></i>
                                                            </div>

                                                            <span class="text-danger" v-if="errors.unit_id">@{{ errors.unit_id }}</span>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control"
                                                               for="price">{{__('admin.price')}} <span
                                                                class="danger">*</span></label>
                                                        <div class="col-md-9 mx-auto position-relative has-icon-left">
                                                            <input class="form-control border-primary" type="number"
                                                                   v-model="form.price"
                                                                   id="price" name="price">
                                                            <div class="form-control-position">
                                                                <i class="la la-money" style="color: #b92c81"></i>
                                                            </div>

                                                            <span class="text-danger" v-if="errors.price">@{{ errors.price }}</span>
                                                        </div>
                                                    </div>

                                                </div>


                                                <div class="form-group col-md-3">
                                                    <div class="row">
                                                        <label class="col-md-5 label-control">{{__('admin.status')}}</label>
                                                        <div class="col-md-7 mx-auto">
                                                            <div class="input-group">
                                                                <div class="d-inline-block custom-control custom-radio mr-1">
                                                                    <input type="radio" name="status" value="1"  v-model="form.status"
                                                                           class="custom-control-input" checked id="available">
                                                                    <label class="custom-control-label cursor-pointer"
                                                                           for="available">{{__('admin.available')}}</label>
                                                                </div>
                                                                <div class="d-inline-block custom-control custom-radio">
                                                                    <input type="radio" name="status" value="0"  v-model="form.status"
                                                                           class="custom-control-input" id="un_available">
                                                                    <label class="custom-control-label cursor-pointer"
                                                                           for="un_available">{{__('admin.un_available')}}</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-md-3">


                                                    <div class="form-group row" >

                                                        <label for="image"
                                                               class="col-md-3 label-control">{{__('admin.image')}}
                                                        </label>
                                                        <div class="col-md-9 mx-auto position-relative has-icon-left">
                                                            <input type="file" id="image"
                                                                   class="form-control border-primary" name="image"
                                                                   ref="image"
                                                                   v-model="form.image"
                                                                   @change="loadAvatar($event)">
                                                            <div class="form-control-position">
                                                                <i class="ft-image" style="color: #b92c81"></i>
                                                            </div>
                                                            <span class="text-danger" v-if="errors.image">@{{ errors.image }}</span>

                                                        </div>



                                                        <button type="button" hidden
                                                                @click="deleteImg"
                                                                style="position: static;"
                                                                ref="deleteBtn"
                                                                class="mx-auto btn btn-sm btn-outline-danger"
                                                                id="delete-img">
                                                            <i class="ft-trash"></i>
                                                        </button>


                                                        <img id="avatar" :src="avatarSrc"  ref="avatar" class="col-md-9 mx-auto"
                                                             style="max-width: 140px; height: auto; margin:10px;">


                                                    </div>


                                                </div>

                                            </div>


                                        </div>

                                        <div class="form-actions text-right" id="app2">

                                            <button id="btn-save"
                                                    :data-url="dataUrl"
                                                    :data-type="dataType"
                                                    class="btn btn-outline-blue-grey btn-min-width btn-glow mr-1 mb-1">
                                                <i class="la la-check-square-o"></i>
                                                @{{ buttonText }}
                                            </button>


                                        </div>

                                    </form>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endcanany

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
                                                        <input type="text"  id="search"
                                                               v-model="searchQuery"
                                                               @keyup="searchProducts"
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
                                        <th>{{__('admin.name')}}</th>
                                        <th>{{__('admin.category')}}</th>
                                        <th>{{__('admin.unit')}}</th>
                                        <th>{{__('admin.price')}}</th>
                                        <th>{{__('admin.status')}}</th>
                                        <th>{{__('admin.image')}}</th>
                                                                                    @canany(['update product', 'delete product'])
                                        <th>{{__('admin.action')}}</th>
                                                                                    @endcanany
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

                                            <td>@{{ row.id }}</td>
                                            <td>@{{ row.name }}</td>
                                            <td>@{{ row.category_name }}</td>
                                            <td>@{{ row.unit_name }}</td>
                                            <td>@{{ row.price }}</td>
                                            <td>
                                                <div class="fonticon-wrap" v-if="row.status == 1">
                                                    <i class="ft-unlock" style="color:#20C997"></i>
                                                </div>
                                                <div class="fonticon-wrap" v-else>
                                                    <i class="ft-lock" style="color:#FC0021"></i>
                                                </div>
                                            </td>
                                            <td>
                                                <img
                                                    :src="'/storage/' + row.image"
                                                    style="max-width: 64px"
                                                    onerror="this.src='/storage/no-image.png'"
                                                >
                                            </td>




                                                                                        @canany(['update product', 'delete product'])


                                            <td>
                                                <a @click.prevent="editProduct(row.id, index)"><i class="la la-pencil-square success"></i></a>
                                                <a @click.prevent="deleteProduct(row.id, index)" class="delete">
                                                    <i class="la la-trash danger"></i>
                                                </a>

                                            </td>
                                                                                        @endcanany
                                        </tr>




                                    </tbody>
                                </table>
                                </div>
                            </div>

                        </div>


                        <nav v-if="lastPage > 1">
                            <ul class="pagination justify-content-end">
                                <li class="page-item" :class="{ disabled: currentPage === 1 }">
                                    <a class="page-link" href="#" @click.prevent="loadProducts(currentPage - 1)">{{__('admin.Previous')}}</a>
                                </li>

                                <li class="page-item" v-for="page in lastPage" :key="page" :class="{ active: currentPage === page }">
                                    <a class="page-link" href="#" @click.prevent="loadProducts(page)">@{{ page }}</a>
                                </li>

                                <li class="page-item" :class="{ disabled: currentPage === lastPage }">
                                    <a class="page-link" href="#" @click.prevent="loadProducts(currentPage + 1)">{{__('admin.Next')}}</a>
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

    @include('managements.stores.product.js')

@endsection


