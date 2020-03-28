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
		@if($userRequests && $userRequests->count())
			<div class="card">
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
										<a @if ($request->status == 1) style='color: green;' @endif
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