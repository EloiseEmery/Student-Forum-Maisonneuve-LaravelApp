@extends('layouts.app')
@section('content')
	<div class="container">
		<div class="row ms-5 me-5 mb-5">
			<div class="col-12 pt-2">
				<a href="{{ route('etudiant.show', $etudiant->id) }}" class="btn btn-outline-primary btn-sm mt-5"><i class="bi bi-caret-left"></i> @lang('lang.second_page_return_button')</a>
				<h1 class="mt-5">@lang('lang.fourth_page_title')</h1>
				<div class="card mt-5">
					<div class="card-header">
					@lang('lang.fourth_page_sub_title') <strong>{{ $etudiant->etudiant_nom }}</strong>
					</div>
					<div class="card-body">
						@if($errors)
							@foreach($errors->all() as $error)
							<div class="alert alert-danger">{{ $error }}</div>
							@endforeach
						@endif
						<form action="" method="POST">
							@csrf
							@method('PUT')
							<div class="control-group">
								<label for="etudiant_nom">@lang('lang.third_page_form_first_input')</label>
								<input type="text" class="form-control" id="nom" name="etudiant_nom" value="{{ $etudiant->etudiant_nom }}" }}>
							</div>
							<div class="form-group">
								<label for="etudiant_adresse">@lang('lang.third_page_form_second_input')</label>
								<input type="street" name="etudiant_adresse"
										class="form-control" 
										id="autocomplete" 
										value="{{ $etudiant->etudiant_adresse }}">
							</div>
							<div class="control-group">
								<label for="etudiant_telephone">@lang('lang.third_page_form_third_input')</label>
								<input type="tel" class="form-control" id="phone" name="etudiant_telephone" placeholder="000-000-0000" value="{{ $etudiant->etudiant_telephone }}">
							</div>
							<div class="control-group">
								<label for="email">@lang('lang.third_page_form_fourth_input')</label>
								<input type="email" class="form-control" id="email" name="email" value="
								@forelse($users as $user)
									@if($user->id == $etudiant->etudiant_user_id)
										{{ $user->email }}
									@endif
								@empty
								@endforelse
								">
							</div>
							<div class="control-group ">
								<label for="etudiant_date_naissance">@lang('lang.third_page_form_fifth_input')</label>
								<input type="date" class="form-control mb-4" id="birthday" name="etudiant_date_naissance" value="{{ $etudiant->etudiant_date_naissance }}">
							</div>
							<div class="control-group">
								<label for="etudiant_ville_id">@lang('lang.third_page_form_sixth_input')</label>
								<select class="pt-1 pb-1 ps-2 pe-2" name="etudiant_ville_id" id="ville">
								@forelse($villes as $ville)
									<option value="{{ $ville->id }}" 
										@if($etudiant->etudiant_ville_id == $ville->id)
											selected
										@endif
									>{{ $ville->ville_nom }}</option>
								@empty
								@lang('lang.third_page_form_sixth_input_error_message')
								@endforelse
								</select>
							</div>
							<div class="control-group pt-4">
								<input type="submit" class="btn btn-success mt-2" value="@lang('lang.fourth_page_form_button')" }}>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection