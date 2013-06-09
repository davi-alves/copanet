define ['jquery', 'index', 'jquery.migrate', 'form'], ($, Index)->
  Index = Index || {}
  Index.Admin = ( (Admin) ->
    Admin.manage = ( ->
      #- modals
      __formModal = ''
      #- containers
      __formElement = 'form.modal-form'
      #- buttons
      __addButton = '.btn-add-gols'
      __editButton = '.btn-edit-gols'
      __saveButton = '.btn-save-widget'
      #- selects
      __departamentoSelect = '.departamento-select'
      __timeSelect = '.time-select'
      __artilheiroSelect = '.artilheiro-select'
      __comboClass = '.combobox'
      #- elements
      __golsInput = 'input.gols'
      #- helpers
      __onEdit = false

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
          $(modal).find('#modalLabel').html 'Adicionar/Subtrair Gols'
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

            if(__onEdit)
              __onEdit = false
              setTimeout(->
                window.location.href = document.URL
              , 1000)
          error: ->
            Index.uiBlocker()
        )

      _triggerSelects = ->
        form = $(__formModal)
        form.find(__departamentoSelect).bind 'change', ->
          getTimes $(@).children('option:selected')

        form.find(__timeSelect).bind 'change', ->
          getArtilheiros $(@).children('option:selected')

        ###form.find(__artilheiroSelect).bind 'change', ->
          getGols $(@).children('option:selected')###

      getTimes = (departamento) ->
        if departamento.val() == ''
          disableToggle 'all'
          return false

        $.ajax(
          beforeSend: ->
            Index.uiBlocker()
            disableToggle 'all'
          url: departamento.data 'url'
          type: 'GET'
          dataType: 'html'
        ).done((data) ->
          return false if data == 'undefined' or data == ''
          disableToggle 'time', false
          $(__timeSelect).empty().html data
        ).always(->
          Index.uiBlocker()
        )

      getArtilheiros = (time) ->
        if time.val() == ''
          disableToggle 'artilheiro'
          return false

        $.ajax(
          beforeSend: ->
            Index.uiBlocker()
            disableToggle 'artilheiro'
          url: time.data 'url'
          type: 'GET'
          dataType: 'html'
        ).done((data) ->
          return false if data == 'undefined' or data == ''
          disableToggle 'artilheiro', false
          $(__artilheiroSelect).empty().html data
        ).always(->
          Index.uiBlocker()
        )

      getGols = (artilheiro) ->
        gols = $(__formModal).find(__golsInput)
        gols.val 0
        if artilheiro.val() == ''
          return false

        $.ajax(
          beforeSend: ->
            Index.uiBlocker()
          url: artilheiro.data 'url'
          type: 'GET'
          dataType: 'html'
        ).done((data) ->
          return false if data == 'undefined' or data == ''
          gols.val data
        ).always(->
          Index.uiBlocker()
        )


      validate = ->
        form = $(__formModal)
        departamento = form.find(__departamentoSelect).val()
        time = form.find(__timeSelect).val()
        artilheiro = form.find(__artilheiroSelect).val()
        gols = parseInt form.find(__golsInput).val()

        if not departamento? or departamento == '' or
        not time? or time == '' or
        not artilheiro? or artilheiro ==''
          return false
        return false if isNaN(gols)
        return true

      disableToggle = (which, disable = true) ->
        switch which
          when 'all'
            $(__formModal).find(__comboClass).empty().prop 'disabled', disable
          when 'time'
            $(__formModal).find(__timeSelect).empty().prop 'disabled', disable
          when 'artilheiro'
            $(__formModal).find(__artilheiroSelect).empty().prop 'disabled', disable
          else true

      bindEvents = ->
        $(__addButton).bind 'click', (event) ->
          event.preventDefault()
          getForm $(@)

        $(__editButton).live 'click', (event) ->
          event.preventDefault()
          __onEdit = true
          getForm $(@)

        $(__saveButton).live 'click', (event) ->
          return false if not validate()
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
