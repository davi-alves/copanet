Index = Index || {}
Index.Gallery = ( (Gallery, $) ->
  Gallery.manage = (->

    #- contatiner
    __galleryContainer = '.gallery'
    __galleryControls = $(__galleryContainer).find('.gallery-controls')[0]
    #- file upload
    __fileUploadForm = '#fileupload-form'
    __fileUploadInput = '#fileupload-input'
    __fileUploadButton = '.fileinput-button'
    __fileUploadThumbnail = '.fileupload-thumbnail'
    #- crop
    __cropModal = ''
    __saveCropButton = '.btn-save-crop'
    __cancelCropButton = '.btn-cancel-crop'
    __cropForm = 'form.crop-form'
    __cropImage = 'img.jcrop-image'
    #- images control
    __imagesCount = 0
    __defaultOrder = 1
    __imagesTable = $(__galleryContainer).find('.gallery-images-table tbody')[0]
    __imageDeleteButton = '.btn-delete-image'
    #-templates
    __trTemplate = '<tr><td><input type="hidden" name="imagens[{{image.index}}][path]" class="fileupload-hidden" value="{{image.path}}"><a href="{{image.src}}" class="thumbnail-fancybox"><img src="{{image.src}}" class="fileupload-thumbnail span2 thumbnail"></a></td><td><input type="text" class="input-small" name="imagens[{{image.index}}][ordem]" value="{{image.order}}"/></td><td><input type="checkbox" name="imagens[{{image.index}}][destaque]" value="1" {{image.destaque}}/></td><td><span class="btn btn-danger btn-delete-image">Deletar</span></td></tr>'
    __trEmpty = '<tr><td colspan="4">Nenhuma imagem cadastrada</td></tr>'
    #-misc
    __entityId = '#entity-id'
    __uiBlock = false
    __fancyboxClass = '.thumbnail-fancybox'

    getImages = ->
      $.ajax(
        url: Index.ajaxUrl
        type: 'POST'
        dataType: 'json'
        data:
          ajaxAction: 'getImages'
          id: $(__entityId).val()
        beforeSend: ->
          uiBlocker()
      ).done((data) ->
        return false if data not instanceof Object or data.success == false or data.result.images.length <= 0
        renderImages data.result.images
      ).always(->
        uiBlocker()
      )

    renderImages = (images) ->
      for image in images
        renderLine image.src, image.path, image.ordem, image.destaque

    renderLine = (src, path, order = __defaultOrder, destaque = false) ->
      html = __trTemplate
      html = html.replace /{{image\.index}}/g, __imagesCount
      html = html.replace /{{image\.path}}/g, path
      html = html.replace /{{image\.src}}/g, src
      html = html.replace /{{image\.order}}/g, order
      if destaque == true
        html = html.replace /{{image\.destaque}}/g, 'checked="checked"'
      else
        html = html.replace /{{image\.destaque}}/g, ''
      $(__imagesTable).html('') if __imagesCount == 0
      __imagesCount++
      $(__imagesTable).append html

    removeLine = (element) ->
      __imagesCount--
      $(element).parents('tr').remove()
      $(__imagesTable).html(__trEmpty) if __imagesCount <= 0

    fileUploadEvents =  ->
      $(__galleryControls).find(__fileUploadButton).bind 'click', ->
        $(__fileUploadForm).find(__fileUploadInput).click()

      $(__fileUploadForm).fileupload(
        dataType: 'json'
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i
        add: (e, data) ->
          data.submit()
        progressall: (e, data) ->
          progressBar = _showProgressBar()
          progress = parseInt(data.loaded / data.total * 100, 10)
          $(progressBar).children('.bar').css 'width', progress + '%' if progressBar isnt false
        done: (e, data) ->
          _hideProgressBar()
          triggerCropForm data.result
      )

    _showProgressBar = ->
      progressBar = $(__galleryControls).find '.progress'
      return false if progressBar.length is 0
      $(progressBar).removeClass 'fade'
      progressBar

    _hideProgressBar = ->
      progressBar =  $(__galleryControls).find '.progress'
      if progressBar.length > 0
        $(progressBar).addClass 'fade'

    triggerCropForm = (data) ->
      return false if data not instanceof Object
      return Index.modals.showAlert(data.message) if data.success == false

      modal = $(Index.modals.widgetCrop)
      $('#modalBody', modal).html data.result.body
      $('#modalLabel', modal).html data.result.label
      __cropModal = modal

      $(__cropModal).find('.max_height').val crop_height
      $(__cropModal).find('.max_width').val crop_width

      $(__cropModal).find(__cropImage).Jcrop(
        onChange: _updateCropCoords
        onSelect: _updateCropCoords
        aspectRatio: crop_width / crop_height
        minSize: [crop_width, crop_height]
        setSelect: [0, 0, crop_width, crop_height]
      , ->
        $(__cropModal).modal()
        $(__cropModal).on 'hidden', ->
          $(@).remove('.modal')
      )

      bindCropEvents()
      $(__cropModal).find(__cropForm).ajaxForm(
        beforeSubmit: ->
          uiBlocker()
        success: (data) ->
          uiBlocker()
          return false if data not instanceof Object
          return Index.modals.showAlert(data.message) if data.success == false

          $(__cropModal).modal('hide')
          renderLine data.result.image, data.result.image_path
        error: ->
          $.unblockUI()
      )

    bindCropEvents = ->
      $(__cropModal).find(__cancelCropButton).bind 'click', ->
        $(__cropModal).modal 'hide'
      $(__cropModal).find(__saveCropButton).bind 'click', ->
        $(__cropModal).find(__cropForm).submit()

    _updateCropCoords = (coords) ->
      $(__cropModal).find('.x_d').val coords.x
      $(__cropModal).find('.y_d').val coords.y
      $(__cropModal).find('.w_sel').val coords.w
      $(__cropModal).find('.h_sel').val coords.h

    uiBlocker = ->
      if not __uiBlock
        $.blockUI(
          baseZ: 2000
          css:
            border: 'none'
            padding: '15px'
            backgroundColor: '#000'
            '-webkit-border-radius': '10px'
            '-moz-border-radius': '10px'
            opacity: .5
            color: '#fff'
          message: 'Aguarde...'
        )
        __uiBlock = true
      else
        $.unblockUI()
        __uiBlock = false

    bindEvents = ->
      fileUploadEvents()
      $(__imageDeleteButton).live 'click', ->
        removeLine $(@)
      $(__fancyboxClass).fancybox()

    {
    #- init the library
    init: ->
      getImages()
      bindEvents()
    }
  )()
  #- return modified object
  Gallery
)(Index.Gallery || {}, jQuery)

jQuery(->
  Index.Gallery.manage.init()
)