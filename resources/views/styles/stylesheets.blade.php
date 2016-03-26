@include('styles.fonts')
<link rel="stylesheet" href="/css/app.css"/>
{{--<link rel="stylesheet" href="/css/frontend.css"/>--}}
<link rel="stylesheet" href="/css/backend.css"/>
<link rel="stylesheet" href="/css/material-design.css"/>
<link rel="stylesheet" href="/css/abstract-css.css"/>
@if(App::getLocale() === 'ar')
    <link href="/css/bootstrap-rtl.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/bootstrap-flipped.min.css"/>
    <link rel="stylesheet" href="/css/custom_ar.css">
@else
    <link rel="stylesheet" href="/css/custom_en.css"/>
@endif