$(document).ready(function () {
    $('.cart-product-add').click(function () {
        let productId = $(this).attr('productId');
        $.ajax({
            url: "/cart/add",
            data: {'productId' : productId},
            method: 'post',
            success: function (data) {
                alert(data['message']);
            },
            error: function () {

            }
        });
    });

});