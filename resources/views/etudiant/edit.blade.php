@extends('layouts.app')
@section('title', 'Etudiants')
@section('content')
	<div class="container">
		<div class="row ms-5 me-5 mb-5">
			<div class="col-12 pt-2">
				<a href="{{ route('etudiant.show', $etudiant->id) }}" class="btn btn-outline-primary btn-sm mt-5"><i class="bi bi-caret-left"></i> Retourner vers le profil de l'étudiant</a>
				<h1 class="mt-5">Modifier l'étudiant</h1>
				<div class="card mt-5">
					<div class="card-header">
						Modifier les informations de <strong>{{ $etudiant->etudiant_nom }}</strong>
					</div>
					<div class="card-body">
						<form action="" method="POST">
							@csrf
							@method('PUT')
							<div class="control-group">
								<label for="etudiant_nom">Nom</label>
								<input type="text" class="form-control" id="nom" name="etudiant_nom" value="{{ $etudiant->etudiant_nom }}" }}>
							</div>
							<div class="form-group">
								<label for="etudiant_adresse">Adresse</label>
								<input type="street" name="etudiant_adresse"
										class="form-control" 
										id="autocomplete" 
										value="{{ $etudiant->etudiant_adresse }}">
							</div>
							<div class="control-group">
								<label for="etudiant_telephone">Téléphone</label>
								<input type="tel" class="form-control" id="phone" name="etudiant_telephone" placeholder="000-000-0000" value="{{ $etudiant->etudiant_telephone }}">
							</div>
							<div class="control-group">
								<label for="etudiant_courriel">Courriel</label>
								<input type="email" class="form-control" id="email" name="etudiant_courriel" value="{{ $etudiant->etudiant_courriel }}">
							</div>
							<div class="control-group ">
								<label for="etudiant_date_naissance">Date de naissance</label>
								<input type="date" class="form-control mb-4" id="birthday" name="etudiant_date_naissance" value="{{ $etudiant->etudiant_date_naissance }}">
							</div>
							<div class="control-group">
								<label for="etudiant_ville_id">Ville d'origine</label>
								<select class="pt-1 pb-1 ps-2 pe-2" name="etudiant_ville_id" id="ville">
								@forelse($villes as $ville)
									<option value="{{ $ville->id }}" 
										@if($etudiant->etudiant_ville_id == $ville->id)
											selected
										@endif
									>{{ $ville->ville_nom }}</option>
								@empty
									Aucune ville enregistrée pour le moment.
								@endforelse
								</select>
							</div>
							<div class="control-group pt-4">
								<input type="submit" class="btn btn-success mt-2" value="Modifier" }}>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection