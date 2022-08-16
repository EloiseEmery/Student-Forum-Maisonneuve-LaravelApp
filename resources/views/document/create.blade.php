@extends('layouts.app')
@section('content')	
<div class="row ms-5 me-5 mb-5">
	<div class="col-12 pt-2">
		<a href="{{ route('document.index') }}" class="btn btn-outline-primary btn-sm mt-5"><i class="bi bi-caret-left"></i>@lang('lang.document_return_button')</a>
		<h1 class="mt-5">@lang('lang.document_add_title')</h1>
		<div class="card mt-5">
			<div class="card-header">
			@lang('lang.document_add_sub_title')
			</div>
			<div class="card-body">
				<form action="{{route('document.create.upload')}}" method="post" enctype="multipart/form-data">
					@csrf
					@if ($message = Session::get('success'))
					<div class="alert alert-success">
						<strong>{{ $message }}</strong>
					</div>
					@endif
					@if (count($errors) > 0)
					<div class="alert alert-danger">
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
					@endif
					<div class="custom-file">
						<input type="file" name="file" class="custom-file-input" id="chooseFile">
					</div>
					<button type="submit" name="submit" class="btn btn-primary btn-block mt-4">
					@lang('lang.document_add_upload_button')
					</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection