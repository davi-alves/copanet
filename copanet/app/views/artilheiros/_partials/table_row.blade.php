<tr>
  <td>{{ $entity->nome }}</td>
  <td>{{ ($entity->time) ? $entity->time->nome : 'Sem Time' }}</td>
  <td>{{ ($entity->artilheiro) ? 'Sim' : 'Não' }}</td>
  <td>
    {{ link_to_route('admin.artilheiro.gols', " $entity->gols",
      array('artilheiro' => $entity->id), array('class' => 'btn btn-edit-gols', 'onclick' => 'return false;')) }}
  </td>
  <td>
    <a class="btn btn-info btn-edit" onclick="return false;"
      href="{{ route('admin.artilheiro.edit', array('artilheiro' => $entity->id)) }}">
        <i class="icon-edit icon-white"></i>
        Editar
    </a>
    <a class="btn btn-danger btn-remove" onclick="return false;"
       href="{{ route('admin.artilheiro.destroy', array('artilheiro' => $entity->id)) }}">
        <i class="icon-trash icon-white"></i>
        Deletar
    </a>
  </td>
</tr>
