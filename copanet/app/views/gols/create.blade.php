<div class="span5">
  {{ Form::open(array('route' => 'admin.gol.store', 'class' => 'form-horizontal modal-form')) }}
    <div class="item">
      <div class="control-group">
        {{ Form::label('departamento_id', 'Departamento', array('class' => 'control-label')) }}

        <div class="controls">
          <select name="departamento_id" id="departamento_id" class="input-xlarge departamento-select">
            <option value="">Selecione</option>
            <?php $i = 0; ?>
            @foreach($departamentos as $departamento)
              <option value="{{ $departamento->id }}"
                data-url="{{ route('admin.gol.times', $departamento->id) }}">
                {{ $departamento->nome }}
              </option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="control-group">
        {{ Form::label('time_id', 'Time', array('class' => 'control-label')) }}

        <div class="controls">
          <select name="time_id" id="time_id" class="input-xlarge time-select combobox">
          </select>
        </div>
      </div>
      <div class="control-group">
        {{ Form::label('artilheiro_id', 'Artilheiro', array('class' => 'control-label')) }}

        <div class="controls">
          <select name="artilheiro_id" id="artilheiro_id" class="input-xlarge artilheiro-select combobox">
          </select>
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
<script>
  var Index = Index || {};
</script>
