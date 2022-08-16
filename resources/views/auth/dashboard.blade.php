@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row ms-5 me-5 mb-5">
		<div class="col-12 pt-2">
			<p class="mt-5">@lang('lang.dashboard_title') {{ $name }}</p>
			<p class="">@lang('lang.dashboard_first_information') :  {{ $email }}</p>
			<a href="{{ route('auth.logout') }}" class="btn btn-outline-primary btn-sm mt-5">@lang('lang.menu_item_sixth')</a>
		</div>
	</div>
</div>
@endsection