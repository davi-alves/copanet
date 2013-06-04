@extends('layouts.backend.master')

@section('content')
  <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">Adicionar Novo</a>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>Título</th>
        <th>Postado em</th>
        <th>Atualizado em</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tbody>
      @if(empty($entities))
      <tr>
        <td colspan="4">Nenhum post cadastrado.</td>
      </tr>
      @else
        @foreach($entities as $entity)
        <tr>
          <td>{{ $entity->id }}</td>
          <td>{{ link_to_route('admin.posts.edit', $entity->titulo, array('posts' => $entity->id)) }}</td>
          <td>{{ $entity->created_at->format('d-m-Y H:i') }}</td>
          <td>{{ $entity->updated_at->format('d-m-Y H:i') }}</td>
          <td>{{ link_to_route('admin.posts.destroy', 'Delete', array('posts' => $entity->id), array('class' => 'delete-link')) }}</td>
        </tr>
        @endforeach
      @endif
    </tbody>
  </table>
@stop
