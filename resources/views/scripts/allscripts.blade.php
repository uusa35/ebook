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

        $('.nav-tabs > li[id^="tab-"]').on('click', function () {
            idVal = $(this).attr('id');
            tabLink = idVal.split('-');
            tabLink = 'step'+tabLink[1];
            $.cookie('tabSelected', idVal);
            $.cookie('tabLink', tabLink);

            console.log($.cookie('tabSelected'));
            console.log($.cookie('tabLink'));

        });

        if($.cookie('tabSelected')) {
            var idVal = $.cookie('tabSelected');
            var tabLink = $.cookie('tabLink');
            console.log('From Inside If Statement : ' + idVal);
            $('#'+idVal+'> a').trigger('click');
        }
    });

    $(document).scroll(function (e) {
        var scrollTop = $(document).scrollTop();
        if (scrollTop > 210) {
            $('.navbar').addClass('navbar-fixed-top');
        } else {
            $('.navbar').removeClass('navbar-fixed-top');
        }
    });

</script>


