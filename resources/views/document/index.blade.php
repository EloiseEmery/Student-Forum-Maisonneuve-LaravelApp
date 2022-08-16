@extends('layouts.app')
@section('content')
<div class="hero hero--page"></div>
<div class="container">
	<a href="{{ route('article.index') }}" class="btn btn-outline-primary btn-sm mt-5 ms-5"><i class="bi bi-caret-left"></i>@lang('lang.forum_return_button')</a>
	<div class="col-12 ps-5 pt-5 pb-5">
		<div class="row pb-5">
			<div class="col-4">
				<h1 class="text-left">@lang('lang.document_title')</h1>
				<p class="pt-2 pb-2">@lang('lang.document_sub_title')</p>
				<a href="{{ route('document.create') }}" class="btn btn-outline-primary btn-sm mb-5 pe-3">@lang('lang.document_button_add')<i class="bi bi-plus"></i></a>
				<br><p class="text-danger"><small> {{ $messageRetour }} </small></p>
			</div>
			<div>
			@forelse($documents as $document)
				<a class="" href="{{ route('document.show', $document->id) }}">{{ $document->document_nom }}<hr></a>
			@empty
			@endforelse
			</div>
		</div>
	</div>
</div>
@endsection