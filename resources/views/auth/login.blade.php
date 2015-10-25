@extends('frontend.layouts.one_col')

@section('content')
    <div class="col-md-6 col-md-offset-3">
        <div class="login-panel panel panel-default">
            <div class="panel-heading"><h3>{{ trans('word.login') }}</h3></div>
            <div class="panel-body">
                <form role="form" method="POST" action="{{ url('/auth/login') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <fieldset>
                        <div class="form-group">
                            <input type="email" class="form-control" name="email"
                                   value="{{ old('email') }}" placeholder="E-mail" autofocus>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>

                        <div class="form-group">

                            <input type="checkbox" name="remember" class="input-form">
                            <label>
                                {{ trans('general.remember_me') }}
                            </label>
                        </div>

                        <div class="row  {{ Session::get('pullClass') }}">
                            <div class="col-lg-12">
                                <button type="submit" name="submit"
                                        class="btn btn-primary">{{ trans('general.login') }}</button>
                                <a class="btn btn-info"
                                   href="{{ url('frontend/conditions') }}">{{ trans('general.register') }}</a>
                                <a class="btn btn-material-purple-200"
                                   href="{{ url('/password/email') }}">{{ trans('general.forgot_password') }}</a>
                            </div>
                            <div class="col-lg-12">
                                <a class="btn btn-social btn-twitter btn-material-light-blue"
                                   href="{{ action('Auth\AuthController@redirectToTwitterProvider') }}">
                                    <i class="fa fa-fw fa-twitter"></i>  {{ trans('buttons.twitter_login') }}
                                </a>
                                <a class="btn btn-social btn-twitter btn-material-blue "
                                   href="{{ action('Auth\AuthController@redirectToFacebookProvider') }}">
                                    <i class="fa fa-facebook"></i> {{ trans('buttons.facebook_login') }}
                                </a>
                                <a class="btn btn-social btn-google btn-material-red "
                                   href="{{ action('Auth\AuthController@redirectToGoogleProvider') }}">
                                    <i class="fa fa-google"></i> {{ trans('buttons.google_login') }}
                                </a>
                                <a class="btn btn-social btn-google btn-material-grey-200 "
                                   href="{{ action('Auth\AuthController@redirectToGithubProvider') }}">
                                    <i class="fa fa-github"></i> {{ trans('buttons.github_login') }}
                                </a>
                            </div>
                        </div>
                        <!-- Change this to a button or input when using this as a form -->
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
    </div>
@stop

