$(document).ready(function () {
    $('.admin-vat-delete').click(function () {
        let vatId = $(this).attr('vatId');
        $.ajax({
            url: "/admin/vat/delete",
            data: {'vatId': vatId},
            success: function (data) {
                if (data === "good") {
                    $(`#${vatId}`).remove();
                }
            },
            error: function () {

            }
        });
    });
});