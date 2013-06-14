require.config({
    paths: {
        'jquery': 'libs/jquery-1.10.0.min',
        'jquery.migrate': 'libs/jquery-migrate-1.2.1.min',
        'jquery.ui': 'libs/jquery-ui.1.10.3.min',
        'jquery.ui.widget': 'libs/jquery-ui/ui/minified/jquery.ui.widget.min',
        'jquery.jcrop': 'libs/jcrop/jquery.Jcrop.min',
        'fancybox': 'libs/fancybox2/jquery.fancybox.pack',
        'bootstrap': '../bootstrap/js/bootstrap.min',
        'blockUI': 'libs/jquery.blockUI.min',
        'form': 'libs/jquery.form.min',
        'fileupload': 'libs/blueimp-jQuery-File-Upload/js/jquery.fileupload',
        'fileupload-ip': 'libs/blueimp-jQuery-File-Upload/js/jquery.fileupload-ip',
        'fileupload-ui': 'libs/blueimp-jQuery-File-Upload/js/jquery.fileupload-ui',
        'holder': 'libs/holder/holder',
        'index': 'index',
        'admin.manage': 'admin/base/manage'
    },
    shim: {
        'jquery.migrate': ['jquery'],
        'jquery.ui': ['jquery'],
        'jquery.ui.widget': ['jquery', 'jquery.ui'],
        'jquery.jcrop': ['jquery'],
        'fancybox': ['jquery'],
        'bootstrap': ['jquery.ui'],
        'blockUI': ['jquery'],
        'form': ['jquery'],
        'index': ['blockUI', 'bootstrap'],
        'fileupload': ['jquery.ui', 'jquery.ui.widget'],
        'fileupload-ip': ['jquery.ui', 'fileupload'],
        'fileupload-ui': ['jquery.ui', 'fileupload'],
        'holder': {
            exports: 'Holder'
        }
    }
});

require(['admin/artilheiros/artilheiros', 'admin/times/times']);
