<script>
    /*start code show details ajax*/
    let category_details_id;
    $(document).on('click', '.show-detail-category', async function () {
        category_details_id = $(this).attr('id');
        let url = "{{url('advertisements/video/show')}}" + '/' + category_details_id;

        try {
            let data = await responseEditOrShowData(url);


            $('.form-details .name').text(data.name);
            $('.form-details .details').text(data.desc);
            $('.form-details .start_date').text(data.start_date);
            $('.form-details .end_date').text(data.end_date);
            $('.form-details .links').text(data.links);

            $('.created').text(data.created_at);
            $('.updated_at').html(data.updated_at);
            $('#ModalShowCategory').modal('show');

            $('#confirm-modal-loading-show').modal('hide');
        } catch (error) {
            return error;
        }
    });
    /*end code show details ajax*/
</script>
