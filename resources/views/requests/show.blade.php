@extends('layouts.app')

@section('content')
	<div class="container">
		<h1> {{$itemRequest->subject}} </h1>
		<div class="card">
			<div class="card-body">
				{{$itemRequest->text}}
			</div>
			<time>{{$itemRequest->created_at}}</time>
			<form action="{{route('requests.destroy', $itemRequest->id)}}" method='POST'>
				@method('DELETE')
				@csrf
				<button type="submit" class='btn btn-danger'>Закрыть заявку</button>
			</form>
		</div>
	</div>
@endsection