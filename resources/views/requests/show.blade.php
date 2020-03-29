@extends('layouts.app')

@section('content')
	<div class="container">
		<h1> {{$itemRequest->subject}} </h1>
		<div class="card">
			<div class="card-body">
				{{$itemRequest->text}}
			</div>
			<time>{{$itemRequest->created_at}}</time>
			@if (!Auth::user()->isAdmin && $itemRequest->status === 0)

				<form action="{{route('requests.destroy', $itemRequest->id)}}" method='POST'>
					@method('DELETE')
					@csrf
					<button type="submit" class='btn btn-danger'>Закрыть заявку</button>
				</form>

			@elseif (Auth::user()->isAdmin) 

				<form action="{{route('requests.accept', $itemRequest->id)}}">
					@csrf
					<button type="submit" class='btn btn-success'>Закрыть заявку</button>
				</form>		

			@endif

			@if ($itemRequest->status === 1)
				<i style='color: green'>
					Заявка принята менеджером
				</i>
			@endif
		</div>
		<br>
		<h1>Оставить сообщение</h1>
		<div class="card">
			<div class="card-body">
				<form action="" method='POST'>
					@csrf
					<textarea name="message"  cols="100" rows="10"></textarea>
					<br>
					<button type='submit' class='btn btn-success'>Оставить сообщение</button>
				</form>
			</div>
		</div>
	</div>
@endsection