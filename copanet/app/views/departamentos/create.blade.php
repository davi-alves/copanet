<div class="span5">
  {{ Form::open(array('route' => 'admin.departamento.store', 'class' => 'form-horizontal modal-form')) }}
    <div class="item">
      <div class="control-group">
        {{ Form::label('nome', 'Nome', array('class' => 'control-label')) }}

        <div class="controls">
          {{ Form::text('nome', '', array( 'class' => 'input-xlarge')) }}
        </div>
      </div>
    </div>
  {{ Form::close() }}
</div>
