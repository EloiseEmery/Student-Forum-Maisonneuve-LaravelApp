@extends('layouts.app')
@section('content')
<main class="login-form">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-4 pt-4">
				<div class="card">
					<h3 class="card-header text-center">@lang('lang.register_title')</h3>
					<div class="card-body">
						<form action="{{ route('custom.registration') }}" method="post">
							@csrf
							@if($errors)
								@foreach($errors->all() as $error)
								<div class="alert alert-danger">{{ $error }}</div>
								@endforeach
							@endif
							<div class="form-group mb-3">
								<input type="text" placeholder="@lang('lang.register_first_input_placeholder')" name="name" class="form-control" value="{{ old('name') }}">
							</div>
							<div class="form-group mb-3">
								<input type="email" placeholder="@lang('lang.register_second_input_placeholder')" name="email" class="form-control" value="{{ old('email') }}">
							</div>
							<div class="form-group mb-3">
								<input type="password" placeholder="@lang('lang.register_third_input_placeholder')" name="password" class="form-control">
							</div>
							<div class="d-grid mx-auto">
								<button type="submit" class="btn btn-primary">@lang('lang.register_submit_button')</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
@endsection
