@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<h1>Добро пожаловать в тех. поддержку!</h1>			
		</div>
		<div class="col-md-6">
			<h2>Вы можете оставить заявку тут:</h2>
			<a href="requests/create" class='btn btn-danger'>
				Оставить заявку
			</a>
		</div>
		@if(Auth::user())
			<div class="col-md-6">
				<h2>Просмотреть оставленные заявки:</h2>
				<a href="requests" class='btn btn-danger'>
					Все заявки
				</a>
			</div>
		@endif
	</div>
@endsection