$(document).ready(function () {
    $('.user-api-token-show').click(function () {
        $.ajax({
            url: "/user/api/token/get",
            method: 'post',
            success: function (data) {
                if (data['status'] === 'bad') {
                    $('.user-setting-wrapp').html('' +
                        '<button type="button" class="btn btn-dark user-api-token-generate">Generate token</button>'
                    );
                    generateToken();
                }
                if (data['status'] === 'good') {
                    showToken(data['token']);
                }
            },
            error: function () {

            }
        });
    });
    function generateToken()
    {
        $('.user-api-token-generate').click(function () {
            $.ajax({
                url: "/user/api/token/generate",
                method: 'post',
                success: function (data) {
                    showToken(data);
                },
                error: function () {

                }
            });
        });
    }
    function showToken(token) {
        $('.user-setting-wrapp').html('' +
            '<p>\n' +
            '  <button class="btn btn-dark" type="button" ' +
            '           data-bs-toggle="collapse" ' +
            '           data-bs-target="#collapseExample" ' +
            '           aria-expanded="false" ' +
            '           aria-controls="collapseExample">\n' +
            '    Show Token\n' +
            '  </button>\n' +
            '</p>\n' +
            '<div class="collapse" id="collapseExample">\n' +
            '  <div class="card card-body">\n' +
            '    '+ token +
            '  </div>\n' +
            '</div>'
        );
    }

})
