@php($is_morris = 1)
@php($page_title = __('admin.Dashboard'))
@extends('layouts.main')
@section('content')


    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row mb-1">
            </div>
            <div class="content-body">
                <!-- Bank Stats -->
                <section id="bank-cards" class="bank-cards">
                    <div class="row match-height">
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                            <div class="card bank-card pull-up">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-5 text-left">
                                                <h3 class="mb-0">{{$product}}</h3>
                                                <p class="text-light">{{ __('admin.numbering')}}</p>
                                                <h4 class="warning mt-1 text-bold-500">{{ __('admin.product')}}</h4>
                                            </div>
                                            <div class="col-7">
                                                <div class="float-right">
                                                    <canvas id="gold-chart" class="height-75"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                            <div class="card bank-card pull-up">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-5 text-left">
                                                <h3 class="mb-0">{{ number_format(abs($inventoryValue), 2) }}</h3>
                                                <p class="text-light">{{ __('admin.total')}}</p>
                                                <h4 class="info mt-1 text-bold-500">{{ __('admin.inventory')}}</h4>
                                            </div>
                                            <div class="col-7">
                                                <div class="float-right">
                                                    <canvas id="silver-chart" class="height-75"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                            <div class="card bank-card pull-up">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-5 text-left">
                                                <h3 class="mb-0">{{$purchases_invoice }}</h3>
                                                <p class="text-light">{{ __('admin.numbering')}}</p>
                                                <h4 class="danger mt-1 text-bold-500">{{ __('admin.purchases_invoice')}}</h4>
                                            </div>
                                            <div class="col-7">
                                                <div class="float-right">
                                                    <canvas id="euro-chart" class="height-75"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                            <div class="card bank-card pull-up">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-5 text-left">
                                                <h3 class="mb-0">{{$sales_invoice}}</h3>
                                                <p class="text-light">{{ __('admin.numbering')}}</p>
                                                <h4 class="success mt-1 text-bold-500">{{ __('admin.sales_invoice')}}</h4>
                                            </div>
                                            <div class="col-7">
                                                <div class="float-right">
                                                    <canvas id="bitcoin-chart" class="height-75"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-9 col-lg-8 col-md-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card card-shadow">
                                        <div class="card-header card-header-transparent">
                                            <h4 class="card-title">Transaction Reports</h4>
                                            <ul class="nav nav-pills nav-pills-rounded chart-action float-right btn-group" role="group">
                                                <li class="nav-item">
                                                    <a class="active nav-link" data-toggle="tab" href="#scoreLineToDay">Day</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#scoreLineToWeek">Week</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#scoreLineToMonth">Month</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="widget-content tab-content bg-white p-20">
                                            <div class="ct-chart tab-pane active scoreLineShadow" id="scoreLineToDay"></div>
                                            <div class="ct-chart tab-pane scoreLineShadow" id="scoreLineToWeek"></div>
                                            <div class="ct-chart tab-pane scoreLineShadow" id="scoreLineToMonth"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-12">
                            <div class="chart-stats text-center my-3">
                                <div class="card bg-gradient-directional-primary">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="media d-flex">
                                                <div class="media-body text-white text-left">
                                                    <h3 class="text-white">{{ $totalIn }}</h3>
                                                    <span>{{ __('admin.Inward_Movement')}}</span>
                                                </div>
                                                <div class="percentage">
                                                    <i class="la la-money" style="font-size: 45px"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card bg-gradient-directional-warning">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="media d-flex">
                                                <div class="media-body text-white text-left">
                                                    <h3 class="text-white">{{ $totalOut }}</h3>
                                                    <span>{{ __('admin.Outward_Movement')}}</span>
                                                </div>
                                                <div class="percentage">
                                                    <i class="la la-money" style="font-size: 45px"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card bg-gradient-directional-cyan">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="media d-flex">
                                                <div class="media-body text-white text-left">
                                                    <h3 class="text-white">{{ $stockQty }}</h3>
                                                    <span>{{ __('admin.Current_Balance')}}</span>
                                                </div>
                                                <div class="percentage">
                                                    <i class="la la-money" style="font-size: 45px"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row match-height">
                        <div class="col-xl-5 col-lg-6 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>{{ __('admin.Calendar')}}</h4>
                                </div>
                                <div class="card-content">
                                    <div id="bank-calendar" class="overflow-hidden bg-grey bg-lighten-3"></div>
                                </div>
                            </div>
                            <div id="clndr" class="clearfix">
                                <script type="text/template" id="bank-calendar-template">
                                    <div class="clndr-controls">
                                        <div class="clndr-previous-button">&lt;</div>
                                        <div class="clndr-next-button">&gt;</div>
                                        <div class="current-month">
                                            <%= month %>
                                            <%= year %>
                                        </div>

                                    </div>
                                    <div class="clndr-grid">
                                        <div class="days-of-the-week clearfix">
                                            <% _.each(daysOfTheWeek, function(day) { %>
                                            <div class="header-day">
                                                <%= day %>
                                            </div>
                                            <% }); %>
                                        </div>
                                        <div class="days">
                                            <% _.each(days, function(day) { %>
                                            <div class="<%= day.classes %>" id="<%= day.id %>"><span class="day-number"><%= day.day %></span></div>
                                            <% }); %>
                                        </div>
                                    </div>
                                    <div class="event-listing">
                                        <div class="event-listing-title">Event this month</div>
                                        <% _.each(eventsThisMonth, function(event) { %>
                                        <div class="event-item font-small-3">
                                            <div class="event-item-day font-small-2">
                                                <%= event.date %>
                                            </div>
                                            <div class="event-item-name text-bold-600">
                                                <%= event.title %>
                                            </div>
                                            <div class="event-item-location">
                                                <%= event.location %>
                                            </div>
                                        </div>
                                        <% }); %>
                                    </div>
                                </script>
                            </div>
                        </div>
                        <div class="col-xl-7 col-lg-6 col-md-12">
                            <div class="card recent-loan">
                                <div class="card-header">
                                    <h4 class="text-center">{{ __('admin.Latest_item_movements')}}</h4>
                                </div>
                                <div class="card-content">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>{{ __('admin.category')}}</th>
                                                <th>{{ __('admin.type')}}</th>
                                                <th>{{ __('admin.quantity')}}</th>
                                                <th>{{ __('admin.date')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($lastMovements as $row)
                                                <tr>
                                                    <td>{{ $row->product->name }}</td>

                                                    <td>
                                                        @if($row->quantity_in > 0)
                                                            <span class="badge badge-success">{{ __('admin.inside')}}</span>
                                                        @else
                                                            <span class="badge badge-danger">{{ __('admin.outside')}}</span>
                                                        @endif
                                                    </td>

                                                    <td>
                                                        {{ $row->quantity_in > 0 ? $row->quantity_in : $row->quantity_out }}
                                                    </td>

                                                    <td>{{ $row->created_at->format('Y-m-d') }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </section>

            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>










@endsection
@section('script')
@endsection


