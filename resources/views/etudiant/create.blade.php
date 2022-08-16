@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row ms-5 me-5 mb-5">
		<div class="col-12 pt-2">
			<a href="{{ route('etudiants.index') }}" class="btn btn-outline-primary btn-sm mt-5"><i class="bi bi-caret-left"></i>@lang('lang.second_page_return_button')</a>
			<h1 class="mt-5">@lang('lang.third_page_title')</h1>
			<div class="card mt-5">
				<div class="card-header">
				@lang('lang.third_page_sub_title')
				</div>
				<div class="card-body">
					@if($errors)
						@foreach($errors->all() as $error)
						<div class="alert alert-danger">{{ $error }}</div>
						@endforeach
					@endif
					<form action="" method="POST">
						@csrf
						<div class="control-group">
							<label for="etudiant_nom">@lang('lang.third_page_form_first_input')</label>
							<input type="text" class="form-control" id="nom" name="etudiant_nom" }}>
						</div>
						<div class="form-group">
							<label for="etudiant_adresse">@lang('lang.third_page_form_second_input')</label>
							<input type="street" name="etudiant_adresse[]"
									class="form-control" 
									id="autocomplete" 
									placeholder="@lang('lang.third_page_form_second_input_placeholder_one')">
							
							<input type="city" name="etudiant_adresse[]"
									class="form-control" 
									id="inputCity" 
									placeholder="@lang('lang.third_page_form_second_input_placeholder_two')">
							
							<input type="state" name="etudiant_adresse[]"
									class="form-control" 
									id="inputState" 
									placeholder="@lang('lang.third_page_form_second_input_placeholder_three')">
							
							<input type="zip" name="etudiant_adresse[]"
									class="form-control" 
									id="inputZip" 
									placeholder="@lang('lang.third_page_form_second_input_placeholder_four')">
						</div>
						<div class="control-group">
							<label for="etudiant_telephone">@lang('lang.third_page_form_third_input')</label>
							<input type="tel" class="form-control" id="phone" name="etudiant_telephone" placeholder="000-000-0000">
						</div>
						<div class="control-group">
							<label for="email">@lang('lang.third_page_form_fourth_input')</label>
							<input type="email" class="form-control" id="email" name="email">
						</div>
						<div class="control-group ">
							<label for="etudiant_date_naissance">@lang('lang.third_page_form_fifth_input')</label>
							<input type="date" class="form-control mb-4" id="birthday" name="etudiant_date_naissance">
						</div>
						<div class="control-group">
							<label for="etudiant_ville_id">@lang('lang.third_page_form_sixth_input')</label>
							<select class="pt-1 pb-1 ps-2 pe-2" name="ville_nom" id="ville">
								<option selected disabled>Choisir une ville</option>
							@forelse($villes as $ville)
								<option value="{{ $ville->id }}">{{ $ville->ville_nom }}</option>
							@empty
								Aucune ville enregistrée pour le moment.
							@endforelse
							</select>
						</div>
						<div class="control-group pt-4">
							<input type="submit" class="btn btn-success mt-2" value="@lang('lang.third_page_form_button')" }}>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection