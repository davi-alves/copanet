@extends('layouts.admin.master')

@section('content')
  @include('artilheiros._partials.menu')
  <select name="time" class="time-select">
    @foreach($times as $key => $nome)
      <option value="{{ $key }}" data-url="{{ route('admin.artilheiro.time', $key) }}">
        {{ $nome }}
      </option>
    @endforeach
  </select>
  <table class="table">
    <thead>
      <tr>
        <th width="40%">Nome</th>
        <th width="40%">Time</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tbody class="table-tbody">
        @if($entities)
          @foreach($entities as $entity)
            @include('artilheiros._partials.table_row')
          @endforeach
        @else
          <tr>
            <td colspan="3">Nenhum artilheiro cadastrado.</td>
          </tr>
        @endif
    </tbody>
  </table>
@stop

@section('javascript')
  @parent
  <script>
    Index.modules = ['admin/artilheiros/manage'];
  </script>
  {{ HTML::script('assets/js/require.min.js', array('data-main' => url('assets/js/backend'))) }}
@stop
