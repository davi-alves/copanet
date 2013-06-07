<option value="">Selecione</option>
@foreach($entities as $entity)
  <option value="{{ $entity->id }}"
    @if(isset($route)) data-url="{{ route($route, $entity->id) }}" @endif>
    {{ $entity->nome }}
  </option>
@endforeach
