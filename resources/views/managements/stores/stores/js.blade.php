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
                dataUrl: "{{ route('stores.store') }}",
                dataType: "add",

                // بيانات الجدول
                storesId: 0,
                editRowIndex: null,
                rows: [],
                searchQuery: "",
                searchTimer: null,

                // نموذج
                form: {
                    status: "",
                    name_ar: "",
                    name_en: "",
                    address_ar: "",
                    address_en: "",
                    manager_name_ar: "",
                    manager_name_en: "",
                    phone: "",

                },

                errors: {
                    status: "",
                    name_ar: "",
                    name_en: "",
                    address_ar: "",
                    address_en: "",
                    manager_name_ar: "",
                    manager_name_en: "",
                    phone: "",
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
            this.resetButton();
            this.loadStores();

            document.addEventListener('click', (e) => {
                if (e.target.closest('.edit-row')) { //هو العنصر الذي تم النقر عليه مباشرةً.
                    const el = e.target.closest('.edit-row');
                    // إذا وجدت العنصر نفسه أو أحد الأبوين الذي يحمل الكلاس .edit-row → تعيد العنصر.
                    //  إذا لم يوجد → تعيد null
                    const id = el.dataset.id; //dataset يسمح لك بالوصول إلى أي attribute يبدأ بـ data- داخل HTML
                    this.editStores(id, 0); // index يمكن تجاهله أو إضافته حسب الحاجة
                }
            });

        },

        methods: {


            async searchStores() {
                clearTimeout(this.searchTimer);
                this.searchTimer = setTimeout(async () => {
                    try {
                        let url = "/stores/stores/search";
                        this.rows = await window.apiService.responseEditOrShowData2(url + "?query=" + this.searchQuery, this);
                    } catch (e) {
                        console.error("Search error:", e);
                    }
                }, 300);
            },

            async loadStores(page = 1) {
                try {
                    const res = await axios.get(`/stores/stores/show?page=${page}&table_length=${this.perPage}`);
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



            resetButton() {
                this.buttonText = "{{ __('admin.add') }}";
                this.buttonIcon = "la la-check-square-o";
                this.dataUrl = "{{ route('stores.store') }}";
                this.dataType = "add";
            },

            resetForm() {
                // امسح كل قيم الحقول داخل form
                Object.keys(this.form).forEach(key => {
                    this.form[key] = '';
                });


                // مسح الأخطاء إن وجدت
                if (this.errors) {
                    Object.keys(this.errors).forEach(key => {
                        this.errors[key] = '';
                    });
                }
            },


            async editStores(id, index) {
                this.storesId = id;
                this.editRowIndex = index;

                this.buttonText = "{{ __('admin.edit') }}";
                this.buttonIcon = "ft-edit";
                this.dataUrl = `/stores/stores/update/${id}`;
                this.dataType = "Update";

                try {
                    let url = `/stores/stores/edit/${id}`;
                    let data = await window.apiService.responseEditOrShowData2(url, this);


                    Object.assign(this.form, data);
                    this.form.status = data.status;
                    this.form.name_ar = data.name_ar;
                    this.form.name_en = data.name_en;
                    this.form.address_ar = data.address_ar;
                    this.form.address_en = data.address_en;
                    this.form.manager_name_ar = data.manager_name_ar;
                    this.form.manager_name_en = data.manager_name_en;
                    this.form.phone = data.phone;



                } catch (e) {
                    console.error(e);
                }


            },

            async saveStores() {
                // امسح الأخطاء القديمة
                Object.keys(this.errors).forEach(k => this.errors[k] = "");

                let formElement = document.getElementById('form');
                if (!formElement) {
                    console.error("Form element with id='form' not found!");
                    return;
                }

                let fd = new FormData(formElement);
                fd.append("stores_id", this.storesId);

                try {
                    // حاول تنفذ الطلب (افترض نفس النداء لديك)
                    let result = await window.apiService.addOrUpdate2(this.dataUrl, fd, this.dataType, "btn-save", this);

                    // اطبع النتيجة عشان تتأكد شكلها
                    console.log("SUCCESS result:", result);

                    if (result && result.status === 200) {
                        let res = result.stores;
                        if (this.dataType === "add") {
                            this.rows.unshift(res);
                        } else {
                            this.rows[this.editRowIndex] = res;
                        }
                        this.resetForm();
                    } else {
                        // في حالات الـ API يرجع 200 لكنه يحتوي على خطأ داخل الجسم
                        console.warn("Result but not status 200:", result);
                    }

                } catch (error) {
                    // اطبع كل شيء لنفهم شكل الخطأ
                    console.error("CATCH error (full):", error);
                    console.error("error.response:", error.response);
                    console.error("error.response && error.response.data:", error.response ? error.response.data : undefined);

                    // مسح الأخطاء القديمة قبل تعيين أخطاء جديدة
                    Object.keys(this.errors).forEach(k => this.errors[k] = "");

                    // حاول التقاط أكثر من شكل شائع لرسائل الفاليديشن:
                    let payload = null;

                    if (error.response && error.response.data) {
                        payload = error.response.data;
                    } else if (error.data) {
                        payload = error.data;
                    } else if (error.responseText) {
                        try { payload = JSON.parse(error.responseText); } catch(e) { payload = null; }
                    }

                    // أشكال ممكنة:
                    // { errors: { phone: ["..."] } }
                    // { error: { phone: ["..."] } }
                    // { message: "..." }
                    // { phone: ["..."] }  <-- directly

                    if (payload) {
                        // case: payload.errors or payload.error
                        let obj = payload.errors || payload.error || payload;

                        if (typeof obj === 'object') {
                            for (let field in obj) {
                                if (this.errors.hasOwnProperty(field)) {
                                    // لو القيم مصفوفة مثلاً ["..."]
                                    this.errors[field] = Array.isArray(obj[field]) ? obj[field][0] : obj[field];
                                }
                            }
                            return;
                        }

                        // لو payload.message فقط
                        if (payload.message) {
                            // عرض رسالة عامة (ما عندك حقل مخصص) — يمكن تضيف alert أو toast
                            console.warn("Server message:", payload.message);
                        }
                    }

                    // لو كل شيء فشل، اعرض خطأ عام في الكونسل
                    console.error("Could not parse validation errors from server. See error.response above.");
                }
            },



            async deleteStores(id, index) {
                const route = `/stores/stores/destroy/${id}`;

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

