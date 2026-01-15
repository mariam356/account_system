@php($page_title = __('admin.Who_are_we'))
@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <div class="content-header row mb-1">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">{{ __('admin.Who_are_we') }}</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">{{ __('admin.Dashboard') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('admin.Who_are_we') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="row my-2">
                        <div class="col-12 text-center mb-3">
                            <h2 class="display-4 font-weight-bold" style="color: #b92c81">{{ __('admin.account_system')}}</h2>
                            <p class="lead text-muted">{{ __('admin.Professionalism_in_financial_management_and_ease_of_use')}}</p>
                            <hr style="width: 100px; border: 2px solid #b92c81;">
                        </div>

                        <div class="col-md-6 col-12 d-flex align-items-center">
                            <div>
                                <h4 class="mb-1"><i class="la la-info-circle text-primary"></i> {{ __('admin.Our_story')}}</h4>
                                <p class="text-justify" style="line-height: 1.8;">
                                    {{ __('admin.This_system_was_founded_by_an_engineer_in_the_fields_of_technology_and_accounting_We_wanted_to_create_a_digital_work_environment_that_enables_the_accountant_and_the_manager_to_work_harmoniously_away_from_human_errors_and_paperwork_complexities')}}
                                      </p>
                            </div>
                        </div>
                        <div class="col-md-6 col-12 text-center">
                            <img src="{{ asset('logo/download.jfif') }}" class="img-fluid rounded" alt="About Us" style="max-height: 300px;">
                        </div>
                    </div>

                    <hr>

                    <div class="row my-3 text-center">
                        <div class="col-md-4 col-12 mb-2">
                            <div class="p-2 border rounded bg-light">
                                <i class="la la-shield text-success" style="font-size: 3rem;"></i>
                                <h4 class="mt-1">{{ __('admin.Data_security')}}</h4>
                                <p>{{ __('admin.We_use_the_highest_encryption_standards_to_ensure_the_confidentiality_and_privacy_of_your_financial_records')}}</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-12 mb-2">
                            <div class="p-2 border rounded bg-light">
                                <i class="la la-flash text-warning" style="font-size: 3rem;"></i>
                                <h4 class="mt-1">{{ __('admin.Processing_speed')}}</h4>
                                <p>{{ __('admin.Generate_financial_and_tax_reports_and_statements_with_the_click_of_a_button')}}</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-12 mb-2">
                            <div class="p-2 border rounded bg-light">

                                <i class="la la-headphones text-info" style="font-size: 3rem;"></i>
                                <h4 class="mt-1">{{ __('admin.Ongoing_technical_support')}}</h4>
                                <p>{{ __('admin.is_always_with_you_to_provide_support_and_resolve_inquiries_to_ensure_the_continuity_of_your_business')}}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="card border-left-primary shadow-sm">
                                <div class="card-body">
                                    <h5><i class="la la-eye"></i> {{ __('admin.Our_vision')}}</h5>
                                    <p>{{ __('admin.To_be_the_most_reliable_platform_for_managing_businesses_financially_and_technically_in_the_region_with_full_commitment_to_international_accounting_standards')}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border-left-success shadow-sm">
                                <div class="card-body">
                                    <h5><i class="la la-bullseye"></i> {{ __('admin.Our_mission')}}</h5>
                                    <p>{{ __('admin.Enabling_companies_to_achieve_sustainable_growth_by_providing_smart_easy-to-use_accounting_tools_that_are_always_up-to-date')}}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="alert bg-blue-grey white text-center mt-3 p-2">
                        <h5 class="mb-0">"{{ __('admin.It_was_developed_by')}} <span style="color: #f0f0ee ">{{ __('admin.eng_mariam')}}</span>"</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
