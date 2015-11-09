@extends('frontend.layouts.one_col')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">{{ trans('general.register') }}</div>
				<div class="panel-body">
					<div class="alert alert-info" role="alert">{{trans('general.fields-required')}}* </br>
					{{--{{trans('general.bank-info-not-shown')}}--}}
					</div>
					<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/register') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">{{ trans('general.name') }}*</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="name" value="{{ old('username') }}">
							</div>
						</div>


						{{--<div class="form-group">
							<label class="col-md-4 control-label">{{ trans('general.name_ar') }}*</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="name_ar" value="{{ old('name_ar') }}">
							</div>
						</div>--}}

						<div class="form-group">
							<label class="col-md-4 control-label">{{ trans('general.email') }}*</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">{{ trans('general.mobile') }}</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="mobile" value="{{ old('mobile') }}">
							</div>
						</div>
						{{--<div class="form-group">
							<label class="col-md-4 control-label">{{ trans('general.bank-number') }}</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="bank_number" value="{{ old('bank_number') }}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">{{ trans('general.bank-name') }}</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="bank_name" value="{{ old('bank_name') }}">
							</div>
						</div>--}}

						<div class="form-group">
							<label class="col-md-4 control-label">{{ trans('general.password') }}*</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">{{ trans('general.confirm_password') }}*</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password_confirmation">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 {{ (App::getLocale('lang') ==='ar') ? 'pull-left' : 'pull-right'  }}">
								<button type="submit" class="btn btn-primary">
									{{ trans('general.register') }}
								</button>
								<a class="btn btn-danger" href="{{ URL::previous() }}">{{ trans('general.cancel') }}</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
