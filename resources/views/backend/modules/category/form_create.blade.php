<div class="form-group">
    {!! Form::label('name_ar',trans('general.category_ar')) !!}
    {!!
    Form::text('name_ar',null,['class'=>'form-control'])
    !!}
</div>
<div class="form-group">
    {!! Form::label('name_en',trans('general.category_en')) !!}
    {!!
    Form::text('name_en',null,['class'=>'form-control'])
    !!}
</div>
@include('backend.partials.buttons.form_btn_create')