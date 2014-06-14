@extends('layout')

@section('content')
  <h2 class="columns">Actualizar perfil</h2>
  
  @include('errors')

  {{ Form::model($user,
    array('action' => 'UsersController@updateProfile',
          'method' => 'post',
          'class' => 'columns')) }}
    
    <div class="row">
      <div class="large-4 columns">
        {{ Form::label('name', 'Nombre') }}
        {{ Form::text('name') }}
      </div>
      <div class="large-4 columns">
        <div class="row collapse">
          {{ Form::label('username', 'Nombre de usuario') }}
          <div class="small-2 columns">
            <span class="prefix">@</span>
          </div>
          <div class="small-10 columns">
            {{ Form::text('username') }}
          </div>
        </div>
      </div>
      <div class="large-4 columns">
        {{ Form::label('type', 'Tipo de usuario') }}
        {{ Form::select('type', User::$types) }}
      </div>
    </div>

    <div class="row">
      <div class="large-6 columns">
        {{ Form::label('email', 'Correo electrónico') }}
        {{ Form::email('email') }}
      </div>
      <div class="large-6 columns">
        {{ Form::label('password', 'Nueva contraseña') }}
        {{ Form::password('password') }}
      </div>
    </div>

    {{ Form::label('profile_image', 'Imagen de perfil') }}
    {{ Form::file('profile_image') }}

    {{ Form::label('description', 'Descripción o biografía') }}
    {{ Form::textarea('description') }}

    {{ Form::submit('Actualizar', array('class' => 'button radius right')) }}

  {{ Form::close() }}
@stop
