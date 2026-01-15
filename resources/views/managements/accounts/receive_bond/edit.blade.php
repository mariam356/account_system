@php($page_title = __('admin.receive_bond'))
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
                <h3 class="content-header-title">{{__('admin.receive_bond')}}</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">{{__('admin.Dashboard')}}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">{{__('admin.edit')}}</a>
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
                <form class="form" action="{{route('receive_bond.update',['id'=>$receive_bond->id])}}" method="POST"
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
                                                                class='bx bxs-notebook'></i> {{__('admin.create')}} {{__('admin.receive_bond')}}
                                                        </h4>
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group row">
                                                                    <label class="col-md-3 label-control"
                                                                           for="check_no">{{__('admin.number')}} {{__('admin.receive_bond')}} <span
                                                                            class="danger">*</span></label>
                                                                    <div
                                                                        class="col-md-9 mx-auto position-relative has-icon-left">
                                                                        <input readonly type="number" id="check_no"
                                                                               value="{{$receive_bond->check_no}}"
                                                                               class="form-control border-primary"
                                                                               required
                                                                               name="check_no">


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
                                                                               value="{{ \Carbon\Carbon::parse($receive_bond->date)->format('Y-m-d') }}"
                                                                               class="form-control border-primary"
                                                                               required
                                                                               name="date">


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

                                                                           {{ $receive_bond->post == 1 ? 'checked' : '' }}
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
                                                                                  name="note">{{$receive_bond->note}}</textarea>
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
                                                                           for="fund_id">{{__('admin.fund')}} </label>
                                                                    <div
                                                                        class="col-md-9 mx-auto position-relative has-icon-left">
                                                                        <select  v-model="fund_id"
                                                                                 :disabled="isBankSelected" class="form-control border-primary"
                                                                                 id="fund_id" name="fund_id">
                                                                            <option
                                                                                value="">{{__('admin.select_option')}}</option>
                                                                            @foreach($fund as $funds)
                                                                                <option
                                                                                    value="{{$funds->id}}" {{ $receive_bond->fund_id == $funds->id ? 'selected' : '' }}>{{$funds->name}}</option>
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
                                                                           for="bank_id">{{__('admin.bank')}} </label>
                                                                    <div
                                                                        class="col-md-9 mx-auto position-relative has-icon-left">
                                                                        <select  v-model="bank_id"
                                                                                 :disabled="isFundSelected" class="form-control border-primary"
                                                                                 id="bank_id"  name="bank_id">
                                                                            <option
                                                                                value="">{{__('admin.select_option')}}</option>
                                                                            @foreach($bank as $banks)
                                                                                <option
                                                                                    value="{{$banks->id}}" {{ $receive_bond->bank_id == $banks->id ? 'selected' : '' }}>{{$banks->name}}</option>
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
                                                <select style="border: #FFFFFF;width: 120px" v-model="item.account_id" required
                                                        :name="'items['+index+'][account_id]'" class="account_id">
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
                                                <select style="border: #FFFFFF;width: 120px" v-model="item.currency_id" required
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
                                                       :value="calcBalance(item)">
                                            </td>

                                            <td hidden>
                                                <input type="hidden" :name="'items['+index+'][id]'" v-if="item.id"
                                                       :value="item.id">
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
                                                               style="  margin-left: 10px; padding-top: 10px;">{{__('admin.total')}} {{__('admin.total')}}</label>
                                                        <input readonly type="text" id="amount"
                                                               class="form-control border-primary"
                                                               name="amount" autocomplete="amount"
                                                               :value="totalAmount">
                                                    </div>

                                                </div>
                                            </div>


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
                                                               value="{{$receive_bond->user->full_name ?? ''}}"
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
                                                               value="{{ $receive_bond->created_at}}"
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
                                                               value="{{ $receive_bond->updated_at }}"
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
                                            id="button_save"  >
                                        <i class="ft ft-save"></i> {{__('admin.edit')}}
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
        window.editItems = @json($receive_bond_details);

        const app = Vue.createApp({
            data() {
                return {
                    fund_id: '{{ $receive_bond->fund_id ?? '' }}',
                    bank_id: '{{ $receive_bond->bank_id ?? '' }}',
                    items: window.editItems.map(row => ({
                        id: row.id,
                        account_id: row.account_id,
                        amount: row.amount,
                        total: row.total,
                        currency_id: row.currency_id,
                        curr_val: row.curr_val,
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
                async fetchCurrVal(item) {
                    if (!item.currency_id) {
                        item.curr_val = "";
                        item.curr_options = [];
                        return;
                    }

                    const res = await fetch(`/accounts/receive_bond/falter_curr_val/${item.currency_id}`);
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
                        amount: 0,
                        total: 0,
                        currency_id: '',
                        curr_val: '',
                        note: '',
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
                            await fetch(`/accounts/receive_bond/details/delete/${item.id}`, {
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
                calcBalance(item) {
                    return Math.abs(
                        (Number(item.amount) || 0) * (Number(item.curr_val) || 0)
                    );
                }
            },
            computed: {
                totalAmount() {
                    return this.items.reduce((sum, it) => sum + (Number(it.amount) || 0), 0);
                },
                isFundSelected() {
                    return this.fund_id !== null && this.fund_id !== '';
                },
                isBankSelected() {
                    return this.bank_id !== null && this.bank_id !== '';
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
