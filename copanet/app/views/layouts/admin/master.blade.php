<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <title>Copanet - Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Davi Alves">

  <!-- Le styles -->
  {{ HTML::style('assets/bootstrap/css/bootstrap.min.css', array('id' => 'main-theme-script'))}}
  {{ HTML::style('assets/css/admin/themes/default.css', array('id' => 'theme-specific-script'))}}
  {{ HTML::style('assets/bootstrap/css/bootstrap-responsive.min.css') }}
  {{ HTML::style('assets/js/libs/fullcalendar/fullcalendar/fullcalendar.css') }}
  {{ HTML::style('assets/js/libs/datepicker/css/datepicker.css') }}
  {{ HTML::style('assets/js/libs/blueimp-jQuery-File-Upload/css/jquery.fileupload-ui.css') }}
  {{ HTML::style('http://blueimp.github.com/Bootstrap-Image-Gallery/css/bootstrap-image-gallery.min.css') }}
  {{ HTML::style('assets/js/libs/uniform/css/uniform.default.css', array('media' => 'screen,projection')) }}
  {{ HTML::style('assets/js/libs/chosen/chosen/chosen.intenso.css') }}
  {{ HTML::style('assets/js/libs/jcrop/jquery.Jcrop.min.css') }}
  {{ HTML::style('assets/js/libs/fancybox2/jquery.fancybox.css') }}
  {{ HTML::style('assets/css/admin/simplenso.css') }}
  {{ HTML::style('assets/css/admin/custom.css') }}

  <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
  <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
  <style>
    /* Sticky footer styles
      -------------------------------------------------- */

      html,
      body {
        height: 93%;
        /* The html and body elements cannot have any padding or margin. */
      }
      body { padding: 0;}

      /* Wrapper for page content to push down footer */
      #wrap {
        margin: 60px 0 0 0px;
        min-height: 100%;
        height: auto !important;
        height: 100%;
      }

      /* Set the fixed height of the footer here */
      #push,
      #footer {
        height: 66px;
      }
      #footer {
        background-color: #F5F5F5;
      }

      /* Lastly, apply responsive CSS fixes as necessary */
      @media (max-width: 767px) {
        #footer {
          margin-left: -20px;
          margin-right: -20px;
          padding-left: 20px;
          padding-right: 20px;
        }
      }
  </style>
</head>
<body>
  <div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container-fluid">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            {{ link_to_route('home', 'Copanet', null, array('class' => 'brand', 'target' => '_blank')) }}

            <div class="btn-group pull-right">
                <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="icon-user"></i> {{ Auth::user()->nome }}
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <!-- <li class="divider"></li>-->
                    <li>{{ link_to_route('logout', 'Logout') }}</li>
                </ul>
            </div>

            <div class="nav-collapse">
                <ul class="nav">
                    <li class="active">
                      {{ link_to_route('dashboard', 'Admin') }}
                    </li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
  </div>

  <div class="container-fluid" id="wrap">

    <div class="row-fluid">

          @include('admin._partials.menu')

          <div class="span10" style="width: 60%;">
            <h2>{{ isset($title) ? $title : 'Admin'}}</h2>
            @include('admin._partials.errors')
            @yield('content')
          </div>

      </div>
  </div> <!-- /container -->

  <div class="container-fluid" id="footer">
    <hr>
    <footer>
        <p>&copy; <a href="http://www.indexdigital.com.br">Index Comunicação Digital</a> 2013</p>
    </footer>
  </div>

  @section('javascript')
    <script>
      var Index = Index || {};
      Index.baseUrl = '{{ url('/') }}';
    </script>
  @show
</body>
</html>
