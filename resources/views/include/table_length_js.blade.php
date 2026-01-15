<script>

    $("select[name=table_length]").click(function () {
        let open = $(this).data("is_open");
        if (open) {
            window.location.href = $(this).val()
        }
        $(this).data("is_open", !open);
    });

</script>
