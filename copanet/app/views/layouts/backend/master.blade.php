<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Laravel Study</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Le styles -->
  <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css')}}">

  <style type="text/css">

    /* Sticky footer styles
    -------------------------------------------------- */

    html,
    body {
      height: 100%;
      /* The html and body elements cannot have any padding or margin. */
    }

    /* Wrapper for page content to push down footer */
    #wrap {
      min-height: 100%;
      height: auto !important;
      height: 100%;
      /* Negative indent footer by it's height */
      margin: 0 auto -60px;
    }

    /* Set the fixed height of the footer here */
    #push,
    #footer {
      height: 60px;
    }
    #footer {
      background-color: #f5f5f5;
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



    /* Custom page CSS
    -------------------------------------------------- */
    /* Not required for template or sticky footer method. */

    .container {
      width: auto;
      max-width: 680px;
    }
    .container .credit {
      margin: 20px 0;
    }

    </style>
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap-responsive.min.css')}}">
  </head>
  <body>
    <!-- Part 1: Wrap all page content here -->
    <div id="wrap">

      <!-- Begin page content -->
      <div class="container">
        <div class="page-header">
          <h1>{{ isset($title) ? $title : ''}}</h1>
        </div>
        @include('_partials.errors')
        @yield('content')
      </div>

      <div id="push"></div>
    </div>

    <div id="footer">
      <div class="container">
        <p class="muted credit">Example courtesy <a href="http://martinbean.co.uk">Martin Bean</a> and <a href="http://ryanfait.com/sticky-footer/">Ryan Fait</a>.</p>
      </div>
    </div>
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
</body>
</html>
