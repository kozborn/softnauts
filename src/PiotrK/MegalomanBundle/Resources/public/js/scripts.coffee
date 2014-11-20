jQuery(document).ready ($)->
  search = new Search

class Search
  inputs: null
  container: null
  url: null

  constructor: ()->
    @inputs = $('form#search input')
    console.log @inputs
    @container = $("#table-container")
    @url = @inputs.closest('form').attr('action')
    console.log @url
    @inputs.bind 'keyup', @search
    @inputs.bind 'change', @search

   search: (e) =>
    e.preventDefault()
    values = {}
    @inputs.each (index, item) =>
      if item.value
        values[$(item).attr('name')] = item.value
    @post = $.ajax({
      url: @url,
      type: "POST",
      data: values
      })
      .done (response) =>
        console.log response
        @container.html(response)
      .fail (jqHXR, response)=>
        console.log response