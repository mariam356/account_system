@php($page_title = __('admin.branch'))
@extends('layouts.main')

@section('content')

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row mb-1">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">{{__('admin.branches')}}</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">{{__('admin.Dashboard')}}</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">{{__('admin.show')}}</a>
                                </li>
                                <li class="breadcrumb-item active">{{__('admin.branch')}}
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
                                class="text-muted">{{__('admin.branches')}}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body" id="app">
                @include('include.modal_loading_show')
                <!-- Form wizard with step validation section start -->
                @canany(['update branch', 'create branch'])

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    {{--                                <h4 class="card-title" id="horz-layout-colored-controls">{{__('admin.branches')}}</h4>--}}
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
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

                                        <form id="form" @submit.prevent="saveBranch" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-body">
                                                <h4 class="form-section"><i
                                                        class='bx bxs-buildings bx-tada'></i> {{__('admin.branches')}}
                                                </h4>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control"
                                                                   for="name_ar">{{__('admin.name')}} (ar)<span
                                                                    class="danger">*</span></label>
                                                            <div
                                                                class="col-md-9 mx-auto position-relative has-icon-left">
                                                                <input type="text" id="name_ar"
                                                                       v-model="form.name_ar"
                                                                       class="form-control border-primary"
                                                                       name="name_ar">
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
                                                                   for="name_en">{{__('admin.name')}} (en)<span
                                                                    class="danger">*</span></label>
                                                            <div
                                                                class="col-md-9 mx-auto position-relative has-icon-left">
                                                                <input type="text" id="name_en"
                                                                       v-model="form.name_en"
                                                                       class="form-control border-primary"
                                                                       name="name_en">
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
                                                                   for="address_ar">{{__('admin.address')}} (ar)</label>
                                                            <div
                                                                class="col-md-9 mx-auto position-relative has-icon-left">
                                                                <input type="text" id="address_ar"
                                                                       v-model="form.address_ar"
                                                                       class="form-control border-primary"
                                                                       name="address_ar">
                                                                <div class="form-control-position">
                                                                    <i class="ft-map-pin" style="color: #b92c81"></i>
                                                                </div>


                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control"
                                                                   for="address_en">{{__('admin.address')}} (en)</label>
                                                            <div
                                                                class="col-md-9 mx-auto position-relative has-icon-left">
                                                                <input type="text" id="address_en"
                                                                       v-model="form.address_en"
                                                                       class="form-control border-primary"
                                                                       name="address_en">
                                                                <div class="form-control-position">
                                                                    <i class="ft-map-pin" style="color: #b92c81"></i>
                                                                </div>


                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control"
                                                                   for="activity">{{__('admin.activity')}} <span
                                                                    class="danger">*</span></label>
                                                            <div
                                                                class="col-md-9 mx-auto position-relative has-icon-left">
                                                                <input class="form-control border-primary" type="text"
                                                                       v-model="form.activity"
                                                                       id="activity" name="activity">
                                                                <div class="form-control-position">
                                                                    <i class="ft-activity" style="color: #b92c81"></i>
                                                                </div>

                                                                <span class="text-danger" v-if="errors.activity">@{{ errors.activity }}</span>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control"
                                                                   for="email">{{__('admin.email')}} <span
                                                                    class="danger">*</span></label>
                                                            <div
                                                                class="col-md-9 mx-auto position-relative has-icon-left">
                                                                <input class="form-control border-primary" type="email"
                                                                       name="email" v-model="form.email"
                                                                       id="email">
                                                                <div class="form-control-position">
                                                                    <i class="ft-mail" style="color: #b92c81"></i>
                                                                </div>

                                                                <span class="text-danger" v-if="errors.email">@{{ errors.email }}</span>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control"
                                                                   for="phone">{{__('admin.phone')}} <span
                                                                    class="danger">*</span></label>
                                                            <div
                                                                class="col-md-9 mx-auto position-relative has-icon-left">
                                                                <input class="form-control border-primary" type="text"
                                                                       id="phone"
                                                                       v-model="form.phone"
                                                                       name="phone">
                                                                <div class="form-control-position">
                                                                    <i class="ft-phone" style="color: #b92c81"></i>
                                                                </div>

                                                                <span class="text-danger" v-if="errors.phone">@{{ errors.phone }}</span>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group row">
                                                            <label class="col-md-3 label-control"
                                                                   for="fax">{{__('admin.fax')}} </label>
                                                            <div
                                                                class="col-md-9 mx-auto position-relative has-icon-left">
                                                                <input class="form-control border-primary" type="number"
                                                                       v-model="form.fax"
                                                                       id="fax" name="fax">
                                                                <div class="form-control-position">
                                                                    <i class="la la-fax" style="color: #b92c81"></i>
                                                                </div>


                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <div class="col-md-3">


                                                        <div class="form-group row">

                                                            <label for="image"
                                                                   class="col-md-3 label-control">{{__('admin.image')}}
                                                            </label>
                                                            <div
                                                                class="col-md-9 mx-auto position-relative has-icon-left">
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


                                                            <img id="avatar" :src="avatarSrc" ref="avatar"
                                                                 class="col-md-9 mx-auto"
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
                                                        <input type="text" id="search"
                                                               v-model="searchQuery"
                                                               @keyup="searchBranches"
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
                                            <th>{{__('admin.address')}}</th>
                                            <th>{{__('admin.activity')}}</th>
                                            <th>{{__('admin.email')}}</th>
                                            <th>{{__('admin.phone')}}</th>
                                            <th>{{__('admin.fax')}}</th>
                                            <th>{{__('admin.image')}}</th>
                                            @canany(['update branch', 'delete branch'])
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

                                        <tr v-for="(row, index) in rows" :key="row.id"
                                            :class="{ 'tr-color-active': row.isActive }">

                                            <td>@{{ row.id }}</td>
                                            <td>@{{ row.name }}</td>
                                            <td>@{{ row.address }}</td>
                                            <td>@{{ row.activity }}</td>
                                            <td>@{{ row.email }}</td>
                                            <td>@{{ row.phone }}</td>
                                            <td>@{{ row.fax }}</td>
                                            <td>
                                                <img
                                                    :src="'/storage/' + row.image"
                                                    style="max-width: 64px"
                                                    onerror="this.src='/storage/no-image.png'"
                                                >
                                            </td>


                                            @canany(['update branch', 'delete branch'])

                                                <td>
                                                    <a @click.prevent="editBranch(row.id, index)"><i
                                                            class="la la-pencil-square success"></i></a>
                                                    <a @click.prevent="deleteBranch(row.id, index)" class="delete">
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
                                    <a class="page-link" href="#"
                                       @click.prevent="loadBranches(currentPage - 1)">{{__('admin.Previous')}}</a>
                                </li>

                                <li class="page-item" v-for="page in lastPage" :key="page"
                                    :class="{ active: currentPage === page }">
                                    <a class="page-link" href="#" @click.prevent="loadBranches(page)">@{{ page }}</a>
                                </li>

                                <li class="page-item" :class="{ disabled: currentPage === lastPage }">
                                    <a class="page-link" href="#"
                                       @click.prevent="loadBranches(currentPage + 1)">{{__('admin.Next')}}</a>
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

    @include('managements.system_setting.branch.js')

@endsection


