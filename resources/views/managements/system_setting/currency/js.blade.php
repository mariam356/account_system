<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>


    let table_show = $('#table-show');
    let table_count = $('#table-count');

    $("select[name=table_length]").click(function () {
        let open = $(this).data("is_open");
        if (open) {
            window.location.href = $(this).val()
        }
        $(this).data("is_open", !open);
    });

    $(document).ready(function() {

        $('#form input:not(:first), #form textarea').val('').removeClass('is-invalid');
        $('#form span strong').empty();


        $('#btn-save').html('<i class="la la-check-square-o"></i> ' + "{{__('admin.add')}}")
            .attr("data_url", "{{route('currency.store')}}")
            .attr("data_type", "add");
    });



    let currency_id = 0;
    let edit_row;

    @can('update currency')

    $(document).on('click', '.edit-table-row', async function () {

        currency_id = $(this).attr('id');
        edit_row = $(this).parent().parent();
        let url = "{{url('system_setting/currency/edit')}}" + '/' + currency_id;
        $('#form input:not(:first), #form textarea')
            .val('')
            .removeClass('is-invalid');

        $('#avatar').attr('hidden', true);
        $('#form span strong').empty();
        $('#btn-save').html('<i class="ft-edit"></i> ' + "{{__('admin.edit')}}")
            .attr("data_url", "{{url('system_setting/currency/update')}}" + '/' + currency_id)
            .attr("data_type", "Update");

        try {
            let data = await responseEditOrShowData(url);

            $('#button_save').html("<i class='ft-edit'></i> {{__('admin.edit')}}");


            $('input[name=curr_penny]').val(data.curr_penny);
            $('input[name=name_ar]').val(data.name_ar);
            $('input[name=name_en]').val(data.name_en);
            $('input[name=curr_val]').val(data.curr_val);
            $('input[name=symbol]').val(data.symbol);
            $('select[name=currency_type_id]').val(data.currency_type_id);





        } catch (error) {
            return error;
        }

    });
    /*end code edit*/
    @endcan



    /*start code add or update*/
    $('#form').on('submit', async function (event) {
        event.preventDefault();
        let btn_save = $('#btn-save');
        let url = btn_save.attr('data_url');
        let type = btn_save.attr('data_type');
        let data_form = new FormData(this);
        data_form.append('currency_id', currency_id);
        console.log(147);
        try {
            let data = await addOrUpdate(url, data_form, type, 'btn-save');
            if (data['status'] === 200) {
                let response_data = data.Currency;


                let tr_color_red = '';


                let row = $("<tr id='row_" + response_data.id + "' class='" + tr_color_red + "'></tr>");
                let col1 = $("<td>" + response_data.id + "</td>");
                let col2 = $("<td>" + response_data.name + "</td>");
                let col3 = $("<td>" + response_data.currency_type_name + "</td>");
                let col4 = $("<td>" + response_data.curr_penny + "</td>");
                let col5 = $("<td>" + response_data.symbol + "</td>");
                let col6 = $("<td>" + response_data.curr_val + "</td>");


                let col7 = $("<td>" + response_data.actions + "</td>");

                let this_row;
                if (type === 'add') {
                    row.append(col1, col2, col3, col4, col5,col6,col7).prependTo("#table");
                    this_row = $('#row_' + response_data.id);
                    table_show.text(parseInt(table_show.text()) + 1);
                    table_count.text(parseInt(table_count.text()) + 1);
                } else {
                    this_row = edit_row;
                    edit_row.attr("class", tr_color_red).attr('style', '');
                    edit_row.empty().append(col1, col2, col3, col4, col5,col6,col7);
                }

                this_row.addClass('tr-color-success');
                setTimeout(function () {
                    this_row.removeClass('tr-color-success');
                }, 7000);
            }
        } catch (error) {
            let obj = JSON.parse((error.responseText)).error;
            let response = JSON.parse(error.responseText);
            if (obj.curr_penny !== undefined) {
                $('#form input[name=curr_penny]').addClass('is-invalid')
                    .parent().find('span strong').text(obj.curr_penny);
            }
            if (obj.currency_type_id !== undefined) {
                $('#form select[name=currency_type_id]').addClass('is-invalid')
                    .parent().find('span strong').text(obj.currency_type_id);
            }

            if (obj.symbol !== undefined) {
                $('#form input[name=symbol]').addClass('is-invalid')
                    .parent().find('span strong').text(obj.symbol);
            }

            if (obj.name_ar !== undefined) {
                $('#form input[name=name_ar]').addClass('is-invalid')
                    .parent().find('span strong').text(obj.name_ar);
            }

            if (obj.name_en !== undefined) {
                $('#form input[name=name_en]').addClass('is-invalid')
                    .parent().find('span strong').text(obj.name_en);
            }


        }
    });
    /*end code add or update*/


    @can('delete currency')
    /*start code Delete ajax*/
    $(document).on('click', '.delete', async function () {
        let id_row = $(this).attr('id');
        let this_row = $(this).parent().parent();
        this_row.addClass('tr-color-active');
        let route = "{{url('system_setting/currency/destroy')}}" + "/" + id_row;
        try {
            await deletedItems(id_row, route);
            table_show.text(parseInt(table_show.text()) - 1);
            table_count.text(parseInt(table_count.text()) - 1);
            this_row.remove();
        } catch (e) {
            this_row.removeClass('tr-color-active');
            return e;
        }
    });
    /*end code Delete ajax*/
    @endcan



    $(document).on('keyup', '#search', async function () {
        const query = $(this).val().trim();
        const route = "{{ url('system_setting/currency/search') }}";
        const tbody = $('#table tbody');

        // clear previous timer to debounce
        clearTimeout(window.searchTimer);

        window.searchTimer = setTimeout(async () => {


            try {
                const data = await $.ajax({
                    url: route,
                    type: 'GET',
                    dataType: 'json',
                    data: { query },
                });

                // Clear table body first
                tbody.empty();

                if (!data.length) {
                    tbody.append(`
                    <tr>
                        <td colspan="9" class="text-center text-muted">
                            {{ __('admin.no_data') }}
                    <hr>
                </td>
            </tr>
`);
                } else {
                    data.forEach(currency => {
                        tbody.append(`
                        <tr>
                            <td>${currency.id}</td>
                            <td>${currency.name ?? ''}</td>
                            <td>${currency.currency_type_name ?? ''}</td>
                            <td>${currency.curr_penny ?? ''}</td>
                            <td>${currency.symbol ?? ''}</td>
                            <td>${currency.curr_val ?? ''}</td>

                            <td>${currency.actions ?? ''}</td>
                        </tr>
                    `);
                    });
                }

            } catch (e) {
                console.error('Search error:', e);
            }
        }, 300); // delay for debounce
    });



</script>

