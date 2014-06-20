@extends('layout')

@section('content')
  <h1 class="columns">{{ $title }}</h1>

  <div class="columns">
    @if ($users->isEmpty())
      <p>{{ $empty_message }}</p>
    @else
      <ul class="small-block-grid-3 medium-block-grid-6 large-block-grid-6">
        @foreach ($users as $user)
          <li>
            <img src="{{ $user->profile_image_url }}">
            <a href="{{ URL::action('UsersController@showProfile',
                                    array($user->username)) }}">
              {{ $user->name }}<br>
              {{ $user->namedType }}
            </a>
          </li>
        @endforeach
      </ul>
    @endif
  </div>
@stop
