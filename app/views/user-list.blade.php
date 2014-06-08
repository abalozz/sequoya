@extends('layout')

@section('content')
  <h1>{{ $title }}</h1>

  @if ($users->isEmpty())
    <p>{{ $empty_message }}</p>
  @else
    <ul>
      @foreach ($users as $user)
        <li>
          <a href="{{ URL::action('UsersController@showProfile',
                                  array($user->username)) }}">
            {{ $user->name }}
            ({{ $user->atUsername }})
            {{ $user->namedType }}
          </a>
        </li>
      @endforeach
    </ul>
  @endif
@stop
