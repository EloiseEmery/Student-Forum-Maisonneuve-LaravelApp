@extends('layouts.app')
@section('content')
<div class="hero hero--page"></div>
<div class="container">
	<div class="col-12 ps-5 pt-5 pb-5">
		<a href="{{ route('etudiants.index') }}" class="btn btn-outline-primary btn-sm mb-5"><i class="bi bi-caret-left"></i>@lang('lang.second_page_return_button')</a>
		<div class="row pb-5">
			<hr>
			<div class="row">
				<div class="col-6">
					<h1 class="mb-3">{{ $etudiant->etudiant_nom }}</h1>
				</div>
				<div class="col-6">
				@if(Auth::check() && Auth::user()->id == $etudiant->etudiant_user_id)
					<!-- <div class="row"> -->
						<a href="{{ route('etudiant.edit', $etudiant->id) }}" class="btn btn-outline-primary btn-sm mb-2 pe-3"><i class="bi bi-pencil"></i> @lang('lang.second_page_modify_button')</a>
						<form method="POST">
							@csrf
							@method('DELETE')
							<button class="btn btn-outline-danger btn-sm pe-2"><i class="bi bi-trash"></i> @lang('lang.second_page_delete_button')</button>
						</form>
					<!-- </div> -->
				@endif
				</div>
			</div>
			<br><p class="text-danger"><small>{{ $messageRetour }}</small></p>
			<p><strong>@lang('lang.second_page_first_sub_title') : </strong>{{ $etudiant->id }}</p>
			<p><strong>@lang('lang.second_page_second_sub_title') : </strong>{{ $etudiant->etudiant_date_naissance }}</p>
			@forelse($users as $user)
				@if($user->id == $etudiant->etudiant_user_id)
					<p><strong>@lang('lang.second_page_third_sub_title') : </strong>{{ $user->email }}</p>	
				@endif
			@empty
			@endforelse
			<p><strong>@lang('lang.second_page_fourth_sub_title') : </strong>{{ $etudiant->etudiant_telephone }}</p>
			<p><strong>@lang('lang.second_page_fifth_sub_title') : </strong>{{ $etudiant->etudiant_adresse }}</p>
			<p><strong>@lang('lang.second_page_sixth_sub_title') : </strong>
			@forelse($villes as $ville)
				@if($etudiant->etudiant_ville_id == $ville->id)
				{{ $ville->ville_nom }}
				@endif
			@empty
			Aucune ville enregistrée pour le moment.
			@endforelse
			</p>
		</div>
	</div>
</div>
@endsection