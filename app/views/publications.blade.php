<h3>Útlimas publicaciones</h3>
@if (Auth::user() == $user)
  {{ Form::model($publication,
    array('action' => 'PublicationsController@publish', 'method' => 'post')) }}
    {{ Form::textarea('content', null,
      array('placeholder' => 'Comparte una nueva publicación')) }}
    {{ Form::submit('Enviar nueva publicación',
      array('class' => 'button radius expand')) }}
  {{ Form::close() }}

  @include('errors')
@endif

<div>
  @if ($publications->isEmpty())
    <p>Aún no publicaron nada :(</p>
  @else
    @foreach ($publications as $publication)
      <article class="panel">
        <img src="{{ $publication->user->profile_image_url }}"
          class="left avatar" width="64">
        <h4>
          {{ $publication->user->name }}
          <small>a las {{ $publication->created_at }}</small>
        </h4>
        <p>{{{ $publication->content }}}</p>
      </article>
    @endforeach
  @endif
</div>
