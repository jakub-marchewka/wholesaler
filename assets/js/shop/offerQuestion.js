$(document).ready(function () {
    $('.product-question-form').submit(function (event) {
        event.preventDefault();
        let form = $(this).serialize();
        console.log(form);
        let test = ['test'];
        $.ajax({
            url: "/question/product",
            data: form + '&' + 'test=test2',
            method: 'post',
            success: function (data) {
                alert(data);
            },
            error: function () {

            }
        });
    });
});