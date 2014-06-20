<!doctype html>
<!--[if IE 9]><html class="lt-ie10" lang="es" > <![endif]-->
<html class="no-js" lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> @yield('title', 'Sequoya, comparte tu música con el mundo') </title>

  {{ HTML::style('css/normalize.css') }}
  {{ HTML::style('css/foundation.min.css') }}

  {{ HTML::style('css/app.css') }}

  {{ HTML::script('js/vendor/modernizr.js') }}
</head>
<body>
  <nav class="top-bar" data-topbar>
    <ul class="title-area">
      <li class="name">
        <h1>
          <a href="{{ URL::action('HomeController@showIndex') }}">Sequoya</a>
        </h1>
      </li>
      <li class="toggle-topbar menu-icon">
        <a href=""><span>Menu</span></a>
      </li>
    </ul>

    <section class="top-bar-section">
      <ul class="left">
        <li>
          {{ link_to_action('HomeController@showIndex', 'Inicio') }}
        </li>
        <li>
          {{ link_to_action('UsersController@showDiscover', 'Descubre') }}
        </li>
        <li class="has-form">
          {{ Form::open(array('action' => 'UsersController@search',
                              'method' => 'post',
                              'class' => '')) }}
          <div class="row collapse">
            <div class="large-8 small-9 columns">
              {{ Form::text('search', isset($search) ? $search : null,
                  array('placeholder' => 'Busca un usuario')) }}
            </div>
            <div class="large-4 small-3 columns">
              {{ Form::submit('Buscar',
                array('class' => 'button postfix radius expand')) }}
            </div>
            </div>
          {{ Form::close() }}
        </li>
      </ul>

      <ul class="right">
        <li class="divider"></li>
        <li class="has-dropdown not-click">
          <a href="#">{{ $user->name }}</a>
          <ul class="dropdown">
            <li>
              <a href="{{ URL::to('me') }}">Perfil</a>
            </li>
            <li>
              <a href="{{ URL::action('UsersController@showEditProfile') }}">
                Configuración
              </a>
            </li>
            <li>
              <a href="{{ URL::to('me/followers') }}">Seguidores</a>
            </li>
            <li>
              <a href="{{ URL::to('me/following') }}">Siguiendo</a>
            </li>
            <li>
              <a href="{{ URL::action('HomeController@logout') }}">
                Cerrar sesión
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </section>
  </nav>

  <div class="row">
    @yield('content')
  </div>


  {{ HTML::script('js/vendor/jquery.js') }}
  {{ HTML::script('js/foundation.min.js') }}
  {{ HTML::script('js/app.js') }}
  <script>
    $(document).foundation();
  </script>

</body>
</html>
