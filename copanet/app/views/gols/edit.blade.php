<div class="span5">
  {{ Form::open(array('route' => 'admin.gol.store', 'class' => 'form-horizontal modal-form')) }}
    <div class="item">
      <div class="control-group">
        {{ Form::label('departamento_id', 'Departamento', array('class' => 'control-label')) }}

        <div class="controls">
          <?php $departamento = $artilheiro->time->departamento ?>
          {{ Form::select('departamento_id', array($departamento->id => $departamento->nome),
            $departamento->id, array( 'class' => 'input-xlarge departamento-select')) }}
        </div>
      </div>
      <div class="control-group">
        {{ Form::label('time_id', 'Time', array('class' => 'control-label')) }}

        <div class="controls">
          <?php $time = $artilheiro->time ?>
          {{ Form::select('time_id', array($time->id => $time->nome), $time->id,
             array( 'class' => 'input-xlarge time-select combobox')) }}
        </div>
      </div>
      <div class="control-group">
        {{ Form::label('artilheiro_id', 'Artilheiro', array('class' => 'control-label')) }}

        <div class="controls">
          {{ Form::select('artilheiro_id', array($artilheiro->id => $artilheiro->nome),
            $artilheiro->id, array( 'class' => 'input-xlarge artilheiro-select combobox')) }}
        </div>
      </div>
      <div class="control-group">
        {{ Form::label('gols', 'Gol', array('class' => 'control-label')) }}

        <div class="controls">
          {{ Form::text('gols', null, array( 'class' => 'input-small gols', 'placeholder' => 'ex.: -1, 1, 10')) }}
          <small class="help-block">Os gols serão adicionados/subtraidos do total de gols do Artilheiro.</small>
        </div>
      </div>
    </div>
  {{ Form::close() }}
</div>
