@extends('layout')

@section('content')
  <h2 class="columns">Perfil de {{ $user->name }}</h2>

  <div class="large-3 columns">
    <div class="panel">
      <img
        src="{{ $user->profile_image_url }}"
        alt="Imagen de perfil">
      <ul class="no-bullet">
        <li>{{ $user->name }} <small>{{ $user->atUsername }}</small></li>
        <li>{{ $user->namedType }}</li>
        <li>{{ $user->description }}</li>
        <li>{{ link_to_action('UsersController@showFollowers', 'Seguidores', $user->username) }}</li>
        <li>{{ link_to_action('UsersController@showFollowing', 'Siguiendo', $user->username) }}</li>
      </ul>
      @if (Auth::user()->id != $user->id)
        <p>
          @if ($user->isFollowedBy(Auth::user()))
            {{ Form::open(array('action' => array('UsersController@unfollow',
                                                  $user->username),
                                'method' => 'post')) }}
              {{ Form::submit('Dejar de seguir',
                array('class' => 'button radius expand alert')) }}
            {{ Form::close() }}
          @else
            {{ Form::open(array('action' => array('UsersController@follow',
                                                  $user->username),
                                'method' => 'post')) }}
              {{ Form::submit('Seguir',
                array('class' => 'button radius expand success')) }}
            {{ Form::close() }}
          @endif
        </p>
      @endif
    </div>

    @if (Auth::user()->id == $user->id)
      <div class="panel">
        <ul class="no-bullet">
          <li>
            <a href="{{ URL::action('UsersController@showEditProfile') }}">
              Editar perfil
            </a>
          </li>
          <li>
            <a href="{{ URL::action('DiscsController@showEditDiscs') }}">
              Editar discos
            </a>
          </li>
          @if ($user->type != 0)
            <li>
              <a href="{{ URL::action('PagesController@showEditPage') }}">
                Editar página personalizada
              </a>
            </li>
          @endif
        </ul>
      </div>
    @endif
  </div>
  
  <div class="large-9 columns">
    {{-- Discos --}}
    @if ($user->discs->isEmpty())
      <p>No tiene ningún disco</p>
    @else
      @foreach ($user->discs as $disc)
        <h3 class="medium-9">{{ $disc->name }}</h3>
        <div class="medium-3">
          <img src="{{ $disc->cover_url }}">
        </div>
        @if ($disc->songs->isEmpty())
          <p>El disco no tiene canciones</p>
        @else
          <table class="small-12">
            <thead>
              <tr>
                <th width="35">Nº</th>
                <th>Nombre</th>
                <th>Duración</th>
                <th>Controles</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($disc->songs as $song)
                <tr>
                  <td>{{ $song->number }}</td>
                  <td>{{ $song->name }}</td>
                  <td>{{ $song->duration }} s</td>
                  <td>
                    @if ($song->track)
                      <audio src="{{ $song->track_url }}"
                        id="song{{ $song->id }}"></audio>
                      <span data-song="{{ $song->id }}" class="play">
                        Play
                      </span>
                      |
                      <span data-song="{{ $song->id }}" class="pause">
                        Pause
                      </span>
                    @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        @endif
      @endforeach
    @endif

    @include('publications')
  </div>
@stop
