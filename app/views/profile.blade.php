@extends('layout')

@section('content')
  <h1>Perfil de {{ $user->name }}</h1>
  <p>
    {{ $user->namedType }}
  </p>
  <p>
    {{ $user->description }}
  </p>
  <ul>
    <li><a href="{{ URL::action('UsersController@showFollowers',
      array($user->username)) }}">
      Seguidores
    </a></li>
    <li><a href="{{ URL::action('UsersController@showFollowing',
      array($user->username)) }}">
      Siguiendo
    </a></li>
  </ul>
  @if (Auth::user() != $user)
    <div>
      @if ($user->isFollowedBy(Auth::user()))
        {{ Form::open(array('action' => array('UsersController@unfollow',
                                              $user->username),
                            'method' => 'post')) }}
          {{ Form::submit('Dejar de seguir') }}
        {{ Form::close() }}
      @else
        {{ Form::open(array('action' => array('UsersController@follow',
                                              $user->username),
                            'method' => 'post')) }}
          {{ Form::submit('Seguir') }}
        {{ Form::close() }}
      @endif
    </div>
  @endif

  @include('publications')
@stop
