$(document).ready(function () {
    $('.product-question-form').submit(function (event) {
        event.preventDefault();
        let form = $(this).serialize();
        let productId = $('.offer-add-to-cart').attr('productId');
        $.ajax({
            url: "/question/product",
            data: form + '&' + 'productId='+productId,
            method: 'post',
            success: function (data) {
                if (data === 'good') {
                    $('.product-question-form-wrapp').html('<h3>Message has been sended</h3>');
                }
            },
            error: function () {

            }
        });
    });
});