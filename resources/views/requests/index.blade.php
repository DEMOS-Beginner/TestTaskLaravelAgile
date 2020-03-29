@extends('layouts.app')

@section('content')
	<div class="container">

		@if (session('success'))
			<div class="row justify-content-center">
				<div class="col-md-11">
					<div class="alert alert-success" role='alert'>
						<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
							<span aria-hidden='true'>x</span>
						</button>
						{{ session()->get('success') }}
					</div>
				</div>
			</div>
		@endif

		<div class="row">

			@if($userRequests && $userRequests->count())

				@if(!Auth::user()->isAdmin)
				<div class="card">
				@else
				<div class="col-md-8">
				@endif
					<div class="card-body">
						<table class="table table-hover">
							<thead>
								<tr>
									@if(Auth::user()->isAdmin)
									<th>Автор заявки</th>
									@endif
									<th>Тема заявки</th>
									<th>Дата отправки</th>
								</tr>
							</thead>
							<tbody>
								@foreach($userRequests as $request)
									<tr> 
										@if(Auth::user()->isAdmin)
										<td>{{$request->user->name}}</td>
										@endif									
										<td>
											<a @if ($request->status == 1) style='color: green;'
												@elseif($request->status == 2) style='color: gray;'
												@endif
											 href="{{route('requests.show', $request->id)}}" class='btn btn-link'>
												{{ $request->subject }}
											</a>						
										</td>
										<td>
											{{ $request->created_at }}
										</td>
									</tr>
								@endforeach
							</tbody>
							<tfoot></tfoot>
						</table>
					</div>
				</div>

			@else
			
				<div class="col-md-8">
					@if (!Auth::user()->isAdmin)
					<h2>Вы ещё не оставляли заявок</h2>
					@else
					<h2>Заявок нет</h2>
					@endif
					<h2>Вы можете оставить заявку тут:</h2>
					<a href="requests/create" class='btn btn-danger'>
						Оставить заявку
					</a>
				</div>

			@endif
				<div class="col-md-4">
					<div class="card-body">
						<h2>Фильтрация</h2>
						<form action="{{route('filter')}}">
							<input type="checkbox" name='looked'>
							<label for="looked">Просмотрено</label>
							<input type="checkbox" name='no_looked'>
							<label for="no_looked">Не просмотрено</label>
							<br>
							<input type="checkbox" name='opened'>
							<label for="opened">Открытые заявки</label>
							<input type="checkbox" name='accepted'>
							<label for="accepted">Закрытые заявки</label>

							<button type='submit' class='btn btn-primary'>Отфильтровать</button>
						</form>
					</div>
				</div>			
		
		</div>
	</div>

@endsection