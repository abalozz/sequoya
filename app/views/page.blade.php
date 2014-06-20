@extends('landing/layout')

@section('content')

  <style type="text/css">
    body {
      background-color: {{ $page->background_color }};
    }
    body, h1, h2, h3, h4, h5 {
      color: {{ $page->font_color }};
    }
    a {
      color: {{ $page->link_color }};
    }
  </style>
  
  <div class="header-image"
    style="background-image:url({{ $page->header_image_url }});
      background-color:{{ $page->font_color }};"></div>

  <div class="row">
    <img src="{{ $page->user->profile_image_url }}"
      class="small-5 medium-3 columns">

    <div class="small-7 medium-9 columns">
      <div class="row">
        <h1 class="columns">{{ $page->user->name }}</h1>
      </div>
      <div class="row">
        <p class="columns">
          {{ $page->user->namedType }}
        </p>
        <p class="columns">
          {{ $page->user->description }}
        </p>
      </div>
    </div>
  </div>

  {{-- Discos --}}
  @if ($page->user->discs->isEmpty())
    <p>No tiene ningún disco</p>
  @else
    @foreach ($page->user->discs as $disc)
      <div class="row">
        <h3 class="small-centered small-11 columns">{{ $disc->name }}</h3>
      </div>
      <div class="row">
        <div class="medium-3 columns">
          <img src="{{ $disc->cover_url }}">
        </div>
        <div class="medium-9 columns">
          @if ($disc->songs->isEmpty())
            <p>El disco no tiene canciones</p>
          @else
            <table class="small-12">
              <thead>
                <tr>
                  <th width="35">Nº</th>
                  <th>Nombre</th>
                  <th>Duración</th>
                  <th>Controles</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($disc->songs as $song)
                  <tr>
                    <td>{{ $song->number }}</td>
                    <td>{{ $song->name }}</td>
                    <td>{{ $song->duration }} s</td>
                    <td>
                      @if ($song->track)
                        <audio src="{{ $song->track_url }}"
                          id="song{{ $song->id }}"></audio>
                        <span data-song="{{ $song->id }}" class="play">
                          Play
                        </span>
                        |
                        <span data-song="{{ $song->id }}" class="pause">
                          Pause
                        </span>
                      @endif
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          @endif
        </div>
      </div>
    @endforeach
  @endif

  <?php $publications = $page->user->publications; ?>
  <?php $user = $page->user; ?>
  <div class="columns">
    <div class="row">
      @include('publications')
    </div>
  </div>

@stop
