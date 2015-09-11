<script src="/css/bower_components/tinymce/tinymce.min.js"></script>
<script src="/css/bower_components/tinymce/tinymce.jquery.min.js"></script>
<script src="/css/bower_components/tinymce/plugins/template/plugin.min.js"></script>
<script type="text/javascript">
    tinymce.init({
        selector: "textarea.editor",
        plugins: [
            ["advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker"],
            ["searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking"],
            ["save table contextmenu directionality emoticons template paste textcolor  directionality jbimages"]
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages | print preview media fullpage | forecolor backcolor emoticons | ltr rtl ",
        relative_urls: true
    });
</script>