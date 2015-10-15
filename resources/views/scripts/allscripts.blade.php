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
        $(document).scroll(function(e){
            var scrollTop = $(document).scrollTop();
            if(scrollTop > 210){
                /*console.log(scrollTop);*/
                $('.navbar').addClass('navbar-fixed-top');
            } else {
                $('.navbar').removeClass('navbar-fixed-top');
            }
        });
    });
</script>


