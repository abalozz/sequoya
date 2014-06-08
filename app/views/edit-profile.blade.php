@extends('layout')

@section('content')
  <h1>Actualizar perfil</h1>

  {{ Form::model($user,
    array('action' => 'UsersController@updateProfile', 'method' => 'post')) }}

    {{ Form::label('name', 'Nombre') }}
    {{ Form::text('name') }}

    {{ Form::label('username', 'Nombre de usuario') }}
    {{ Form::text('username') }}

    {{ Form::label('email', 'Correo electrónico') }}
    {{ Form::email('email') }}

    {{ Form::label('profile_image', 'Imagen de perfil') }}
    {{ Form::file('profile_image') }}

    {{ Form::label('password', 'Nueva contraseña') }}
    {{ Form::password('password') }}

    {{ Form::label('description', 'Descripción o biografía') }}
    {{ Form::textarea('description') }}

    {{ Form::label('type', 'Tipo de usuario') }}
    {{ Form::select('type', User::$types) }}

    {{ Form::submit('Actualizar') }}

  {{ Form::close() }}

  @include('errors')
@stop
