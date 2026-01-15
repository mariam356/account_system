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
    function addOrUpdate(url, data, type, id_button) {
        let btn_lang_before = "{{__('admin.adding')}}";
        let btn_lang = '<i class="ft-save"></i> ' + "{{__('admin.add')}}";
        if (type === 'Update') btn_lang_before = "{{__('admin.updating')}}";
        if (type === 'Update') btn_lang = '<i class="ft-edit"></i> ' + "{{__('admin.edit')}}";

        return new Promise((resolve, reject) => {
            $.ajax({
                url: url,
                method: "POST",
                data: data,
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function () {
                    $('#' + id_button).html('<i class="la la-spinner spinner"></i><span>' + btn_lang_before + '...</span>');
                    $('input, select').removeClass('is-invalid');
                    $('span strong').empty();
                },
                success: function (data) {
                    $('#' + id_button).html(btn_lang);
                    $('#row-not-found').remove();
                    var myhtml = document.createElement("div");
                    myhtml.innerHTML = data.message;
                    swal({
                        icon: "success",
                        title: data.title + "!",
                        /*text: data.message + ".",*/
                        content: myhtml,
                        button: '{{__('admin.ok')}}'
                    });
                    resolve(data);
                    $('#form input[type="text"]').val('');
                    $('#form input[type="number"]').val('');
                    $('#form input[type="email"]').val('');
                    $('#form input[type="date"]').val('');
                    $('#form input[type="file"]').val('');
                    $('#avatar').attr('hidden',true);
                    $('#delete-img').attr('hidden',true);
                    $('#form textarea').val('');
                    $('#form select').val('');
                    $('#form .select2').val('').trigger('change');

                    $('#form input[type="radio"], #form input[type="checkbox"]').prop('checked', false);
                    $('input[name="appearance_status"][value="1"]').prop('checked', true);
                    $('input[name="default"][value="1"]').prop('checked', true);
                    $('input[name="status"][value="1"]').prop('checked', true);
                    $('input[name="stock_currency"][value="1"]').prop('checked', true);

                },
                error: function (data) {
                    if (data.status !== 401){
                        $('#message-loading-or-error').html('{{__('admin.loading_failed')}} <i class="ft-alert-triangle color-red"></i>');
                        $('#confirm-modal-loading-show').modal('show');
                    }
                    if (data.status == 401){
                        $('#message-loading-or-error').html('{{__('admin.available_currency_exists')}} <i class="ft-alert-triangle color-red"></i>');
                        $('#confirm-modal-loading-show').modal('show');
                    }
                    $('#' + id_button).html(btn_lang);
                    reject(data);
                }
            });
        });
    }

    /**
     * response edit data or display Data.
     * The data is sent in a GET method.
     *
     * @param url string => url path
     */
    function responseEditOrShowData(url) {
        return new Promise((resolve, reject) => {
            $.ajax({
                type: 'GET',
                url: url,
                dataType: "json",
                beforeSend: function () {
                    $('#message-loading-or-error').html('{{__('admin.loading')}} <i class="la la-spinner spinner"></i>');
                    $('#confirm-modal-loading-show').modal('show');
                },
                success: function (data) {
                    $('#confirm-modal-loading-show').modal('hide');
                    resolve(data);
                },
                error: function (data) {
                    $('#message-loading-or-error').html('{{__('admin.loading_failed')}} <i class="ft-alert-triangle color-red"></i>');
                    $('#confirm-modal-loading-show').modal('show');
                    reject(data);
                }
            })
        });
    }

    /**
     * Delete data using AJAX and return swal message
     * The data is sent in a DELETE method.
     *
     * @param items_id ids to be deleted
     * @param route  url path
     * @returns {Promise<unknown>}
     */
    function deletedItems(items_id, route) {
        return new Promise((resolve, reject) => {
            swal({
                title: "{{__('admin.are_you_sure_you_want_to_remove_this_data')}}",
                text: "{{__('admin.the_data_will_be_permanently_deleted')}}!",
                icon: "warning",
                buttons: {
                    cancel: {
                        text: "{{__('admin.no')}}",
                        value: null,
                        visible: true,
                        className: "",
                        closeModal: false,
                    },
                    confirm: {
                        text: "{{__('admin.yes')}}",
                        value: true,
                        visible: true,
                        className: "",
                        closeModal: false
                    }
                }
            })
                .then((isConfirm) => {
                    if (isConfirm) {
                        $.ajax({
                            type: 'POST',
                            data: {
                                _method: 'delete',
                                _token: $('input[name ="_token"]').val(),
                                items_id: items_id,
                            },
                            url: route,
                            dataType: "json",
                            success:  function (data) {
                                if (data.data_count === 0){
                                    $('#table tbody').html(
                                        '<tr id="row-not-found">' +
                                        '   <td colspan="9" class="text-center">' +
                                        '       {{__('admin.no_data')}}' +
                                        '       <hr>' +
                                        '   </td>' +
                                        '</tr>'
                                    );
                                }
                                swal({
                                    icon: "success",
                                    {{--text: "{{$delete_success ?? ''}}!",--}}
                                    title: "" + data.message,
                                    button: '{{__('admin.ok')}}'
                                });
                                resolve(data);
                            },
                            error: function (data) {
                                swal({
                                    icon: "error",
                                    title: "{{__('admin.error')}}",
                                    text: data.responseJSON.error_delete,
                                    button: '{{__('admin.ok')}}'
                                });
                                reject(data);
                            }
                        })
                    } else {
                        swal({
                            icon: "error",
                            text: "",
                            title: "{{__('admin.canceled')}}",
                            button: '{{__('admin.ok')}}'
                        });
                        return reject('reject message use no');
                    }
                });
        });
    }

    /**
     *
     */
    function statusChange(
        items_id,
        route,
        title,
        text,
        icon
    ) {
        return new Promise((resolve, reject) => {
            swal({
                title: title,
                text: text,
                icon: icon,
                buttons: {
                    cancel: {
                        text: "{{__('admin.no')}}",
                        value: null,
                        visible: true,
                        className: "",
                    },
                    confirm: {
                        text: "{{__('admin.yes')}}",
                        value: true,
                        visible: true,
                        className: "",
                        closeModal: false
                    }
                }
            })
                .then((isConfirm) => {
                    if (isConfirm) {
                        $.ajax({
                            type: 'POST',
                            data: {
                                _token: $('input[name ="_token"]').val(),
                                items_id: items_id,
                            },
                            url: route,
                            dataType: "json",
                            success:  function (data) {
                                if (data.data_count === 0){
                                    $('#table tbody').html(
                                        '<tr id="row-not-found">' +
                                        '   <td colspan="9" class="text-center">' +
                                        '       {{__('admin.no_data')}}' +
                                        '       <hr>' +
                                        '   </td>' +
                                        '</tr>'
                                    );
                                }
                                swal({
                                    icon: "success",
                                    title: data.title + "!",
                                    text: data.message,
                                    button: '{{__('admin.ok')}}'
                                });
                                resolve(data);
                            },
                            error: function (data) {
                                swal({
                                    icon: "error",
                                    title: "{{__('admin.error')}}",
                                    text: data.responseJSON.error_delete,
                                    button: '{{__('admin.ok')}}'
                                });
                                reject(data);
                            }
                        })
                    }
                });
        });
    }
</script>
