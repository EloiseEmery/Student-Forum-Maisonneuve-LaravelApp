@extends('layouts.app')
@section('title', 'Etudiants')
@section('content')
	<div class="container">
		<div class="row ms-5 me-5 mb-5">
			<div class="col-12 pt-2">
				<a href="{{ route('etudiants.index') }}" class="btn btn-outline-primary btn-sm mt-5"><i class="bi bi-caret-left"></i> Retourner vers la liste des étudiants</a>
				<h1 class="mt-5">Ajouter un étudiant</h1>
				<div class="card mt-5">
					<div class="card-header">
						Entrez les informations de l'étudiant
					</div>
					<div class="card-body">
						<form action="" method="POST">
							@csrf
							<div class="control-group">
								<label for="etudiant_nom">Nom</label>
								<input type="text" class="form-control" id="nom" name="etudiant_nom" }}>
							</div>
							<div class="form-group">
								<label for="etudiant_adresse">Adresse</label>
								<input type="street" name="etudiant_adresse[]"
										class="form-control" 
										id="autocomplete" 
										placeholder="Rue">
								
								<input type="city" name="etudiant_adresse[]"
										class="form-control" 
										id="inputCity" 
										placeholder="Ville">
								
								<input type="state" name="etudiant_adresse[]"
										class="form-control" 
										id="inputState" 
										placeholder="États">
								
								<input type="zip" name="etudiant_adresse[]"
										class="form-control" 
										id="inputZip" 
										placeholder="Code Postale">
							</div>
							<div class="control-group">
								<label for="etudiant_telephone">Téléphone</label>
								<input type="tel" class="form-control" id="phone" name="etudiant_telephone" placeholder="000-000-0000">
							</div>
							<div class="control-group">
								<label for="etudiant_courriel">Courriel</label>
								<input type="email" class="form-control" id="email" name="etudiant_courriel">
							</div>
							<div class="control-group ">
								<label for="etudiant_date_naissance">Date de naissance</label>
								<input type="date" class="form-control mb-4" id="birthday" name="etudiant_date_naissance">
							</div>
							<div class="control-group">
								<label for="etudiant_ville_id">Ville d'origine</label>
								<select class="pt-1 pb-1 ps-2 pe-2" name="ville_nom" id="ville">
								@forelse($villes as $ville)
									<option value="{{ $ville->id }}">{{ $ville->ville_nom }}</option>
								@empty
									Aucune ville enregistrée pour le moment.
								@endforelse
								</select>
							</div>
							<br><p class="text-danger">{{ $erreur ?? '' }}</p>
							<div class="control-group pt-4">
								<input type="submit" class="btn btn-success mt-2" value="Ajouter" }}>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection