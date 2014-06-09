@extends('layout')

@section('content')
  <h1>Perfil de {{ $user->name }}</h1>
  <p>
    <a href="{{ URL::action('UsersController@showEditProfile') }}">
      Editar perfil
    </a>
  </p>
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

  {{-- Discos --}}
  <div>
    <a href="{{ URL::action('DiscsController@showEditDiscs') }}">
      Editar discos
    </a>
  </div>
  @if ($user->discs->isEmpty())
    <p>No tiene ningún disco</p>
  @else
    @foreach ($user->discs as $disc)
      <h3>{{ $disc->name }}</h3>
      @if ($disc->songs->isEmpty())
        <p>El dico no tiene ninguna canción</p>
      @else
        <ul>
          @foreach ($disc->songs as $song)
            <li>{{ $song->name }} - Duración: {{ $song->duration }}s</li>
          @endforeach
        </ul>
      @endif
    @endforeach
  @endif

  @include('publications')
@stop
