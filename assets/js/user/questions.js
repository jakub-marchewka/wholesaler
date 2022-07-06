$(document).ready(function () {
    $('.user-setting-change-question-button').click(function () {
        $.ajax({
            url: "/user/questions",
            method: 'post',
            success: function (data) {
                $('.user-setting-wrapp').html(data);
            },
            error: function () {

            }
        });
    });
});