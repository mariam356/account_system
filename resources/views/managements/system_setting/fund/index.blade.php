@php($page_title = __('admin.fund'))
@extends('layouts.main')

@section('content')

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row mb-1">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">{{__('admin.funds')}}</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">{{__('admin.Dashboard')}}</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">{{__('admin.show')}}</a>
                                </li>
                                <li class="breadcrumb-item active">{{__('admin.fund')}}
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
                            <h3 class="m-0">{{$data_count}}</h3><span class="text-muted">{{__('admin.funds')}}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">


                <!-- Form wizard with step validation section start -->
                @canany(['update fund', 'create fund'])
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                {{--                                <h4 class="card-title" id="horz-layout-colored-controls">{{__('admin.funds')}}</h4>--}}
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
                                            <h4 class="form-section"><i class='bx bxs-box bx-tada' ></i> {{__('admin.funds')}} </h4>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control"
                                                               for="name_ar">{{__('admin.name')}}  (ar)<span
                                                                class="danger">*</span></label>
                                                        <div class="col-md-9 mx-auto position-relative has-icon-left">
                                                            <input type="text" id="name_ar"
                                                                   class="form-control border-primary" name="name_ar">
                                                            <div class="form-control-position">
                                                                <i class="ft-user" style="color: #b92c81"></i>
                                                            </div>

                                                            <span class="error-message" style="color:red;">
                                                        <strong></strong>
                                                    </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control"
                                                               for="name_en">{{__('admin.name')}}  (en)<span
                                                                class="danger">*</span></label>
                                                        <div class="col-md-9 mx-auto position-relative has-icon-left">
                                                            <input type="text" id="name_en"
                                                                   class="form-control border-primary" name="name_en">
                                                            <div class="form-control-position">
                                                                <i class="ft-user" style="color: #b92c81"></i>
                                                            </div>

                                                            <span class="error-message" style="color:red;">
                                                        <strong></strong>
                                                    </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control"
                                                               for="account_id">{{__('admin.account_number')}}  <span
                                                                class="danger">*</span></label>
                                                        <div class="col-md-9 mx-auto position-relative has-icon-left">
                                                            <select class="form-control border-primary" id="account_id" required name="account_id">
                                                                <option value="">{{__('admin.select_option')}}</option>
                                                                @foreach($account as $accounts)
                                                                    <option value="{{$accounts->id}}">{{$accounts->acc_code}} - {{$accounts->name}}</option>
                                                                @endforeach

                                                            </select>
                                                            <div class="form-control-position">
                                                                <i class="ft-credit-card" style="color: #b92c81"></i>
                                                            </div>

                                                            <span class="error-message" style="color:red;">
                                                        <strong></strong>
                                                    </span>
                                                        </div>
                                                    </div>
                                                </div>
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
                @endcanany

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
                                        <th>#</th>
                                        <th>{{__('admin.name')}}</th>
                                        <th>{{__('admin.account_number')}}</th>

                                                                                    @canany(['update fund', 'delete fund'])
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
                                    @foreach($data as $fund)
                                        <tr>
                                            <td hidden>{{$fund->updated_at}}</td>
                                            <td>{{ $fund->id }}</td>
                                            <td>{{ $fund->name }}</td>
                                            <td>{{$fund->account->acc_code ?? ""}}</td>


                                                                                        @canany(['update fund', 'delete fund'])
                                            <td>
                                                {!! $fund->actions !!}
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

    @include('managements.system_setting.fund.js')

@endsection


