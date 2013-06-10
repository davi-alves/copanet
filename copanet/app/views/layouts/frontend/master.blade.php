<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="description" content="">
    <meta name="author" content="Index Comunicação Digital / www.indexdigital.com.br">
    <meta name="viewport" content="width=device-width">

    <!-- FAVICONS -->
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="apple-touch-icon-57-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="apple-touch-icon-precomposed.png">
    <!-- FAVICONS -->

    <title>Copanet</title>

    {{ HTML::style('assets/css/frontend/style.min.css') }}
    {{ HTML::script('assets/js/libs/modernizr.custom.86827.js') }}

</head>

<body>
    <!--[if lt IE 7]>
        <p class="chromeframe">Você está usando um navegador desatualizado. <a href="http://browsehappy.com/">Atualize agora mesmo</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> para ter uma melhor performance.</p>
    <![endif]-->
        <header>
            <div class="container">
                <h1 class="pull-left"><a href="#" title="Copanet">
                    <img src="{{ url('assets/css/frontend/img/logocopanet.png') }}" alt=""/>
                </a></h1>
                <p class="pull-right">Seja o artilheiro e ganhe um prêmio especial!</p>
            </div>
        </header>

        <div id="main" role="main">
            @yield('content')
        </div><!-- MAIN -->

        <footer>
            <div class="container">
                <a class="pull-left" href="http://www.netfortaleza.com.br/" title="net"><img src="{{ url('assets/css/frontend/img/net.gif') }}" alt="net"/></a>
                <p class="pull-right">Marketing  - NET Fortaleza - 85 2181 1011 <a href="mailto:henrique.nobre@netfortaleza.com.br"> henrique.nobre@netfortaleza.com.br</a> </p>
            </div>
        </footer>

        @section('javascript')
            {{ HTML::script('assets/js/require.min.js', array('data-main' => 'assets/js/frontend')) }}
        @show
</body>
</html>
