define ['jquery', 'index', 'jquery-ui', 'dropbox', 'fancybox', 'blockUI'], (jQuery, Index)->
  Index = Index || {}
  Index.Admin = ( (Admin, jQuery) ->
    Admin.manage = ( ->
      #- containers
      __fancyboxImage = '.image-fancybox'
      #- buttons
      __deleteButton = '.btn-remove'
      #- misc
      __uiBlock = false

      confirmDelete = (target) ->
        id = $(target).closest('td').find(__deleteButton).attr('rel')
        modal = $(Index.modals.confirm)
        $('#modalBody', modal).html 'Deseja deletar o item?'
        $('#modalLabel', modal).html 'Deletar'
        $(modal).modal()

        $(modal).on 'hidden', ->
          $(@).remove('.modal')

        $(modal).find('.btn-confirm-modal').bind 'click', ->
          $(modal).modal 'hide'
          remove id

      remove = (id) ->
        $.ajax(
          url: Index.ajaxUrl
          type: 'post'
          dataType: 'json'
          data:
            id: id
            ajaxAction: 'delete'
          beforeSend: ->
            uiBlocker()
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
          uiBlocker()
        )

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
        $(__deleteButton).bind 'click', (event) ->
          event.preventDefault()
          confirmDelete event.target

        $(__fancyboxImage).fancybox()

      {
      init: ->
        bindEvents()
      }
    )()

    Admin
  )(Index || {}, jQuery)

  jQuery(->
    Index.Admin.manage.init()
  )
