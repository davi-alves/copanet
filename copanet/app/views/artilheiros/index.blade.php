@extends('layouts.admin.master')

@section('content')
  @include('artilheiros._partials.menu')
  <select name="time" class="time-select">
    <option value="0" data-url="{{ route('admin.artilheiro.time', 0) }}">Selecione</option>
    @foreach($times as $departamento => $time)
      <optgroup label="{{ $departamento }}">
        @foreach($time as $key => $nome)
          <option value="{{ $key }}" data-url="{{ route('admin.artilheiro.time', $key) }}">
            {{ $nome }}
          </option>
        @endforeach
      </optgroup>
    @endforeach
  </select>
  <table class="table">
    <thead>
      <tr>
        <th width="40%">Nome</th>
        <th width="30%">Time</th>
        <th width="5%">Gols</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tbody class="table-tbody">
        @if($entities->count() > 0)
          @foreach($entities as $entity)
            @include('artilheiros._partials.table_row')
          @endforeach
        @else
          <tr>
            <td colspan="4">Nenhum artilheiro cadastrado.</td>
          </tr>
        @endif
    </tbody>
  </table>
@stop

@section('javascript')
  @parent
  <!--<script>
    Index.modules = ['admin/artilheiros/manage', 'admin/gols/manage'];
  </script>
  {{ HTML::script('assets/js/require.min.js', array('data-main' => url('assets/js/backend'))) }}-->

  {{ HTML::script('assets/js/admin/scripts.min.js') }}
@stop
