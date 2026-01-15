<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>

    window.translations = {
        loading: '{{ __("admin.loading") }}',
        loading_failed: '{{ __("admin.loading_failed") }}',
        adding:"{{__('admin.adding')}}",
        add:"{{__('admin.add')}}",
        updating:"{{__('admin.updating')}}",
        edit:"{{__('admin.edit')}}",
        ok:"{{__('admin.ok')}}",
        Are_you_sure:"{{__('admin.are_you_sure_you_want_to_remove_this_data')}}",
        Data_will_be_permanently_deleted:"{{__('admin.the_data_will_be_permanently_deleted')}}",
        yes:"{{__('admin.yes')}}",
        no:"{{__('admin.no')}}",
        canceled:"{{__('admin.canceled')}}"
    };

    const { createApp } = Vue;
    window.currencyRates = @json($currency);
    createApp({
        data() {
            return {
                rows: [],
                searched: false,
                loading: false,
                form: {
                    operation_type_id: '',
                    from_date: '',
                    to_date: '',
                    currency_id: '',
                    curr_val: '',
                    account_id: ''
                },
                currencyRates: window.currencyRates,
                total: 0,
                perPage: 10,
                currentPage: 1,
                lastPage: 1
            };
        },

        computed: {
            hasRows() {
                return Array.isArray(this.rows) && this.rows.length > 0;
            },
            hasFilters() {
                return Object.values(this.form).some(v => v);
            },
            totalDebit() {
                return this.rows.reduce((sum, row) => {
                    const debit = Number(row.total_debit) || 0;
                    return sum + (this.form.curr_val ? debit / this.form.curr_val : debit);
                }, 0);
            },

            totalCredit() {
                return this.rows.reduce((sum, row) => {
                    const credit = Number(row.total_credit) || 0;
                    return sum + (this.form.curr_val ? credit / this.form.curr_val : credit);
                }, 0);
            },

            totalBalance() {
                return this.totalDebit - this.totalCredit;
            }
        },
        watch: {
            'form.currency_id'(id) {
                const currency = this.currencyRates.find(c => c.id == id);
                this.form.curr_val = currency ? currency.curr_val : '';
            }
        },

        methods: {
            openReport() {
                // 1. جلب الفلاتر من الرابط الحالي إن وجدت
                const urlParams = new URLSearchParams(window.location.search);
                const currentIds = urlParams.get('ids');

                if (currentIds) {
                    const url = `/accounts/profit_loss/report_export?ids=${currentIds}`;
                    window.open(url, '_blank');
                }
                else {
                    // 2. الوصول للبيانات (تأكد من التعامل مع هيكلة الـ Pagination)
                    let items = Array.isArray(this.rows) ? this.rows : (this.rows.data || []);

                    if (items.length === 0) return alert("لا توجد بيانات للطباعة");

                    // 3. التعديل الجوهري: استخدام account_id بدلاً من id
                    // واستخدام filter لضمان عدم وجود قيم فارغة
                    const ids = items
                        .map(row => row.account_id)
                        .filter(id => id != null) // لضمان عدم ظهور الفواصل الفارغة
                        .join(',');

                    if (!ids) return alert("فشل في تحديد أرقام الحسابات");

                    window.open(`/accounts/profit_loss/report_export?ids=${ids}`, '_blank');
                }
            },
            async search(page = 1) {
                this.loading = true;
                this.searched = true;

                try {
                    const res = await axios.get('/accounts/profit_loss/search', {
                        params: {
                            ...this.form,
                            page: page,
                            table_length: this.perPage
                        }
                    });

                    const data = res.data;

                    this.rows = data.data;
                    this.currentPage = data.current_page;
                    this.lastPage = data.last_page;
                    this.perPage = data.per_page;
                    this.total = data.total;

                } catch (err) {
                    console.error(err);
                } finally {
                    this.loading = false;
                }
            },



        }
        }).mount('#app');




</script>

