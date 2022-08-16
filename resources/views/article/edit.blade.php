@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row ms-5 me-5 mb-5">
		<div class="col-12 pt-2">
		@forelse($articleToShow as $article)
			<a href="{{ route('article.show', $article->id) }}" class="btn btn-outline-primary btn-sm mt-5"><i class="bi bi-caret-left"></i>@lang('lang.forum_edit_return_button')</a>
			<h1 class="mt-5">@lang('lang.forum_modify_title') {{ $article->article_nom }}</h1>
			<div class="card mt-5">
				<div class="card-header">
				@lang('lang.forum_modif_sub_title')
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
							<label for="@lang('lang.forum_article_nom')">@lang('lang.forum_add_form_first_input')*</label>
							<input type="text" class="form-control" id="nom" name="@lang('lang.forum_article_nom')" value="{{ $article->article_nom }}">
						</div>
						<div class="control-group">
							<label for="@lang('lang.forum_article_description')">@lang('lang.forum_add_form_second_input')*</label>
							<textarea type="text" class="form-control" id="nom" name="@lang('lang.forum_article_description')">{{ $article->article_description }}</textarea>
						</div>
						<div class="control-group pt-4">
							<input type="submit" class="btn btn-success mt-2" value="@lang('lang.fourth_page_form_button')" }}>
						</div>
					</form>
				</div>
			</div>
		@empty
		@endforelse
		</div>
	</div>
</div>
@endsection