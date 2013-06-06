@extends('layouts.admin.master')

@section('content')
  @include('times._partials.menu')
  <select name="departamento" class="departamento-select">
    @foreach($departamentos as $key => $nome)
      <option value="{{ $key }}" data-url="{{ route('admin.time.departamento', $key) }}">
        {{ $nome }}
      </option>
    @endforeach
  </select>
  <table class="table">
    <thead>
      <tr>
        <th width="40%">Nome do Time</th>
        <th width="40%">Departamento</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tbody class="table-tbody">
        @if($entities)
          @foreach($entities as $entity)
            @include('times._partials.table_row')
          @endforeach
        @else
          <tr>
            <td colspan="3">Nenhum time cadastrado.</td>
          </tr>
        @endif
    </tbody>
  </table>
@stop

@section('javascript')
  @parent
  <script>
    Index.modules = ['admin/times/manage'];
  </script>
  {{ HTML::script('assets/js/require.min.js', array('data-main' => url('assets/js/backend'))) }}
@stop
