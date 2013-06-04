Index = Index || {}
Index.Post = ( (Post, $) ->
  Post.manage = ( ->
    #- elements
    __deleteLink = '.delete-link'

    bindEvents = ->
      # events

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

