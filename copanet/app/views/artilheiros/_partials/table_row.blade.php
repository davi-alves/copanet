<tr>
  <td>{{ $entity->nome }}</td>
  <td>{{ $entity->time->nome }}</td>
  <td>
    <a class="btn btn-info btn-edit"
      href="{{ route('admin.artilheiro.edit', array('artilheiro' => $entity->id)) }}">
        <i class="icon-edit icon-white"></i>
        Editar
    </a>
    <a class="btn btn-danger btn-remove"
       href="{{ route('admin.artilheiro.destroy', array('artilheiro' => $entity->id)) }}">
        <i class="icon-trash icon-white"></i>
        Deletar
    </a>
  </td>
</tr>
