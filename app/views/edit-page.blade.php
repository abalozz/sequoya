<?php

if ($page->exists) {
    $action = 'PagesController@update';
}
else
{
    $action = 'PagesController@create';
}

?>

@extends('layout')

@section('content')

  <h1 class="columns">Editar página personalizada</h1>

  {{ Form::model($page, array('action' => $action,
                              'method' => 'post',
                              'class' => 'columns',
                              'files' => true)) }}

    <div class="row collapse">
      {{ Form::label('subdomain', 'Subdominio') }}
      <div class="small-7 medium-10 columns">
        {{ Form::text('subdomain') }}
      </div>
      <div class="small-5 medium-2 columns">
        <span class="postfix">.sequoya.music</span>
      </div>
    </div>

    <div class="row collapse">
      {{ Form::label('header_image', 'Imagen de cabecera') }}
      {{ Form::file('header_image') }}
    </div>

    <div class="row">
      <div class="medium-4 columns">
        {{ Form::label('background_color', 'Color de fondo') }}
        {{ Form::text('background_color') }}
      </div>

      <div class="medium-4 columns">
        {{ Form::label('font_color', 'Color de fuente') }}
        {{ Form::text('font_color') }}
      </div>

      <div class="medium-4 columns">
        {{ Form::label('link_color', 'Color de enlaces') }}
        {{ Form::text('link_color') }}
      </div>
    </div>

    <div class="row">
      <div class="columns">
        {{ Form::submit('Guardar',
          array('class' => 'button expand radius')) }}
      </div>
    </div>

  {{ Form::close() }}

  @include('errors')
    
@stop
