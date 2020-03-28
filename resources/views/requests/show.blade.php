@extends('layouts.app')

@section('content')
	<div class="container">
		<h1> {{$itemRequest->subject}} </h1>
		<div class="card">
			<div class="card-body">
				{{$itemRequest->text}}
			</div>
			<time>{{$itemRequest->created_at}}</time>
			@if (!Auth::user()->isAdmin)
				<form action="{{route('requests.destroy', $itemRequest->id)}}" method='POST'>
					@method('DELETE')
					@csrf
					<button type="submit" class='btn btn-danger'>Закрыть заявку</button>
				</form>
			@else
				<form action="{{route('requests.close', $itemRequest->id)}}">
					@csrf
					<button type="submit" class='btn btn-danger'>Закрыть заявку</button>
				</form>			
			@endif
		</div>
	</div>
@endsection