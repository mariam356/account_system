<!DOCTYPE html>
@php($page_title = __('admin.trial_balance'))
<html dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}" lang="{{ app()->getLocale() }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('logo/images2.png')}}">

    <title>{{ __('admin.trial_balance') }}</title>
    <style>
        @font-face {
            font-family: "Linaround-Light";
            src: url('{{ asset('fonts/fonts/Linaround-Light.otf') }}') format("opentype");
            font-weight: normal;
            font-style: normal;
            font-display: swap;
        }
        body {
            font-family: "Linaround-Light", Arial, sans-serif;
            direction: {{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }};
            text-align: {{ app()->getLocale() === 'ar' ? 'right' : 'left' }};
            line-height: 1.5;
            margin: 0;
            padding: 20px;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #369fd9;
            padding-bottom: 15px;
        }
        .header h1 {
            font-size: 18px;
            margin: 10px 0 5px 0;
            color: #333;
        }
        .date-range {
            font-size: 12px;
            margin: 10px 0;
            color: #369fd9;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 11px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 6px 8px;
            text-align: {{ app()->getLocale() === 'ar' ? 'right' : 'left' }};
            vertical-align: top;
        }
        th {
            background-color: #f2f2f2;
            color: #000000;
            font-weight: bold;
            font-size: 10px;
        }
        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .footer {
            margin-top: 30px;
            text-align: {{ app()->getLocale() === 'ar' ? 'right' : 'left' }};
            font-size: 10px;
            border-top: 1px solid #eee;
            padding-top: 10px;
            color: #666;
        }
        .text-center {
            text-align: center;
        }
        .no-data {
            padding: 20px;
            font-style: italic;
            color: #999;
        }
        .company-info {
            text-align: center;
            margin-bottom: 10px;
            font-size: 16px;
            font-weight: bold;
            color: #369fd9;
        }
        .date-range {
            font-size: 12px;
            margin: 10px 0;
            color: #369fd9;
        }
        .filter-info {
            margin-bottom: 15px;
            font-size: 12px;
        }
        .filter-info strong {
            color: #369fd9;
        }
    </style>
</head>
<body>
<div class="header">
    <div class="company-info">
        @if(file_exists(public_path('ebhar_soft.png')))
            <img src="https://enterprise.ebharsoft.com/accounting.png" width="193" height="230" alt="Ebhar Soft logo">
            <br>
        @endif
            @if(!$isPdf)
            <a style="float: left" href="{{ route('trial_balance.export', ['ids' => request('ids')])  }}" class="btn btn-outline-primary">
                <img src="{{ asset('logo/Download PDF icon design.jfif') }}" width="60">
            </a>

                <a style="float: left" href="{{ route('trial_balance.exportExcel', ['ids' => request('ids')])  }}" class="btn btn-outline-primary">
                    <img src="{{ asset('logo/XLSX Spreadsheet - Free download and install on Windows _ Microsoft Store.jfif') }}" width="60">
                </a>
            @endif

    </div>
    <br>
    <div class="header-container" style="width: 100%; margin-bottom: 20px;">
        <table style="width: 100%; border-collapse: collapse; border: none; direction: {{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }};">
            <tr>
                @if($isPdf)
                    <td style="width: 33.33%; text-align: {{ app()->getLocale() === 'ar' ? 'right' : 'left' }}; border: none; vertical-align: middle;">
                        <img src="{{ public_path('logo/images2.png') }}" style="max-height: 80px;">
                    </td>
                @else
                    <td style="width: 33.33%; text-align: {{ app()->getLocale() === 'ar' ? 'right' : 'left' }}; border: none; vertical-align: middle;">
                        <img src="{{ asset('logo/images2.png') }}" style="max-height: 80px;">
                    </td>
                @endif

                <td style="width: 33.33%; text-align: center; border: none; vertical-align: middle;">
                    <h2 style="margin: 0; font-size: 1.5rem; color: #369fd9;">{{ \Illuminate\Support\Facades\Auth::user()->branch->name ?? 'Accounting System' }}</h2>
                    <h3 style="margin: 5px 0; font-size: 1.2rem;">{{ Auth::user()->branch->address ?? 'Sana\'a' }}</h3>
                    <div class="date-range" style="margin-top: 10px; font-size: 0.9rem; color: #369fd9;">
                        {{ __('admin.from') }} <strong>{{ $request->from ?? '_________' }}</strong>
                        {{ __('admin.to') }} <strong>{{ $request->to ?? now()->format('Y-m-d') }}</strong>
                    </div>
                </td>

                <td style="width: 33.33%; text-align: {{ app()->getLocale() === 'ar' ? 'left' : 'right' }}; border: none; vertical-align: middle;">
                    <div style="display: inline-block; text-align: left; direction: ltr;">
                        <p style="margin: 0;font-size: 0.9rem"><strong>{{__('admin.phone')}}:</strong> {{ \Illuminate\Support\Facades\Auth::user()->branch->phone ?? '774548558' }}</p>
                        <p style="margin: 0;font-size: 0.9rem"><strong>{{__('admin.fax')}}:</strong> {{ \Illuminate\Support\Facades\Auth::user()->branch->fax ?? '4548558' }}</p>
                    </div>
                </td>
            </tr>
        </table>


    </div>


</div>
<h2 style="text-align: center; border-bottom: 2px dashed #369fd9; padding-bottom: 10px; margin: 20px auto; width: 17%;">
    {{ __('admin.trial_balance') }}
</h2>

<table>
    <thead>
    <tr>

        <th>{{__('admin.account_name')}}</th>

        <th>{{__('admin.debit')}}</th>
        <th>{{__('admin.creditor')}}</th>


    </tr>
    </thead>
    <tbody>

        @foreach($data as $trial_balance)
            <tr>



                <td>{{$trial_balance->account->name ?? ''}}</td>
               <?php
                    // 1. حساب الرصيد الصافي (مدين - دائن)
                    $rawBalance = $trial_balance->total_debit - $trial_balance->total_credit;

                    $balanceAfterCurrency = $rawBalance;
               ?>

                <td>
                    {{ $balanceAfterCurrency >= 0 ? number_format($balanceAfterCurrency, 2) : '0.00' }}
                </td>

                <td>
                    {{ $balanceAfterCurrency < 0 ? number_format(abs($balanceAfterCurrency), 2) : '0.00' }}
                </td>




            </tr>
        @endforeach

    </tbody>
</table>

<div class="footer">
    <table style="width: 100%; border: none; margin-top: 50px; table-layout: fixed;">
        <tr>
            <td style="width: 25%; text-align: center; border: none; font-size: 1.0rem;">
                <strong>{{__('admin.specialist')}}</strong>
                <br><br>....................
            </td>

            <td style="width: 25%; text-align: center; border: none; font-size: 1.0rem;">
                <strong>{{__('admin.Accountant')}}</strong>
                <br><br>....................
            </td>

            <td style="width: 25%; text-align: center; border: none; font-size: 1.0rem;">
                <strong>{{__('admin.account_manager')}}</strong>
                <br><br>....................
            </td>

            <td style="width: 25%; text-align: center; border: none; font-size: 1.0rem;">
                <strong>{{__('admin.boss')}}</strong>
                <br><br>....................
            </td>
        </tr>
    </table>

</div>


</body>
</html>
