@php($page_title = __('admin.purchases_invoice'))
@extends('layouts.main')

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
                            <li class="breadcrumb-item"><a href="#">{{__('admin.edit')}}</a>
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
                <form class="form" action="{{route('purchases_invoice.update',['id'=>$purchases_invoice->id])}}" method="POST"
                      id="my_form_id"
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
                                                                               value="{{ \Carbon\Carbon::parse($purchases_invoice->date)->format('Y-m-d') }}"
                                                                               class="form-control border-primary"
                                                                               required
                                                                               name="date">


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
                                                                                    value="{{$suppliers->id}}" {{ $purchases_invoice->supplier_id == $suppliers->id ? 'selected' : '' }}>{{$suppliers->name}}</option>
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

                                                                           {{ $purchases_invoice->post == 1 ? 'checked' : '' }}
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
                                                                           for="note">{{__('admin.note')}}<span
                                                                            class="danger">*</span> </label>
                                                                    <div
                                                                        class="col-md-9 mx-auto position-relative has-icon-left">
                                                                        <textarea required class="form-control border-primary"
                                                                                  type="text"
                                                                                  id="note"
                                                                                  name="note">{{$purchases_invoice->note}}</textarea>
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
                                                                                @foreach($bill_type as $bt)
                                                                                    <div class="d-inline-block custom-control custom-radio mr-1">
                                                                                        <input type="radio"
                                                                                               name="bill_type_id"
                                                                                               v-model="bill_type_id"
                                                                                               :value="{{ $bt->id }}"
                                                                                               class="custom-control-input"
                                                                                               id="bt_{{ $bt->id }}">

                                                                                        <label class="custom-control-label cursor-pointer"
                                                                                               for="bt_{{ $bt->id }}">
                                                                                            {{ $bt->name }}
                                                                                        </label>
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
                                                        v-model="item.product_id"
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

                                                       :value="lineTotal(item).toFixed(2)">
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

                                                               :value="totalItemsAmount.toFixed(2)"
                                                              >
                                                    </div>



                                                </div>
                                            </div>


                                        </div>



                                        <div class="col-md-1">
                                        </div>


                                    </div>
                                </div>

                                <br> <br> <br>
                                <div class="form-body">
                                    <div class="row">

                                        <div class="col-md-3">
                                            <div class="col-md-12">
                                                <div class="form-group ">
                                                    <div class="input-group">
                                                        <label for="user_id"
                                                               style="  margin-left: 10px; padding-top: 10px;">{{__('admin.entry_entrance')}}</label>
                                                        <input disabled type="text" id="user_id"
                                                               class="form-control"
                                                               value="{{$purchases_invoice->user->full_name ?? ''}}"
                                                               name="user_id" autocomplete="user_id"
                                                               style="border: none;background-color: #ffffff; border-bottom: 1px solid #b92c81; border-radius: 0; outline: none;"
                                                        >
                                                    </div>

                                                </div>
                                            </div>


                                        </div>

                                        <div class="col-md-3">
                                            <div class="col-md-12">
                                                <div class="form-group ">
                                                    <div class="input-group">
                                                        <label for="created_at"
                                                               style="  margin-left: 10px; padding-top: 10px;">{{__('admin.created_at')}}</label>
                                                        <input disabled type="text" id="created_at"
                                                               class="form-control"
                                                               name="created_at" autocomplete="created_at"
                                                               value="{{ $purchases_invoice->created_at}}"
                                                               style="border: none;background-color: #ffffff; border-bottom: 1px solid #b92c81; border-radius: 0; outline: none;"
                                                              >
                                                    </div>

                                                </div>
                                            </div>


                                        </div>
                                        <div class="col-md-3">


                                            <div class="col-md-12">
                                                <div class="form-group ">
                                                    <div class="input-group">
                                                        <label for="updated_at"
                                                               style="  margin-left: 10px; padding-top: 10px;">{{__('admin.updated_at')}}</label>
                                                        <input disabled type="text" id="updated_at"
                                                               class="form-control"
                                                               value="{{ $purchases_invoice->updated_at }}"
                                                               name="updated_at" autocomplete="updated_at"
                                                               style="border: none;background-color: #ffffff; border-bottom: 1px solid #b92c81; border-radius: 0; outline: none;"
                                                              >
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
                                        <i class="ft ft-save"></i> {{__('admin.edit')}}
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
        window.editItems = @json($purchases_invoice_details);
        window.editBillTypeId = {{ $purchases_invoice->bill_type_id }};
        const app = Vue.createApp({
            data() {
                return {
                    bill_type_id: window.editBillTypeId ?? {{ $bill_type->first()->id }},
                    items: window.editItems.map(row => ({
                        id: row.id,
                        product_id: row.product_id,
                        price: row.price,
                        quantity: row.quantity,
                        discount: row.discount,
                        vat: row.vat,
                        currency_id: row.currency_id,
                        curr_val: row.curr_val,
                        total: row.total,
                        note: row.note,
                        curr_options: []

                    }))
                }
            },
            mounted() {
                // عند تحميل الصفحة — اجلب خيارات العملات لكل صف
                this.items.forEach(item => {
                    if (item.currency_id) {
                        this.fetchCurrVal(item);
                    }
                });


                // فتح المودال عند تحميل المكون
                const modalEl = document.getElementById('messageSave');
                const modal = new bootstrap.Modal(modalEl); // إذا تستخدم Bootstrap 5
                modal.show();



            },
            methods: {

                calculateTotal(item) {
                    const subtotal =
                        (parseFloat(item.quantity) || 0) *
                        (parseFloat(item.price) || 0);

                    const dPercent = parseFloat(item.discount) || 0;
                    const discountAmount = subtotal * (dPercent / 100);

                    const taxableAmount = subtotal - discountAmount;

                    const vPercent = parseFloat(item.vat) || 0;
                    const vatAmount = taxableAmount * (vPercent / 100);

                    item.total = taxableAmount + vatAmount;
                    item.line_vat_amount = vatAmount;

                    return item.total.toFixed(2);
                },

                async fetchCurrVal(item) {
                    if (!item.currency_id) {
                        item.curr_val = "";
                        item.curr_options = [];
                        return;
                    }

                    const res = await fetch(`/purchases/purchases_invoice/falter_curr_val/${item.currency_id}`);
                    const data = await res.json();

                    if (Array.isArray(data) && data.length > 0) {
                        item.curr_options = data;

                        // إذا كان لديه قيمة محفوظة سابقاً — لا تغيرها
                        if (!item.curr_val) {
                            item.curr_val = data[0].curr_val;
                        }
                    } else {
                        item.curr_options = [];
                    }
                },
                addRow() {
                    this.items.push({
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
                },
                async removeRow(index) {
                    const item = this.items[index];
                    const csrfToken = "{{ csrf_token() }}";
                    // إذا هذا الصف موجود في قاعدة البيانات (له id)
                    if (item.id) {
                        try {
                            // إرسال طلب DELETE إلى السيرفر
                            await fetch(`/purchases/purchases_invoice/details/delete/${item.id}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': csrfToken,
                                    'Accept': 'application/json'
                                }
                            });
                        } catch (err) {
                            console.error("Failed to delete:", err);
                            return; // توقف إذا حصل خطأ
                        }
                    }

                    // إزالة الصف من Vue
                    if (this.items.length > 1) {
                        this.items.splice(index, 1);
                    }
                },

            },

            computed: {

                lineTotal() {
                    return (item) => {
                        const quantity = Number(item.quantity) || 0;
                        const price = Number(item.price) || 0;
                        const discountPercent = Number(item.discount) || 0;
                        const vatPercent = Number(item.vat) || 0;

                        const subtotal = quantity * price;
                        const discount = subtotal * (discountPercent / 100);
                        const taxable = subtotal - discount;
                        const vat = taxable * (vatPercent / 100);

                        return taxable + vat;
                    };
                },

                totalItemsAmount() {
                    return this.items.reduce((sum, item) => {
                        return sum + this.lineTotal(item);
                    }, 0);
                }

            }


        });

        app.mount("#app");
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
