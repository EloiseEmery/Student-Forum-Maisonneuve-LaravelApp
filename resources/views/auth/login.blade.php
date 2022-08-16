@extends('layouts.app')
@section('content')
<main class="login-form">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-4 pt-4">
				<div class="card">
					<h3 class="card-header text-center">@lang('lang.login_title')</h3>
					<div class="card-body">
						@if($errors)
							@foreach($errors->all() as $error)
							<div class="alert alert-danger">{{ $error }}</div>
							@endforeach
						@endif
						<form action="{{ route('custom.login') }}" method="post">
							@csrf
							<div class="form-group mb-3">
								<input type="email" placeholder="@lang('lang.login_first_input_placeholder')" name="email" class="form-control" value="{{ old('email') }}">
							</div>
							<div class="form-group mb-3">
								<input type="password" placeholder="@lang('lang.login_second_input_placeholder')" name="password" class="form-control">
							</div>
							<div class="d-grid mx-auto">
								<button type="submit" class="btn btn-primary">@lang('lang.login_submit_button')</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
@endsection
