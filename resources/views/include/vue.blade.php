<script>
    /**
     * Adding new data or update existing data.
     * The data is sent in a POST method.
     *
     * @param url  string => url path
     * @param data array => the data http request
     * @param type string => Add or Update
     * @param id_button string
     * @returns {Promise<unknown>}
     */


        // apiService.js - خدمة API العامة
        // ajax-CRUD.js - يحتوي على الدوال المشتركة
    class ApiService {
        // {
        //data: {...},       // البيانات الفعلية التي طلبتها
        //status: 200,       // كود حالة HTTP
        //statusText: "OK",  // نص حالة HTTP
        // headers: {...},    // رؤوس الاستجابة
        // config: {...},     // إعدادات الطلب
        //  request: {...}     // معلومات عن الطلب نفسه
        //}
        //
        //هنا res يمثل هذا الكائن كله.

        responseEditOrShowData2(url, vueInstance = null) { // vueInstance == this in js.blade.php
            const translations = window.translations || {};

            if (vueInstance) {
                vueInstance.loadingMessage = translations.loading || 'Loading...';
                vueInstance.showModal = true;
            }

            return new Promise((resolve, reject) => {
                axios.get(url)
                    .then(res => { // عند نجاح الطلب
                        if (vueInstance) vueInstance.showModal = false;
                        resolve(res.data); // resolve: دالة تُستدعى عندما تنجح العملية. تمرر لها النتيجة.
                        //لأن غالبًا ما نحتاج فقط البيانات التي أرسلها السيرفر، وليست كل معلومات الاستجابة. res.data
                    })
                    .catch(err => {
                        if (vueInstance) {
                            vueInstance.loadingMessage = translations.loading_failed || 'Loading failed!';
                            setTimeout(() => {
                                vueInstance.showModal = false;
                            }, 3000);
                        }
                        /*عند فشل الطلب (.catch):

                        إذا كان هناك vueInstance نغيّر رسالة التحميل إلى رسالة فشل (loading_failed) ثم نغلق المودال بعد 3 ثواني (يعطي المستخدم وقت لقراءة الرسالة).
                   */
                        reject(err); //reject: دالة تُستدعى عندما تفشل العملية. تمرر لها الخطأ أو سبب الفشل.
                    });
            });
        }

        async addOrUpdate2(url, formData, type, buttonId, vueInstance = null) {
            const translations = window.translations || {};

            let btnTextBefore = translations.adding || 'Adding...';
            let btnText = translations.add || 'Add';

            if (type === 'Update') {
                btnTextBefore = translations.updating || 'updating...';
                btnText = translations.edit || 'edit';
            }

            try {
                // قبل الإرسال - تحديث واجهة المستخدم
                if (vueInstance) {
                    this.updateButtonState2(vueInstance, buttonId, true, btnTextBefore);
                    this.clearValidationErrors2(vueInstance);
                }

                const response = await axios.post(url, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                });

                // في حالة النجاح
                if (vueInstance) {
                    this.handleSuccess2(vueInstance, response.data, buttonId, btnText);
                }

                return response.data;

            } catch (error) {
                // في حالة الخطأ
                if (vueInstance) {
                    this.handleError2(vueInstance, error, buttonId, btnText);
                }
                throw error;
            }
        }

        // دوال مساعدة
        updateButtonState2(vueInstance, buttonId, isLoading, text) {
            // إذا كان لديك refs للزر
            if (vueInstance.$refs[buttonId]) {
                vueInstance.$refs[buttonId].innerHTML = isLoading
                    ? `<i class="la la-spinner spinner"></i><span>${text}...</span>`
                    : text;
                vueInstance.$refs[buttonId].disabled = isLoading;
            }

            // أو إذا كنت تريد استخدام state في Vue
            vueInstance.isLoading = isLoading;
            vueInstance.buttonText = text;
        }

        clearValidationErrors2(vueInstance) {
            if (vueInstance.errors) {
                Object.keys(vueInstance.errors).forEach(key => { //يستخدم Object.keys() للحصول على كل مفاتيح الحقول (name, email, ...).
                    vueInstance.errors[key] = '';
                });
            }

            // إزالة classes الخطأ من العناصر
            const inputs = document.querySelectorAll('input, select');
            inputs.forEach(input => {
                input.classList.remove('is-invalid'); // عند التحقق من البيانات، عادةً يضاف للحقول class اسمه is-invalid ليظهر الحقل باللون الأحمر أو تأثير آخر.
            });
        }

        handleSuccess2(vueInstance, data, buttonId, btnText) {
            // إعادة حالة الزر
            this.updateButtonState2(vueInstance, buttonId, false, btnText);

            // عرض رسالة النجاح
            this.showSuccessMessage2(data);

            // إعادة تعيين الفورم
            this.resetForm2(vueInstance);

            // resolve البيانات للاستخدام الخارجي
            if (vueInstance.$emit) { //$emit هي طريقة لإرسال حدث (Event) من مكوّن ابن إلى مكوّن أب أو أي مستمع للحدث.
                vueInstance.$emit('operation-success', data); // operation-success the name of event
            }
        }

        handleError2(vueInstance, error, buttonId, btnText) {
            // إعادة حالة الزر
            this.updateButtonState2(vueInstance, buttonId, false, btnText);

            if (error.response?.status !== 401) {
                this.showErrorMessage2(vueInstance);
            }

            // معالجة أخطاء التحقق
            if (error.response?.status === 422 && error.response.data.errors) {
                this.setValidationErrors2(vueInstance, error.response.data.errors);
            }
        }

        showSuccessMessage2(data) {
            // استخدام SweetAlert أو أي مكتبة أخرى
            if (typeof swal !== 'undefined') { // typeof هي عامل (operator) في JavaScript يُستخدم لمعرفة نوع المتغير أو القيمة.
                const myhtml = document.createElement("div");
                myhtml.innerHTML = data.message;

                swal({
                    icon: "success",
                    title: data.title + "!",
                    content: myhtml,
                    button: window.translations?.ok || 'OK'
                });
            } else {
                // بديل إذا لم تكن SweetAlert متاحة
                console.log('Success:', data.title, data.message);
                alert(data.message);
            }
        }

        showErrorMessage2(vueInstance) {
            if (vueInstance.loadingMessage !== undefined) {
                vueInstance.loadingMessage = window.translations?.loading_failed || 'Loading failed!';
                vueInstance.showModal = true;

                setTimeout(() => {
                    vueInstance.showModal = false;
                }, 3000);
            }
        }

        setValidationErrors2(vueInstance, errors) {
            if (vueInstance.errors) {
                Object.keys(errors).forEach(field => {
                    if (vueInstance.errors.hasOwnProperty(field)) {
                       /* هذا يتحقق أن الحقل موجود بالفعل داخل نموذج Vue.

                            يمنع ظهور أخطاء إذا كانت هناك حقول إضافية في الاستجابة من السيرفر لا نستخدمها في المكوّن.*/
                        vueInstance.errors[field] = errors[field][0];
                    }
                });
            }
        }

        resetForm2(vueInstance) {
            if (!vueInstance.form) return; ///إذا لم يكن هناك كائن form داخل المكوّن، لا نفعل أي شيء ونتوقف عن التنفيذ.
            //   هذا يحمي الكود من الأخطاء.

            // إعادة تعيين حقول الفورم
            Object.keys(vueInstance.form).forEach(key => {
                if (typeof vueInstance.form[key] === 'string') {
                    vueInstance.form[key] = '';
                } else if (typeof vueInstance.form[key] === 'number') {
                    vueInstance.form[key] = 0;
                } else if (typeof vueInstance.form[key] === 'boolean') {
                    vueInstance.form[key] = false;
                }
            });

            // إعادة تعيين القيم الافتراضية
            if (vueInstance.form.appearance_status !== undefined) {
                vueInstance.form.appearance_status = '1';
            }
            if (vueInstance.form.default !== undefined) {
                vueInstance.form.default = '1';
            }
            if (vueInstance.form.status !== undefined) {
                vueInstance.form.status = '1';
            }
            if (vueInstance.form.stock_currency !== undefined) {
                vueInstance.form.stock_currency = '1';
            }

            // إعادة تعيين الصورة
            if (vueInstance.avatarSrc !== undefined) {
                vueInstance.avatarSrc = null;
            }
            if (vueInstance.$refs.avatar) {
                vueInstance.$refs.avatar.hidden = true;
            }
            if (vueInstance.$refs.deleteBtn) {
                vueInstance.$refs.deleteBtn.hidden = true;
            }
            if (vueInstance.$refs.image) {
                vueInstance.$refs.image.value = null;
            }
        }

        async deletedItems2(itemId, route, vueInstance = null) {
            const trans = window.translations || {};

            try {
                // تأكيد الحذف
                const isConfirm = await new Promise((resolve) => { //await new Promise(...) → ننتظر اختيار المستخدم قبل متابعة الحذف.
                    swal({
                        title: trans.Are_you_sure || 'Are_you_sure',
                        text: trans.Data_will_be_permanently_deleted || 'Data_will_be_permanently_deleted',
                        icon: "warning",
                        buttons: {
                            cancel: {text: trans.no || 'No', value: null},
                            confirm: {text: trans.yes || 'Yes', value: true}
                        }
                    }).then(resolve);
                });

                if (!isConfirm) {
                    swal({icon: "error", title: trans.canceled || 'canceled', button: trans.ok || 'OK'});
                    throw new Error('cancelled');
                }

                // تنفيذ الحذف
                const formData = new FormData();
                formData.append('_method', 'delete');
                formData.append('_token', document.querySelector('meta[name="csrf-token"]')?.content || '');
                formData.append('items_id', itemId);

                const response = await axios.post(route, formData);

                // عرض النجاح
                swal({
                    icon: "success",
                    title: response.data.message || 'Deleted!',
                    button: trans.ok || 'OK'
                });

                // تحديث الجدول إذا كان فارغاً
                if (vueInstance && response.data.data_count === 0) {
                    vueInstance.rows = [];
                }

                return response.data;

            } catch (error) {
                // معالجة الخطأ
                if (error.response?.data?.error_delete) {
                    swal({
                        icon: "error",
                        title: trans.error || 'Error',
                        text: error.response.data.error_delete,
                        button: trans.ok || 'OK'
                    });
                }
                throw error;
            }
        }


        async statusChange2(itemId, route, title, text, icon, vueInstance = null) {
            const trans = window.translations || {};

            try {
                // تأكيد تغيير الحالة
                const isConfirm = await new Promise((resolve) => {
                    swal({
                        title: title,
                        text: text,
                        icon: icon,
                        buttons: {
                            cancel: {text: trans.no || 'No', value: null},
                            confirm: {text: trans.yes || 'Yes', value: true}
                        }
                    }).then(resolve);
                });

                if (!isConfirm) {
                    throw new Error('Cancelled');
                }

                // تنفيذ الطلب
                const formData = new FormData();
                formData.append('_token', document.querySelector('meta[name="csrf-token"]')?.content || '');
                formData.append('items_id', itemId);

                const response = await axios.post(route, formData);

                // عرض النجاح
                swal({
                    icon: "success",
                    title: response.data.title + "!",
                    text: response.data.message,
                    button: trans.ok || 'OK'
                });

                // تحديث الجدول إذا كان فارغاً
                if (vueInstance && response.data.data_count === 0) {
                    vueInstance.rows = [];
                }

                return response.data;

            } catch (error) {
                // معالجة الخطأ
                if (error.message !== 'Cancelled') {
                    swal({
                        icon: "error",
                        title: trans.error || 'Error',
                        text: error.response?.data?.error_delete || 'Operation failed',
                        button: trans.ok || 'OK'
                    });
                }
                throw error;
            }
        }

    }

    // جعل الخدمة متاحة globally
    window.apiService = new ApiService();


</script>
