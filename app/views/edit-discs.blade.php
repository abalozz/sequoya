@extends('layout')

@section('content')
  <h1>Editar discos</h1>

  @if ($user->discs->isEmpty())
    <p>No tiene ningún disco</p>
  @else
    @foreach ($user->discs as $disc)
      <h3>{{ $disc->name }}</h3>

      @if ($disc->songs->isEmpty())
        <p>El disco no tiene ninguna canción</p>
      @else
        <ul>
          @foreach ($disc->songs as $song)
            <li>{{ $song->name }} - Duración: {{ $song->duration }}s</li>
          @endforeach
        </ul>
      @endif

      {{ Form::model($new_song,
        array('action' => array('SongsController@create', $disc->id),
              'method' => 'post')) }}
        
        {{ Form::label('name', 'Nombre de la canción') }}
        {{ Form::text('name') }}

        {{ Form::label('duration', 'Duración (en segundos)') }}
        {{ Form::text('duration') }}

        {{ Form::submit('Enviar nueva canción') }}

      {{ Form::close() }}
    @endforeach
  @endif

  {{ Form::model($new_disc,
    array('action' => 'DiscsController@create', 'method' => 'post')) }}
    
    {{ Form::label('name', 'Nombre del disco') }}
    {{ Form::text('name') }}

    {{ Form::label('cover', 'Imagen de portada / Carátula') }}
    {{ Form::file('cover') }}
    
    {{ Form::label('release_date', 'Fecha de lanzamiento') }}
    {{ Form::text('release_date') }}

    {{ Form::submit('Crear nuevo disco') }}

  {{ Form::close() }}

  @include('errors')
@stop
