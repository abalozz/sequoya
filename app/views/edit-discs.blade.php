@extends('layout')

@section('content')
  <h2 class="columns">Editar discos</h2>

  <div class="columns">
    @include('errors')
  </div>

  @if ($user->discs->isEmpty())
    <p class="columns">No tiene ningún disco</p>
  @else
    @foreach ($user->discs as $disc)
      <h3 class="columns">
        {{ $disc->name }}
        <small>Fecha de lanzamiento: {{ $disc->release_date }}</small>
      </h3>

      @if ($disc->songs->isEmpty())
        <p class="columns">El disco no tiene ninguna canción</p>
      @else
        <div class="columns">
          <table class="small-12">
            <thead>
              <tr>
                <th width="35">Nº</th>
                <th>Nombre</th>
                <th>Duración</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($disc->songs as $song)
              <tr>
                <td>{{ $song->number }}</td>
                <td>{{ $song->name }}</td>
                <td>{{ $song->duration }} s</td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      @endif

      {{ Form::model($new_song,
        array('action' => array('SongsController@create', $disc->id),
              'method' => 'post',
              'files' => true)) }}
        
        <div class="large-7 columns">
          {{ Form::text('name', null,
            array('placeholder' => 'Nombre de la canción')) }}
        </div>
        <div class="large-3 columns">
          {{ Form::text('duration', null,
            array('placeholder' => 'Duración (en segundos)')) }}
        </div>
        <div class="large-2 columns">
          {{ Form::submit('Enviar nueva canción',
            array('class' => 'button radius tiny expand')) }}
        </div>

      {{ Form::close() }}
    @endforeach
  @endif

  <h4 class="columns">Nuevo disco</h4>
  {{ Form::model($new_disc,
    array('action' => 'DiscsController@create',
                      'method' => 'post',
                      'files' => true,
                      'class' => 'columns')) }}
    
    <div class="row">
      <div class="large-8 columns">
        {{ Form::label('name', 'Nombre del disco') }}
        {{ Form::text('name') }}
      </div>
      <div class="large-4 columns">
        {{ Form::label('release_date', 'Fecha de lanzamiento') }}
        {{ Form::text('release_date') }}
      </div>
    </div>

    {{ Form::label('cover', 'Imagen de portada / Carátula') }}
    {{ Form::file('cover') }}

    {{ Form::submit('Crear nuevo disco',
      array('class' => 'button radius right')) }}

  {{ Form::close() }}

@stop
