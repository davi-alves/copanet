<div class="span5">
  {{ Form::open(array('route' => 'admin.time.store', 'class' => 'form-horizontal modal-form')) }}
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
          {{ Form::text('nome', '', array( 'class' => 'input-xlarge')) }}
        </div>
      </div>
    </div>
  {{ Form::close() }}
</div>
