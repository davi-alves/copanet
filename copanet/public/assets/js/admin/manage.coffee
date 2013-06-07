define ['jquery', 'index', 'holder', 'jquery.migrate', 'fancybox', 'fileupload', 'form', 'jquery.jcrop'], ($, Index, Holder)->
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
        $.ajax(
          beforeSend: ->
            Index.uiBlocker()
          url: target.attr 'href'
          type: 'GET'
          dataType: 'html'
        ).done((data) ->
          return false if data == 'undefined' or data == ''

          modal = $(Index.modals.widgetForm)
          $(modal).find('#modalBody').html data
          $(modal).find('#modalLabel').html if action == 'add' then 'Novo' else 'Editar'
          $(modal).modal()
          __formModal = modal
          $(__formModal).on 'hidden', ->
            $(@).remove('.modal')

          image = $(__formModal).find(__fileUploadThumbnail)
          if image.length > 0 && image.attr('src') == undefined
            Holder.run(
              images: $(__formModal).find(__fileUploadThumbnail)[0]
            )

          _triggerFileUpload()
          _triggerAjaxForm()
        ).always(->
          Index.uiBlocker()
        )

      _triggerAjaxForm =  ->
        $(__formModal).find(__formElement).ajaxForm(
          beforeSubmit: ->
            Index.uiBlocker()
          success: (data) ->
            Index.uiBlocker()
            $(__formModal).modal('hide')
            setTimeout(->
              window.location.href = document.URL
            , 1000)
          error: ->
            Index.uiBlocker()
        )

      _triggerFileUpload =  ->
        $(__formModal).find(__fileUploadButton).bind 'click', ->
          $(__formModal).find(__fileUploadInput).click()
          __itemCurrent = $(@).parents(__itemClass)

        $(__formModal).find(__fileUploadForm).fileupload(
          dataType: 'json',
          add: (e, data) ->
            data.submit()
          progressall: (e, data) ->
            progressBar = _showProgressBar()
            progress = parseInt(data.loaded / data.total * 100, 10)
            $(progressBar).children('.bar').css 'width', progress + '%' if progressBar isnt false
          done: (e, data) ->
            _hideProgressBar()
            _triggerCropForm data.result
        )

      _showProgressBar = ->
        progressBar = $(__itemCurrent).find '.progress'
        return false if progressBar.length is 0
        $(progressBar).removeClass 'fade'
        progressBar

      _hideProgressBar = ->
        progressBar =  $(__itemCurrent).find '.progress'
        if progressBar.length > 0
          $(progressBar).addClass 'fade'

      _triggerCropForm = (data) ->
        return false if data not instanceof Object
        return Index.modals.showAlert(data.message) if data.success == false

        modal = $(Index.modals.widgetCrop)
        $('#modalBody', modal).html data.form
        $('#modalLabel', modal).html 'Crop'
        __cropModal = modal

        $(__cropModal).find('.max_height').val max_height
        $(__cropModal).find('.max_width').val max_width

        $(__cropModal).find(__cropImage).Jcrop(
          onChange: _updateCropCoords
          onSelect: _updateCropCoords
          aspectRatio: max_width / max_height
          minSize: [min_width, min_height]
          setSelect: [0, 0, min_width, min_height]
        , ->
          $(__cropModal).modal()
          $(__cropModal).on 'hidden', ->
            $(@).remove('.modal')
        )

        _showThumbnail data.url
        _bindCropEvents()

        $(__cropModal).find(__cropForm).ajaxForm(
          beforeSubmit: ->
            Index.uiBlocker()
          success: (data) ->
            Index.uiBlocker()
            return false if data not instanceof Object
            return Index.modals.showAlert(data.message) if data.success == false

            $(__cropModal).modal('hide')

            _showThumbnail data.image
            $(__itemCurrent).find(__FileUploadHiddden).val data.url
          error: ->
            $.unblockUI()
        )

      _bindCropEvents = ->
        $(__cropModal).find(__cancelCropButton).bind 'click', ->
          $(__cropModal).modal 'hide'
        $(__cropModal).find(__saveCropButton).bind 'click', ->
          $(__cropModal).find(__cropForm).submit()

      _updateCropCoords = (coords) ->
        $(__cropModal).find('.x_d').val coords.x
        $(__cropModal).find('.y_d').val coords.y
        $(__cropModal).find('.w_sel').val coords.w
        $(__cropModal).find('.h_sel').val coords.h

      _showThumbnail = (image) ->
        console.log image
        time = new Date().getTime();
        $(__itemCurrent).find(__fileUploadThumbnail).attr 'src', image + '?' + time

      confirmDelete = (target) ->
        url = target.attr 'href'
        modal = $(Index.modals.confirm)
        $('#modalBody', modal).html 'Deseja deletar o item?'
        $('#modalLabel', modal).html 'Deletar'
        $(modal).modal()

        $(modal).on 'hidden', ->
          $(@).remove('.modal')

        $(modal).find('.btn-confirm-modal').bind 'click', ->
          $(modal).modal 'hide'
          remove url

      remove = (url) ->
        $.ajax(
          url: url
          type: 'DELETE'
          dataType: 'json'
          beforeSend: ->
            Index.uiBlocker()
        ).done((data) ->
          return false if data not instanceof Object
          if data.success == true
            title = 'Sucesso!'
          else
            title = false
          data.message = if data.message == undefined or data.message == '' then 'Item removido com sucesso' else data.message

          Index.modals.showAlert data.message, title
          if data.success == true
            setTimeout(->
              window.location.href = document.URL
            , 1000)
        ).always(->
          Index.uiBlocker()
        )

      bindEvents = ->
        $(__addButton).bind 'click', (event) ->
          event.preventDefault()
          getForm $(@), 'add'

        $(__editButton).live 'click', (event) ->
          event.preventDefault()
          id = $(@).attr 'rel'
          getForm $(@), 'edit'

        $(__deleteButton).live 'click', (event) ->
          event.preventDefault()
          confirmDelete $(@)

        $(__saveButton).live 'click', (event) ->
          $(__formModal).find(__formElement).submit()

        $(__fancyboxImage).fancybox()

      {
      init: ->
        bindEvents()
      }
    )()

    Admin
  )(Index || {})

  $(->
    Index.Admin.manage.init()
  )
