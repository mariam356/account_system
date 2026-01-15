@php($page_title = __('admin.permission'))
@extends('layouts.main')
<link rel="stylesheet" href="{{asset('css/switchery.min.css')}}"/>
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
                            <li class="breadcrumb-item"><a href="#">{{__('admin.edit')}}</a>
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

            <div class="col-md-12">
                <div class="card">
                    <form class="form" action="{{ route('permission.update',['id'=>$role->id])}}" method="POST"
                          id="my_form_id"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="card-header">
                            <input class="form-control col-md-8 col-sm-8 @error('role') is-invalid @enderror"
                                   value="{{$role->name}}" name="role" required
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
                                                    <h4 class="text-bold-600">{{__('admin.Dashboard')}}</h4>
                                                    <hr>
                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label for="js-switchSize12"
                                                                   class="font-medium-2 text-bold-500 mr-1">{{__('admin.show')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch" data-size="sm"
                                                                   value="show dashboard" name="permission[]"
                                                                   @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='show dashboard') checked @endif @endfor/>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
{{--                                        @endcan--}}



{{--                                        @can('show user')--}}
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="div-style-group">
                                                    <h4 class="text-bold-600">{{__('admin.user')}}</h4>
                                                    <hr>
                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label for="js-switchSize12"
                                                                   class="font-medium-2 text-bold-500 mr-1">{{__('admin.create')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch" data-size="sm"
                                                                   value="create user" name="permission[]"
                                                                   @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='create user') checked @endif @endfor/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label for="js-switchSize12"
                                                                   class="font-medium-2 text-bold-500 mr-1">{{__('admin.edit')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch" data-size="sm"
                                                                   value="update user" name="permission[]"
                                                                   @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='update user') checked @endif @endfor/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label for="js-switchSize12"
                                                                   class="font-medium-2 text-bold-500 mr-1">{{__('admin.show')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch" data-size="sm"
                                                                   value="show user" name="permission[]"
                                                                   @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='show user') checked @endif @endfor/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label for="js-switchSize12"
                                                                   class="font-medium-2 text-bold-500 mr-1">{{__('admin.delete')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch" data-size="sm"
                                                                   value="delete user" name="permission[]"
                                                                   @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='delete user') checked @endif @endfor/>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
{{--                                        @endcan--}}

{{--                                        @can('show backup')--}}
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="div-style-group">
                                                    <h4 class="text-bold-600">{{__('admin.backup')}}</h4>
                                                    <hr>
                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label for="js-switchSize12"
                                                                   class="font-medium-2 text-bold-500 mr-1">{{__('admin.create')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch" data-size="sm"
                                                                   value="create backup" name="permission[]"
                                                                   @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='create backup') checked @endif @endfor/>
                                                        </div>
                                                    </div>

                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label for="js-switchSize12"
                                                                   class="font-medium-2 text-bold-500 mr-1">{{__('admin.edit')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch" data-size="sm"
                                                                   value="update backup" name="permission[]"
                                                                   @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='update backup') checked @endif @endfor/>
                                                        </div>
                                                    </div>

                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label for="js-switchSize12"
                                                                   class="font-medium-2 text-bold-500 mr-1">{{__('admin.show')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch" data-size="sm"
                                                                   value="show backup" name="permission[]"
                                                                   @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='show backup') checked @endif @endfor/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label for="js-switchSize12"
                                                                   class="font-medium-2 text-bold-500 mr-1">{{__('admin.delete')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch" data-size="sm"
                                                                   value="delete backup" name="permission[]"
                                                                   @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='delete backup') checked @endif @endfor/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
{{--                                        @endcan--}}

{{--                                        @can('show branch')--}}
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="div-style-group">
                                                    <h4 class="text-bold-600">{{__('admin.branch')}}</h4>
                                                    <hr>
                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label for="js-switchSize12"
                                                                   class="font-medium-2 text-bold-500 mr-1">{{__('admin.create')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch" data-size="sm"
                                                                   value="create branch" name="permission[]"
                                                                   @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='create branch') checked @endif @endfor/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label for="js-switchSize12"
                                                                   class="font-medium-2 text-bold-500 mr-1">{{__('admin.edit')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch" data-size="sm"
                                                                   value="update branch" name="permission[]"
                                                                   @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='update branch') checked @endif @endfor/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label for="js-switchSize12"
                                                                   class="font-medium-2 text-bold-500 mr-1">{{__('admin.show')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch" data-size="sm"
                                                                   value="show branch" name="permission[]"
                                                                   @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='show branch') checked @endif @endfor/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label for="js-switchSize12"
                                                                   class="font-medium-2 text-bold-500 mr-1">{{__('admin.delete')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch" data-size="sm"
                                                                   value="delete branch" name="permission[]"
                                                                   @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='delete branch') checked @endif @endfor/>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
{{--                                        @endcan--}}


                                        {{--                                            @can('show fund')--}}
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="div-style-group">
                                                <h4 class="text-bold-600">{{__('admin.fund')}}</h4>
                                                <hr>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.create')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="create fund" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='create fund') checked @endif @endfor/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.edit')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="update fund" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='update fund') checked @endif @endfor/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.show')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="show fund" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='show fund') checked @endif @endfor/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.delete')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="delete fund" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='delete fund') checked @endif @endfor/>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        {{--                                            @endcan--}}




                                        {{--                                            @can('show bank')--}}
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="div-style-group">
                                                <h4 class="text-bold-600">{{__('admin.bank')}}</h4>
                                                <hr>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.create')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="create bank" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='create bank') checked @endif @endfor/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.edit')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="update bank" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='update bank') checked @endif @endfor/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.show')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="show bank" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='show bank') checked @endif @endfor/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.delete')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="delete bank" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='delete bank') checked @endif @endfor/>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        {{--                                            @endcan--}}

{{--                                        @can('show currency')--}}
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="div-style-group">
                                                    <h4 class="text-bold-600">{{__('admin.currency')}}</h4>
                                                    <hr>
                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label for="js-switchSize12"
                                                                   class="font-medium-2 text-bold-500 mr-1">{{__('admin.create')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch" data-size="sm"
                                                                   value="create currency" name="permission[]"
                                                                   @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='create currency') checked @endif @endfor/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label for="js-switchSize12"
                                                                   class="font-medium-2 text-bold-500 mr-1">{{__('admin.edit')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch" data-size="sm"
                                                                   value="update currency" name="permission[]"
                                                                   @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='update currency') checked @endif @endfor/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label for="js-switchSize12"
                                                                   class="font-medium-2 text-bold-500 mr-1">{{__('admin.show')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch" data-size="sm"
                                                                   value="show currency" name="permission[]"
                                                                   @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='show currency') checked @endif @endfor/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label for="js-switchSize12"
                                                                   class="font-medium-2 text-bold-500 mr-1">{{__('admin.delete')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch" data-size="sm"
                                                                   value="delete currency" name="permission[]"
                                                                   @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='delete currency') checked @endif @endfor/>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
{{--                                        @endcan--}}

{{--                                        @can('show account')--}}
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="div-style-group">
                                                    <h4 class="text-bold-600">{{__('admin.accounting_guide')}}</h4>
                                                    <hr>
                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label for="js-switchSize12"
                                                                   class="font-medium-2 text-bold-500 mr-1">{{__('admin.create')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch" data-size="sm"
                                                                   value="create account" name="permission[]"
                                                                   @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='create account') checked @endif @endfor/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label for="js-switchSize12"
                                                                   class="font-medium-2 text-bold-500 mr-1">{{__('admin.edit')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch" data-size="sm"
                                                                   value="update account" name="permission[]"
                                                                   @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='update account') checked @endif @endfor/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label for="js-switchSize12"
                                                                   class="font-medium-2 text-bold-500 mr-1">{{__('admin.show')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch" data-size="sm"
                                                                   value="show account" name="permission[]"
                                                                   @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='show account') checked @endif @endfor/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label for="js-switchSize12"
                                                                   class="font-medium-2 text-bold-500 mr-1">{{__('admin.delete')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch" data-size="sm"
                                                                   value="delete account" name="permission[]"
                                                                   @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='delete account') checked @endif @endfor/>
                                                        </div>

                                                    </div>

                                                    <div class="form-group padding-10">
                                                        <div class="pull-left">
                                                            <label for="js-switchSize12"
                                                                   class="font-medium-2 text-bold-500 mr-1">{{__('admin.report')}}</label>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input type="checkbox" class="js-switch" data-size="sm"
                                                                   value="report account" name="permission[]"
                                                                   @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='report account') checked @endif @endfor/>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
{{--                                        @endcan--}}


                                        {{--                                        @can('show journal')--}}
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="div-style-group">
                                                <h4 class="text-bold-600">{{__('admin.journal')}}</h4>
                                                <hr>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.create')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="create journal" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='create journal') checked @endif @endfor/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.edit')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="update journal" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='update journal') checked @endif @endfor/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.show')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="show journal" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='show journal') checked @endif @endfor/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.delete')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="delete journal" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='delete journal') checked @endif @endfor/>
                                                    </div>

                                                </div>

                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.report')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="report journal" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='report journal') checked @endif @endfor/>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                        {{--                                        @endcan--}}


                                        {{--                                        @can('show exchange_bond')--}}
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="div-style-group">
                                                <h4 class="text-bold-600">{{__('admin.exchange_bond')}}</h4>
                                                <hr>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.create')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="create exchange_bond" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='create exchange_bond') checked @endif @endfor/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.edit')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="update exchange_bond" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='update exchange_bond') checked @endif @endfor/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.show')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="show exchange_bond" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='show exchange_bond') checked @endif @endfor/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.delete')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="delete exchange_bond" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='delete exchange_bond') checked @endif @endfor/>
                                                    </div>

                                                </div>

                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.report')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="report exchange_bond" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='report exchange_bond') checked @endif @endfor/>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                        {{--                                        @endcan--}}

                                        {{--                                        @can('show receive_bond')--}}
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="div-style-group">
                                                <h4 class="text-bold-600">{{__('admin.receive_bond')}}</h4>
                                                <hr>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.create')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="create receive_bond" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='create receive_bond') checked @endif @endfor/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.edit')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="update receive_bond" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='update receive_bond') checked @endif @endfor/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.show')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="show receive_bond" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='show receive_bond') checked @endif @endfor/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.delete')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="delete receive_bond" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='delete receive_bond') checked @endif @endfor/>
                                                    </div>

                                                </div>

                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.report')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="report receive_bond" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='report receive_bond') checked @endif @endfor/>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                        {{--                                        @endcan--}}

                                        {{--                                        @can('show account_statement')--}}
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="div-style-group">
                                                <h4 class="text-bold-600">{{__('admin.account_statement')}}</h4>
                                                <hr>


                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.show')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="show account_statement" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='show account_statement') checked @endif @endfor/>
                                                    </div>
                                                </div>


                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.report')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="report account_statement" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='report account_statement') checked @endif @endfor/>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                        {{--                                        @endcan--}}

                                        {{--                                        @can('show trial_balance')--}}
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="div-style-group">
                                                <h4 class="text-bold-600">{{__('admin.trial_balance')}}</h4>
                                                <hr>


                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.show')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="show trial_balance" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='show trial_balance') checked @endif @endfor/>
                                                    </div>
                                                </div>


                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.report')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="report trial_balance" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='report trial_balance') checked @endif @endfor/>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                        {{--                                        @endcan--}}


                                        {{--                                        @can('show balance_sheet')--}}
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="div-style-group">
                                                <h4 class="text-bold-600">{{__('admin.balance_sheet')}}</h4>
                                                <hr>


                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.show')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="show balance_sheet" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='show balance_sheet') checked @endif @endfor/>
                                                    </div>
                                                </div>


                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.report')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="report balance_sheet" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='report balance_sheet') checked @endif @endfor/>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                        {{--                                        @endcan--}}

                                        {{--                                        @can('show profit_loss')--}}
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="div-style-group">
                                                <h4 class="text-bold-600">{{__('admin.profit_loss')}}</h4>
                                                <hr>


                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.show')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="show profit_loss" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='show profit_loss') checked @endif @endfor/>
                                                    </div>
                                                </div>


                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.report')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="report profit_loss" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='report profit_loss') checked @endif @endfor/>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                        {{--                                        @endcan--}}





{{--                                            @can('show stores')--}}
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="div-style-group">
                                                <h4 class="text-bold-600">{{__('admin.stores')}}</h4>
                                                <hr>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.create')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="create stores" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='create stores') checked @endif @endfor/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.edit')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="update stores" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='update stores') checked @endif @endfor/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.show')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="show stores" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='show stores') checked @endif @endfor/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.delete')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="delete stores" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='delete stores') checked @endif @endfor/>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
{{--                                            @endcan--}}


{{--                                            @can('show categories')--}}
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="div-style-group">
                                                <h4 class="text-bold-600">{{__('admin.categories')}}</h4>
                                                <hr>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.create')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="create categories" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='create categories') checked @endif @endfor/>
                                                    </div>
                                                </div>

                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.edit')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="update categories" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='update categories') checked @endif @endfor/>
                                                    </div>
                                                </div>

                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.show')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="show categories" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='show categories') checked @endif @endfor/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.delete')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="delete categories" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='delete categories') checked @endif @endfor/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
{{--                                            @endcan--}}



{{--                                            @can('show units')--}}
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="div-style-group">
                                                <h4 class="text-bold-600">{{__('admin.units')}}</h4>
                                                <hr>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.create')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="create units" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='create units') checked @endif @endfor/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.edit')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="update units" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='update units') checked @endif @endfor/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.show')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="show units" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='show units') checked @endif @endfor/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.delete')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="delete units" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='delete units') checked @endif @endfor/>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
{{--                                            @endcan--}}

{{--                                            @can('show product')--}}
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="div-style-group">
                                                <h4 class="text-bold-600">{{__('admin.product')}}</h4>
                                                <hr>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.create')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="create product" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='create product') checked @endif @endfor/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.edit')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="update product" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='update product') checked @endif @endfor/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.show')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="show product" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='show product') checked @endif @endfor/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.delete')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="delete product" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='delete product') checked @endif @endfor/>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
{{--                                            @endcan--}}


{{--                                            @can('show inventory_management')--}}
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="div-style-group">
                                                <h4 class="text-bold-600">{{__('admin.inventory_management')}}</h4>
                                                <hr>

                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.edit')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="update inventory_management" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='update inventory_management') checked @endif @endfor/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.show')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="show inventory_management" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='show inventory_management') checked @endif @endfor/>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
{{--                                            @endcan--}}


                                        {{--                                            @can('show category_movement')--}}
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="div-style-group">
                                                <h4 class="text-bold-600">{{__('admin.category_movement')}}</h4>
                                                <hr>

                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.show')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="show category_movement" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='show category_movement') checked @endif @endfor/>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                        {{--                                            @endcan--}}





{{--                                            @can('show suppliers')--}}
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="div-style-group">
                                                <h4 class="text-bold-600">{{__('admin.suppliers')}}</h4>
                                                <hr>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.create')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="create suppliers" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='create suppliers') checked @endif @endfor/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.edit')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="update suppliers" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='update suppliers') checked @endif @endfor/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.show')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="show suppliers" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='show suppliers') checked @endif @endfor/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.delete')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="delete suppliers" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='delete suppliers') checked @endif @endfor/>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
{{--                                            @endcan--}}



{{--                                            @can('show purchases_invoice')--}}
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="div-style-group">
                                                <h4 class="text-bold-600">{{__('admin.purchases_invoice')}}</h4>
                                                <hr>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.create')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="create purchases_invoice" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='create purchases_invoice') checked @endif @endfor/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.edit')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="update purchases_invoice" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='update purchases_invoice') checked @endif @endfor/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.show')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="show purchases_invoice" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='show purchases_invoice') checked @endif @endfor/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.delete')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="delete purchases_invoice" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='delete purchases_invoice') checked @endif @endfor/>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
{{--                                            @endcan--}}



{{--                                            @can('show customer')--}}
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="div-style-group">
                                                <h4 class="text-bold-600">{{__('admin.customer')}}</h4>
                                                <hr>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.create')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="create customer" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='create customer') checked @endif @endfor/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.edit')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="update customer" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='update customer') checked @endif @endfor/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.show')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="show customer" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='show customer') checked @endif @endfor/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.delete')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="delete customer" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='delete customer') checked @endif @endfor/>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
{{--                                            @endcan--}}


                                        {{--                                            @can('show sale_representative')--}}
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="div-style-group">
                                                <h4 class="text-bold-600">{{__('admin.sale_representatives')}}</h4>
                                                <hr>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.create')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="create sale_representative" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='create sale_representative') checked @endif @endfor/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.edit')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="update sale_representative" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='update sale_representative') checked @endif @endfor/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.show')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="show sale_representative" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='show sale_representative') checked @endif @endfor/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.delete')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="delete sale_representative" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='delete sale_representative') checked @endif @endfor/>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        {{--                                            @endcan--}}


{{--                                            @can('show sales_invoice')--}}
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="div-style-group">
                                                <h4 class="text-bold-600">{{__('admin.sales_invoice')}}</h4>
                                                <hr>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.create')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="create sales_invoice" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='create sales_invoice') checked @endif @endfor/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.edit')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="update sales_invoice" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='update sales_invoice') checked @endif @endfor/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.show')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="show sales_invoice" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='show sales_invoice') checked @endif @endfor/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.delete')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="delete sales_invoice" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='delete sales_invoice') checked @endif @endfor/>
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
                                                               value="show audit" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='show audit') checked @endif @endfor/>
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
                                                               value="create permission" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='create permission') checked @endif @endfor/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.edit')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="update permission" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='update permission') checked @endif @endfor/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.show')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="show permission" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='show permission') checked @endif @endfor/>
                                                    </div>
                                                </div>
                                                <div class="form-group padding-10">
                                                    <div class="pull-left">
                                                        <label for="js-switchSize12"
                                                               class="font-medium-2 text-bold-500 mr-1">{{__('admin.delete')}}</label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <input type="checkbox" class="js-switch" data-size="sm"
                                                               value="delete permission" name="permission[]"
                                                               @for($i=0;$i<count($permission);$i++)@if($permission[$i]=='delete permission') checked @endif @endfor/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
{{--                                            @endcan--}}

                                    </div>
                                </div>
                                <div class="form-actions">
                                    <button type="submit"
                                            class="btn btn-outline-blue-grey btn-min-width btn-glow mr-1 mb-1"
                                            id="button_save" >
                                        <i class="ft ft-save"></i> {{__('admin.edit')}}
                                    </button>
                                    <a href="{{ url('/file/permission')}}"
                                       class="btn btn-outline-danger btn-min-width btn-glow mr-1 mb-1">
                                        <i class="ft-x"></i> {{__('admin.cancel')}}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
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
