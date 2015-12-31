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

    $(document).scroll(function (e) {
        var scrollTop = $(document).scrollTop();
        if (scrollTop > 210) {
            $('.navbar').addClass('navbar-fixed-top');
        } else {
            $('.navbar').removeClass('navbar-fixed-top');
        }
    });

</script>
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-71840397-1', 'auto');
    ga('send', 'pageview');

</script>



