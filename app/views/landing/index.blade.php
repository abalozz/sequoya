@extends('landing/layout')

@section('content')
  <h1>Sequoya</h1>

  {{ Form::open(array('action' => 'HomeController@login',
                              'method' => 'post')) }}
    {{ Form::label('username', 'Nombre de usuario') }}
    {{ Form::text('username') }}

    {{ Form::label('password', 'Contraseña') }}
    {{ Form::password('password') }}

    {{ Form::submit('Iniciar sesión') }}

  {{ Form::close() }}

  @include('errors')
@stop
