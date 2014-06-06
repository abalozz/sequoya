<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title> @yield('title', 'Sequoya, comparte tu música con el mundo') </title>
</head>
<body>
  <nav>
    <a href="{{ URL::action('HomeController@logout') }}">Cerrar sesión</a>
  </nav>
  @yield('content')
</body>
</html>
