


<!-- BEGIN: Main Menu-->

<div class="header-navbar navbar-expand-sm navbar navbar-horizontal navbar-fixed navbar-dark navbar-without-dd-arrow navbar-shadow" role="navigation" data-menu="menu-wrapper">
    <div class="navbar-container main-menu-content" data-menu="menu-container">
        <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">
            <li  class="@if($page_title == __('admin.Dashboard'))  active @endif nav-item" ><a class="nav-link" href="/"><i class="la la-home"></i><span>{{__('admin.Dashboard')}}</span></a></li>

            <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="la la-paperclip"></i><span data-i18n="nav.accounts.main">{{__('admin.file')}}</span></a>
                <ul class="dropdown-menu">
                    <li data-menu="" class="@if($page_title == __('admin.backup')) nav-item active @endif"><a class="dropdown-item" href="{{route('backup')}}" data-toggle=""><span>{{__('admin.backup')}}</span></a>
                    </li>
                    <li data-menu="" class="@if($page_title == __('admin.user')) nav-item active @endif"><a class="dropdown-item" href="{{route('user')}}" data-toggle=""><span>{{__('admin.users')}}</span></a>
                    </li>
                    <li data-menu="" class="@if($page_title == __('admin.permission')) nav-item active @endif"><a class="dropdown-item" href="{{route('permission')}}" data-toggle=""><span>{{__('admin.permission')}}</span></a>
                    </li>

                </ul>
            </li>

            <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="la la-cog"></i><span data-i18n="nav.accounts.main">{{__('admin.system_setting')}}</span></a>
                <ul class="dropdown-menu">
                    <li data-menu="" class="@if($page_title == __('admin.branch')) nav-item active @endif"><a class="dropdown-item" href="{{route('branch')}}" data-toggle=""><span>{{__('admin.branches')}}</span></a>
                    </li>
                    <li data-menu="" class="@if($page_title == __('admin.fund')) nav-item active @endif"><a class="dropdown-item" href="{{route('fund')}}" data-toggle=""><span>{{__('admin.funds')}}</span></a>
                    <li data-menu="" class="@if($page_title == __('admin.bank')) nav-item active @endif"><a class="dropdown-item" href="{{route('bank')}}" data-toggle=""><span>{{__('admin.banks')}}</span></a>
                    <li data-menu="" class="@if($page_title == __('admin.currency')) nav-item active @endif"><a class="dropdown-item" href="{{route('currency')}}" data-toggle=""><span>{{__('admin.currencies')}}</span></a>
                    </li>
                </ul>
            </li>
            <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="la la-calculator"></i><span data-i18n="nav.cards.main">{{__('admin.accounts')}}</span></a>
                <ul class="dropdown-menu">
                    <li class="@if($page_title == __('admin.accounting_guide')) nav-item active @endif" data-menu=""><a class="dropdown-item" href="{{route('account')}}" data-toggle=""><span>{{__('admin.accounting_guide')}}</span></a>
                    </li>
                    <li data-menu="" class="@if($page_title == __('admin.journal')) nav-item active @endif"><a class="dropdown-item" href="{{route('journal')}}" data-toggle=""><span>{{__('admin.journal')}}</span></a>
                    </li>

                    <li class="dropdown dropdown-submenu" data-menu="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#" data-toggle="dropdown"><span>{{__('admin.bonds')}}</span></a>
                        <ul class="dropdown-menu">
                            <li data-menu="" class="@if($page_title == __('admin.exchange_bond')) nav-item active @endif"><a class="dropdown-item" href="{{route('exchange_bond')}}" data-toggle=""><span>{{__('admin.exchange_bond')}}</span></a>
                            </li>
                            <li data-menu="" class="@if($page_title == __('admin.receive_bond')) nav-item active @endif"><a class="dropdown-item" href="{{route('receive_bond')}}" data-toggle=""><span>{{__('admin.receive_bond')}}</span></a>
                            </li>

                        </ul>
                    </li>

                    <li data-menu="" class="@if($page_title == __('admin.account_statement')) nav-item active @endif"><a class="dropdown-item" href="{{route('account_statement')}}" data-toggle=""><span>{{__('admin.account_statement')}}</span></a>
                    </li>

                    <li data-menu="" class="@if($page_title == __('admin.trial_balance')) nav-item active @endif"><a class="dropdown-item" href="{{route('trial_balance')}}" data-toggle=""><span>{{__('admin.trial_balance')}}</span></a>
                    </li>

                    <li data-menu="" class="@if($page_title == __('admin.balance_sheet')) nav-item active @endif"><a class="dropdown-item" href="{{route('balance_sheet')}}" data-toggle=""><span>{{__('admin.balance_sheet')}}</span></a>
                    </li>

                    <li data-menu="" class="@if($page_title == __('admin.profit_loss')) nav-item active @endif"><a class="dropdown-item" href="{{route('profit_loss')}}" data-toggle=""><span>{{__('admin.profit_loss')}}</span></a>
                    </li>

                </ul>
            </li>
            <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="la la-truck"></i><span data-i18n="nav.payments.main">{{__('admin.stores')}}</span></a>
                <ul class="dropdown-menu">
                    <li data-menu="" class="@if($page_title == __('admin.stores')) nav-item active @endif"><a class="dropdown-item" href="{{route('stores')}}" data-toggle=""><span>{{__('admin.stores')}}</span></a>
                    </li>
                    <li data-menu="" class="@if($page_title == __('admin.inventory_groups')) nav-item active @endif"><a class="dropdown-item" href="{{route('categories')}}" data-toggle=""><span>{{__('admin.inventory_groups')}}</span></a>
                    </li>

                    <li data-menu="" class="@if($page_title == __('admin.units')) nav-item active @endif"><a class="dropdown-item" href="{{route('units')}}" data-toggle=""><span>{{__('admin.units')}}</span></a>
                    </li>

                    <li data-menu="" class="@if($page_title == __('admin.products')) nav-item active @endif"><a class="dropdown-item" href="{{route('product')}}" data-toggle=""><span>{{__('admin.products')}}</span></a>
                    </li>

                    <li data-menu="" class="@if($page_title == __('admin.inventory_management')) nav-item active @endif"><a class="dropdown-item" href="{{route('inventory_management')}}" data-toggle=""><span>{{__('admin.inventory_management')}}</span></a>
                    </li>

                    <li data-menu="" class="@if($page_title == __('admin.category_movement')) nav-item active @endif"><a class="dropdown-item" href="{{route('category_movement')}}" data-toggle=""><span>{{__('admin.category_movement')}}</span></a>
                    </li>
                </ul>
            </li>
            <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="icon-basket-loaded"></i><span data-i18n="nav.loan.main">{{__('admin.purchases')}}</span></a>
                <ul class="dropdown-menu">
                    <li data-menu="" class="@if($page_title == __('admin.suppliers')) nav-item active @endif"><a class="dropdown-item" href="{{route('suppliers')}}" data-toggle=""><span>{{__('admin.suppliers')}}</span></a>
                    </li>
                    <li data-menu="" class="@if($page_title == __('admin.purchases_invoice')) nav-item active @endif"><a class="dropdown-item" href="{{route('purchases_invoice')}}" data-toggle=""><span>{{__('admin.purchases_invoice')}}</span></a>
                    </li>
                </ul>
            </li>
            <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="la la-shopping-cart"></i><span>{{__('admin.sales')}}</span></a>
                <ul class="dropdown-menu">
                    <li data-menu="" class="@if($page_title == __('admin.customer')) nav-item active @endif"><a class="dropdown-item" href="{{route('customer')}}" data-toggle=""><span>{{__('admin.customers')}}</span></a>
                    </li>
                    <li data-menu="" class="@if($page_title == __('admin.sale_representatives')) nav-item active @endif"><a class="dropdown-item" href="{{route('sale_representative')}}" data-toggle=""><span>{{__('admin.sale_representatives')}}</span></a>
                    </li>
                    <li data-menu="" class="@if($page_title == __('admin.sales_invoice')) nav-item active @endif"><a class="dropdown-item" href="{{route('sales_invoice')}}" data-toggle=""><span>{{__('admin.sales_invoice')}}</span></a>
                    </li>
                </ul>
            </li>

            <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="la la-question-circle"></i><span data-i18n="nav.loan.main">{{__('admin.helping')}}</span></a>
                <ul class="dropdown-menu">
                    <li data-menu="" class="@if($page_title == __('admin.Who_are_we')) nav-item active @endif"><a class="dropdown-item" href="{{route('Who_are_we')}}" data-toggle=""><span>{{__('admin.Who_are_we')}}</span></a>
                    </li>

                </ul>
            </li>
        </ul>
    </div>
</div>

<!-- END: Main Menu-->
