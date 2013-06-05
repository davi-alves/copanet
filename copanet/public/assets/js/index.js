/**
 * Created with JetBrains PhpStorm.
 * User: Davi
 * Date: 23/01/13
 * Time: 10:53
 * To change this template use File | Settings | File Templates.
 */
define(['jquery'], function() {
    var Index = Index || {}

    //- Block Ui
    Index.__uiBlock = false;
    Index.uiBlocker = function() {
      if (!Index.__uiBlock) {
        jQuery.blockUI({
          baseZ: 2000,
          css: {
            border: 'none',
            padding: '15px',
            backgroundColor: '#000',
            '-webkit-border-radius': '10px',
            '-moz-border-radius': '10px',
            opacity: .5,
            color: '#fff'
          },
          message: 'Aguarde...'
        });
        return Index.__uiBlock = true;
      } else {
        jQuery.unblockUI();
        return Index.__uiBlock = false;
      }
    };

    //- Modals
    Index.modals = Index.modals || {}

    Index.modals.widgetForm = '<div id="indexModalForm" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">' +
        '<div class="modal-header">' +
        '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>' +
        '<h3 id="modalLabel"></h3>' +
        '</div>' +
        '<div class="modal-body" id="modalBody"></div>' +
        '<div class="modal-footer">' +
        '<button class="btn btn-primary btn-save-widget" aria-hidden="true">Salvar</button>' +
        '<button class="btn btn-cancel" data-dismiss="modal" aria-hidden="true">Cancelar</button>' +
        '</div>' +
        '</div>';

    Index.modals.widgetFormLarge = '<div id="indexModalForm" class="modal hide fade modal-large" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">' +
        '<div class="modal-header">' +
        '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>' +
        '<h3 id="modalLabel"></h3>' +
        '</div>' +
        '<div class="modal-body" id="modalBody"></div>' +
        '<div class="modal-footer">' +
        '<button class="btn btn-primary btn-save-widget" aria-hidden="true">Salvar</button>' +
        '<button class="btn btn-cancel" data-dismiss="modal" aria-hidden="true">Cancelar</button>' +
        '</div>' +
        '</div>';

    Index.modals.confirm = '<div id="indexModalConfirm" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">' +
        '<div class="modal-header">' +
        '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>' +
        '<h3 id="modalLabel"></h3>' +
        '</div>' +
        '<div class="modal-body" id="modalBody"></div>' +
        '<div class="modal-footer">' +
        '<button class="btn btn-primary btn-confirm-modal" aria-hidden="true">Confirmar</button>' +
        '<button class="btn btn-cancel" data-dismiss="modal" aria-hidden="true">Cancelar</button>' +
        '</div>' +
        '</div>';

    Index.modals.widgetCrop = '<div id="indexModalCrop" class="modal hide fade modal-crop" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">' +
        '<div class="modal-header">' +
        '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>' +
        '<h3 id="modalLabel"></h3>' +
        '</div>' +
        '<div class="modal-body" id="modalBody"></div>' +
        '<div class="modal-footer">' +
        '<button class="btn btn-primary btn-save-crop" aria-hidden="true">Cortar</button>' +
        '<button class="btn btn-cancel-crop" aria-hidden="true">Cancelar</button>' +
        '</div>' +
        '</div>';

    Index.modals.showAlert = function (message, title) {
        if (!title) {
            title = 'Erro!';
        }
        var modal;
        modal = jQuery('<div id="indexModalAlert" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">' +
            '<div class="modal-header">' +
            '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>' +
            '<h3 id="modalLabel"></h3>' +
            '</div>' +
            '<div class="modal-body" id="modalBody"></div>' +
            '<div class="modal-footer">' +
            '<button class="btn btn-cancel" data-dismiss="modal" aria-hidden="true">Fechar</button>' +
            '</div>' +
            '</div>');
        jQuery('#modalLabel', modal).html('<h4>' + title + '</h4>');
        jQuery('#modalBody', modal).html('<h4>' + message + '</h4>');
        return jQuery(modal).modal();
    }

    return Index;
});
