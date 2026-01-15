@php($page_title = __('admin.journal'))
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
                <h3 class="content-header-title">{{__('admin.journal')}}</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">{{__('admin.Dashboard')}}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">{{__('admin.edit')}}</a>
                            </li>
                            <li class="breadcrumb-item active"><a
                                    href="{{route('journal')}}">{{__('admin.journal')}}</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-12">
            <div class="card" id="app">
                <form class="form" action="{{route('journal.update',['id'=>$journal->id])}}" method="POST"
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
                                                                class='bx bxs-notebook'></i> {{__('admin.create')}} {{__('admin.journal')}}
                                                        </h4>
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group row">
                                                                    <label class="col-md-3 label-control"
                                                                           for="journal_number">{{__('admin.journal_number')}} <span
                                                                            class="danger">*</span></label>
                                                                    <div
                                                                        class="col-md-9 mx-auto position-relative has-icon-left">
                                                                        <input readonly type="journal_number" id="journal_number"
                                                                               value="{{$journal->journal_number}}"
                                                                               class="form-control border-primary"
                                                                               required
                                                                               name="journal_number">


                                                                        <span class="error-message" style="color:red;">
                                                        <strong></strong>
                                                    </span>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <div class="form-group row">

                                                                    <label
                                                                        for="operation_type_id">{{__('admin.entry_type')}}
                                                                        <span
                                                                            class="danger">*</span></label>
                                                                    <div
                                                                        class="col-md-9 mx-auto position-relative has-icon-left">

                                                                        <input class="form-control" disabled type="text"
                                                                               id="operation_type_id"
                                                                               value="{{$journal->operation_type->name ?? ''}}"
                                                                               name="operation_type_id"
                                                                               autocomplete="operation_type_id"
                                                                               style="border: none;background-color: #ffffff; border-bottom: 1px solid #b92c81; border-radius: 0; outline: none;"
                                                                        >
                                                                        <div class="form-control-position">
                                                                            <i class="bx bx-notepad"
                                                                               style="color: #b92c81"></i>
                                                                        </div>
                                                                    </div>


                                                                </div>
                                                            </div>

                                                            <div class="col-md-2">
                                                                <div class="form-group row d-flex align-items-center">

                                                                    <input type="checkbox"
                                                                           name="post"
                                                                           id="post"

                                                                           {{ $journal->post == 1 ? 'checked' : '' }}
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
                                                                                  name="note">{{$journal->note}}</textarea>
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
                                                                           for="date">{{__('admin.date')}} <span
                                                                            class="danger">*</span></label>
                                                                    <div
                                                                        class="col-md-9 mx-auto position-relative has-icon-left">
                                                                        <input type="date" id="date"
                                                                               value="{{ \Carbon\Carbon::parse($journal->date)->format('Y-m-d') }}"
                                                                               class="form-control border-primary"
                                                                               required
                                                                               name="date">


                                                                        <span class="error-message" style="color:red;">
                                                        <strong></strong>
                                                    </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group col-md-12">
                                                                    <div class="row">
                                                                        <label>{{__('admin.entry_entrance')}}</label>
                                                                        <div class="col-md-7 mx-auto ">
                                                                            <div class="input-group">
                                                                                @foreach($journal_type as $journal_types)
                                                                                    <div class="d-inline-block custom-control custom-radio mr-1">
                                                                                        <input type="radio"
                                                                                               name="journal_type_id"
                                                                                               :value="{{ $journal_types->id }}"
                                                                                               v-model="journal_type_id"
                                                                                               class="custom-control-input"
                                                                                               id="journal_type_id_{{ $journal_types->id }}">

                                                                                        <label class="custom-control-label cursor-pointer"
                                                                                               for="journal_type_id_{{ $journal_types->id }}">
                                                                                            {{ $journal_types->name }}
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
                                            <th>{{__('admin.account')}}</th>
                                            <th>{{__('admin.debit')}}</th>
                                            <th>{{__('admin.creditor')}}</th>
                                            <th>{{__('admin.currency')}}</th>
                                            <th>{{__('admin.curr_val')}}</th>
                                            <th>{{__('admin.note')}}</th>

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
                                                       :name="'items['+index+'][acc_debit]'"
                                                       v-model.number="item.acc_debit">
                                            </td>

                                            <td>
                                                <input style="border: #FFFFFF;width:70px" type="number"
                                                       style="width:70px"
                                                       :name="'items['+index+'][acc_credit]'"
                                                       v-model.number="item.acc_credit">
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
                        <textarea style="border: #FFFFFF;" :name="'items['+index+'][note]'"
                                  v-model="item.note"></textarea>
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
                                        <div class="col-md-1">
                                        </div>
                                        <div class="col-md-3">
                                            <div class="col-md-12">
                                                <div class="form-group ">
                                                    <div class="input-group">
                                                        <label for="debit"
                                                               style="  margin-left: 10px; padding-top: 10px;">{{__('admin.total')}} {{__('admin.debit')}}</label>
                                                        <input readonly type="text" id="debit"
                                                               class="form-control border-primary"
                                                               name="debit" autocomplete="debit"
                                                               :value="totalDebit">
                                                    </div>
                                                    <div v-if="journal_type_id == 1 && totalDebit != totalCredit || journal_type_id == 3 && totalDebit != totalCredit"
                                                         class="text-danger mt-1">
                                                        {{__('admin.The_total_debit_must_equal_the_total_credit')}}
                                                    </div>
                                                </div>
                                            </div>


                                        </div>

                                        <div class="col-md-3">
                                            <div class="col-md-12">
                                                <div class="form-group ">
                                                    <div class="input-group">
                                                        <label for="credit"
                                                               style="  margin-left: 10px; padding-top: 10px;">{{__('admin.total')}} {{__('admin.creditor')}}</label>
                                                        <input readonly type="text" id="credit"
                                                               class="form-control border-primary"
                                                               name="credit" autocomplete="credit"
                                                               :value="totalCredit">
                                                    </div>
                                                    <div v-if="journal_type_id == 1 && totalDebit != totalCredit || journal_type_id == 3 && totalDebit != totalCredit"
                                                         class="text-danger mt-1">
                                                        {{__('admin.The_total_debit_must_equal_the_total_credit')}}
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="col-md-4">


                                            <div class="col-md-12">
                                                <div class="form-group ">
                                                    <div class="input-group">
                                                        <label for="balance"
                                                               style="  margin-left: 10px; padding-top: 10px;">{{__('admin.balance')}}</label>
                                                        <input readonly type="text" id="balance"
                                                               class="form-control border-primary"
                                                               name="balance" autocomplete="balance"
                                                               :value="totalBalance"
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
                                                               value="{{$journal->user->full_name ?? ''}}"
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
                                                               value="{{ $journal->created_at}}"
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
                                                               value="{{ $journal->updated_at }}"
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
                                            id="button_save"  :disabled="journal_type_id == 1 && totalDebit != totalCredit || journal_type_id == 3 && totalDebit != totalCredit">
                                        <i class="ft ft-save"></i> {{__('admin.edit')}}
                                    </button>
                                    <a href="{{ url('/accounts/journal')}}"
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
        window.editItems = @json($journal_details);
        window.editJournalTypeId = {{ $journal->journal_type_id }};
        const app = Vue.createApp({
            data() {
                return {
                    journal_type_id: window.editJournalTypeId ?? {{ $journal_type->first()->id }},
                    items: window.editItems.map(row => ({
                        id: row.id,
                        account_id: row.account_id,
                        acc_debit: row.acc_debit,
                        acc_credit: row.acc_credit,
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

                    const res = await fetch(`/accounts/journal/falter_curr_val/${item.currency_id}`);
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
                        acc_debit: 0,
                        acc_credit: 0,
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
                            await fetch(`/accounts/journal/details/delete/${item.id}`, {
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
                }
            },
            computed: {
                totalDebit() {
                    return this.items.reduce((sum, it) => sum + (Number(it.acc_debit) || 0), 0);
                },
                totalCredit() {
                    return this.items.reduce((sum, it) => sum + (Number(it.acc_credit) || 0), 0);
                },

                totalBalance() {
                    return this.totalDebit - this.totalCredit;
                },

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
