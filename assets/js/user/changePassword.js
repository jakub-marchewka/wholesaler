$(document).ready(function () {
    $('.user-setting-change-password-button').click(function () {
        let form;
        if ( $('.user-setting-change-password-form').length > 0) {
            let form = $('.user-setting-change-password-form').serialize();
        }
        $.ajax({
            url: "/user/password/change",
            data: form,
            method: 'post',
            success: function (data) {
                if (data === 'good') {
                    $('.user-setting-wrapp').html('<h3>Password has been changed.</h3>');
                    formOnSubmit();
                } else {
                    $('.user-setting-wrapp').html(data);
                }
            },
            error: function () {

            }
        });
    });
    function formOnSubmit()
    {
        $('.user-setting-change-password-form').onsubmit(function () {
            
        });
    }
});