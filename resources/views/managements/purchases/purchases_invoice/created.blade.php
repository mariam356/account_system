@php($page_title = __('admin.purchases_invoice'))
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
                <h3 class="content-header-title">{{__('admin.purchases_invoice')}}</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">{{__('admin.Dashboard')}}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">{{__('admin.create')}}</a>
                            </li>
                            <li class="breadcrumb-item active"><a
                                    href="{{route('purchases_invoice')}}">{{__('admin.purchases_invoice')}}</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-12">
            <div class="card" id="app">
                <form class="form" action="{{route('purchases_invoice.store')}}" method="POST" id="my_form_id"
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
                                                                class='bx bxs-notebook'></i> {{__('admin.create')}} {{__('admin.purchases_invoice')}}
                                                        </h4>
                                                        <div class="row">
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
                                                            <div class="col-md-3">
                                                                <div class="form-group row">
                                                                    <label class="col-md-3 label-control"
                                                                           for="supplier_id">{{__('admin.supplier')}}
                                                                        <span
                                                                            class="danger">*</span></label>
                                                                    <div
                                                                        class="col-md-9 mx-auto position-relative has-icon-left">
                                                                        <select
                                                                            class="select2 form-control border-primary"
                                                                            id="supplier_id" required
                                                                            name="supplier_id">
                                                                            <option
                                                                                value="">{{__('admin.select_option')}}</option>
                                                                            @foreach($supplier as $suppliers)
                                                                                <option
                                                                                    value="{{$suppliers->id}}">{{$suppliers->name}}</option>
                                                                            @endforeach

                                                                        </select>
                                                                        <div class="form-control-position">
                                                                            <i class="la la-truck"
                                                                               style="color: #b92c81"></i>
                                                                        </div>

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




                                                            <div class="col-md-6">
                                                                <div class="form-group col-md-12">
                                                                    <div class="row">
                                                                        <label>{{__('admin.bill_type')}}</label>
                                                                        <div class="col-md-7 mx-auto ">
                                                                            <div class="input-group">
                                                                                @foreach($bill_type as $bill_types)
                                                                                    <div
                                                                                        class="d-inline-block custom-control custom-radio mr-1">
                                                                                        <input type="radio"
                                                                                               name="bill_type_id"
                                                                                               :value="{{$bill_types->id}}"
                                                                                               v-model="bill_type_id"
                                                                                               class="custom-control-input"
                                                                                               {{ $loop->first ? 'checked' : '' }}
                                                                                               id="bill_type_id_{{$bill_types->id}}">
                                                                                        <label
                                                                                            class="custom-control-label cursor-pointer"
                                                                                            for="bill_type_id_{{$bill_types->id}}">{{$bill_types->name}}</label>
                                                                                    </div>
                                                                                @endforeach


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
                                    </div>
                                </div>


                                <br>
                                <div class="table-responsive">
                                    <table id="items-table" class="table mb-0">
                                        <thead style="background-color: #345862d1; color:#f0f0ee ">
                                        <tr>
                                            <th>{{__('admin.products')}}</th>

                                            <th>{{__('admin.currency')}}</th>
{{--                                            <th>{{__('admin.curr_val')}}</th>--}}

                                            <th>{{__('admin.quantity')}}</th>
                                            <th>{{__('admin.price')}}</th>
                                            <th>{{__('admin.discount')}}</th>
                                            <th>{{__('admin.tax')}}</th>
                                            <th>{{__('admin.total')}}</th>

                                            <th>{{__('admin.action')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="(item, index) in items" :key="index">

                                            <td>
                                                <select style="border: #FFFFFF;width: 120px"
                                                        :name="'items['+index+'][product_id]'" required
                                                        class="product_id">
                                                    <option value="">{{__('admin.select_option')}}</option>
                                                    @foreach($product as $products)
                                                        <option value="{{$products->id}}">{{$products->name}}</option>
                                                    @endforeach
                                                </select>
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

{{--                                            <td>--}}
{{--                                                <!-- إذا توجد خيارات -->--}}
{{--                                                <select disabled style="border: #FFFFFF;width: 120px"--}}
{{--                                                        v-if="item.curr_options.length > 0" v-model="item.curr_val"--}}
{{--                                                        style="width:70px">--}}
{{--                                                    <option v-for="opt in item.curr_options" :key="opt.id"--}}
{{--                                                            :value="opt.curr_val">--}}
{{--                                                        @{{ opt.curr_val }}--}}
{{--                                                    </option>--}}
{{--                                                </select>--}}

{{--                                                <!-- إذا لا توجد خيارات -->--}}
{{--                                                <input disabled style="border: #FFFFFF;width:120px" v-else type="text"--}}
{{--                                                       v-model="item.curr_val" style="width:70px"/>--}}
{{--                                            </td>--}}

                                            <td>
                                                <input style="border: #FFFFFF" type="number"

                                                       :name="'items['+index+'][quantity]'"
                                                       v-model.number="item.quantity" @input="calculateTotal(item)">
                                            </td>

                                            <td>
                                                <input style="border: #FFFFFF;width:70px" type="number"

                                                       :name="'items['+index+'][price]'"
                                                       v-model.number="item.price" @input="calculateTotal(item)">
                                            </td>

                                            <td>
                                                <input style="border: #FFFFFF;width:70px" type="number"

                                                       :name="'items['+index+'][discount]'"
                                                       v-model.number="item.discount" @input="calculateTotal(item)">
                                            </td>

                                            <td>
                                                <input style="border: #FFFFFF;width:70px" type="number"

                                                       :name="'items['+index+'][vat]'"
                                                       v-model.number="item.vat" @input="calculateTotal(item)">
                                            </td>

                                            <td>
                                                <input disabled style="border: #FFFFFF" type="number"

                                                       :name="'items['+index+'][total]'"
                                                       :value="item.total"
                                                       v-model.number="item.total">
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
                                        <div class="col-md-3">
                                            <div class="col-md-12">
                                                <div class="form-group ">
                                                    <div class="input-group">
                                                        <label for="all_total"
                                                               style="  margin-left: 10px; padding-top: 10px;">{{__('admin.total')}}</label>
                                                        <input readonly type="text" id="all_total"
                                                               class="form-control border-primary"
                                                               name="all_total" autocomplete="all_total"
                                                               v-model="all_total"
                                                               :value="totalItemsAmount.toFixed(2)">
                                                    </div>



                                                </div>
                                            </div>


                                        </div>



                                        <div class="col-md-1">
                                        </div>


                                    </div>
                                </div>


                                <br> <br> <br>
                                <div>
                                    <button type="submit"
                                            class="btn btn-outline-blue-grey btn-min-width btn-glow mr-1 mb-1"
                                            id="button_save"
                                            >
                                        <i class="ft ft-save"></i> {{__('admin.save')}}
                                    </button>
                                    <a href="{{ url('/purchases/purchases_invoice')}}"
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


                const items = ref([
                    {
                        product_id: '',
                        price: 0,
                        quantity: 0,
                        discount: 0,
                        currency_id: '',
                        curr_val: '',
                        vat: 0,
                        note: '',
                        total:0,
                        curr_options: []
                    }
                ]);
                const calculateTotal = (item) => {
                    // 1. حساب الإجمالي المبدئي (الكمية × السعر)
                    const subtotal = (parseFloat(item.quantity) || 0) * (parseFloat(item.price) || 0);

                    // 2. حساب قيمة الخصم (مبلغ) من النسبة المئوية
                    const dPercent = (parseFloat(item.discount) || 0);
                    const discountAmount = subtotal * (dPercent / 100);

                    // 3. المبلغ الخاضع للضريبة (الصافي بعد الخصم)
                    const taxableAmount = subtotal - discountAmount;

                    // 4. حساب قيمة الضريبة (مبلغ) من النسبة المئوية
                    const vPercent = (parseFloat(item.vat) || 0);
                    const vatAmount = taxableAmount * (vPercent / 100);

                    // 5. الإجمالي النهائي للسطر (الصافي + الضريبة)
                    item.total = taxableAmount + vatAmount;

                    // اختياري: يمكنك تخزين قيمة الضريبة في الحقل لتسهيل جمعها لاحقاً
                    item.vat = vatAmount;

                    return item.total.toFixed(2); // إرجاع القيمة مقربة لرقمين عشريين
                };

                // 1. حساب إجمالي الأصناف (قبل الضريبة)
                const totalItemsAmount = computed(() => {
                    return items.value.reduce((sum, item) => sum + (parseFloat(item.total) || 0), 0);
                });



                const baseUrl = "/purchases/purchases_invoice/falter_curr_val";

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
                        product_id: '',
                        price: 0,
                        quantity: 0,
                        discount: 0,
                        currency_id: '',
                        curr_val: '',
                        vat: 0,
                        note: '',
                        total:0,
                        curr_options: []
                    });
                };

                const removeRow = (index) => {
                    if (items.value.length > 1) {
                        items.value.splice(index, 1);
                    }
                };

                return {items, addRow, removeRow, fetchCurrVal,calculateTotal,totalItemsAmount};
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
