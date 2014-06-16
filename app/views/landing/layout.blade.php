<!doctype html>
<!--[if IE 9]><html class="lt-ie10" lang="es" > <![endif]-->
<html class="no-js" lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>
    @yield('title', 'Sequoya - Comparte tu música con el mundo')
  </title>

  {{ HTML::style('css/normalize.css') }}
  {{ HTML::style('css/foundation.min.css') }}

  {{ HTML::style('css/app.css') }}

  {{ HTML::script('js/vendor/modernizr.js') }}
</head>
<body>

  @yield('content')

  {{ HTML::script('js/vendor/jquery.js') }}
  {{ HTML::script('js/foundation.min.js') }}
  {{ HTML::script('js/app.js') }}
  <script>
    $(document).foundation();
  </script>

</body>
</html>
