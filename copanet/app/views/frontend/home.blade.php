@extends('layouts.frontend.master')

@section('content')
<div class="row-fluid">
    <div class="container">
        <p class="descricao">As equipes vencedoras ganharão A CAFUSA! A Bola da Copa da Confederações!</p>

        <!-- Departamentos -->
        <div class="departamentos-times span12">
            @if($departamentos && $departamentos->count() > 0)
                <?php $i = 0; ?>
                @foreach($departamentos as $departamento)
                    <?php $artilheiro = Artilheiro::getArtilheiroFromDepartamento($departamento->id) ?>
                    <?php $i++ ?>
                    <div class="box span6 @if($i != 0 && $i % 2 != 0) nomg @endif">

                        @if($artilheiro)
                            <!-- Artilheiro -->
                            <div class="artilheiro">
                                <p>artilheiro da vez</p>
                                <p class="name">{{ $artilheiro->nome }} <span>{{ $artilheiro->gols }} gols</span></p>
                                @if($artilheiro->foto)
                                    <?php $foto = Resize::make($artilheiro->foto, 82, 83) ?>
                                    <div class="img pull-right"><img class="img-circle" src="{{ url($foto) }}" alt="scarlett"/></div>
                                @endif
                            </div> <!-- /Artilheiro -->
                        @endif

                        <!-- Departamento -->
                        <div class="departamento">
                            <div class="gols">
                                <p><strong>{{ $departamento->gols }}</strong>gols</p>
                                <div class="carret"></div>
                            </div>
                            <p>{{ $departamento->nome }}</p>
                        </div><!-- /Departamento -->

                        <!-- Times -->
                        <?php $times = Time::getTimesByDepartamento($departamento->id) ?>
                        @if(!empty($times))
                            <div class="times">
                                <ul>
                                    @foreach($times as $time)
                                        <li>
                                            <p>{{ $time->nome}} <span>{{ (int) $time->gols }} gols</span></p>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif<!-- /Times -->

                    </div>

                    @if($i != 0 && $i % 2 == 0) <div class="clearfix"></div> @endif

                @endforeach
            @endif
        </div><!-- /Departamentos -->

    </div>
</div>
@stop

@section('javascript')
  @parent

@stop
