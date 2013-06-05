@if( $errors->any())
  @foreach($errors->all() as $error)
    <div class="alert alert-error">
      <button type="button" class="close" data-dismiss="alert">×</button>
      <strong>Erro!</strong> {{ $error }}.
    </div>
  @endforeach
@endif
