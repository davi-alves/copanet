@extends('layouts.admin.master')

@section('content')
  <br><br>
  {{ link_to_route('admin.gol.create', 'Adicionar Gols!', null, array('class' => 'btn-add btn btn-large btn-success')) }}
@stop

@section('javascript')
  @parent
  <script>
    Index.modules = ['admin/gols/manage'];
  </script>
  {{ HTML::script('assets/js/require.min.js', array('data-main' => url('assets/js/backend'))) }}
@stop
