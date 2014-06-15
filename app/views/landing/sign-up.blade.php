@extends('/landing/layout')

@section('content')
  <div class="row">
    <h1 class="text-center">Registro</h1>
  </div>

  {{ Form::model($user, array('action' => 'HomeController@signUp',
                              'method' => 'post')) }}

    <div class="row">
      <div class="medium-6 large-5 small-centered columns">
        {{ Form::label('username', 'Nombre de usuario') }}
        {{ Form::text('username') }}
      </div>
    </div>

    <div class="row">
      <div class="medium-6 large-5 small-centered columns">
        {{ Form::label('email', 'Correo electrónico') }}
        {{ Form::email('email') }}
      </div>
    </div>

    <div class="row">
      <div class="medium-6 large-5 small-centered columns">
        {{ Form::label('password', 'Contraseña') }}
        {{ Form::password('password') }}
      </div>
    </div>

    <div class="row">
      <div class="medium-6 large-5 small-centered columns">
        {{ Form::label('type', 'Tipo de usuario') }}
        {{ Form::select('type', User::$types) }}
      </div>
    </div>

    <div class="row">
      <div class="medium-6 large-5 small-centered columns">
        {{ Form::submit('Regístrate',
          array('class' => 'button expand radius')) }}
      </div>
    </div>

    <div class="row">
      <div class="medium-6 large-5 small-centered columns text-center">
        <p>ó</p>
      </div>
    </div>

    <div class="row">
      <div class="medium-6 large-5 small-centered columns text-center">
        {{ link_to_action('HomeController@showLanding', 'Inicia sesión') }}
      </div>
    </div>

  {{ Form::close() }}

  @include('errors')
@stop
