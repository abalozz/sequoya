<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title> @yield('title', 'Sequoya, comparte tu música con el mundo') </title>
</head>
<body>
  <nav>
    <a href="{{ URL::action('HomeController@showIndex') }}">Inicio</a>
    <a href="{{ URL::to('me') }}">Perfil</a>
    <a href="{{ URL::to('me/followers') }}">Seguidores</a>
    <a href="{{ URL::to('me/following') }}">Siguiendo</a>
    <span>Conectado como <strong>{{ $user->username }}</strong></span>
    <a href="{{ URL::action('HomeController@logout') }}">Cerrar sesión</a>
  </nav>
  {{ Form::open(array('action' => 'UsersController@search',
                      'method' => 'post')) }}
    {{ Form::text('search', isset($search) ? $search : null,
                  array('placeholder' => 'Busca un usuario')) }}
    {{ Form::submit('Buscar') }}
  {{ Form::close() }}
  @yield('content')
</body>
</html>
