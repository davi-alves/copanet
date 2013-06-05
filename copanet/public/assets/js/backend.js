//- require bootstrap

require.config({
  paths: {
    'use': 'libs/use.min',
    'jquery': 'http://code.jquery.com/jquery-1.10.0.min',
    'jquery.migrate': 'http://code.jquery.com/jquery-migrate-1.2.1.min',
    'jquery.ui': 'http://code.jquery.com/ui/1.10.3/jquery-ui.min',
    'jquery.ui.widget': 'libs/jquery-ui/ui/minified/jquery.ui.widget.min',
    'bootstrap': '../bootstrap/js/bootstrap.min',
    'blockUI': 'libs/jquery.blockUI.min',
    'form': 'libs/jquery.form.min',
    'fancybox': 'libs/fancybox2/jquery.fancybox.pack',
    'fileupload': 'libs/blueimp-jQuery-File-Upload/js/jquery.fileupload',
    'fileupload-ip': 'libs/blueimp-jQuery-File-Upload/js/jquery.fileupload-ip',
    'fileupload-ui': 'libs/blueimp-jQuery-File-Upload/js/jquery.fileupload-ui',
    'index': 'index'
    // 'bootstrap': 'assets/libs/',
  },
  shim: {
    'jquery.migrate': ['jquery'],
    'jquery.ui': ['jquery'],
    'jquery.ui.widget': ['jquery', 'jquery.ui'],
    'bootstrap': ['jquery.ui'],
    'fancybox': ['jquery'],
    'blockUI': ['jquery'],
    'form': ['jquery'],
    'index': ['blockUI', 'bootstrap'],
    'fileupload': ['jquery.ui', 'jquery.ui.widget'],
    'fileupload-ip': ['jquery.ui','fileupload'],
    'fileupload-ui': ['jquery.ui','fileupload']

  },
  urlArgs: (new Date()).getTime()
});

require(Index.modules, function(){});
