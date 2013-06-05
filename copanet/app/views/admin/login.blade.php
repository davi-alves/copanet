<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Copanet - Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Davi Alves">

  <!-- Le styles -->
  {{ HTML::style('assets/bootstrap/css/bootstrap.min.css', array('id' => 'main-theme-script'))}}
  {{ HTML::style('assets/css/admin/themes/default.css', array('id' => 'theme-specific-script'))}}
  {{ HTML::style('assets/bootstrap/css/bootstrap-responsive.min.css') }}
  {{ HTML::style('assets/css/admin/simplenso.css') }}

  <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
  <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
  <style>
    .box h4.box-header { cursor: pointer; }
  </style>
</head>

<body>
  <!-- Main Content Area | Side Nav | Content -->
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span4">&nbsp;</div>
      <div class="span4">
        <div class="page-header">
          <h1>Copanet</h1>
        </div>
        <div class="box" style="margin-bottom:500px;">
          <h4 class="box-header round-top">Login</h4>

          <div class="box-container-toggle">
            <div class="box-content">

              {{ Form::open(array('route' => 'login', 'class' => 'well form-search'))}}
                {{ Form::text('username', null, array( 'placeholder' => 'Usuário', 'class' => 'input-small')) }}
                {{ Form::password('password', array( 'placeholder' => 'Senha', 'class' => 'input-small')) }}

                {{ Form::button('Entrar', array('type' => 'submit', 'class' => 'btn btn-primary')) }}
              {{ Form::close() }}
            </div>
          </div>
        </div>
        <!--/span-->
        <div class="span4">&nbsp;</div>
      </div>
      <!--/span-->
    </div>
    <!--/row-->

    <footer>
      <p class="pull-right">&copy; <a href="http://www.indexdigital.com.br">Index Comunicação Digital</a> 2013</p>
    </footer>
  </div>

  <!-- Le javascript
  ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  {{ HTML::script('http://code.jquery.com/jquery.js') }}
  {{ HTML::script('assets/bootstrap/js/bootstrap.min.js') }}

</body>
</html>
