@extends('frontend.layouts.one_col')


@section('content')
    <div class="col-md-7">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('general.books') }}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @foreach($userBooks as $book)
                    <div class="row">
                        <div class="col-lg-2">
                            <img class="img-responsive"
                                 src="{{ asset('images/uploads/cover/thumbnail/'.$book->cover) }}" alt=""/>
                        </div>
                        <div class="col-lg-10">
                            <p>
                            <h5><a href="{{ action('BookController@show',$book->id) }}">{{ $book->title }}</a></h5>
                            <small> {{ $book->description }}</small>
                            </p>
                        </div>
                    </div>
                @endforeach
                {!! $userBooks->render() !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <div class="col-md-5">

        <!-- Profile Image -->
        <div class="box box-primary">
            <div class="box-body box-profile">
                <img class="profile-user-img img-responsive img-circle"
                     src="{{ asset('images/uploads/avatar/large/'.$user->avatar) }}" alt="User profile picture">

                <h3 class="profile-username text-center">{{ $user->name }}</h3>

                <p class="text-muted text-center"> {{ $user->email }}</p>
                <p class="text-muted text-center"><i class="fa fa-fw fa-phone"></i> : {{  $user->phone }}</p>
                <p class="text-muted text-center">{{ trans('general.member_scince') }} : {{ $user->created_at->format('d-M-Y')}}</p>

                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>Followers</b> <a class="pull-right">1,322</a>
                    </li>
                    <li class="list-group-item">
                        <b>Following</b> <a class="pull-right">543</a>
                    </li>
                    <li class="list-group-item">
                        <b>Friends</b> <a class="pull-right">13,287</a>
                    </li>
                </ul>

                <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

        <!-- About Me Box -->
    </div><!-- /.col -->

@stop