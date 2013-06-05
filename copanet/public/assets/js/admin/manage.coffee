define ['jquery', 'index', 'jquery.migrate', 'fancybox', 'fileupload', 'form'], (jQuery, Index)->
  Index = Index || {}
  Index.Admin = ( (Admin) ->
    Admin.manage = ( ->
      #- modals
      __formModal = ''
      #- containers
      __formElement = 'form.modal-form'
      __itemClass = '.item'
      __fancyboxImage = '.image-fancybox'
      #- buttons
      __addButton = '.btn-add'
      __editButton = '.btn-edit'
      __deleteButton = '.btn-remove'
      __saveButton = '.btn-save-widget'
      __publishButtom = '.btn-generate'
      #- [widget form] File upload
      __fileUploadForm = '#fileupload-form'
      __fileUploadInput = '#fileupload-input'
      __fileUploadButton = '.fileinput-button'
      __fileUploadThumbnail = '.fileupload-thumbnail'
      __FileUploadHiddden = '.fileupload-hidden'
      __itemCurrent = ''
      #- crop
      __cropModal = ''
      __saveCropButton = '.btn-save-crop'
      __cancelCropButton = '.btn-cancel-crop'
      __cropForm = 'form.crop-form'
      __cropImage = 'img.jcrop-image'

      getForm = (target, action) ->
        jQuery.ajax(
          beforeSend: ->
            Index.uiBlocker()
          url: target.attr 'href'
          type: 'GET'
          dataType: 'html'
        ).done((data) ->
          return false if data == 'undefined' or data == ''

          modal = jQuery(Index.modals.widgetForm)
          jQuery(modal).find('#modalBody').html data
          jQuery(modal).find('#modalLabel').html if action == 'add' then 'Novo' else 'Editar'
          jQuery(modal).modal()
          __formModal = modal
          jQuery(__formModal).on 'hidden', ->
            jQuery(@).remove('.modal')

          _triggerFileUpload()
          _triggerAjaxForm()
        ).always(->
          Index.uiBlocker()
        )

      _triggerAjaxForm =  ->
        jQuery(__formModal).find(__formElement).ajaxForm(
          beforeSubmit: ->
            Index.uiBlocker()
          success: (data) ->
            Index.uiBlocker()
            jQuery(__formModal).modal('hide')
            setTimeout(->
              window.location.href = document.URL
            , 1300)
          error: ->
            Index.uiBlocker()
        )

      _triggerFileUpload =  ->
        jQuery(__formModal).find(__fileUploadButton).bind 'click', ->
          jQuery(__formModal).find(__fileUploadInput).click()
          __itemCurrent = jQuery(@).parents(__itemClass)

        jQuery(__formModal).find(__fileUploadForm).fileupload(
          dataType: 'json',
          add: (e, data) ->
            data.submit()
          progressall: (e, data) ->
            progressBar = _showProgressBar()
            progress = parseInt(data.loaded / data.total * 100, 10)
            jQuery(progressBar).children('.bar').css 'width', progress + '%' if progressBar isnt false
          done: (e, data) ->
            _hideProgressBar()
            _triggerCropForm data.result
        )

      _showProgressBar = ->
        progressBar = jQuery(__itemCurrent).find '.progress'
        return false if progressBar.length is 0
        jQuery(progressBar).removeClass 'fade'
        progressBar

      _hideProgressBar = ->
        progressBar =  jQuery(__itemCurrent).find '.progress'
        if progressBar.length > 0
          jQuery(progressBar).addClass 'fade'

      _triggerCropForm = (data) ->
        return false if data not instanceof Object
        return Index.modals.showAlert(data.message) if data.success == false

        modal = jQuery(Index.modals.widgetCrop)
        jQuery('#modalBody', modal).html data.result.body
        jQuery('#modalLabel', modal).html data.result.label
        __cropModal = modal

        jQuery(__cropModal).find('.max_height').val crop_height
        jQuery(__cropModal).find('.max_width').val crop_width

        jQuery(__cropModal).find(__cropImage).Jcrop(
          onChange: _updateCropCoords
          onSelect: _updateCropCoords
          aspectRatio: crop_width / crop_height
          minSize: [crop_width, crop_height]
          setSelect: [0, 0, crop_width, crop_height]
        , ->
          jQuery(__cropModal).modal()
          jQuery(__cropModal).on 'hidden', ->
            jQuery(@).remove('.modal')
        )

        _showThumbnail data.result.image
        _bindCropEvents()

        jQuery(__cropModal).find(__cropForm).ajaxForm(
          beforeSubmit: ->
            Index.uiBlocker()
          success: (data) ->
            Index.uiBlocker()
            return false if data not instanceof Object
            return Index.modals.showAlert(data.message) if data.success == false

            jQuery(__cropModal).modal('hide')

            _showThumbnail data.result.image
            jQuery(__itemCurrent).find(__FileUploadHiddden).val data.result.image_path
          error: ->
            jQuery.unblockUI()
        )

      _bindCropEvents = ->
        jQuery(__cropModal).find(__cancelCropButton).bind 'click', ->
          jQuery(__cropModal).modal 'hide'
        jQuery(__cropModal).find(__saveCropButton).bind 'click', ->
          jQuery(__cropModal).find(__cropForm).submit()

      _updateCropCoords = (coords) ->
        jQuery(__cropModal).find('.x_d').val coords.x
        jQuery(__cropModal).find('.y_d').val coords.y
        jQuery(__cropModal).find('.w_sel').val coords.w
        jQuery(__cropModal).find('.h_sel').val coords.h

      _showThumbnail = (image) ->
        time = new Date().getTime();
        jQuery(__itemCurrent).find(__fileUploadThumbnail).attr 'src', image + '?' + time

      confirmDelete = (target) ->
        id = jQuery(target).closest('td').find(__deleteButton).attr('rel')
        modal = jQuery(Index.modals.confirm)
        jQuery('#modalBody', modal).html 'Deseja deletar o item?'
        jQuery('#modalLabel', modal).html 'Deletar'
        jQuery(modal).modal()

        jQuery(modal).on 'hidden', ->
          jQuery(@).remove('.modal')

        jQuery(modal).find('.btn-confirm-modal').bind 'click', ->
          jQuery(modal).modal 'hide'
          remove id

      remove = (id) ->
        jQuery.ajax(
          url: Index.ajaxUrl
          type: 'post'
          dataType: 'json'
          data:
            id: id
            ajaxAction: 'delete'
          beforeSend: ->
            Index.uiBlocker()
        ).done((data) ->
          return false if data not instanceof Object
          if data.success == true
            title = 'Sucesso!'
          else
            title = false

          Index.modals.showAlert data.message, title
          if data.success == true
            setTimeout(->
              window.location.href = document.URL
            , 2000)
        ).always(->
          Index.uiBlocker()
        )

      bindEvents = ->
        jQuery(__addButton).bind 'click', (event) ->
          event.preventDefault()
          getForm jQuery(@), 'add'

        jQuery(__editButton).bind 'click', (event) ->
          event.preventDefault()
          id = jQuery(@).attr 'rel'
          getForm jQuery(@), 'edit'

        jQuery(__deleteButton).bind 'click', (event) ->
          event.preventDefault()
          confirmDelete jQuery(@)

        jQuery(__saveButton).live 'click', (event) ->
          jQuery(__formModal).find(__formElement).submit()

        jQuery(__fancyboxImage).fancybox()

      {
      init: ->
        bindEvents()
      }
    )()

    Admin
  )(Index || {})

  jQuery(->
    Index.Admin.manage.init()
  )
