@extends('layouts.app')

@section('content')
	<div class="container">
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
				</div>
				<button type='submit' class='btn btn-success'>Отправить</button>			
			</form>
		</div>
	</div>
@endsection