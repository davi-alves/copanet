@extends('layouts.frontend.master')

@section('content')
<div class="row-fluid">
    <div class="container">
        <p class="descricao">As equipes vencedoras ganharão A CAFUSA! A Bola da Copa da Confederações!</p>
        <div class="departamentos-times span12">
            <div class="box span6">
                <div class="artilheiro">
                    <p>artilheiro da vez</p>
                    <p class="name">Scarlett Johansson <span>119 gols</span></p>
                    <div class="img pull-right"><img class="img-circle" src="{{ url('assets/css/frontend/img/scarlett.gif') }}" alt="scarlett"/></div>
                </div>
                <div class="departamento">
                    <div class="gols">
                        <p><strong>500</strong>gols</p>
                        <div class="carret"></div>
                    </div>
                    <p>Departamento de vendas</p>
                </div>
                <div class="times">
                    <ul>
                        <li> <p>Time nome do time 1 <span>119 gols</span></p> </li>
                        <li> <p>Time nome do time 2 <span>119 gols</span></p> </li>
                        <li> <p>Time nome do time 3 <span>119 gols</span></p> </li>
                        <li> <p>Time nome do time 4 <span>119 gols</span></p> </li>
                        <li> <p>Time nome do time 5 <span>119 gols</span></p> </li>
                        <li> <p>Time nome do time 6 <span>119 gols</span></p> </li>
                        <li> <p>Time nome do time 7 <span>119 gols</span></p> </li>
                        <li> <p>Time nome do time 8 <span>119 gols</span></p> </li>
                        <li> <p>Time nome do time 9 <span>119 gols</span></p> </li>
                    </ul>
                </div>
            </div>
            <div class="box span6">
                <div class="artilheiro">
                    <p>artilheiro da vez</p>
                    <p class="name">Jessica Alba<span>100 gols</span></p>
                    <div class="img pull-right"><img class="img-circle" src="{{ url('assets/css/frontend/img/jessica.gif') }}" alt="jessica"/></div>
                </div>
                <div class="departamento">
                    <div class="gols">
                        <p><strong>500</strong>gols</p>
                        <div class="carret"></div>
                    </div>
                    <p>Atendimento</p>
                </div>
                <div class="times">
                    <ul>
                        <li> <p>Time nome do time 1 <span>119 gols</span></p> </li>
                        <li> <p>Time nome do time 2 <span>119 gols</span></p> </li>
                        <li> <p>Time nome do time 3 <span>119 gols</span></p> </li>
                        <li> <p>Time nome do time 4 <span>119 gols</span></p> </li>
                        <li> <p>Time nome do time 5 <span>119 gols</span></p> </li>
                        <li> <p>Time nome do time 6 <span>119 gols</span></p> </li>
                    </ul>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="box nomg span6">
                <div class="artilheiro">
                    <p>artilheiro da vez</p>
                    <p class="name">Tyler Durden<span>91 gols</span></p>
                    <div class="img pull-right"><img class="img-circle" src="{{ url('assets/css/frontend/img/tyler.gif') }}" alt="tyler"/></div>
                </div>
                <div class="departamento">
                    <div class="gols">
                        <p><strong>500</strong>gols</p>
                        <div class="carret"></div>
                    </div>
                    <p>Atendimento banda larga</p>
                </div>
                <div class="times">
                    <ul>
                        <li> <p>Time nome do time 1 <span>119 gols</span></p> </li>
                        <li> <p>Time nome do time 2 <span>119 gols</span></p> </li>
                        <li> <p>Time nome do time 3 <span>119 gols</span></p> </li>
                        <li> <p>Time nome do time 4 <span>119 gols</span></p> </li>
                        <li> <p>Time nome do time 5 <span>119 gols</span></p> </li>
                        <li> <p>Time nome do time 6 <span>119 gols</span></p> </li>
                    </ul>
                </div>
            </div>
            <div class="box span6">
                <div class="artilheiro">
                    <p>artilheiro da vez</p>
                    <p class="name">Tom Morello<span>91 gols</span></p>
                    <div class="img pull-right"><img class="img-circle" src="{{ url('assets/css/frontend/img/tom.gif') }}" alt="tom"/></div>
                </div>
                <div class="departamento">
                    <div class="gols">
                        <p><strong>500</strong>gols</p>
                        <div class="carret"></div>
                    </div>
                    <p>Retenção</p>
                </div>
                <div class="times">
                    <ul>
                        <li> <p>Time nome do time 1 <span>119 gols</span></p> </li>
                        <li> <p>Time nome do time 2 <span>119 gols</span></p> </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('javascript')
  @parent

@stop
