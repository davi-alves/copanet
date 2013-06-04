@extends('layouts.backend.master')

@section('content')
  {{ Form::model($entity, array('route' => array('admin.posts.update', $entity->id),
        'method' => 'PUT', 'class' => 'form-horizontal')) }}
    <div class="control-group">
      {{ Form::label('titulo', 'Título', array('class' => 'control-label')) }}
      <div class="controls">
        {{ Form::text('titulo') }}
      </div>
    </div>
    <div class="control-group">
      {{ Form::label('resenha', 'Resenha', array('class' => 'control-label')) }}
      <div class="controls">
        {{ Form::textarea('resenha', null, array('rows' => 3)) }}
      </div>
    </div>
    <div class="form-actions">
      {{ Form::button('Salvar', array('type' => 'submit', 'class' => 'btn btn-primary')) }}
      <a href="{{ route('admin.posts.index') }}" class="btn">Cancelar</a>
    </div>
  {{ Form::close() }}
@stop
