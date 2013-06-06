//- require bootstrap

require.config({
  paths: {
    'use': 'libs/use.min',
    'jquery': 'libs/jquery-1.10.0.min',
    'jquery.migrate': 'libs/jquery-migrate-1.2.1.min',
    'jquery.ui': 'libs/jquery-ui.1.10.3.min',
    'jquery.ui.widget': 'libs/jquery-ui/ui/minified/jquery.ui.widget.min',
    'jquery.jcrop': 'libs/jcrop/jquery.Jcrop.min',
    'bootstrap': '../bootstrap/js/bootstrap.min',
    'blockUI': 'libs/jquery.blockUI.min',
    'form': 'libs/jquery.form.min',
    'fancybox': 'libs/fancybox2/jquery.fancybox.pack',
    'fileupload': 'libs/blueimp-jQuery-File-Upload/js/jquery.fileupload',
    'fileupload-ip': 'libs/blueimp-jQuery-File-Upload/js/jquery.fileupload-ip',
    'fileupload-ui': 'libs/blueimp-jQuery-File-Upload/js/jquery.fileupload-ui',
    'holder': 'libs/holder/holder',
    'index': 'index'
    // 'bootstrap': 'assets/libs/',
  },
  shim: {
    'jquery.migrate': ['jquery'],
    'jquery.ui': ['jquery'],
    'jquery.ui.widget': ['jquery', 'jquery.ui'],
    'jquery.jcrop': ['jquery'],
    'bootstrap': ['jquery.ui'],
    'fancybox': ['jquery'],
    'blockUI': ['jquery'],
    'form': ['jquery'],
    'index': ['blockUI', 'bootstrap'],
    'fileupload': ['jquery.ui', 'jquery.ui.widget'],
    'fileupload-ip': ['jquery.ui','fileupload'],
    'fileupload-ui': ['jquery.ui','fileupload'],
    'holder': {
        exports: 'Holder'
    }
  },
  urlArgs: (new Date()).getTime()
});

require(Index.modules, function(){});
