$(document).ready(function () {
    $('.user-setting-change-email-button').click(function () {
        formGenerate();
    });
    function formOnSubmit()
    {
        $('.user-setting-change-email-form').submit(function (event) {
            event.preventDefault();
            let form = $(this).serialize();
            formGenerate(form);
        });
    }
    function formGenerate(form = null)
    {

        console.log(form);
        $.ajax({
            url: "/user/email/change",
            data: form,
            method: 'post',
            success: function (data) {
                if (data === 'good') {
                    $('.user-setting-wrapp').html('<h3>Email has been changed.</h3>');
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