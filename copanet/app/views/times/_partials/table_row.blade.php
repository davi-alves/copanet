<tr>
  <td>{{ $entity->nome }}</td>
  <td>{{ $entity->departamento->nome }}</td>
  <td>
    {{ link_to_route('admin.time.gols', " $entity->gols",
      array('time' => $entity->id), array('class' => 'btn btn-edit-gols', 'onclick' => 'return false;')) }}
  </td>
  <td>
    <a class="btn btn-info btn-edit"  onclick="return false;"
      href="{{ route('admin.time.edit', array('time' => $entity->id)) }}">
        <i class="icon-edit icon-white"></i>
        Editar
    </a>
    <a class="btn btn-danger btn-remove"  onclick="return false;"
       href="{{ route('admin.time.destroy', array('time' => $entity->id)) }}">
        <i class="icon-trash icon-white"></i>
        Deletar
    </a>
  </td>
</tr>
