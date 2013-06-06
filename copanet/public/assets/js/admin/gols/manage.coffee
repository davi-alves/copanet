define ['jquery', 'index', 'jquery.migrate', 'form'], ($, Index)->
  Index = Index || {}
  Index.Admin = ( (Admin) ->
    Admin.manage = ( ->
      #- modals
      __formModal = ''
      #- containers
      __formElement = 'form.modal-form'
      __itemClass = '.item'
      #- buttons
      __addButton = '.btn-add'
      __editButton = '.btn-edit'
      __saveButton = '.btn-save-widget'
      #- selects
      __departamentoSelect = '.departamento-select'
      __timeSelect = '.time-select'
      __artilheiroSelect = '.artilheiro-select'

      getForm = (target) ->
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
          $(modal).find('#modalLabel').html 'Adicionar Gols'
          $(modal).modal()
          __formModal = modal
          $(__formModal).on 'hidden', ->
            $(@).remove('.modal')

          _triggerAjaxForm()
          _triggerSelects()
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
          error: ->
            Index.uiBlocker()
        )

      _triggerSelects = ->
        $(__formModal).find(__departamentoSelect).bind 'change', ->
          getTimes $(@).children('option:selected')

      getTimes = (departamento) ->
        $.ajax(
          beforeSend: ->
            Index.uiBlocker()
          url: departamento.data 'url'
          type: 'GET'
          dataType: 'html'
        ).done((data) ->
          return false if data == 'undefined' or data == ''
          $(__timeSelect).empty().html data
        ).always(->
          Index.uiBlocker()
        )

      bindEvents = ->
        $(__addButton).bind 'click', (event) ->
          event.preventDefault()
          getForm $(@)

        $(__saveButton).live 'click', (event) ->
          $(__formModal).find(__formElement).submit()

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
