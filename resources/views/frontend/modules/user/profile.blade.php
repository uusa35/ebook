@extends('frontend.layouts.one_col')


@section('content')
    <div class="col-md-7">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <blockquote>{{ trans('general.books') }}</blockquote>
                </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @if(count($userBooks) < 1)
                    <div class="alert alert-dismissable alert-info">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <h4>{!! Config::get('button.icon-info') !!} {{ trans('general.alert') }}!</h4>

                        <p>{{ trans('messages.info.no_books') }}.</p>
                    </div>
                @else
                    @foreach($userBooks as $book)
                        <div class="row">
                            <div class="col-lg-2">
                                <img class="img-responsive"
                                     src="{{ asset('images/uploads/cover/thumbnail/'.$book->cover) }}" alt=""/>
                            </div>
                            <div class="col-lg-10">
                                <p>
                                <h5><a href="{{ action('BookController@show',$book->id) }}">{{ $book->title }}</a></h5>
                                <small> {{ \Illuminate\Support\Str::words($book->description,10) }}</small>
                                </p>
                            </div>
                        </div>
                        <hr/>
                    @endforeach
                    {!! $userBooks->render() !!}
                @endif
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <div class="col-md-5">

        <!-- Profile Image -->
        <div class="box box-primary">
            <div class="box-body box-profile">

                @if(count($user->avatar) >2 )
                    <img class="profile-user-img img-responsive img-circle"
                         src="{{ asset('images/uploads/avatar/large/'.$user->avatar) }}"
                         alt="User profile picture">

                @else
                    <img src="//www.gravatar.com/avatar/{!! md5(Auth::user()->email) !!}?s=64"
                         alt="{!! Auth::user()->name !!}" class="profile-user-img img-responsive img-circle">
                @endif

                <h3 class="profile-username text-center">{{ $user->name }}</h3>

                <p class="text-muted text-center"> {{ $user->email }}</p>

                <p class="text-muted text-center"><i class="fa fa-fw fa-phone"></i> : {{  $user->phone }}</p>

                <p class="text-muted text-center">{{ trans('general.member_scince') }}
                    : {{ $user->created_at->format('d-M-Y')}}</p>

                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <div class="col-lg-8 text-center">
                            <b>
                                <a data-toggle="modal"
                                   data-target="#followers">
                                    {{ trans('general.followers') }}
                                </a>
                            </b>
                            <a data-toggle="modal"
                               data-target="#followers"
                               class="pull-right">{{ count($user->followers) }}</a>
                            @include('frontend.partials._followers_modal')
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="col-lg-8 text-center">
                            <b><a href="#">{{ trans('general.following') }}</a></b>
                            <a class="pull-right">{{ count($user->following) }}</a>
                        </div>
                    </li>
                </ul>

                @if($user->id != Auth::id())
                    <a href="{{ action('UserController@followUser',[$user->id, Auth::id()]) }}"
                       class="btn btn-material-light-blue-A700 btn-block"><b>Follow</b></a>
                @endif

            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

        <!-- About Me Box -->
    </div><!-- /.col -->

@stop