@extends('layout')

@section('content')
  <h1>{{ $page->user->name }}</h1>
  <p>
    {{ $page->user->namedType }}
  </p>
  <p>
    {{ $page->user->description }}
  </p>

  {{-- Discos --}}
  @if ($page->user->discs->isEmpty())
    <p>No tiene ningún disco</p>
  @else
    @foreach ($page->user->discs as $disc)
      <h3>{{ $disc->name }}</h3>
      @if ($disc->songs->isEmpty())
        <p>El dico no tiene ninguna canción</p>
      @else
        <ul>
          @foreach ($disc->songs as $song)
            <li>{{ $song->name }} - Duración: {{ $song->duration }}s</li>
          @endforeach
        </ul>
      @endif
    @endforeach
  @endif

  <div>
    @if ($page->user->publications->isEmpty())
      <p>Aún no publicaron nada :(</p>
    @else
      @foreach ($page->user->publications as $publication)
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
@stop
