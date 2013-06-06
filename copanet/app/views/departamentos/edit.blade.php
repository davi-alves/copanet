<div class="span5">
  {{ Form::model($entity, array('route' => array('admin.departamento.update', $entity->id),
    'method' => 'put', 'class' => 'form-horizontal modal-form')) }}
    <div class="item">
      <div class="control-group">
        {{ Form::label('nome', 'Nome', array('class' => 'control-label')) }}

        <div class="controls">
          {{ Form::text('nome', null, array( 'class' => 'input-xlarge')) }}
        </div>
      </div>
    </div>
  {{ Form::close() }}
</div>
