$(document).ready(function () {
    $('.admin-product-delete').click(function () {
        let productId = $(this).attr('productId');
        $.ajax({
            url: "/admin/product/delete",
            data: {'productId': productId},
            success: function (data) {
                if (data === "good") {
                    $(`#${productId}`).remove();
                }
            },
            error: function () {

            }
        });
    });
});