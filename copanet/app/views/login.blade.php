<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <title>Laravel Study - Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
   {{ HTML::style('assets/bootstrap/css/bootstrap.min.css')}}
    <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }

    </style>
    {{ HTML::style('assets/bootstrap/css/bootstrap-responsive.min.css') }}

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">

      {{ Form::open(array('route' => 'login', 'class' => 'form-signin'))}}
        <h2 class="form-signin-heading">Login</h2>
        @if($errors->any())
          <div class="alert alert-error">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>Ops!</strong> {{ $errors->first('login') }}
          </div>
        @endif
        {{ Form::text('username', null, array( 'placeholder' => 'Usuário', 'class' => 'input-block-level')) }}
        {{ Form::password('password', array( 'placeholder' => 'Senha', 'class' => 'input-block-level')) }}
        {{ Form::button('Entrar', array('type' => 'submit', 'class' => 'btn btn-large btn-primary')) }}
      {{ Form::close() }}

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="http://code.jquery.com/jquery.js"></script>
    {{ HTML::script('assets/bootstrap/js/bootstrap.min.js') }}

  </body>
</html>
