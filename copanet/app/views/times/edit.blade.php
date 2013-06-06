<div class="span5">
  {{ Form::model($entity, array('route' => array('admin.time.update', $entity->id),
    'method' => 'put', 'class' => 'form-horizontal modal-form')) }}
    <div class="item">
      <div class="control-group">
        {{ Form::label('departamento', 'Departamento', array('class' => 'control-label')) }}

        <div class="controls">
          {{ Form::select('departamento_id', array_slice($departamentos, 1, null, true), null, array( 'class' => 'input-xlarge')) }}
        </div>
      </div>
      <div class="control-group">
        {{ Form::label('nome', 'Nome', array('class' => 'control-label')) }}

        <div class="controls">
          {{ Form::text('nome', null, array( 'class' => 'input-xlarge')) }}
        </div>
      </div>
    </div>
  {{ Form::close() }}
</div>
