@extends('layouts.app')

@section('content')
  <div class="jumbotron text-center">
    <h1>Laratter</h1>
    <nav>
      <ul class="nav">
        <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
      </ul>
    </nav>
  </div>

  <div class="row">
    <div class="col-md-12">
    <form action="/messages/create" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="form-group">
        <input type="text" name="message" id="message" class="form-control @if($errors->has('message')) is-invalid @endif" placeholder="Qué estás pensando?">
        @if ($errors->has('message'))
          @foreach($errors->get('message') as $e)
            <div class="invalid-feedback">{{ $e }}</div>
          @endforeach
        @endif
        <input type="file" class="form-control-file" name="image">
      </div>
    </form>
    </div>
  </div>
  

  <div class="row">
    @forelse($messages as $message)
      <div class="col-md-6">
        @include('messages.message')
      </div>
    @empty
      <p>No hay mensajes registrados.</p>
    @endforelse

    @if(count($messages))
      <div class="mt-4 mx-auto">
        {{ $messages->links() }}
      </div>
    @endif
  </div>
@endsection
