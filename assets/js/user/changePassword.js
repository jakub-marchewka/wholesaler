$(document).ready(function () {
    $('.user-setting-change-password-button').click(function () {
        formGenerate();
    });
    function formOnSubmit()
    {
        $('.user-setting-change-password-form').submit(function (event) {
            event.preventDefault();
            let form = $(this).serialize();
            formGenerate(form);
        });
    }
    function formGenerate(form = null)
    {

        console.log(form);
        $.ajax({
            url: "/user/password/change",
            data: form,
            method: 'post',
            success: function (data) {
                if (data === 'good') {
                    $('.user-setting-wrapp').html('<h3>Password has been changed.</h3>');
                } else {
                    $('.user-setting-wrapp').html(data);
                    formOnSubmit();
                }
            },
            error: function () {

            }
        });
    }
});