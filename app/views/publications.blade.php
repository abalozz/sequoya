  @if (Auth::user() == $user)
    {{ Form::model($publication,
      array('action' => 'PublicationsController@publish', 'method' => 'post')) }}
      {{ Form::label('content', 'Comparte una nueva publicación') }}
      <div>{{ Form::textarea('content', null,
        array('placeholder' => 'Contenido')) }}</div>
      {{ Form::submit('Enviar') }}
    {{ Form::close() }}

    @include('errors')
  @endif

  <div>
    @if ($publications->isEmpty())
      <p>Aún no publicaron nada :(</p>
    @else
      @foreach ($publications as $publication)
        <article>
          <header>
            Publicado por {{ $publication->user->name }}
            a las {{ $publication->created_at }}
          </header>
          {{ $publication->content }}
        </article>
      @endforeach
    @endif
  </div>
