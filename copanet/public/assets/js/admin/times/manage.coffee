define ['index', 'admin/manage'], (Index) ->
  Index = Index || {}
  Index.Post = ( (Post, $) ->
    Post.manage = ( ->
      #- elements
      __departamentSelect = '.departamento-select'
      __tableTBody = '.table-tbody'

      getTimes = (selected) ->
        return console.log selected
        return false if selected.length <= 0
        url = selected.data 'url'
        $.ajax(
          beforeSend: ->
            Index.uiBlocker()
          url: url
          type: 'GET'
          dataType: 'html'
        ).done((data) ->
          return false if data == undefined or data == ''
          $(__tableTBody).empty().html data
        ).always(->
          Index.uiBlocker()
        )

      bindEvents = ->
        # events
        $(__departamentSelect).bind 'change', ->
          getTimes $(@).children('option:selected')

      {
      init: ->
        bindEvents()
      }
    )()

    Post
  )(Index.Post || {}, jQuery)

  jQuery( ->
    Index.Post.manage.init()
  )

