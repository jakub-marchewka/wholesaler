$(document).ready(function () {
    $('.admin-category-delete').click(function () {
        let categoryId = $(this).attr('categoryId');
        $.ajax({
            url: "/admin/category/delete",
            data: {'categoryId': categoryId},
            success: function (data) {
                if (data === "good") {
                    $(`#${categoryId}`).remove();
                }
            },
            error: function () {

            }
        });
    });
});