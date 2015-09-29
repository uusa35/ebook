<script src="/js/app.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.tooltip').tooltipster();

        $('#conditions').click(function () {
            if ($(this).is(":checked")) {
                $('#btncon').removeAttr('disabled');
                $('#btncon').removeClass('hidden');
            }
            else if ($(this).is(":not(:checked)")) {
                $('#btncon').attr('disabled', 'disabled');
                $('#btncon').addClass('hidden');

            }
        });
    });
</script>


