@extends('layouts.app')
@section('title', 'Etudiants')
@section('content')
<div class="hero hero--page"></div>
<div class="container">
	<div class="col-12 ps-5 pt-5 pb-5">
		<div class="row pb-5">
			<div class="col-4">
				<h1>Nos étudiants</h1>
				<p class="pt-2 pb-2">Liste de tous les étudiants du Collège de Maisonneuve.</p>
				<a href="{{ route('etudiant.create') }}" class="btn btn-outline-primary btn-sm mb-5 pe-3"><i class="bi bi-plus"></i> Ajouter un étudiant</a>
				<br><p class="text-danger"><small> {{ $messageRetour }} </small></p>
			</div>
			<div class="col-8 pe-5">
				<div class="input-group rounded pt-5">
					<input type="search" class="form-control rounded" placeholder="Trouver un étudiant" aria-label="Search" aria-describedby="search-addon" />
					<button type="button" class="input-group-text border-0 btn btn-outline-primary" id="search-addon">
						<i class="bi bi-search"></i>
					</button>
				</div>
			</div>
		</div>
		<div class="row">
			<div>
				<table>
					<tr><th class="pe-5 pb-4 ps-2">Code<br>Permanent</th><th class="pb-4">Nom</th></tr>
					@forelse($etudiants as $etudiant)
					<tr class="tr">
						<td class="pb-2 pt-2 text-center">{{ $etudiant->id }}</td>
						<td class="pb-2 pt-2"><a class="" href="{{ route('etudiant.show', $etudiant->id) }}">{{ $etudiant->etudiant_nom }}</a></td>
					</tr>
					@empty
					<p>Aucun étudiant enregistré pour le moment.</p>
					@endforelse
				</table>
			</div>
		</div>
	</div>
</div>
@endsection