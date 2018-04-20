$(document).ready(function(){
    $('#registration_form_password').on('change', validateConfirmPassword);
    $('#registration_form_confirm').on('keyup', validateConfirmPassword);

    $(document).on('submit', 'form', sendForm);
});

function sendForm() {
    event.preventDefault();
    on();
    var _this = $(this),
        form = _this.closest('form'),
        formId = form.attr('id'),
        action = form.attr('action') || location.href,
        method = form.attr('method') || 'post',
        resetForm = form.data('reset') == true ? 1 : 0,
        redirectSec = form.data('time') ? form.data('time') : 0,
        redirectUrl = form.data('url') ? form.data('url') : '';

    $.ajax({
        url: action,
        method: method,
        data: new FormData(this),
        contentType: false,
        dataType: 'json',
        processData : false,
        beforeSend: function () {
            $('#'+formId + ' .error').removeClass('d-block');
            $('#'+formId + ' .success').removeClass('d-block');
        },
        success: function(answ){
            var isSuccess = true;
            $.each(answ, function(i, val){
                var _fieldId = val[0],
                    _valid = val[1],
                    _message = val[2],
                    _class = _valid ? 'success' : 'error';

                $('#' + _fieldId).closest('.form-group').find('.'+_class).html(_message).addClass('d-block');

                if (!_valid) {
                    isSuccess = false;
                }
            });

            if (isSuccess) {
                if (resetForm) {
                    $('#' + formId).trigger('reset');
                }
                if (redirectUrl) {
                    setTimeout(function(){
                        location.href = redirectUrl;
                    }, redirectSec * 1000);
                }
            }
            off();
        },
        error: function() {
            alert("Ошибка выполнения");
        },
        statusCode: {
            404: function() {
                alert("Page Not Found");
            }
        }
    });
}

function validateConfirmPassword() {
    var password = $('#registration_form_password'),
        confirmPassword = $('#registration_form_confirm');

    if(password.val() != confirmPassword.val()) {
        confirmPassword[0].setCustomValidity('Entered passwords do not match');
    } else {
        confirmPassword[0].setCustomValidity('');
    }
}

function on() {
    document.getElementById("overlay").style.display = "block";
}

function off() {
    document.getElementById("overlay").style.display = "none";
}