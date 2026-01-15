@php($page_title = __('admin.receive_bond'))
@extends('layouts.main')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/forms/toggle/switchery.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/forms/selects/select2.min.css')}}">
@endsection
@section('content')
    <div class="content-wrapper">

        @if(session()->has('success'))
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

        <div class="content-header row mb-1">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">{{__('admin.receive_bond')}}</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">{{__('admin.Dashboard')}}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">{{__('admin.create')}}</a>
                            </li>
                            <li class="breadcrumb-item active"><a
                                    href="{{route('receive_bond')}}">{{__('admin.receive_bond')}}</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-12">
            <div class="card" id="app">
                <form class="form" action="{{route('receive_bond.store')}}" method="POST" id="my_form_id"
                      enctype="multipart/form-data">
                    @csrf

                    <div class="card-content collpase show">
                        <div class="card-body">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">

                                            <div class="card-content collpase show">
                                                <div class="card-body">

                                                    <div class="form-body">
                                                        <h4 class="form-section"><i
                                                                class='bx bxs-notebook'></i> {{__('admin.create')}} {{__('admin.receive_bond')}}
                                                        </h4>
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group row">
                                                                    <label class="col-md-3 label-control"
                                                                           for="fund_id">{{__('admin.fund')}} </label>
                                                                    <div
                                                                        class="col-md-9 mx-auto position-relative has-icon-left">
                                                                        <select v-model="fund_id" :disabled="isBankSelected" class="form-control border-primary"
                                                                                id="fund_id" name="fund_id">
                                                                            <option
                                                                                value="">{{__('admin.select_option')}}</option>
                                                                            @foreach($fund as $funds)
                                                                                <option
                                                                                    :value="'{{ $funds->id }}'">{{$funds->name}}</option>
                                                                            @endforeach

                                                                        </select>
                                                                        <div class="form-control-position">
                                                                            <i class="bx bx-box"
                                                                               style="color: #b92c81"></i>
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
                                                                           for="date">{{__('admin.date')}} <span
                                                                            class="danger">*</span></label>
                                                                    <div
                                                                        class="col-md-9 mx-auto position-relative has-icon-left">
                                                                        <input type="date" id="date"
                                                                               class="form-control border-primary"
                                                                               name="date" required>


                                                                        <span class="error-message" style="color:red;">
                                                        <strong></strong>
                                                    </span>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                            <div class="col-md-2">
                                                                <div class="form-group row d-flex align-items-center">

                                                                    <input type="checkbox"
                                                                           name="post"
                                                                           id="post"
                                                                           class="border-primary ml-4">

                                                                    <label class="col label-control ml-1"
                                                                           for="post">
                                                                        {{__('admin.post')}}
                                                                    </label>

                                                                    <span class="error-message text-danger">
            <strong></strong>
        </span>
                                                                </div>
                                                            </div>


                                                            <div class="col-md-4">
                                                                <div class="form-group row">
                                                                    <label class="col-md-3 label-control"
                                                                           for="note">{{__('admin.note')}} <span
                                                                            class="danger">*</span></label>
                                                                    <div
                                                                        class="col-md-9 mx-auto position-relative has-icon-left">
                                                                        <textarea required
                                                                                  class="form-control border-primary"
                                                                                  type="text"
                                                                                  id="note" name="note"></textarea>
                                                                        <div class="form-control-position">
                                                                            <i class="icon-note"
                                                                               style="color: #b92c81"></i>
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
                                                                           for="bank_id">{{__('admin.bank')}} </label>
                                                                    <div
                                                                        class="col-md-9 mx-auto position-relative has-icon-left">
                                                                        <select v-model="bank_id" :disabled="isFundSelected" class="form-control border-primary"
                                                                                id="bank_id" name="bank_id">
                                                                            <option
                                                                                value="">{{__('admin.select_option')}}</option>
                                                                            @foreach($bank as $banks)
                                                                                <option
                                                                                    :value="'{{ $banks->id }}'">{{$banks->name}}</option>
                                                                            @endforeach

                                                                        </select>
                                                                        <div class="form-control-position">
                                                                            <i class="bx bxs-bank"
                                                                               style="color: #b92c81"></i>
                                                                        </div>

                                                                        <span class="error-message" style="color:red;">
                                                        <strong></strong>
                                                    </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <br>
                                <div class="table-responsive">
                                    <table id="items-table" class="table mb-0">
                                        <thead style="background-color: #345862d1; color:#f0f0ee ">
                                        <tr>
                                            <th>{{__('admin.account')}}</th>
                                            <th>{{__('admin.amount')}}</th>
                                            <th>{{__('admin.currency')}}</th>
                                            <th>{{__('admin.curr_val')}}</th>
                                            <th>{{__('admin.Amount_in_local_currency')}}</th>

                                            <th>{{__('admin.action')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="(item, index) in items" :key="index">

                                            <td>
                                                <select style="border: #FFFFFF;width: 120px"
                                                        :name="'items['+index+'][account_id]'" required
                                                        class="account_id">
                                                    <option value="">{{__('admin.select_option')}}</option>
                                                    @foreach($account as $accounts)
                                                        <option value="{{$accounts->id}}">{{$accounts->name}}</option>
                                                    @endforeach
                                                </select>
                                            </td>

                                            <td>
                                                <input style="border: #FFFFFF;width:70px" type="number"
                                                       style="width:70px"
                                                       :name="'items['+index+'][amount]'"
                                                       v-model.number="item.amount">
                                            </td>

                                            <td>
                                                <select style="border: #FFFFFF;width: 120px " required
                                                        v-model="item.currency_id"
                                                        :name="'items['+index+'][currency_id]'"
                                                        @change="fetchCurrVal(item)">
                                                    <option value="">{{__('admin.select_option')}}</option>
                                                    @foreach($currency as $c)
                                                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>

                                            <td>
                                                <!-- إذا توجد خيارات -->
                                                <select disabled style="border: #FFFFFF;width: 120px"
                                                        v-if="item.curr_options.length > 0" v-model="item.curr_val"
                                                        style="width:70px">
                                                    <option v-for="opt in item.curr_options" :key="opt.id"
                                                            :value="opt.curr_val">
                                                        @{{ opt.curr_val }}
                                                    </option>
                                                </select>

                                                <!-- إذا لا توجد خيارات -->
                                                <input disabled style="border: #FFFFFF;width:120px" v-else type="text"
                                                       v-model="item.curr_val" style="width:70px"/>
                                            </td>


                                            <td>
                                                <input disabled style="border: #FFFFFF;"
                                                       :name="'items['+index+'][total]'"
                                                       v-model="item.total" :value="calcBalance(item)">
                                            </td>

                                            <td>
                                                <i @click="addRow" class="ft-plus btn btn-sm btn-outline-success"></i>
                                                <i @click="removeRow(index)"
                                                   class="ft-trash btn btn-sm btn-outline-danger"></i>
                                            </td>

                                        </tr>
                                        </tbody>

                                    </table>
                                </div>


                                <hr>
                                <br>
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                        </div>
                                        <div class="col-md-4">
                                            <div class="col-md-12">
                                                <div class="form-group ">
                                                    <div class="input-group">
                                                        <label for="amount"
                                                               style="  margin-left: 10px; padding-top: 10px;">{{__('admin.total')}} {{__('admin.amount')}}</label>
                                                        <input readonly type="text" id="amount"
                                                               class="form-control border-primary"
                                                               name="amount" autocomplete="amount"
                                                               v-model="amount"
                                                               :value="totalAmount">
                                                    </div>


                                                </div>
                                            </div>


                                        </div>




                                    </div>
                                </div>


                                <br> <br> <br>
                                <div>
                                    <button type="submit"
                                            class="btn btn-outline-blue-grey btn-min-width btn-glow mr-1 mb-1"
                                            id="button_save">
                                        <i class="ft ft-save"></i> {{__('admin.save')}}
                                    </button>
                                    <a href="{{ url('/accounts/receive_bond')}}"
                                       class="btn btn-outline-danger btn-min-width btn-glow mr-1 mb-1">
                                        <i class="ft-x"></i> {{__('admin.cancel')}}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        const {createApp, ref, reactive, computed} = Vue;

        createApp({


            setup() {

                const fund_id = ref('');
                const bank_id = ref('');


                const isFundSelected = computed(() => fund_id.value !== '');
                const isBankSelected = computed(() => bank_id.value !== '');
                const items = ref([
                    {
                        amount: 0,
                        total: 0,
                        currency_id: '',
                        curr_val: '',
                        note: '',
                        curr_options: []
                    }
                ]);

                // computed لحساب المجموع (نستعمل Number لضمان تحويل النص إلى رقم)
                const totalAmount = computed(() => {
                    return items.value.reduce((sum, it) => {
                        // v-model.number يحاول تحويل للقيم الرقمية تلقائياً، لكن نحمي هنا أيضاً
                        const n = Number(it.amount) || 0;
                        return sum + n;
                    }, 0);
                });


                const calcBalance = (item) => {
                    return Math.abs(
                        (Number(item.amount) || 0) * (Number(item.curr_val) || 0)
                    );
                };


                const baseUrl = "/accounts/receive_bond/falter_curr_val";

                const fetchCurrVal = async (item) => {
                    if (!item.currency_id) {
                        item.curr_val = '';
                        item.curr_options = [];
                        return;
                    }

                    try {
                        const res = await fetch(`${baseUrl}/${item.currency_id}`);
                        const data = await res.json();

                        console.log("Fetched data:", data);

                        // هنا نستخدم المصفوفة مباشرة
                        if (Array.isArray(data) && data.length > 0) {
                            item.curr_options = data;
                            item.curr_val = data[0].curr_val; // تعبئة تلقائية
                        } else {
                            item.curr_options = [];
                            item.curr_val = '';
                        }

                    } catch (err) {
                        console.error("Error fetching currency values:", err);
                        item.curr_options = [];
                        item.curr_val = '';
                    }
                };

                const addRow = () => {
                    items.value.push({
                        amount: 0,
                        total: 0,
                        currency_id: '',
                        curr_val: '',
                        note: '',
                        curr_options: []
                    });
                };

                const removeRow = (index) => {
                    if (items.value.length > 1) {
                        items.value.splice(index, 1);
                    }
                };

                return {items, addRow, removeRow, fetchCurrVal, totalAmount, calcBalance,   fund_id,
                    bank_id,isFundSelected,isBankSelected};
            }

        }).mount("#app");


    </script>

@endsection

<style>


    .select2, .form-control {
        flex: 1; /* Take remaining space */
        margin-right: auto; /* Push input to the left */
    }

    /* RTL (Arabic) support */
    [dir="rtl"] .form-group {
        flex-direction: row; /* Default order for RTL */
    }
</style>
