$(document).ready(function () {
    $('.admin-file-delete').click(function () {
        let fileId = $(this).attr('fileId');
        $.ajax({
            url: "/admin/file/delete",
            data: {'adminFileId': fileId},
            success: function (data) {
                if (data === "good") {
                    $(`#${fileId}`).remove();
                }
            },
            error: function () {

            }
        });
    });
});