  @if ($errors->any())
    <div>
      <p>Hay algunos errores en el formulario</p>
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
