<div class="span5">
  {{ Form::open(array('route' => $route, 'class' => 'form-horizontal modal-form')) }}
    <div class="item">
      <div class="control-group">
        {{ Form::label('gols', 'Gol', array('class' => 'control-label')) }}

        <div class="controls">
          {{ Form::text('gols', $entity->gols, array( 'class' => 'input-small gols')) }}
        </div>
      </div>
    </div>
  {{ Form::close() }}
</div>
