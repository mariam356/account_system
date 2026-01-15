@php($page_title = __('admin.permission'))
@extends('layouts.main')
@section('css')

@endsection
@section('content')
    <div class="content-wrapper">
        <div class="content-header row mb-1">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">{{__('admin.permission')}}</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">{{__('admin.Dashboard')}}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">{{__('admin.create')}}</a>
                            </li>
                            <li class="breadcrumb-item active"><a
                                    href="{{route('permission')}}">{{__('admin.permission')}}</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>

        </div>
        <div class="content-header row mb-1">

            @if(session('success'))
                <div id="messageSave" class="modal fade text-left" role="dialog">
                    <div class="modal-dialog">
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <div class="alert bg-info alert-icon-left mb-2" role="alert">
                                    <span class="alert-icon"><i class="la la-pencil-square"></i></span>
                                    <strong>{{__('admin.successfully_done')}}!</strong>
                                    <p>{{session('success')}}.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="col-md-12">
                <div class="card">
                    <form class="form" action="{{ route('permission.store')}}" method="POST" id="my_form_id"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="card-header">
                            <input class="form-control border-primary col-md-8 col-sm-8 @error('role') is-invalid @enderror"
                                   name="role" required
                                   placeholder="{{__('admin.enter_the_role_name')}}">
                            @error('role')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <div class="heading-elements">
                                <ul class="">
                                    <fieldset>
                                        <div class="float-left">
                                            {{__('admin.select_all')}}
                                            <input type="checkbox" class="js-switch pull-right float-left select-all"/>
                                        </div>
                                    </fieldset>
                                    <div class="form-group mt-1">
                                    </div>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content collpase show">
                            <div class="card-body">
                                <div class="form-body">
                                    <div class="row">

{{--                                        @can('show dashboard')--}}
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="div-style-group">
                                                <div class="form-group padding-bottom">
                                                    <h4 class="text-bold-600 pull-left">{{__('admin.Dashboard')}}</h4>
                                                </div>
                                                <hr>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="switcherySize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.show')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch event_type"
                                                               data-size="sm" value="show dashboard"
                                                               name="permission[]"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
{{--                                        @endcan--}}



{{--                                            @can('show user')--}}
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="div-style-group">
                                                <div class="form-group padding-bottom">
                                                    <h4 class="text-bold-600 pull-left">{{__('admin.user')}}</h4>
                                                </div>
                                                <hr>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="switcherySize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.create')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch event_type"
                                                               data-size="sm" value="create user"
                                                               name="permission[]"/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="switcherySize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.edit')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch event_type"
                                                               data-size="sm" value="update user"
                                                               name="permission[]"/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="switcherySize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.show')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch event_type"
                                                               data-size="sm" value="show user"
                                                               name="permission[]"/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="switcherySize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.delete')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch event_type"
                                                               data-size="sm" value="delete user"
                                                               name="permission[]"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
{{--                                        @endcan--}}

{{--                                        @can('show backup')--}}
                                        <!-- Backup Permissions -->
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="div-style-group">
                                                <div class="form-group padding-bottom">
                                                    <h4 class="text-bold-600 pull-left">{{__('admin.backup')}}</h4>
                                                </div>
                                                <hr>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="switcherySize12" class="font-medium-2 text-bold-500 mr-1">{{__('admin.create')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch event_type" data-size="sm" value="create backup" name="permission[]"/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="switcherySize12" class="font-medium-2 text-bold-500 mr-1">{{__('admin.edit')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch event_type" data-size="sm" value="update backup" name="permission[]"/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="switcherySize12" class="font-medium-2 text-bold-500 mr-1">{{__('admin.show')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch event_type" data-size="sm" value="show backup" name="permission[]"/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="switcherySize12" class="font-medium-2 text-bold-500 mr-1">{{__('admin.delete')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch event_type" data-size="sm" value="delete backup" name="permission[]"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

{{--                                        @endcan--}}

{{--                                        @can('show branch')--}}
                                        <!-- branch Permissions -->
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="div-style-group">
                                                <div class="form-group padding-bottom">
                                                    <h4 class="text-bold-600 pull-left">{{__('admin.branch')}}</h4>
                                                </div>
                                                <hr>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.create')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch event_type" data-size="sm" value="create branch" name="permission[]"/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.edit')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch event_type" data-size="sm" value="update branch" name="permission[]"/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.show')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch event_type" data-size="sm" value="show branch" name="permission[]"/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.delete')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch event_type" data-size="sm" value="delete branch" name="permission[]"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
{{--                                        @endcan--}}

                                        {{--                                        @can('show fund')--}}
                                        <!-- fund Permissions -->
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="div-style-group">
                                                <div class="form-group padding-bottom">
                                                    <h4 class="text-bold-600 pull-left">{{__('admin.fund')}}</h4>
                                                </div>
                                                <hr>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.create')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch event_type" data-size="sm" value="create fund" name="permission[]"/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.edit')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch event_type" data-size="sm" value="update fund" name="permission[]"/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.show')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch event_type" data-size="sm" value="show fund" name="permission[]"/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.delete')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch event_type" data-size="sm" value="delete fund" name="permission[]"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{--                                            @endcan--}}


                                        {{--                                        @can('show bank')--}}
                                        <!-- bank Permissions -->
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="div-style-group">
                                                <div class="form-group padding-bottom">
                                                    <h4 class="text-bold-600 pull-left">{{__('admin.bank')}}</h4>
                                                </div>
                                                <hr>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.create')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch event_type" data-size="sm" value="create bank" name="permission[]"/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.edit')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch event_type" data-size="sm" value="update bank" name="permission[]"/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.show')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch event_type" data-size="sm" value="show bank" name="permission[]"/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.delete')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch event_type" data-size="sm" value="delete bank" name="permission[]"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{--                                            @endcan--}}

{{--                                        @can('show currency')--}}
                                        <!-- Currency Permissions -->
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="div-style-group">
                                                <div class="form-group padding-bottom">
                                                    <h4 class="text-bold-600 pull-left">{{__('admin.currency')}}</h4>
                                                </div>
                                                <hr>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.create')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch event_type" data-size="sm" value="create currency" name="permission[]"/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.edit')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch event_type" data-size="sm" value="update currency" name="permission[]"/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.show')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch event_type" data-size="sm" value="show currency" name="permission[]"/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.delete')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch event_type" data-size="sm" value="delete currency" name="permission[]"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
{{--                                            @endcan--}}


{{--                                            @can('show account')--}}
                                            <!-- Accounting Guide Permissions -->
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="div-style-group">
                                                    <div class="form-group padding-bottom">
                                                        <h4 class="text-bold-600 pull-left">{{__('admin.accounting_guide')}}</h4>
                                                    </div>
                                                    <hr>
                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.create')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch event_type" data-size="sm" value="create account" name="permission[]"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.edit')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch event_type" data-size="sm" value="update account" name="permission[]"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.show')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch event_type" data-size="sm" value="show account" name="permission[]"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.delete')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch event_type" data-size="sm" value="delete account" name="permission[]"/>
                                                        </div>
                                                    </div>

                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.report')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch event_type" data-size="sm" value="report account" name="permission[]"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
{{--                                            @endcan--}}


{{--                                        @can('show journal')--}}
                                        <!-- journal Permissions -->
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="div-style-group">
                                                <div class="form-group padding-bottom">
                                                    <h4 class="text-bold-600 pull-left">{{__('admin.journal')}}</h4>
                                                </div>
                                                <hr>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.create')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch event_type" data-size="sm" value="create journal" name="permission[]"/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.edit')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch event_type" data-size="sm" value="update journal" name="permission[]"/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.show')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch event_type" data-size="sm" value="show journal" name="permission[]"/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.delete')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch event_type" data-size="sm" value="delete journal" name="permission[]"/>
                                                    </div>
                                                </div>

                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.report')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch event_type" data-size="sm" value="report journal" name="permission[]"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{--                                            @endcan--}}


{{--                                        @can('show exchange_bond')--}}
                                        <!-- exchange_bond Permissions -->
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="div-style-group">
                                                <div class="form-group padding-bottom">
                                                    <h4 class="text-bold-600 pull-left">{{__('admin.exchange_bond')}}</h4>
                                                </div>
                                                <hr>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.create')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch event_type" data-size="sm" value="create exchange_bond" name="permission[]"/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.edit')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch event_type" data-size="sm" value="update exchange_bond" name="permission[]"/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.show')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch event_type" data-size="sm" value="show exchange_bond" name="permission[]"/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.delete')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch event_type" data-size="sm" value="delete exchange_bond" name="permission[]"/>
                                                    </div>
                                                </div>

                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.report')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch event_type" data-size="sm" value="report exchange_bond" name="permission[]"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{--                                            @endcan--}}



                                        {{--                                        @can('show receive_bond')--}}
                                        <!-- receive_bond Permissions -->
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="div-style-group">
                                                <div class="form-group padding-bottom">
                                                    <h4 class="text-bold-600 pull-left">{{__('admin.receive_bond')}}</h4>
                                                </div>
                                                <hr>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.create')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch event_type" data-size="sm" value="create receive_bond" name="permission[]"/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.edit')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch event_type" data-size="sm" value="update receive_bond" name="permission[]"/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.show')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch event_type" data-size="sm" value="show receive_bond" name="permission[]"/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.delete')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch event_type" data-size="sm" value="delete receive_bond" name="permission[]"/>
                                                    </div>
                                                </div>

                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.report')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch event_type" data-size="sm" value="report receive_bond" name="permission[]"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{--                                            @endcan--}}


                                        {{--                                        @can('show account_statement')--}}
                                        <!-- account_statement Permissions -->
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="div-style-group">
                                                <div class="form-group padding-bottom">
                                                    <h4 class="text-bold-600 pull-left">{{__('admin.account_statement')}}</h4>
                                                </div>
                                                <hr>

                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.show')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch event_type" data-size="sm" value="show account_statement" name="permission[]"/>
                                                    </div>
                                                </div>


                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.report')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch event_type" data-size="sm" value="report account_statement" name="permission[]"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{--                                            @endcan--}}



                                        {{--                                        @can('show trial_balance')--}}
                                        <!-- trial_balance Permissions -->
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="div-style-group">
                                                <div class="form-group padding-bottom">
                                                    <h4 class="text-bold-600 pull-left">{{__('admin.trial_balance')}}</h4>
                                                </div>
                                                <hr>

                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.show')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch event_type" data-size="sm" value="show trial_balance" name="permission[]"/>
                                                    </div>
                                                </div>


                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.report')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch event_type" data-size="sm" value="report trial_balance" name="permission[]"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{--                                            @endcan--}}


                                        {{--                                        @can('show balance_sheet')--}}
                                        <!-- balance_sheet Permissions -->
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="div-style-group">
                                                <div class="form-group padding-bottom">
                                                    <h4 class="text-bold-600 pull-left">{{__('admin.balance_sheet')}}</h4>
                                                </div>
                                                <hr>

                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.show')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch event_type" data-size="sm" value="show balance_sheet" name="permission[]"/>
                                                    </div>
                                                </div>


                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.report')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch event_type" data-size="sm" value="report balance_sheet" name="permission[]"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{--                                            @endcan--}}



                                        {{--                                        @can('show profit_loss')--}}
                                        <!-- profit_loss Permissions -->
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="div-style-group">
                                                <div class="form-group padding-bottom">
                                                    <h4 class="text-bold-600 pull-left">{{__('admin.profit_loss')}}</h4>
                                                </div>
                                                <hr>

                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.show')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch event_type" data-size="sm" value="show profit_loss" name="permission[]"/>
                                                    </div>
                                                </div>


                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.report')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch event_type" data-size="sm" value="report profit_loss" name="permission[]"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{--                                            @endcan--}}


{{--                                            @can('show stores')--}}
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="div-style-group">
                                                    <div class="form-group padding-bottom">
                                                        <h4 class="text-bold-600 pull-left">{{__('admin.stores')}}</h4>
                                                    </div>
                                                    <hr>
                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.create')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch event_type" data-size="sm" value="create stores" name="permission[]"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.edit')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch event_type" data-size="sm" value="update stores" name="permission[]"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.show')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch event_type" data-size="sm" value="show stores" name="permission[]"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.delete')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch event_type" data-size="sm" value="delete stores" name="permission[]"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
{{--                                            @endcan--}}

{{--                                            @can('show categories')--}}
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="div-style-group">
                                                    <div class="form-group padding-bottom">
                                                        <h4 class="text-bold-600 pull-left">{{__('admin.categories')}}</h4>
                                                    </div>
                                                    <hr>
                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.create')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch event_type" data-size="sm" value="create categories" name="permission[]"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.edit')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch event_type" data-size="sm" value="update categories" name="permission[]"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.show')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch event_type" data-size="sm" value="show categories" name="permission[]"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.delete')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch event_type" data-size="sm" value="delete categories" name="permission[]"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
{{--                                            @endcan--}}



{{--                                            @can('show units')--}}
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="div-style-group">
                                                    <div class="form-group padding-bottom">
                                                        <h4 class="text-bold-600 pull-left">{{__('admin.units')}}</h4>
                                                    </div>
                                                    <hr>
                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.create')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch event_type" data-size="sm" value="create units" name="permission[]"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.edit')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch event_type" data-size="sm" value="update units" name="permission[]"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.show')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch event_type" data-size="sm" value="show units" name="permission[]"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.delete')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch event_type" data-size="sm" value="delete units" name="permission[]"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
{{--                                            @endcan--}}

{{--                                            @can('show product')--}}
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="div-style-group">
                                                    <div class="form-group padding-bottom">
                                                        <h4 class="text-bold-600 pull-left">{{__('admin.product')}}</h4>
                                                    </div>
                                                    <hr>
                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.create')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch event_type" data-size="sm" value="create product" name="permission[]"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.edit')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch event_type" data-size="sm" value="update product" name="permission[]"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.show')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch event_type" data-size="sm" value="show product" name="permission[]"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.delete')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch event_type" data-size="sm" value="delete product" name="permission[]"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
{{--                                            @endcan--}}

{{--                                            @can('show inventory_management')--}}
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="div-style-group">
                                                    <div class="form-group padding-bottom">
                                                        <h4 class="text-bold-600 pull-left">{{__('admin.inventory_management')}}</h4>
                                                    </div>
                                                    <hr>

                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.edit')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch event_type" data-size="sm" value="update inventory_management" name="permission[]"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.show')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch event_type" data-size="sm" value="show inventory_management" name="permission[]"/>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
{{--                                            @endcan--}}

                                        {{--                                            @can('show category_movement')--}}
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="div-style-group">
                                                <div class="form-group padding-bottom">
                                                    <h4 class="text-bold-600 pull-left">{{__('admin.category_movement')}}</h4>
                                                </div>
                                                <hr>


                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.show')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch event_type" data-size="sm" value="show category_movement" name="permission[]"/>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        {{--                                            @endcan--}}

{{--                                            @can('show suppliers')--}}
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="div-style-group">
                                                    <div class="form-group padding-bottom">
                                                        <h4 class="text-bold-600 pull-left">{{__('admin.suppliers')}}</h4>
                                                    </div>
                                                    <hr>
                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.create')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch event_type" data-size="sm" value="create suppliers" name="permission[]"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.edit')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch event_type" data-size="sm" value="update suppliers" name="permission[]"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.show')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch event_type" data-size="sm" value="show suppliers" name="permission[]"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.delete')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch event_type" data-size="sm" value="delete suppliers" name="permission[]"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
{{--                                            @endcan--}}





{{--                                                        @can('show purchases_invoice')--}}
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="div-style-group">
                                                    <div class="form-group padding-bottom">
                                                        <h4 class="text-bold-600 pull-left">{{__('admin.purchases_invoice')}}</h4>
                                                    </div>
                                                    <hr>
                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.create')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch event_type" data-size="sm" value="create purchases_invoice" name="permission[]"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.edit')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch event_type" data-size="sm" value="update purchases_invoice" name="permission[]"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.show')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch event_type" data-size="sm" value="show purchases_invoice" name="permission[]"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.delete')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch event_type" data-size="sm" value="delete purchases_invoice" name="permission[]"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
{{--                                            @endcan--}}




{{--                                                @can('show customer')--}}
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="div-style-group">
                                                    <div class="form-group padding-bottom">
                                                        <h4 class="text-bold-600 pull-left">{{__('admin.customer')}}</h4>
                                                    </div>
                                                    <hr>
                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.create')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch event_type" data-size="sm" value="create customer" name="permission[]"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.edit')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch event_type" data-size="sm" value="update customer" name="permission[]"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.show')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch event_type" data-size="sm" value="show customer" name="permission[]"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.delete')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch event_type" data-size="sm" value="delete customer" name="permission[]"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
{{--                                            @endcan--}}

                                        {{--                                                            @can('show sale_representative')--}}
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="div-style-group">
                                                <div class="form-group padding-bottom">
                                                    <h4 class="text-bold-600 pull-left">{{__('admin.sale_representatives')}}</h4>
                                                </div>
                                                <hr>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.create')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch event_type" data-size="sm" value="create sale_representative" name="permission[]"/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.edit')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch event_type" data-size="sm" value="update sale_representative" name="permission[]"/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.show')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch event_type" data-size="sm" value="show sale_representative" name="permission[]"/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.delete')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch event_type" data-size="sm" value="delete sale_representative" name="permission[]"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{--                                            @endcan--}}

{{--                                                            @can('show sales_invoice')--}}
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="div-style-group">
                                                    <div class="form-group padding-bottom">
                                                        <h4 class="text-bold-600 pull-left">{{__('admin.sales_invoice')}}</h4>
                                                    </div>
                                                    <hr>
                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.create')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch event_type" data-size="sm" value="create sales_invoice" name="permission[]"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.edit')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch event_type" data-size="sm" value="update sales_invoice" name="permission[]"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.show')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch event_type" data-size="sm" value="show sales_invoice" name="permission[]"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label class="font-medium-2 text-bold-500 mr-1">{{__('admin.delete')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch event_type" data-size="sm" value="delete sales_invoice" name="permission[]"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
{{--                                            @endcan--}}




{{--                                            @can('show audit')--}}
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="div-style-group">
                                                    <h4 class="text-bold-600">{{__('admin.audit')}}</h4>
                                                    <hr>
                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label for="js-switchSize12"
                                                                   class="font-medium-2 text-bold-500 mr-1">{{__('admin.show')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch" data-size="sm"
                                                                   value="show audit" name="permission[]"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
{{--                                            @endcan--}}
{{--                                            @can('show permission')--}}
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="div-style-group">
                                                    <h4 class="text-bold-600">{{__('admin.permission')}}</h4>
                                                    <hr>
                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label for="js-switchSize12"
                                                                   class="font-medium-2 text-bold-500 mr-1">{{__('admin.create')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch" data-size="sm"
                                                                   value="create permission" name="permission[]"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label for="js-switchSize12"
                                                                   class="font-medium-2 text-bold-500 mr-1">{{__('admin.edit')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch" data-size="sm"
                                                                   value="update permission" name="permission[]"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label for="js-switchSize12"
                                                                   class="font-medium-2 text-bold-500 mr-1">{{__('admin.show')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch" data-size="sm"
                                                                   value="show permission" name="permission[]"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label for="js-switchSize12"
                                                                   class="font-medium-2 text-bold-500 mr-1">{{__('admin.delete')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch" data-size="sm"
                                                                   value="delete permission" name="permission[]"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
{{--                                            @endcan--}}

                                        </div>
                                </div>

                            </div>
                            <div class="form-actions">
                                <button type="submit"
                                        class="btn btn-outline-blue-grey btn-min-width btn-glow mr-1 mb-1"
                                        id="button_save" >
                                    <i class="ft ft-save"></i> {{__('admin.save')}}
                                </button>
                                <a href="{{ url('/file/permission')}}"
                                   class="btn btn-outline-danger btn-min-width btn-glow mr-1 mb-1">
                                    <i class="ft-x"></i> {{__('admin.cancel')}}
                                </a>
                            </div>

                                </div>


                    </form>
                </div>

                </div>
            </div>
        </div>

        <!-- // Form actions layout section end -->
    </div>
@endsection
@section('script')
    <script src="{{asset('js/switchery.min.js')}}"></script>
    <script>
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        elems.forEach(function (html) {
            var switchery = new Switchery(html, {size: 'small'});
        });
        var special = document.querySelectorAll('.js-switch')
            , specialButton = document.querySelector('.select-all');
        specialButton.addEventListener('change', function (e) {
            if (specialButton.checked) {
                special.forEach(function (html) {
                    html.checked = true;
                    onChange(html);
                });
            } else {
                special.forEach(function (html) {
                    html.checked = false;
                    onChange(html);
                });
            }
        });

        function onChange(el) {
            if (typeof Event === 'function' || !document.fireEvent) {
                var event = document.createEvent('HTMLEvents');
                event.initEvent('change', true, true);
                el.dispatchEvent(event);
            } else {
                el.fireEvent('onchange');
            }
        }
    </script>
    <script>
        $(document).on('click', '#button_save', function () {
            document.getElementById('my_form_id').submit();
            $('#button_save').attr('disabled', true);
        });
        /*start message save*/
        $('#messageSave').modal('show');
        setTimeout(function () {
            $('#messageSave').modal('hide');
        }, 3000);
        /*end  message save*/
    </script>
    <script src="{{asset('app-assets/vendors/js/forms/icheck/icheck.min.js')}}"></script>
    <script src="{{asset('app-assets/js/scripts/forms/checkbox-radio.js')}}"></script>
@endsection
