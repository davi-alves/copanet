@foreach($entities as $entity)
  <option value="{{ $entity->id }}">{{ $entity->nome }}</option>
@endforeach
