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

		@if ($errors->any())
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
		@endif		
		<h1>Оставить сообщение</h1>
		<div class="card">
			<form action="{{route('messages.store')}}" method='POST'>
				@csrf
				<textarea name="text"  cols="100" rows="10"></textarea>
				<input type="hidden" name='test_request_id' value ='{{$itemRequest->id}}'>
				<input type="hidden" name='user_id' value='{{Auth::user()->id}}'>
				<input type="hidden" name='created_at' value='{{Carbon\Carbon::now()}}'>
				<br>
				<button type='submit' class='btn btn-success mb-25'>Оставить сообщение</button>
			</form>
		</div>

		<div class="card mt-25">
			@foreach ($itemRequest->messages as $message)
				<div class="card-body">
					<h2>{{$message->user->name}}</h2>
					<p>{{$message->text}}</p>
					<time>{{$message->created_at}}</time>
				</div>
				<br>	
			@endforeach
		</div>
	</div>
@endsection