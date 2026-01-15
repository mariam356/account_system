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
            .attr("data_url", "{{route('user.store')}}")
            .attr("data_type", "add");
    });



    let user_id = 0;
    let edit_row;

    @can('update user')

    $(document).on('click', '.edit-table-row', async function () {

        user_id = $(this).attr('id');
        edit_row = $(this).parent().parent();
        let url = "{{url('file/user/edit')}}" + '/' + user_id;
        $('#form input:not(:first), #form textarea')
            .val('')
            .removeClass('is-invalid');

        $('#avatar').attr('hidden', true);
        $('#form span strong').empty();
        $('#btn-save').html('<i class="ft-edit"></i> ' + "{{__('admin.edit')}}")
            .attr("data_url", "{{url('file/user/update')}}" + '/' + user_id)
            .attr("data_type", "Update");

        try {
            let data = await responseEditOrShowData(url);

            $('#button_save').html("<i class='ft-edit'></i> {{__('admin.edit')}}");
            $('#image').attr('required', false);
            $('#avatar').attr('src', data.image).attr('hidden', false);
            $('#delete-img').attr('hidden', false);


            $('input[name=full_name]').val(data.full_name);
            $('input[name=name]').val(data.name);
            $('input[name=branch_id]').val(data.branch_id);

            $('input[name=email]').val(data.email);
            $('input[name=phone]').val(data.phone);





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
        data_form.append('user_id', user_id);
        console.log(147);
        try {
            let data = await addOrUpdate(url, data_form, type, 'btn-save');
            if (data['status'] === 200) {
                let response_data = data.User;


                let tr_color_red = '';


                let row = $("<tr id='row_" + response_data.id + "' class='" + tr_color_red + "'></tr>");

                let col1 = $("<td>" + response_data.full_name + "</td>");
                let col2 = $("<td>" + response_data.name + "</td>");
                let col3 = $("<td>" + response_data.phone + "</td>");
                let col4 = $("<td>" + response_data.email + "</td>");
                let col5 = $("<td>" + response_data.branch_name + "</td>");

                let col6 = $('<td><img style="max-width:64px" src="{{asset('storage')}}' + '/' + response_data.image + '"' +
                    'onerror=this.src="{{asset('/storage/no-image.png')}}"/></td>'
                );

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
            if (obj.email !== undefined) {
                $('#form input[name=email]').addClass('is-invalid')
                    .parent().find('span strong').text(obj.email);
            }
            if (obj.activity !== undefined) {
                $('#form input[name=activity]').addClass('is-invalid')
                    .parent().find('span strong').text(obj.activity);
            }

            if (obj.phone !== undefined) {
                $('#form input[name=phone]').addClass('is-invalid')
                    .parent().find('span strong').text(obj.phone);
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


    @can('delete user')
    /*start code Delete ajax*/
    $(document).on('click', '.delete', async function () {
        let id_row = $(this).attr('id');
        let this_row = $(this).parent().parent();
        this_row.addClass('tr-color-active');
        let route = "{{url('file/user/destroy')}}" + "/" + id_row;
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

    function delete_img() {
        document.getElementById('image').value = null;
        $('#avatar').attr('hidden', true);
        $('#delete-img').attr('hidden', true);
    }

    function loadAvatar(input) {
        $('#avatar').attr('hidden', false);
        $('#delete-img').attr('hidden', false);

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#avatar').attr('hidden', false);
                $('#delete-img').attr('hidden', false);
                var image = document.getElementById('avatar');
                image.src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }


    $(document).on('keyup', '#search', async function () {
        const query = $(this).val().trim();
        const route = "{{ url('file/user/search') }}";
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
                    data.forEach(user => {
                        tbody.append(`
                        <tr>
                            <td>${user.id}</td>
                            <td>${user.full_name ?? ''}</td>
                            <td>${user.name ?? ''}</td>
                            <td>${user.phone ?? ''}</td>
                            <td>${user.email ?? ''}</td>
                            <td>${user.branch_id ?? ''}</td>

                            <td>
                                <img style="max-width:64px" src="/storage/${user.image ?? ''}" />
                            </td>
                            <td>${user.actions ?? ''}</td>
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

