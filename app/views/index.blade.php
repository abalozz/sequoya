@extends('layout')

@section('content')

  <div class="large-3 columns">
    <div class="panel">
      <img
        src="{{ $user->profile_image_url }}"
        alt="Imagen de perfil">
      <ul class="no-bullet">
        <li>{{ $user->name }} <small>{{ $user->atUsername }}</small></li>
        <li>{{ $user->namedType }}</li>
        <li>{{ $user->description }}</li>
        <li>{{ link_to('me/followers', 'Seguidores') }}</li>
        <li>{{ link_to('me/following', 'Siguiendo') }}</li>
      </ul>
    </div>
  </div>

  <div class="large-9 columns">
    @include('publications')
  </div>
@stop
