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

    createApp({

        data() {
            return {


                // بيانات الجدول
                category_movementId: 0,
                editRowIndex: null,
                rows: [],

                searchQuery: "",
                searchTimer: null,

                // نموذج
                form: {
                    from_date: '',
                    to_date: '',
                    product_id: '',
                    movement_type_id: '',

                },



                loadingMessage: '',
                showModal: false,
                total: 0,
                perPage: 10,
                currentPage: 1,
                lastPage: 1
            };
        },
        computed: {
            currentCount() {
                return this.rows.length; // عدد الصفوف الحالي في الصفحة
            },
            totalCount() {
                return this.total || this.rows.length; // إجمالي عدد الصفوف في قاعدة البيانات
            }
        },

        mounted() { // الحاجة إلى الوصول للعناصر داخل الصفحة

            this.loadCategoryManagement();


        },

        methods: {
// دالة تنسيق التاريخ
            formatDate(dateString) {
                if (!dateString) return '-';
                const date = new Date(dateString);
                return date.toISOString().split('T')[0];
            },

            // دالة حساب الرصيد التراكمي برمجياً في الواجهة
            calculateRunningBalance(index) {
                let balance = 0;
                // ملاحظة: الرصيد التراكمي في Vue يعتمد على ترتيب المصفوفة rows
                // سنحسب من بداية المصفوفة حتى السطر الحالي
                for (let i = 0; i <= index; i++) {
                    balance += (parseFloat(this.rows[i].quantity_in) - parseFloat(this.rows[i].quantity_out));
                }
                return balance;
            },

            async search() {
                // جلب القيمة من Select2 يدوياً لأن v-model قد لا يعمل معه مباشرة
                const selectedProductId = $('#product_id').val();
                const selectedMovementTypeIdId = $('#movement_type_id').val();
                console.log(selectedMovementTypeIdId)
                clearTimeout(this.searchTimer);
                this.searchTimer = setTimeout(async () => {
                    try {
                        const params = new URLSearchParams({
                            // تأكد من استخدام مراجع الـ form الصحيحة
                            product_id: selectedProductId || '',
                            movement_type_id: selectedMovementTypeIdId || '',
                            from_date: this.form.from_date || '',
                            to_date: this.form.to_date || '',
                            query: this.searchQuery || ''
                        }).toString();

                        let url = `/stores/category_movement/search?${params}`;

                        const response = await window.apiService.responseEditOrShowData2(url, this);

                        // التأكد أن النتيجة مصفوفة دائماً
                        if (response && Array.isArray(response)) {
                            this.rows = response;
                        } else if (response && response.data) {
                            // في حال كان السيرفر يستخدم Pagination
                            this.rows = response.data;
                        } else {
                            // إذا لم يوجد نتائج (تاريخ غير موجود مثلاً)
                            this.rows = [];
                        }

                    } catch (e) {
                        this.rows = []; // تصفير الجدول في حال حدوث خطأ
                        console.error("Search error:", e);
                    }

                }, 300);
            },

            async loadCategoryManagement(page = 1) {
                try {
                    const res = await axios.get(`/stores/category_movement?page=${page}&table_length=${this.perPage}`);
                    const data = res.movements;

                    this.rows = data.data;          // بيانات الجدول
                    this.currentPage = data.current_page;
                    this.lastPage = data.last_page;
                    this.perPage = data.per_page;
                    this.total = data.total;

                } catch (err) {
                    console.error("Error loading data:", err);
                }
            },




        }

    }).mount("#app");


</script>

