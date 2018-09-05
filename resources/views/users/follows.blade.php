@extends('layouts.app')

@section('content')
<h2>{{ $user->name}}</h2>
<ul class="list-unstyled">
	@foreach($follows as $follow)
		<li>{{ $follow->username }}</li>
	@endforeach
</ul>
@endsection