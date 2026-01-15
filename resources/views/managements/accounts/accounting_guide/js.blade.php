<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>


    $(document).ready(function () {
        treeBuilding();

        function treeBuilding() {

            $.ajax({
                type: 'GET',
                url: "{{route('account.treeBuilding')}}",
                dataType: "json",

                success: function (data) {
                    var i, j;

                    $('#min-tree').html(

                        '<ul>' +
                        '<li>' +
                        '<a href="javascript:void(0);"><div class="member-view-box">' +
                        '<button type="button" class="btn account"><span class="span span-accounting-guide">{{__('admin.accounting_guide')}}</span></button>' +
                        @can('create account')

                            '<button type="button" class="add-accounting-guide btn btm-sm btn-success add-sub-row" title="اضافة تصنيف تحت هذا التصنيف"' +
                        'data-ranks="0" data-id="0" hidden><i class="ft-plus"></i></button>' +
                        @endcan

                            '<br>' +
                        '<button type="button" class="plus btn">-</button>' +
                        '</div>' +
                        '</a>' +
                        '<ul class="active" id="null"></ul>' +
                        '</li>' +
                        '</ul>'
                    );

                    for (i = 0; i < data.account.length; i++) {
                        for (j = 0; j < data.account[i].length; j++) {

                            if (data.account[i][j]['account_id'] === null) data.account[i][j]['account_id'] = 'null';
                            btn_delete = '';

                            @can('delete account')
                                btn_delete = '<button type="button" class="btn btm-sm btn-danger delete-sub-row " data-id="' + data.account[i][j]['id'] + '" title="حذف" hidden><i class="ft-trash-2"></i></button>';
                            @endcan

                                tree = '<li>' +
                                '<a href="javascript:void(0);">' +
                                '<div class="member-view-box">';

                            @can('update account')
                                tree += '<button type="button" class="btn btm-sm btn-blue edit-sub-row" data-id="' + data.account[i][j]['id'] + '" title="{{__('admin.edit')}} " hidden><i class="ft-edit"></i></button>';
                            @endcan
                                tree += '<button type="button" class="btn account"><span class="span span-accounting-guide">' + data.account[i][j]['name'] + ' - ' + data.account[i][j]['acc_code'] +  '</span></button>';

                            @can('create account')

                                tree += '<button type="button" class="add-accounting-guide btn btm-sm btn-success add-sub-row" title="اضافة تصنيف تحت هذا التصنيف" data-ranks="' + data.account[i][j]['ranks'] + '" data-id="' + data.account[i][j]['id'] + '" hidden><i class="ft-plus"></i></button>';

                            @endcan
                            /*else {
                                if (data.account[i][j]['is_leaf'] === false) tree += btn_delete;
                            }*/

                            if (data.account[i][j]['is_leaf'] === true) tree += '<br><button type="button" class="plus btn">-</button>';
                            else {
                                if (data.account[i][j]['is_leaf'] === false) tree += '<br>' + btn_delete;

                            }

                            tree += '</div></a>';
                            if (data.account[i][j]['is_leaf'] === true) tree += '<ul class="active" id="' + data.account[i][j]['id'] + '"></ul>';

                            tree += '</li>';

                            $('#' + data.account[i][j]['account_id']).append(tree);
                        }
                    }
                    eventTree();
                    $('#save').text('إضافة');
                    $('#edit').text('{{__('admin.edit')}}');

                },
            });
        }

        let data_id, data_ranks;

        function eventTree() {
            $('.account').on('click', function (e) {
                e.preventDefault();
                if ($(this).hasClass('btn-hide')) {
                    $(this).removeClass('btn-hide');
                    $(this).parent().find('.edit-sub-row').attr('hidden', true);
                    $(this).parent().find('.delete-sub-row').attr('hidden', true);
                    $(this).parent().find('.add-sub-row').attr('hidden', true);
                    $(this).removeClass('active');
                } else {
                    $(this).addClass('btn-hide');
                    $(this).parent().find('.edit-sub-row').attr('hidden', false);
                    $(this).parent().find('.delete-sub-row').attr('hidden', false);
                    $(this).parent().find('.add-sub-row').attr('hidden', false);
                    $(this).addClass('active');
                }
            });

            $(function () {
                $('.genealogy-tree ul').hide();
                $('.genealogy-tree>ul').show();
                $('.genealogy-tree ul.active').show();
                $('.genealogy-tree .plus').on('click', function (e) {
                    var children = $(this).parent().parent().parent().find('> ul');
                    if (children.is(":visible")) {
                        children.hide('fast').removeClass('active');
                        $(this).text('+');
                    } else {
                        children.show('fast').addClass('active');
                        $(this).text('-');
                    }
                    e.stopPropagation();
                });
            });

            $('.add-accounting-guide').on('click', function () {
                inputEmpty();

                $('form#form-accounting-guide span.danger').val('');
                $('#save').attr('hidden', false);
                $('#edit').attr('hidden', true);
                data_id = $(this).attr('data-id');
                data_ranks = $(this).attr('data-ranks');

                /*$('#message-error-account').text('');
                $('#message-error-image').text('');
                $('#message-error-type').text('');
                document.getElementById('account-type').value = '';*/

                $('#addModal').modal('show');
            });
        }

        function inputEmpty() {

            $('form#form-accounting-guide select:not(:first)').removeClass('is-invalid').val('');
            $('form#form-accounting-guide #activity_id').removeClass('is-invalid').val('');
            $('form#form-accounting-guide input:not(:first)').removeClass('is-invalid').val('');
            $('#table-currency tbody').empty();
            $('#form-accounting-guide span strong').empty();
        }

        let items_id;

        @can('update account')
        $(document).on('click', '.edit-sub-row', function () {
            inputEmpty();
            /*$('#type-group').attr('hidden', true);*/
            items_id = $(this).attr('data-id');
            $.ajax({
                type: 'GET',
                url: "{{url('accounts/account/edit')}}" + "/" + items_id,
                dataType: "json",
                success: function (data) {
                    $('#save').attr('hidden', true);
                    $('#edit').attr('hidden', false);

                    $('input[name=acc_code]').val(data.acc_code);
                    $('input[name=name_ar]').val(data.name_ar);
                    $('input[name=name_en]').val(data.name_en);

                    $('input[name=acc_balance]').val(data.acc_balance);
                    $('input[name=acc_debit]').val(data.acc_debit);

                    $('select[name=acc_type_id]').val(data.acc_type_id);
                    $('input[name=acc_level]').val(data.acc_level);

                    $('input[name=acc_credit]').val(data.acc_credit);
                    $('select[name=acc_report_type_id]').val(data.acc_report_type_id);

                    $('select[name=status]').val(data.status);
                    $('input[name=account_id]').val(data.id);
                    $('#addModal').modal('show');



                },
                error: function () {
                }
            });
        });
        @endcan

        @can('create account')
        $('#form-accounting-guide').on('submit', function (event) {
            event.preventDefault();


            let route = "{{ route('account.store')}}";
            let formData = new FormData(this);
            formData.append('account_id', data_id);
            formData.append('ranks', data_ranks);
            saveAndUpdate(formData, route, 'save');
        });
        @endcan

        @can('update account')
        $('#edit').click(function (event) {

            event.preventDefault();
            let route = "{{route('account.update')}}";
            let formData = new FormData($('#form-accounting-guide')[0]);
            formData.append('id', items_id);
            formData.append('ranks', 1);
            saveAndUpdate(formData, route, 'edit');
        });

        @endcan

        function saveAndUpdate(data, route, _type) {
            let type;
            if (_type === 'save') type = 'إضافة';
            else if (_type === 'edit') type = '{{__('admin.edit')}}';

            $.ajax({
                url: route,
                method: "POST",
                data: data,
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function () {
                    $('#' + _type).html('<i class="la la-spinner spinner"></i><span>جاري ال' + type + '...</span>');
                    $('#form-accounting-guide').find('input').removeClass('is-invalid');
                    $('#form-accounting-guide span strong').empty();
                },
                success: function (data) {
                    treeBuilding();
                    $('#addModal').modal('hide');
                    swal({
                        icon: "success",
                        text: data.message + "!",
                        title: "تم ال" + type + " !",
                        button: 'موافق'
                    });
                },
                error: function (xhr) {
                    // Reset button
                    $('#' + _type).html(type);

                    try {
                        const response = JSON.parse(xhr.responseText);

                        // Clear previous errors
                        $('#form-accounting-guide').find('.is-invalid').removeClass('is-invalid');
                        $('#form-accounting-guide span strong').empty();

                        // Handle Laravel-style validation errors
                        if (response.errors) {
                            if (response.errors.acc_code) {
                                $('#form-accounting-guide input[name=acc_code]').addClass('is-invalid');
                                $('#form-accounting-guide input[name=acc_code]').parent().find('span strong').text(response.errors.acc_code[0]);
                            }

                            if (response.errors.name_ar) {
                                $('#form-accounting-guide input[name=name_ar]').addClass('is-invalid');
                                $('#form-accounting-guide input[name=name_ar]').parent().find('span strong').text(response.errors.name_ar[0]);
                            }

                            if (response.errors.name_en) {
                                $('#form-accounting-guide input[name=name_en]').addClass('is-invalid');
                                $('#form-accounting-guide input[name=name_en]').parent().find('span strong').text(response.errors.name_en[0]);
                            }

                            if (response.errors.acc_level) {
                                $('#form-accounting-guide input[name=acc_level]').addClass('is-invalid');
                                $('#form-accounting-guide input[name=acc_level]').parent().find('span strong').text(response.errors.acc_level[0]);
                            }

                            if (response.errors.acc_type_id) {
                                $('#form-accounting-guide select[name=acc_type_id]').addClass('is-invalid');
                                $('#form-accounting-guide select[name=acc_type_id]').parent().find('span strong').text(response.errors.acc_type_id[0]);
                            }


                            if (response.errors.acc_report_type_id) {
                                $('#form-accounting-guide select[name=acc_report_type_id]').addClass('is-invalid');
                                $('#form-accounting-guide select[name=acc_report_type_id]').parent().find('span strong').text(response.errors.acc_report_type_id[0]);
                            }


                        }
                    } catch (e) {
                        // Fallback for non-JSON responses or parse errors
                        swal({
                            icon: "error",
                            text: "حدث خطأ غير متوقع",
                            title: "خطأ!",
                            button: 'موافق'
                        });
                    }
                }
            });
        }

        @can('delete account')
        $(document).on('click', '.delete-sub-row', async function () {
            items_id = $(this).attr('data-id');
            try {
                await deletedItems(items_id, "{{route('account.destroy')}}");
                treeBuilding();
            } catch (e) {
                return e;
            }
        });
        @endcan

    });


</script>


