@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="col-md-12">
			@foreach($userRequests as $request)
				<h1> {{ $request->subject }} </h1>
				<p> {{ $request->text }}  </p>
				<time> {{ $request->created_at }} </time>
			@endforeach
		</div>		
	</div>

@endsection