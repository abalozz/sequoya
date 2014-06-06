@extends('/landing/layout')

@section('content')
  <h1>Sign Up</h1>
  {{ Form::model($user, array('action' => 'HomeController@signUp',
                              'method' => 'post')) }}

    {{ Form::label('username', 'Nombre de usuario') }}
    {{ Form::text('username') }}

    {{ Form::label('email', 'Correo electrónico') }}
    {{ Form::email('email') }}

    {{ Form::label('password', 'Contraseña') }}
    {{ Form::password('password') }}

    {{ Form::label('type', 'Tipo de usuario') }}
    {{ Form::select('type', User::$types) }}

    {{ Form::submit('Registrarse') }}

  {{ Form::close() }}

  @include('errors')
@stop
