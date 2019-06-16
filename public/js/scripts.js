
// Submit AJAX request to capture content for ID 'id'
function request(id) {
  const loading = $(`#panel-loading-${id}`).show()
  const content = $(`#panel-content-${id}`).hide()
  $.ajax({
    method: 'POST',
    url: `/api/show/${id}`,
    context: this,
    dataType: 'html',
    error: resp => console.log(resp),
    success: resp => {
      $(`#panel-content-${id}`).html(resp)
      loading.hide()
      content.show()
    }
  })
}

// Require database update
function refresh() {
  $('#refresh-btn').prop('disabled', true)
  $('[id^="panel-loading-"]').show()
  $('[id^="panel-content-"]').hide()
  $.ajax({
    method: 'POST',
    url: '/api/load',
    context: this,
    error: resp => console.log(resp),
    success: resp => {
      for (id of LANGUAGES)
        request(id)
      setTimeout(() => {
        $('#refresh-btn').prop('disabled', false)
      }, 5000)
    }
  })
}

// Activate language tab
function activate(id) {
  $('[id^="panel-tab-"]').removeClass('active')
  $('[id^="panel-board-"]').hide()
  $(`#panel-tab-${id}`).addClass('active')
  $(`#panel-board-${id}`).show()
}

// Display repository details in modal
function display(id) {
  $('#repository-modal').modal('show')
  const loading = $('#modal-loading').show()
  const content = $("#modal-content").hide()
  $.ajax({
    method: 'GET',
    url: `/api/repository/${id}`,
    context: this,
    dataType: 'json',
    error: resp => console.log(resp),
    success: resp => {
      console.log(resp)
      loading.hide()
      content.show()
    }
  })
}

// Run functions when page finished loading
$(document).ready(function() {
  for (id of LANGUAGES)
    request(id)
})
