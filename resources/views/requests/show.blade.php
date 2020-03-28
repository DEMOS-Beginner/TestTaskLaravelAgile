@extends('layouts.app')

@section('content')
	<div class="container">
		<h1> {{$itemRequest->subject}} </h1>
		<div class="card">
			<div class="card-body">
				{{$itemRequest->text}}
			</div>
			<time>{{$itemRequest->created_at}}</time>
		</div>
	</div>
@endsection