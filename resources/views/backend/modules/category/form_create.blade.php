<div class="form-group">
    {!! Form::label('name_ar',trans('word.category-ar')) !!}
    {!!
    Form::text('name_ar',null,['class'=>'form-control','placeholder'=>trans('word.category-ar')])
    !!}
</div>
<div class="form-group">
    {!! Form::label('name_en',trans('word.category-en')) !!}
    {!!
    Form::text('name_en',null,['class'=>'form-control','placeholder'=>trans('word.category-en')])
    !!}
</div>
@include('backend.partials.buttons.form_btn_create')