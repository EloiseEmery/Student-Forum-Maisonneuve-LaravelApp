@extends('layouts.app')
@section('content')	
<div class="row ms-5 me-5 mb-5">
@forelse($documentToShow as $document)
	<div class="col-12 pt-2">
		<a href="{{ route('document.show', $document->id) }}" class="btn btn-outline-primary btn-sm mt-5"><i class="bi bi-caret-left"></i>@lang('lang.document_modify_return_button')</a>
		<h1 class="mt-5">@lang('lang.document_modify_title') {{ $document->document_nom }}</h1>
		<div class="card mt-5">
			<div class="card-header">
			@lang('lang.document_modify_sub_title')
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
						<input type="text" class="form-control" id="nom" name="@lang('lang.document_modify_nom')" value="{{ $document->document_nom }}">
					</div>
					<div class="control-group pt-4">
						<input type="submit" class="btn btn-success mt-2" value="@lang('lang.fourth_page_form_button')" }}>
					</div>
				</form>
			</div>
		</div>
	</div>
@empty
@endforelse
</div>
@endsection