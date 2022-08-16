@extends('layouts.app')
@section('title', 'Accueil')
@section('content')
<div class="hero"></div>
<div class="container">
	<div class="row ps-5 pt-5 pb-5">
		<h1>@lang('lang.home_title')</h1>
		<p>@lang('lang.home_sub_title')</p>
	</div>
</div>
@endsection