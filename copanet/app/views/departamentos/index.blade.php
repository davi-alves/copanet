@extends('layouts.admin.master')

@section('content')
  @include('departamentos._partials.menu')
  <table class="table">
    <thead>
      <tr>
        <th width="50%">Nome do Departamento</th>
        <th width="5%">Gols</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tbody>
        @if($entities)
          @foreach($entities as $entity)
            <tr>
              <td>{{ $entity->nome }}</td>
              <td>
                {{ link_to_route('admin.departamento.gols', " $entity->gols",
                  array('departamento' => $entity->id), array('class' => 'btn btn-edit-gols', 'onclick' => 'return false;')) }}
              </td>
              <td>
                <a class="btn btn-info btn-edit"  onclick="return false;"
                  href="{{ route('admin.departamento.edit', array('departamento' => $entity->id)) }}">
                    <i class="icon-edit icon-white"></i>
                    Editar
                </a>
                <a class="btn btn-danger btn-remove"  onclick="return false;"
                   href="{{ route('admin.departamento.destroy', array('departamento' => $entity->id)) }}">
                    <i class="icon-trash icon-white"></i>
                    Deletar
                </a>
              </td>
            </tr>
          @endforeach
        @else
          <tr>
            <td colspan="3">Nenhum departamento cadastrado.</td>
          </tr>
        @endif
    </tbody>
  </table>
@stop

@section('javascript')
  @parent
  <!--<script>
    Index.modules = ['admin/manage'];
  </script>
  {{ HTML::script('assets/js/require.min.js', array('data-main' => url('assets/js/backend'))) }}-->
  {{ HTML::script('assets/js/admin/scripts.min.js') }}
@stop
