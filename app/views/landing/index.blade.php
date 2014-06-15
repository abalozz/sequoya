@extends('landing/layout')

@section('content')

  {{ Form::open(array('action' => 'HomeController@login',
                      'method' => 'post',
                      'class' => 'row login')) }}

    @include('errors')

    <div class="medium-3 medium-offset-3 large-offset-4 columns">
      {{ Form::text('username', null,
        array('placeholder' => 'Usuario')) }}
    </div>

    <div class="medium-3 columns">
      {{ Form::password('password',
        array('placeholder' => 'Contraseña', 'class' => 'tiny')) }}
    </div>

    <div class="medium-3 large-2 columns">
      {{ Form::submit('Iniciar sesión',
        array('class' => 'button tiny radius expand')) }}
    </div>

  {{ Form::close() }}

  <div class="row">
    <h1 class="text-center columns">
      <img src="{{ asset('img/logo.png') }}" class="logo">Sequoya
    </h1>
  </div>

  <div class="row">
    <p class="text-center columns">
      <cite>"Una pequeña semilla puede convertirse en un árbol gigante"</cite>
    </p>
  </div>

  <div class="row text-center">
    {{ link_to_action('HomeController@showSignUp', '¡Regístrate ahora!',
      null, array('class' => 'button success radius')) }}
  </div>

  <div class="row landing-row">
    <div class="medium-6 columns">
      <div class="landing-image landing-image-1">
        <img src="{{ asset('img/landing-1.jpg') }}">
      </div>
    </div>
    <div class="medium-6 columns">
      <blockquote class="text-center landing-text">
        Comparte tu música con el mundo.
      </blockquote>
    </div>
  </div>

  <div class="row landing-row">
    <div class="medium-6 columns right">
      <div class="landing-image landing-image-2">
        <img src="{{ asset('img/landing-2.jpg') }}">
      </div>
    </div>
    <div class="medium-6 columns left">
      <blockquote class="text-center landing-text">
        Date a conocer y convierteté en el mejor.
      </blockquote>
    </div>
  </div>

  <div class="row landing-row">
    <div class="medium-6 columns">
      <div class="landing-image landing-image-3">
        <img src="{{ asset('img/landing-3.jpg') }}">
      </div>
    </div>
    <div class="medium-6 columns">
      <blockquote class="text-center landing-text">
        O descubre sonidos que nunca escuchaste.
      </blockquote>
    </div>
  </div>

  <div class="row text-center">
    {{ link_to_action('HomeController@showSignUp', '¡Pruébalo gratis!',
      null, array('class' => 'button success radius')) }}
  </div>
@stop
