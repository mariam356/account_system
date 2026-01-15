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
                // زر الحفظ
                buttonText: "{{ __('admin.add') }}",
                buttonIcon: "la la-check-square-o",
                dataUrl: "{{ route('inventory_management.store') }}",
                dataType: "add",

                // بيانات الجدول
                inventory_managementId: 0,
                editRowIndex: null,
                rows: [],

                searchQuery: "",
                searchTimer: null,

                // نموذج
                form: {

                    quantity_out: "",
                    quantity_in: "",
                    price: "",

                },

                errors: {
                    quantity_out: "",
                    quantity_in: "",
                    price: "",

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

            this.loadInventoryManagement();


        },

        methods: {

            async searchInventoryManagement() {
                clearTimeout(this.searchTimer);
                this.searchTimer = setTimeout(async () => {
                    try {
                        let url = "/stores/inventory_management/search";
                        this.rows = await window.apiService.responseEditOrShowData2(url + "?query=" + this.searchQuery, this);
                    } catch (e) {
                        console.error("Search error:", e);
                    }
                }, 300);
            },

            async loadInventoryManagement(page = 1) {
                try {
                    const res = await axios.get(`/stores/inventory_management/show?page=${page}&table_length=${this.perPage}`);
                    const data = res.data;

                    this.rows = data.data;          // بيانات الجدول
                    this.currentPage = data.current_page;
                    this.lastPage = data.last_page;
                    this.perPage = data.per_page;
                    this.total = data.total;

                } catch (err) {
                    console.error("Error loading data:", err);
                }
            },


            saveRow(row) {
                axios.post('{{ route("inventory_management.store") }}', {
                    products: [row],
                    actual_quantity: row.actual_quantity
                })
                    .then(response => {
                        row.system_quantity = row.actual_quantity;

                    })
                    .catch(error => {
                        console.error(error);
                        // alert('حدث خطأ أثناء حفظ الجرد');
                    });



        },





            async deleteInventoryManagement(id, index) {
                const route = `/stores/inventory_management/destroy/${id}`;

                // اجعل الصف مميزًا (بدل jQuery)
                this.rows[index].isActive = true;

                try {
                    await window.apiService.deletedItems2(id, route,this);

                    // احذف الصف من Vue array
                    this.rows.splice(index, 1);

                } catch (e) {
                    // رجّع لون الصف إذا فشل الحذف
                    this.rows[index].isActive = false;
                    console.error(e);
                }
            },



        }

    }).mount("#app");


</script>

