<div class="span5">
  {{ Form::open(array('route' => array('admin.gol.update', $artilheiro->id), 'class' => 'form-horizontal modal-form')) }}
    <div class="item">
      <div class="control-group">
        {{ Form::label('departamento_id', 'Departamento', array('class' => 'control-label')) }}

        <div class="controls">
          {{ Form::select('departamento_id', $departamentos, $artilheiro->time->departamento->id, array( 'class' => 'input-xlarge')) }}
        </div>
      </div>
      <div class="control-group">
        {{ Form::label('time_id', 'Time', array('class' => 'control-label')) }}

        <div class="controls">
          {{ Form::select('time_id', $times, $artilheiro->time->id, array( 'class' => 'input-xlarge')) }}
        </div>
      </div>
      <div class="control-group">
        {{ Form::label('artilheiro_id', 'Artilheiro', array('class' => 'control-label')) }}

        <div class="controls">
          {{ Form::select('artilheiro_id', $artilheiros, $artilheiro->id, array( 'class' => 'input-xlarge')) }}
        </div>
      </div>
      <div class="control-group">
        {{ Form::label('gols', 'Gol', array('class' => 'control-label')) }}

        <div class="controls">
          {{ Form::text('gols', $gols->gols, array( 'class' => 'input-xlarge')) }}
        </div>
      </div>
    </div>
  {{ Form::close() }}
</div>
