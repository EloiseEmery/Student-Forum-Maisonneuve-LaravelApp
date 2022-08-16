@extends('layouts.app')
@section('content')
<div class="hero hero--page"></div>
<div class="container">
	<div class="col-12 ps-5 pt-5 pb-5">
		<a href="{{ route('document.index') }}" class="btn btn-outline-primary btn-sm mb-5"><i class="bi bi-caret-left"></i>@lang('lang.document_return_button')</a>
		<div class="row pb-5">
			<br><p class="text-danger"><small>{{ $messageRetour }}</small></p>
			<hr>
			<div class="row">
				<div class="col-6">
				@forelse($documentToShow as $document)	
					<h1 class="mb-3">{{ $document->document_nom }}</h1>
					<small> 
						@forelse($etudiants as $etudiant)
						@if($etudiant->etudiant_user_id == $document->document_user_id)
						{{ $etudiant->etudiant_nom }}
						@endif
						@empty
						@endforelse
						- {{ $document->created_at }}
					</small>
					<hr>
					<a href="{{ route('document.download', $document->id) }}" class="btn btn-outline-primary btn-sm mb-2 pe-3"><i class="bi bi-arrow-down-circle"></i> @lang('lang.document_download_button')</a>
					@if(Auth::user()->id == $document->document_user_id)
					<div class="col-6">
						<a href="{{ route('document.edit', $document->id) }}" class="btn btn-outline-primary btn-sm mb-2 pe-3"><i class="bi bi-pencil"></i> @lang('lang.second_page_modify_button')</a>
						<form method="POST">
							@csrf
							@method('DELETE')
							<button class="btn btn-outline-danger btn-sm pe-2"><i class="bi bi-trash"></i> @lang('lang.second_page_delete_button')</button>
						</form>
					</div>
					@endif
				@empty
				@endforelse
				</div>
			</div>
		</div>
	</div>
</div>
@endsection