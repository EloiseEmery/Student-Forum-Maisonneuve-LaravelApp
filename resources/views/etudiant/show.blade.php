@extends('layouts.app')
@section('title', 'Etudiant')
@section('content')
<div class="hero hero--page"></div>
<div class="container">
	<div class="col-12 ps-5 pt-5 pb-5">
		<a href="{{ route('etudiants.index') }}" class="btn btn-outline-primary btn-sm mb-5"><i class="bi bi-caret-left"></i> Retourner vers la liste des étudiants</a>
		<div class="row pb-5">
			<hr>
			<div class="row">
				<div class="col-6">
					<h1 class="mb-3">{{ $etudiant->etudiant_nom }}</h1>
				</div>
				<div class="col-6">
					<!-- <div class="row"> -->
						<a href="{{ route('etudiant.edit', $etudiant->id) }}" class="btn btn-outline-primary btn-sm mb-2 pe-3"><i class="bi bi-pencil"></i> Modifier</a>
						<form method="POST">
							@csrf
							@method('DELETE')
							<button class="btn btn-outline-danger btn-sm pe-2"><i class="bi bi-trash"></i> Supprimer</button>
						</form>
					<!-- </div> -->
				</div>
			</div>
			<br><p class="text-danger"><small>{{ $messageRetour }}</small></p>
			<p><strong>Code permanent : </strong>{{ $etudiant->id }}</p>
			<p><strong>Date de naissance : </strong>{{ $etudiant->etudiant_date_naissance }}</p>
			<p><strong>Courriel : </strong>{{ $etudiant->etudiant_courriel }}</p>
			<p><strong>Téléphone : </strong>{{ $etudiant->etudiant_telephone }}</p>
			<p><strong>Adresse : </strong>{{ $etudiant->etudiant_adresse }}</p>
			<p><strong>Ville d'origine : </strong>
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