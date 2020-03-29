@extends('layouts.app')

@section('content')
	<div class="container">
		@if ($errors->any())
			<div class="row justify-content-center">
				<div class="col-md-11">
					<div class="alert alert-danger" role='alert'>
						<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
							<span aria-hidden='true'>x</span>
						</button>
						<ul>
							@foreach($errors->all() as $errorTxt)
								<li> {{$errorTxt}} </li>
							@endforeach
						</ul>
					</div>
				</div>
			</div>
		@endif
		<div class="row justify-content-center">
			<h1>Форма заявки:</h1>
		</div>
		<div class="col-md-12">
			<form action="{{ route('requests.store') }}" enctype="multipart/form-data" method='POST'>
				@csrf
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text">Тема</span>
					</div>
				  <input type="text" class="form-control" placeholder="Тема заявки" aria-label="Subject" aria-describedby="basic-addon1" name='subject'>
				</div>
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text">Текст заявки</span>
					</div>
					<textarea name="text" cols="200" rows="10"></textarea>
					<input type="hidden" name='user_id' value='{{Auth::user()->id}}'>
					<input type="hidden" name='created_at' value='{{Carbon\Carbon::now()}}'>
					<input type="hidden" name='status' value='0'>
					<input type="file" name='filename'>
				</div>
				<button type='submit' class='btn btn-success'>Отправить</button>			
			</form>
		</div>
	</div>
@endsection