@php($page_title = __('admin.user'))
@extends('layouts.main')

@section('content')

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row mb-1">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">{{__('admin.users')}}</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">{{__('admin.Dashboard')}}</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">{{__('admin.show')}}</a>
                                </li>
                                <li class="breadcrumb-item active">{{__('admin.user')}}
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
                            <h3 class="m-0">{{$data_count}}</h3><span class="text-muted">{{__('admin.users')}}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">


                <!-- Form wizard with step validation section start -->
{{--                @canany(['update user', 'create user'])--}}
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                {{--                                <h4 class="card-title" id="horz-layout-colored-controls">{{__('admin.user')}}</h4>--}}
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

                                    <form id="form">
                                        @csrf
                                        <div class="form-body">
                                            <h4 class="form-section"><i class='bx bxs-user-circle bx-tada' ></i>{{__('admin.users')}} :</h4>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control"
                                                               for="full_name">{{__('admin.full_name')}} <span
                                                                class="danger">*</span></label>
                                                        <div class="col-md-9 mx-auto position-relative has-icon-left">
                                                            <input type="text" id="full_name"
                                                                   class="form-control border-primary" name="full_name">
                                                            <div class="form-control-position">
                                                                <i class="ft-user" style="color: #b92c81"></i>
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
                                                               for="name">{{__('admin.name')}} {{__('admin.user')}}</label>
                                                        <div class="col-md-9 mx-auto position-relative has-icon-left">
                                                            <input type="text" id="name"
                                                                   class="form-control border-primary" name="name">
                                                            <div class="form-control-position">
                                                                <i class="ft-user" style="color: #b92c81"></i>
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
                                                               for="password">{{__('admin.password')}}<span
                                                                class="danger">*</span></label>
                                                        <div class="col-md-9 mx-auto position-relative has-icon-left">
                                                            <input type="password" id="password"
                                                                   class="form-control border-primary"
                                                                   name="password">
                                                            <div class="form-control-position">
                                                                <i class="ft-lock" style="color: #b92c81"></i>
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
                                                               for="confirm_password">{{__('admin.confirm_password')}}<span
                                                                class="danger">*</span></label>
                                                        <div class="col-md-9 mx-auto position-relative has-icon-left">
                                                            <input type="password" id="confirm_password"
                                                                   class="form-control border-primary"
                                                                   name="confirm_password">
                                                            <div class="form-control-position">
                                                                <i class="ft-lock" style="color: #b92c81"></i>
                                                            </div>

                                                            <span class="error-message" style="color:red;">
                                                        <strong></strong>
                                                    </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="row">

                                                <div class="col-md-3">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control"
                                                               for="email">{{__('admin.email')}} <span
                                                                class="danger">*</span></label>
                                                        <div class="col-md-9 mx-auto position-relative has-icon-left">
                                                            <input class="form-control border-primary" type="email"
                                                                   name="email"
                                                                   id="email">
                                                            <div class="form-control-position">
                                                                <i class="ft-mail" style="color: #b92c81"></i>
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
                                                               for="phone">{{__('admin.phone')}} <span
                                                                class="danger">*</span></label>
                                                        <div class="col-md-9 mx-auto position-relative has-icon-left">
                                                            <input class="form-control border-primary" type="text"
                                                                   id="phone" name="phone">
                                                            <div class="form-control-position">
                                                                <i class="ft-phone" style="color: #b92c81"></i>
                                                            </div>

                                                            <span class="error-message" style="color:red;">
                                                        <strong></strong>
                                                    </span>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="col-md-3">


                                                    <div class="form-group row">

                                                        <label for="image"
                                                               class=" col-md-3 label-control">{{__('admin.image')}} </label>
                                                        <div class="col-md-9 mx-auto position-relative has-icon-left">
                                                            <input type="file" id="image"
                                                                   class="form-control border-primary " name="image"
                                                                   onchange="loadAvatar(this);">
                                                            <div class="form-control-position">
                                                                <i class="ft-image" style="color: #b92c81"></i>
                                                            </div>
                                                        </div>
                                                        <span class="error-message">
                                                        <strong></strong>
                                                    </span>


                                                        <button type="button" hidden onclick="delete_img()"
                                                                style="position: static; "
                                                                class="mx-auto btn btn-sm btn-outline-danger"
                                                                id="delete-img"><i class="ft-trash"></i>
                                                        </button>

                                                        <img id="avatar" class="col-md-9 mx-auto"
                                                             style="max-width: 140px; height: auto; margin:10px;">


                                                    </div>


                                                </div>

                                                @can('show permission')
                                                    <div class="col-md-3">
                                                        <div
                                                            class="form-group">
                                                            <div class="input-group">
                                                                <label for="projectinput2" style="  margin-left: 10px; padding-top: 10px;">{{__('admin.roles')}}</label>
                                                                <select id="role_name" name="role_name" class="form-control border-primary">
                                                                    <option value="">{{__('admin.select_option')}}</option>
                                                                    @foreach($role as $roles)
                                                                        <option
                                                                            value="{{$roles->name ?? ''}}">{{$roles->name ?? ''}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endcan

                                            </div>


                                        </div>

                                        <div class="form-actions text-right">

                                            <button type="submit" id="btn-save" class="btn btn-outline-blue-grey btn-min-width btn-glow mr-1 mb-1">
                                                <i class="la la-check-square-o"></i> {{__('admin.save')}}
                                            </button>


                                        </div>

                                    </form>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
{{--                @endcanany--}}

                <!-- Table head options start -->
                <div class="row">
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
                                                        <input type="text" id="search" class="form-control round border-primary" placeholder="{{__('admin.Type_to_search')}}" autocomplete="off">

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

                                        <th>{{__('admin.full_name')}}</th>
                                        <th>{{__('admin.name')}} {{__('admin.user')}}</th>
                                        <th>{{__('admin.phone')}}</th>
                                        <th>{{__('admin.email')}}</th>
                                        <th>{{__('admin.branch')}}</th>

                                        <th>{{__('admin.image')}}</th>
                                                                                    @canany(['update user', 'delete user'])
                                        <th>{{__('admin.action')}}</th>
                                                                                    @endcanany
                                    </tr>
                                    </thead>

                                    <tbody>


                                    @if(count($data) == 0)
                                        <tr id="row-not-found">
                                            <td colspan="9" class="text-center">
                                                {{__('admin.no_data')}}
                                                <hr>
                                            </td>
                                        </tr>
                                    @endif
                                    @foreach($data as $user)
                                        <tr>
                                            <td hidden>{{$user->updated_at}}</td>

                                            <td>{{ $user->full_name }}</td>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->phone}}</td>

                                            <td>{{$user->email}}</td>
                                            <td>{{$user->branch->name ?? ''}}</td>

                                            <td>
                                                <img style="max-width:64px"
                                                     src="{{asset('storage').'/'.$user->image}}"  onerror="this.src='{{ asset('storage/no-image.png') }}'">
                                            </td>

                                                                                        @canany(['update user', 'delete user'])
                                            <td>
                                                {!! $user->actions !!}
                                            </td>
                                                                                        @endcanany
                                        </tr>
                                    @endforeach
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

    @include('managements.file.users.js')

@endsection


