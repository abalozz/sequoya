<!doctype html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>
    @yield('title', 'Sequoya - Comparte tu música con el mundo')
  </title>
</head>
<body>
  <nav>
    <a href="{{ URL::action('HomeController@showLanding') }}">Inicio</a>
    <a href="{{ URL::action('HomeController@showSignUp') }}">Registro</a>
  </nav>
  @yield('content')
</body>
</html>
