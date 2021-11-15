
$(document).ready(function () {
    toastr.options = {
        "progressBar": true,
        "positionClass": "toast-bottom-right",
    }

    window.addEventListener('hide-form', event => {
        $('#show-form').modal('hide')
        toastr.success(event.detail.message, 'Success!')
    })
})

window.addEventListener('show-form', event => {
    $('#show-form').modal('show')
})

window.addEventListener('updated', event => {
    toastr.success(event.detail.message, 'Success!')
})

window.addEventListener('alert', event => {
    toastr.success(event.detail.message, 'Success!')
})

$('[x-ref="profileLink"]').on('click', function(){
    localStorage.setItem('_x_currentTab', '"profile"')
});
$('[x-ref="changePasswordLink"]').on('click', function(){
    localStorage.setItem('_x_currentTab', '"changePassword"')
});
