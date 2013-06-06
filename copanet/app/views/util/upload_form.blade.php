{{ Form::open(array('route' => 'admin.artilheiro.foto', 'id' => 'fileupload-form',
  'files' => true, 'style' => 'margin:0;')) }}
    <input type="hidden" name="ajaxAction" value="upload">
    {{ Form::file('image', array('id' => 'fileupload-input', 'style' => 'display: none;')) }}
{{ Form::close() }}
