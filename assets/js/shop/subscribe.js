$(document).ready(function () {
    $('.subscribe-product').click(function () {
        let productId = $(this).attr('productId');

        $.ajax({
            url: "/product/subscribe",
            data: {'productId': productId},
            success: function (data) {
                if (data === "good") {
                    $(`.subscribe-product-${productId}`).html('<i class="fa-solid fa-heart"></i>');
                } else {
                    $(`.subscribe-product-${productId}`).html('<i class="fa-regular fa-heart"></i>');
                }

            },
            error: function () {

            }
        });
    });
});