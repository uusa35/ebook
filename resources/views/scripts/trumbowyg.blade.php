<script src="/trumbowyg/dist/trumbowyg.min.js"></script>
<script src="/trumbowyg/dist/plugins/upload/trumbowyg.upload.js"></script>
<script src="/trumbowyg/dist/plugins/colors/trumbowyg.colors.min.js"></script>
<script src="/trumbowyg/dist/plugins/base64/trumbowyg.base64.min.js"></script>
<script src="/trumbowyg/dist/langs/ar.js"></script>
<script type="text/javascript">
    $('textarea').trumbowyg({
        lang: 'ar',
        closable: false,
        fixedBtnPane: true,
        prefix: 'modern-ui',
        mobile: true,
        tablet: true,
        btnsDef: {
            // Customizables dropdowns
            align: {
                dropdown: ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
                ico: 'justifyLeft'
            },
            image: {
                dropdown: ['insertImage', 'base64','upload'],
                ico: 'insertImage'
            }
        },
        btns: ['viewHTML',
            '|', 'formatting',
            '|', 'btnGrp-test',
            '|', 'align',
            '|', 'btnGrp-lists',
            '|', 'btnGrp-design',
            '|', 'link',
            '|', 'btnGrp-justify',
            '|', 'foreColor', 'backColor',
            '|', 'horizontalRule',
            '|', 'image']
    });
</script>