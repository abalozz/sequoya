@extends('/landing/layout')

@section('content')
  <div class="row">
    <h1 class="text-center">Registro</h1>
  </div>

  <div class="row" data-equalizer>
    <div class="medium-4 columns">
      <ul class="pricing-table" data-equalizer-watch>
        <li class="title">Suscripción Gratuita</li>
        <li class="price">0€</li>
        <li class="description">
          Distribuye tu música de forma gratuita o descubre nuevos artistas.
          La opción ideal si eres un usuario común o quieres autopromocionarte.
        </li>
        <li class="bullet-item">
          Infinitos discos gratuitos
        </li>
        <li class="cta-button">
          <label class="button pay-method" for="suscription1">Seleccionar</label>
        </li>
      </ul>
    </div>
    <div class="medium-4 columns">
      <ul class="pricing-table" data-equalizer-watch>
        <li class="title">Maqueta</li>
        <li class="price">4,99€/disco</li>
        <li class="description">
          Obtén ganancias distribuyendo tu música a través de las principales
          plataformas de streaming* de música.
        </li>
        <li class="bullet-item">
          Infinitos discos gratuitos
        </li>
        <li class="bullet-item">
          *Stopify, AiTuns, Deecer, Pandera, LostFM
        </li>
        <li class="bullet-item">
          40% de interés por venta
        </li>
        <li class="cta-button">
          <label class="button pay-method" for="suscription2">Seleccionar</label>
        </li>
      </ul>
    </div>
    <div class="medium-4 columns">
      <ul class="pricing-table" data-equalizer-watch>
        <li class="title">Profesional</li>
        <li class="price">79,99€/mes</li>
        <li class="description">
          Obtén ganancias distribuyendo tu música a través de las principales
          plataformas de streaming* de música.
        </li>
        <li class="bullet-item">
          Infinitos discos gratuitos
        </li>
        <li class="bullet-item">
          *Stopify, AiTuns, Deecer, Pandera, LostFM
        </li>
        <li class="bullet-item">
          5% de interés por venta
        </li>
        <li class="cta-button">
          <label class="button pay-method" for="suscription3">Seleccionar</label>
        </li>
      </ul>
    </div>
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

    <div class="hide">
      {{ Form::radio('suscription', '0', true,
        array('id' => 'suscription1')) }}
      {{ Form::radio('suscription', '1', false,
        array('id' => 'suscription2')) }}
      {{ Form::radio('suscription', '2', false,
        array('id' => 'suscription3')) }}
    </div>

  {{ Form::close() }}

  @include('errors')
@stop
