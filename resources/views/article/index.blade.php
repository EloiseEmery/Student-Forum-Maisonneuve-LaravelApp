@extends('layouts.app')
@section('content')
<div class="hero hero--page"></div>
<div class="container">
	<div class="col-12 ps-5 pt-5 pb-5">
		<div class="row pb-5">
			<div class="col-4">
				<h1 class="text-left">@lang('lang.forum_title')</h1>
				<p class="pt-2 pb-2">@lang('lang.forum_sub_title')</p>
				<div class="row">
					<p class="text-danger"><small> {{ $messageRetour }} </small></p>
					<div class="col-6">
						<a href="{{ route('article.create') }}" class="btn btn-outline-primary btn-sm mb-5 pe-3">@lang('lang.forum_button_add')<i class="bi bi-plus"></i></a>
					</div>
					<div class="col-6">
						<a href="{{ route('document.index') }}" class="btn btn-outline-primary btn-sm mb-5 pe-3">@lang('lang.forum_document')<i class="bi bi-caret-right"></i></a>
					</div>
				</div>
				<table>
					<tr><th class="pe-5 pb-4 ps-2">@lang('lang.forum_article_title')</th><th class="pb-4">@lang('lang.forum_article_author')</th><th class="pb-4">Date</th></tr>
					@forelse($articles as $article)
					<tr class="tr">
						<td class="pb-2 pt-2 text-center pe-5"><a class="" href="{{ route('article.show', $article->id) }}">{{ $article->article_nom }}</a></td>
						<td class="pb-2 pt-2 text-center pe-5"><a class="" href="{{ route('article.show', $article->id) }}">
						@forelse($etudiants as $etudiant)
							@if($etudiant->etudiant_user_id == $article->article_user_id)
							{{ $etudiant->etudiant_nom }}
							@endif
						@empty
						@endforelse
						</a></td>
						<td class="pb-2 pt-2 text-center"><a class="" href="{{ route('article.show', $article->id) }}">{{ $article->created_at }}</a></td>
					</tr>
					@empty
					<p>@lang('lang.forum_no_article_message')</p>
					@endforelse
				</table>
			</div>
		</div>
	</div>
</div>
@endsection