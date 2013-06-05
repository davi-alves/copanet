//- require bootstrap

require.config({
  paths: {
    'use': 'assets/js/use',
    'jquery': 'http://code.jquery.com/jquery-1.10.0.min',
    'bootstrap': 'assets/bootstrap/js/bootstrap.min'
  }
});

require(['jquery'], function () {
  // body...
});
