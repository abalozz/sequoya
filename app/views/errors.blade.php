@if ($errors->any())
  @foreach ($errors->all() as $error)
    <div class="alert-box alert" data-alert>
      {{ $error }}
      <a href="#" class="close">&times;</a>
    </div>
  @endforeach
@endif
