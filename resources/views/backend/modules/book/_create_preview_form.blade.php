@extends('backend.layouts.dashboard')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            {{ trans('word.create-new-preview') }}
        </div>

        <div class="panel-body">

            @if(Session::get('role.admin'))
                {!! Form::open(['route'=>
                'app.admin.book.postCreateNewCustomizedPreview','method'=>'post'],['class'=>'form-horizontal']) !!}
            @elseif(Session::get('role.editor'))
                {!! Form::open(['route'=>
                'app.editor.book.postCreateNewCustomizedPreview','method'=>'post'],['class'=>'form-horizontal']) !!}
            @endif
            {!! Form::hidden('author_id',$autherId) !!}
            {!! Form::hidden('total_pages',$total_pages) !!}
            {!! Form::hidden('book_id',$bookId) !!}
            <div class="form-group col-md-12">
                {!! Form::label('preview_start',trans('word.preview-start')) !!} :
                {!! Form::selectRange('preview_start',1,$total_pages) !!}
            </div>
            <div class="form-group col-md-12">
                {!! Form::label('preview_start',trans('word.preview-start')) !!} :
                {!! Form::selectRange('preview_end',1,$total_pages) !!}
            </div>

            <div class="form-group col-md-12">
                {!! Form::label('usersList',trans('word.users')) !!} :
                {!!
                Form::select('usersList',$usersList,null,['multiple'=>'multiple','name'=>'usersList[]','class'=>'form-control','placeholder'=>trans('word.users'),'id'=>'users'])
                !!}
            </div>
            <div class="form-group col-md-2">
                {!! Form::submit(trans('word.submit'),['class'=>'btn btn-info']) !!}
            </div>
            <div class="col-md-4">
                <a class="btn btn-danger" href="{{ url('/') }}">{{ trans('word.back') }}</a>
            </div>

            {!! Form::close() !!}
        </div>
    </div>

@endsection