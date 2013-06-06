<div class="span5">
    {{ Form::open(array('route' => 'admin.artilheiro.foto', 'class' => 'form-horizontal crop-form',
        'files' => true, 'style' => 'margin:0;')) }}
        <input type="hidden" name="ajaxAction" value="crop">
        <input type="hidden" name="image" value="{{ $path }}">
        <input type="hidden" name="width" value="{{ $image->width }}">
        <input type="hidden" name="height" value="{{ $image->height }}">
        <input type="hidden" class="x_d" name="x_d"/>
        <input type="hidden" class="y_d" name="y_d"/>
        <input type="hidden" class="w_sel" name="w_sel"/>
        <input type="hidden" class="h_sel" name="h_sel"/>
        <input type="hidden" class="max_height" name="max_height"/>
        <input type="hidden" class="max_width" name="max_width"/>

        <!--    jCrop    -->
        <input type="hidden" name="">

        <img src="{{ url($url) }}" class="jcrop-image">
    {{ Form::close() }}
</div>
