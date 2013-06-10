@extends('layouts.admin.master')

@section('content')
  <br><br>
  {{ link_to_route('admin.gol.create', '&nbsp;&nbsp;&nbsp;&nbsp;Gols!&nbsp;&nbsp;&nbsp;&nbsp;',
    null, array('class' => 'btn-add-gols btn btn-large btn-success', 'onclick' => 'return false;')) }}
@stop

@section('javascript')
  @parent
  <!--<script>
    Index.modules = ['admin/gols/manage'];
  </script>
  {{ HTML::script('assets/js/require.min.js', array('data-main' => url('assets/js/backend'))) }}-->

  {{ HTML::script('assets/js/admin/scripts.min.js') }}
@stop
