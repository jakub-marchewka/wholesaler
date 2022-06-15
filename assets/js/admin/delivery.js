$(document).ready(function () {
    $('.admin-delivery-delete').click(function () {
        let deliveryId = $(this).attr('deliveryId');

        $.ajax({
            url: "/admin/delivery/delete",
            data: {'deliveryId': deliveryId},
            success: function (data) {
                if (data === "good") {
                    $(`#${deliveryId}`).remove();
                }
            },
            error: function () {

            }
        });
    });
});