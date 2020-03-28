@extends('layouts.app')

@section('content')
	<div class="container">
		@if($userRequests && $userRequests->count())
			<div class="col-md-12">
				@foreach($userRequests as $request)
					<h1> {{ $request->subject }} </h1>
					<p> {{ $request->text }}  </p>
					<time> {{ $request->created_at }} </time>
				@endforeach
			</div>
		@else
			<div class="col-md-12">
				<h2>Вы ещё не оставляли заявок</h2>
				<h2>Вы можете оставить заявку тут:</h2>
				<a href="requests/create" class='btn btn-danger'>
					Оставить заявку
				</a>
			</div>
		@endif
	</div>

@endsection