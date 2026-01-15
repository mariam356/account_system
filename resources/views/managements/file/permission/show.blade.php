@php($page_title = __('admin.permission'))
@extends('layouts.main')
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
                            <li class="breadcrumb-item"><a href="#">{{__('admin.show')}}</a>
                            </li>
                            <li class="breadcrumb-item active"><a
                                    href="{{route('permission')}}">{{__('admin.permission')}}</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>

        </div>
        <div class="card">
            <div class="card-head">
            </div>
            <div class="card-content">
                <div class="card-body">
                    <table class="table ">
                        <thead>
                        <tr>
                            <th>{{__('admin.screen')}}</th>
                            <th>{{__('admin.show')}}</th>
                            <th>{{__('admin.create')}}</th>
                            <th>{{__('admin.edit')}}</th>
                            <th>{{__('admin.delete')}}</th>
                            <th>{{__('admin.report')}}</th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                            <th>{{__('admin.Dashboard')}}</th>
                            <td>
                                @for($i=0;$i<count($permission);$i++)
                                    @if($permission[$i]=='show dashboard')
                                        <i class="ft-check"
                                           style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                    @endif
                                @endfor
                            </td>
                            <td>_______</td>
                            <td>_______</td>
                            <td>_______</td>
                            <td>_______</td>
                        </tr>

{{--                        @can('show user')--}}
                            <tr>
                                <th>{{__('admin.user')}}</th>
                                <td>
                                    @for($i=0;$i<count($permission);$i++)
                                        @if($permission[$i]=='show user')
                                            <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                        @endif
                                    @endfor
                                </td>
                                <td>
                                    @for($i=0;$i<count($permission);$i++)
                                        @if($permission[$i]=='create user')
                                            <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                        @endif
                                    @endfor
                                </td>
                                <td>
                                    @for($i=0;$i<count($permission);$i++)
                                        @if($permission[$i]=='update user')
                                            <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                        @endif
                                    @endfor
                                </td>
                                <td>
                                    @for($i=0;$i<count($permission);$i++)
                                        @if($permission[$i]=='delete user')
                                            <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                        @endif
                                    @endfor
                                </td>
                                <td>_______</td>
                            </tr>
{{--                        @endcan--}}





{{--                        @can('show backup')--}}
                            <tr>
                                <th>{{__('admin.backup')}}</th>
                                <td>
                                    @for($i=0;$i<count($permission);$i++)
                                        @if($permission[$i]=='show backup')
                                            <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                        @endif
                                    @endfor
                                </td>
                                <td>
                                    @for($i=0;$i<count($permission);$i++)
                                        @if($permission[$i]=='create backup')
                                            <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                        @endif
                                    @endfor
                                </td>
                                <td>
                                    @for($i=0;$i<count($permission);$i++)
                                        @if($permission[$i]=='update backup')
                                            <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                        @endif
                                    @endfor
                                </td>
                                <td>
                                    @for($i=0;$i<count($permission);$i++)
                                        @if($permission[$i]=='delete backup')
                                            <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                        @endif
                                    @endfor
                                </td>
                                <td>_______</td>
                            </tr>
{{--                        @endcan--}}


{{--                        @can('show branch')--}}
                            <tr>
                                <th>{{__('admin.branch')}}</th>
                                <td>
                                    @for($i=0;$i<count($permission);$i++)
                                        @if($permission[$i]=='show branch')
                                            <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                        @endif
                                    @endfor
                                </td>
                                <td>
                                    @for($i=0;$i<count($permission);$i++)
                                        @if($permission[$i]=='create branch')
                                            <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                        @endif
                                    @endfor
                                </td>
                                <td>
                                    @for($i=0;$i<count($permission);$i++)
                                        @if($permission[$i]=='update branch')
                                            <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                        @endif
                                    @endfor
                                </td>
                                <td>
                                    @for($i=0;$i<count($permission);$i++)
                                        @if($permission[$i]=='delete branch')
                                            <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                        @endif
                                    @endfor
                                </td>
                                <td>_______</td>
                            </tr>
{{--                        @endcan--}}

{{--                        @can('show fund')--}}
                            <tr>
                                <th>{{__('admin.fund')}}</th>
                                <td>
                                    @for($i=0;$i<count($permission);$i++)
                                        @if($permission[$i]=='show fund')
                                            <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                        @endif
                                    @endfor
                                </td>
                                <td>
                                    @for($i=0;$i<count($permission);$i++)
                                        @if($permission[$i]=='create fund')
                                            <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                        @endif
                                    @endfor
                                </td>
                                <td>
                                    @for($i=0;$i<count($permission);$i++)
                                        @if($permission[$i]=='update fund')
                                            <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                        @endif
                                    @endfor
                                </td>
                                <td>
                                    @for($i=0;$i<count($permission);$i++)
                                        @if($permission[$i]=='delete fund')
                                            <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                        @endif
                                    @endfor
                                </td>
                                <td>_______</td>
                            </tr>
{{--                        @endcan--}}



{{--                        @can('show bank')--}}
                            <tr>
                                <th>{{__('admin.bank')}}</th>
                                <td>
                                    @for($i=0;$i<count($permission);$i++)
                                        @if($permission[$i]=='show bank')
                                            <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                        @endif
                                    @endfor
                                </td>
                                <td>
                                    @for($i=0;$i<count($permission);$i++)
                                        @if($permission[$i]=='create bank')
                                            <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                        @endif
                                    @endfor
                                </td>
                                <td>
                                    @for($i=0;$i<count($permission);$i++)
                                        @if($permission[$i]=='update bank')
                                            <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                        @endif
                                    @endfor
                                </td>
                                <td>
                                    @for($i=0;$i<count($permission);$i++)
                                        @if($permission[$i]=='delete bank')
                                            <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                        @endif
                                    @endfor
                                </td>
                                <td>_______</td>
                            </tr>
{{--                        @endcan--}}

                        <!-- Continue with all other permissions following the same pattern -->
{{--                        @can('show currency')--}}
                            <tr>
                                <th>{{__('admin.currency')}}</th>
                                <td>
                                    @for($i=0;$i<count($permission);$i++)
                                        @if($permission[$i]=='show currency')
                                            <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                        @endif
                                    @endfor
                                </td>
                                <td>
                                    @for($i=0;$i<count($permission);$i++)
                                        @if($permission[$i]=='create currency')
                                            <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                        @endif
                                    @endfor
                                </td>
                                <td>
                                    @for($i=0;$i<count($permission);$i++)
                                        @if($permission[$i]=='update currency')
                                            <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                        @endif
                                    @endfor
                                </td>
                                <td>
                                    @for($i=0;$i<count($permission);$i++)
                                        @if($permission[$i]=='delete currency')
                                            <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                        @endif
                                    @endfor
                                </td>

                                <td>_______</td>
                            </tr>
{{--                        @endcan--}}



{{--                        @can('show account')--}}
                            <tr>
                                <th>{{__('admin.accounting_guide')}}</th>
                                <td>
                                    @for($i=0;$i<count($permission);$i++)
                                        @if($permission[$i]=='show account')
                                            <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                        @endif
                                    @endfor
                                </td>
                                <td>
                                    @for($i=0;$i<count($permission);$i++)
                                        @if($permission[$i]=='create account')
                                            <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                        @endif
                                    @endfor
                                </td>
                                <td>
                                    @for($i=0;$i<count($permission);$i++)
                                        @if($permission[$i]=='update account')
                                            <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                        @endif
                                    @endfor
                                </td>
                                <td>
                                    @for($i=0;$i<count($permission);$i++)
                                        @if($permission[$i]=='delete account')
                                            <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                        @endif
                                    @endfor
                                </td>
                                <td>
                                    @for($i=0;$i<count($permission);$i++)
                                        @if($permission[$i]=='report account')
                                            <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                        @endif
                                    @endfor
                                </td>
                            </tr>
{{--                        @endcan--}}


                        {{--                        @can('show journal')--}}
                        <tr>
                            <th>{{__('admin.journal')}}</th>
                            <td>
                                @for($i=0;$i<count($permission);$i++)
                                    @if($permission[$i]=='show journal')
                                        <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                    @endif
                                @endfor
                            </td>
                            <td>
                                @for($i=0;$i<count($permission);$i++)
                                    @if($permission[$i]=='create journal')
                                        <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                    @endif
                                @endfor
                            </td>
                            <td>
                                @for($i=0;$i<count($permission);$i++)
                                    @if($permission[$i]=='update journal')
                                        <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                    @endif
                                @endfor
                            </td>
                            <td>
                                @for($i=0;$i<count($permission);$i++)
                                    @if($permission[$i]=='delete journal')
                                        <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                    @endif
                                @endfor
                            </td>
                            <td>
                                @for($i=0;$i<count($permission);$i++)
                                    @if($permission[$i]=='report journal')
                                        <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                    @endif
                                @endfor
                            </td>
                        </tr>
                        {{--                        @endcan--}}

                        {{--                        @can('show exchange_bond')--}}
                        <tr>
                            <th>{{__('admin.exchange_bond')}}</th>
                            <td>
                                @for($i=0;$i<count($permission);$i++)
                                    @if($permission[$i]=='show exchange_bond')
                                        <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                    @endif
                                @endfor
                            </td>
                            <td>
                                @for($i=0;$i<count($permission);$i++)
                                    @if($permission[$i]=='create exchange_bond')
                                        <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                    @endif
                                @endfor
                            </td>
                            <td>
                                @for($i=0;$i<count($permission);$i++)
                                    @if($permission[$i]=='update exchange_bond')
                                        <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                    @endif
                                @endfor
                            </td>
                            <td>
                                @for($i=0;$i<count($permission);$i++)
                                    @if($permission[$i]=='delete exchange_bond')
                                        <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                    @endif
                                @endfor
                            </td>
                            <td>
                                @for($i=0;$i<count($permission);$i++)
                                    @if($permission[$i]=='report exchange_bond')
                                        <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                    @endif
                                @endfor
                            </td>
                        </tr>
                        {{--                        @endcan--}}


                        {{--                        @can('show receive_bond')--}}
                        <tr>
                            <th>{{__('admin.receive_bond')}}</th>
                            <td>
                                @for($i=0;$i<count($permission);$i++)
                                    @if($permission[$i]=='show receive_bond')
                                        <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                    @endif
                                @endfor
                            </td>
                            <td>
                                @for($i=0;$i<count($permission);$i++)
                                    @if($permission[$i]=='create receive_bond')
                                        <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                    @endif
                                @endfor
                            </td>
                            <td>
                                @for($i=0;$i<count($permission);$i++)
                                    @if($permission[$i]=='update receive_bond')
                                        <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                    @endif
                                @endfor
                            </td>
                            <td>
                                @for($i=0;$i<count($permission);$i++)
                                    @if($permission[$i]=='delete receive_bond')
                                        <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                    @endif
                                @endfor
                            </td>
                            <td>
                                @for($i=0;$i<count($permission);$i++)
                                    @if($permission[$i]=='report receive_bond')
                                        <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                    @endif
                                @endfor
                            </td>
                        </tr>
                        {{--                        @endcan--}}


                        {{--                        @can('show account_statement')--}}
                        <tr>
                            <th>{{__('admin.account_statement')}}</th>
                            <td>
                                @for($i=0;$i<count($permission);$i++)
                                    @if($permission[$i]=='show account_statement')
                                        <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                    @endif
                                @endfor
                            </td>
                            <td>_______</td>
                            <td>_______</td>
                            <td>_______</td>
                            <td>
                                @for($i=0;$i<count($permission);$i++)
                                    @if($permission[$i]=='report account_statement')
                                        <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                    @endif
                                @endfor
                            </td>
                        </tr>
                        {{--                        @endcan--}}

                        {{--                        @can('show trial_balance')--}}
                        <tr>
                            <th>{{__('admin.trial_balance')}}</th>
                            <td>
                                @for($i=0;$i<count($permission);$i++)
                                    @if($permission[$i]=='show trial_balance')
                                        <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                    @endif
                                @endfor
                            </td>
                            <td>_______</td>
                            <td>_______</td>
                            <td>_______</td>
                            <td>
                                @for($i=0;$i<count($permission);$i++)
                                    @if($permission[$i]=='report trial_balance')
                                        <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                    @endif
                                @endfor
                            </td>
                        </tr>
                        {{--                        @endcan--}}

                        {{--                        @can('show balance_sheet')--}}
                        <tr>
                            <th>{{__('admin.balance_sheet')}}</th>
                            <td>
                                @for($i=0;$i<count($permission);$i++)
                                    @if($permission[$i]=='show balance_sheet')
                                        <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                    @endif
                                @endfor
                            </td>
                            <td>_______</td>
                            <td>_______</td>
                            <td>_______</td>
                            <td>
                                @for($i=0;$i<count($permission);$i++)
                                    @if($permission[$i]=='report balance_sheet')
                                        <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                    @endif
                                @endfor
                            </td>
                        </tr>
                        {{--                        @endcan--}}

                        {{--                        @can('show profit_loss')--}}
                        <tr>
                            <th>{{__('admin.profit_loss')}}</th>
                            <td>
                                @for($i=0;$i<count($permission);$i++)
                                    @if($permission[$i]=='show profit_loss')
                                        <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                    @endif
                                @endfor
                            </td>
                            <td>_______</td>
                            <td>_______</td>
                            <td>_______</td>
                            <td>
                                @for($i=0;$i<count($permission);$i++)
                                    @if($permission[$i]=='report profit_loss')
                                        <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                    @endif
                                @endfor
                            </td>
                        </tr>
                        {{--                        @endcan--}}


{{--                        @can('show stores')--}}
                            <tr>
                                <th>{{__('admin.stores')}}</th>
                                <td>
                                    @for($i=0;$i<count($permission);$i++)
                                        @if($permission[$i]=='show stores')
                                            <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                        @endif
                                    @endfor
                                </td>
                                <td>
                                    @for($i=0;$i<count($permission);$i++)
                                        @if($permission[$i]=='create stores')
                                            <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                        @endif
                                    @endfor
                                </td>
                                <td>
                                    @for($i=0;$i<count($permission);$i++)
                                        @if($permission[$i]=='update stores')
                                            <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                        @endif
                                    @endfor
                                </td>
                                <td>
                                    @for($i=0;$i<count($permission);$i++)
                                        @if($permission[$i]=='delete stores')
                                            <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                        @endif
                                    @endfor
                                </td>
                                <td>_______</td>
                            </tr>
{{--                        @endcan--}}

{{--                        @can('show categories')--}}
                            <tr>
                                <th>{{__('admin.categories')}}</th>
                                <td>
                                    @for($i=0;$i<count($permission);$i++)
                                        @if($permission[$i]=='show categories')
                                            <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                        @endif
                                    @endfor
                                </td>
                                <td>
                                    @for($i=0;$i<count($permission);$i++)
                                        @if($permission[$i]=='create categories')
                                            <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                        @endif
                                    @endfor
                                </td>
                                <td>
                                    @for($i=0;$i<count($permission);$i++)
                                        @if($permission[$i]=='update categories')
                                            <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                        @endif
                                    @endfor
                                </td>
                                <td>
                                    @for($i=0;$i<count($permission);$i++)
                                        @if($permission[$i]=='delete categories')
                                            <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                        @endif
                                    @endfor
                                </td>
                                <td>_______</td>
                            </tr>
{{--                        @endcan--}}





{{--                        @can('show units')--}}
                            <tr>
                                <th>{{__('admin.units')}}</th>
                                <td>
                                    @for($i=0;$i<count($permission);$i++)
                                        @if($permission[$i]=='show units')
                                            <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                        @endif
                                    @endfor
                                </td>
                                <td>
                                    @for($i=0;$i<count($permission);$i++)
                                        @if($permission[$i]=='create units')
                                            <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                        @endif
                                    @endfor
                                </td>
                                <td>
                                    @for($i=0;$i<count($permission);$i++)
                                        @if($permission[$i]=='update units')
                                            <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                        @endif
                                    @endfor
                                </td>
                                <td>
                                    @for($i=0;$i<count($permission);$i++)
                                        @if($permission[$i]=='delete units')
                                            <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                        @endif
                                    @endfor
                                </td>
                                <td>_______</td>
                            </tr>
{{--                        @endcan--}}

                        {{--                        @can('show product')--}}
                        <tr>
                            <th>{{__('admin.product')}}</th>
                            <td>
                                @for($i=0;$i<count($permission);$i++)
                                    @if($permission[$i]=='show product')
                                        <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                    @endif
                                @endfor
                            </td>
                            <td>
                                @for($i=0;$i<count($permission);$i++)
                                    @if($permission[$i]=='create product')
                                        <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                    @endif
                                @endfor
                            </td>
                            <td>
                                @for($i=0;$i<count($permission);$i++)
                                    @if($permission[$i]=='update product')
                                        <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                    @endif
                                @endfor
                            </td>
                            <td>
                                @for($i=0;$i<count($permission);$i++)
                                    @if($permission[$i]=='delete product')
                                        <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                    @endif
                                @endfor
                            </td>
                            <td>_______</td>
                        </tr>
                        {{--                        @endcan--}}


                        {{--                        @can('show inventory_management')--}}
                        <tr>
                            <th>{{__('admin.inventory_management')}}</th>
                            <td>
                                @for($i=0;$i<count($permission);$i++)
                                    @if($permission[$i]=='show inventory_management')
                                        <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                    @endif
                                @endfor
                            </td>
                            <td>_______</td>
                            <td>
                                @for($i=0;$i<count($permission);$i++)
                                    @if($permission[$i]=='update inventory_management')
                                        <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                    @endif
                                @endfor
                            </td>
                            <td>_______</td>

                            <td>_______</td>
                        </tr>
                        {{--                        @endcan--}}


                        {{--                        @can('show category_movement')--}}
                        <tr>
                            <th>{{__('admin.category_movement')}}</th>
                            <td>
                                @for($i=0;$i<count($permission);$i++)
                                    @if($permission[$i]=='show category_movement')
                                        <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                    @endif
                                @endfor
                            </td>
                            <td>_______</td>
                            <td>_______</td>
                            <td>_______</td>

                            <td>_______</td>
                        </tr>
                        {{--                        @endcan--}}


{{--                        @can('show suppliers')--}}
                            <tr>
                                <th>{{__('admin.suppliers')}}</th>
                                <td>
                                    @for($i=0;$i<count($permission);$i++)
                                        @if($permission[$i]=='show suppliers')
                                            <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                        @endif
                                    @endfor
                                </td>
                                <td>
                                    @for($i=0;$i<count($permission);$i++)
                                        @if($permission[$i]=='create suppliers')
                                            <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                        @endif
                                    @endfor
                                </td>
                                <td>
                                    @for($i=0;$i<count($permission);$i++)
                                        @if($permission[$i]=='update suppliers')
                                            <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                        @endif
                                    @endfor
                                </td>
                                <td>
                                    @for($i=0;$i<count($permission);$i++)
                                        @if($permission[$i]=='delete suppliers')
                                            <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                        @endif
                                    @endfor
                                </td>
                                <td>_______</td>
                            </tr>
{{--                        @endcan--}}



{{--                        @can('show purchases_invoice')--}}
                            <tr>
                                <th>{{__('admin.purchases_invoice')}}</th>
                                <td>
                                    @for($i=0;$i<count($permission);$i++)
                                        @if($permission[$i]=='show purchases_invoice')
                                            <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                        @endif
                                    @endfor
                                </td>
                                <td>
                                    @for($i=0;$i<count($permission);$i++)
                                        @if($permission[$i]=='create purchases_invoice')
                                            <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                        @endif
                                    @endfor
                                </td>
                                <td>
                                    @for($i=0;$i<count($permission);$i++)
                                        @if($permission[$i]=='update purchases_invoice')
                                            <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                        @endif
                                    @endfor
                                </td>
                                <td>
                                    @for($i=0;$i<count($permission);$i++)
                                        @if($permission[$i]=='delete purchases_invoice')
                                            <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                        @endif
                                    @endfor
                                </td>
                                <td>_______</td>
                            </tr>
{{--                        @endcan--}}


{{--                        @can('show customer')--}}
                            <tr>
                                <th>{{__('admin.customer')}}</th>
                                <td>
                                    @for($i=0;$i<count($permission);$i++)
                                        @if($permission[$i]=='show customer')
                                            <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                        @endif
                                    @endfor
                                </td>
                                <td>
                                    @for($i=0;$i<count($permission);$i++)
                                        @if($permission[$i]=='create customer')
                                            <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                        @endif
                                    @endfor
                                </td>
                                <td>
                                    @for($i=0;$i<count($permission);$i++)
                                        @if($permission[$i]=='update customer')
                                            <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                        @endif
                                    @endfor
                                </td>
                                <td>
                                    @for($i=0;$i<count($permission);$i++)
                                        @if($permission[$i]=='delete customer')
                                            <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                        @endif
                                    @endfor
                                </td>
                                <td>_______</td>
                            </tr>
{{--                        @endcan--}}

                        {{--                        @can('show sale_representative')--}}
                        <tr>
                            <th>{{__('admin.sale_representatives')}}</th>
                            <td>
                                @for($i=0;$i<count($permission);$i++)
                                    @if($permission[$i]=='show sale_representative')
                                        <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                    @endif
                                @endfor
                            </td>
                            <td>
                                @for($i=0;$i<count($permission);$i++)
                                    @if($permission[$i]=='create sale_representative')
                                        <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                    @endif
                                @endfor
                            </td>
                            <td>
                                @for($i=0;$i<count($permission);$i++)
                                    @if($permission[$i]=='update sale_representative')
                                        <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                    @endif
                                @endfor
                            </td>
                            <td>
                                @for($i=0;$i<count($permission);$i++)
                                    @if($permission[$i]=='delete sale_representative')
                                        <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                    @endif
                                @endfor
                            </td>
                            <td>_______</td>
                        </tr>
                        {{--                        @endcan--}}

                        {{--                        @can('show sales_invoice')--}}
                        <tr>
                            <th>{{__('admin.sales_invoice')}}</th>
                            <td>
                                @for($i=0;$i<count($permission);$i++)
                                    @if($permission[$i]=='show sales_invoice')
                                        <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                    @endif
                                @endfor
                            </td>
                            <td>
                                @for($i=0;$i<count($permission);$i++)
                                    @if($permission[$i]=='create sales_invoice')
                                        <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                    @endif
                                @endfor
                            </td>
                            <td>
                                @for($i=0;$i<count($permission);$i++)
                                    @if($permission[$i]=='update sales_invoice')
                                        <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                    @endif
                                @endfor
                            </td>
                            <td>
                                @for($i=0;$i<count($permission);$i++)
                                    @if($permission[$i]=='delete sales_invoice')
                                        <i class="ft-check" style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                    @endif
                                @endfor
                            </td>
                            <td>_______</td>
                        </tr>
                        {{--                        @endcan--}}


{{--                        @can('show audit')--}}
                        <tr>
                            <th>{{__('admin.audit')}}</th>
                            <td>
                                @for($i=0;$i<count($permission);$i++)
                                    @if($permission[$i]=='show audit')
                                        <i class="ft-check"
                                           style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                    @endif
                                @endfor
                            </td>
                            <td>_______</td>
                            <td>_______</td>
                            <td>_______</td>
                            <td>_______</td>
                        </tr>
{{--                        @endcan--}}

{{--                        @can('show permission')--}}
                        <tr>
                            <th>{{__('admin.permission')}}</th>
                            <td>
                                @for($i=0;$i<count($permission);$i++)
                                    @if($permission[$i]=='show permission')
                                        <i class="ft-check"
                                           style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                    @endif
                                @endfor
                            </td>
                            <td>
                                @for($i=0;$i<count($permission);$i++)
                                    @if($permission[$i]=='create permission')
                                        <i class="ft-check"
                                           style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                    @endif
                                @endfor
                            </td>
                            <td>
                                @for($i=0;$i<count($permission);$i++)
                                    @if($permission[$i]=='update permission')
                                        <i class="ft-check"
                                           style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                    @endif
                                @endfor
                            </td>
                            <td>
                                @for($i=0;$i<count($permission);$i++)
                                    @if($permission[$i]=='delete permission')
                                        <i class="ft-check"
                                           style="color: #18A367; font-weight: 600; font-size: 22px"></i>
                                    @endif
                                @endfor
                            </td>
                            <td>_______</td>
                        </tr>
{{--                        @endcan--}}


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
