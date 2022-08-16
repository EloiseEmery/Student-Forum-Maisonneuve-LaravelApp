@extends('layouts.app')
@section('content')
<div class="hero hero--page"></div>
<div class="container">
	<div class="col-12 ps-5 pt-5 pb-5">
		<a href="{{ route('article.index') }}" class="btn btn-outline-primary btn-sm mb-5"><i class="bi bi-caret-left"></i>@lang('lang.forum_return_button')</a>
		<div class="row pb-5">
			<br><p class="text-danger"><small>{{ $messageRetour }}</small></p>
			<hr>
			<div class="row">
				<div class="col-6">
				@forelse($articleToShow as $article)	
						<h1 class="mb-3">{{ $article->article_nom }}</h1>
						<small> 
							@forelse($etudiants as $etudiant)
								@if($etudiant->etudiant_user_id == $article->article_user_id)
								{{ $etudiant->etudiant_nom }}
								@endif
							@empty
							@endforelse
							- {{ $article->created_at }}
						</small>
						<p class="mt-5">{{ $article->article_description }}</p>
					</div>
					@if(Auth::user()->id == $article->article_user_id)
					<div class="col-6">
						<!-- <div class="row"> -->
							<a href="{{ route('article.edit', $article->id) }}" class="btn btn-outline-primary btn-sm mb-2 pe-3"><i class="bi bi-pencil"></i> @lang('lang.second_page_modify_button')</a>
							<form method="POST">
								@csrf
								@method('DELETE')
								<button class="btn btn-outline-danger btn-sm pe-2"><i class="bi bi-trash"></i> @lang('lang.second_page_delete_button')</button>
							</form>
						<!-- </div> -->
					</div>
					@endif
				@empty
				@endforelse
			</div>
		</div>
	</div>
</div>
@endsection