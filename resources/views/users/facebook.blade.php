@extends('layouts.app')

@section('content')
	<form action="/auth/facebook/register" method="post" accept-charset="utf-8">
		{{ csrf_field() }}

		<div class="card">
			<div class="card-block">
				<img src="{{$user->avatar}}" class="img-thumbnail" alt="">
			</div>
			<div class="card-block">
				<div class="form-group">
					<label for="name" class="form-control-label">Nombre</label>
					<input type="text" name="name" value="{{ $user->name }}" readonly class="form-control">
				</div>

				<div class="form-group">
					<label for="email" class="form-control-label">Email</label>
					<input type="text" name="email" value="{{ $user->email }}" readonly class="form-control">
				</div>

				<div class="form-group">
					<label for="username" class="form-control-label">Username</label>
					<input type="text" name="username" value="{{ old('username') }}" class="form-control">
				</div>
			</div>

			<div class="card-footer">
				<button class="btn btn-primary" type="submit">Registrarme</button>
			</div>
		</div>
		

	</form>
@endsection