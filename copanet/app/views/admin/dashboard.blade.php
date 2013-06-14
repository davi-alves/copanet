@extends('layouts.admin.master')

@section('content')
@stop

@section('javascript')
  @parent
  <!--<script>
    Index.modules = ['admin/gols/manage'];
  </script>
  {{ HTML::script('assets/js/require.min.js', array('data-main' => url('assets/js/backend'))) }}-->

  {{ HTML::script('assets/js/admin/scripts.min.js') }}
@stop
