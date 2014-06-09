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

  <h1>Editar página personalizada</h1>

  {{ Form::model($page, array('action' => $action, 'method' => 'post')) }}

    {{ Form::label('subdomain', 'Subdominio') }}
    {{ Form::text('subdomain') }}

    {{ Form::label('header_image', 'Imagen de cabecera') }}
    {{ Form::file('header_image') }}

    {{ Form::label('background_color', 'Color de fondo') }}
    {{ Form::file('background_color') }}

    {{ Form::label('font_color', 'Color de fuente') }}
    {{ Form::file('font_color') }}

    {{ Form::label('link_color', 'Color de enlaces') }}
    {{ Form::file('link_color') }}

    {{ Form::submit('Guardar') }}

  {{ Form::close() }}

  @include('errors')
    
@stop
