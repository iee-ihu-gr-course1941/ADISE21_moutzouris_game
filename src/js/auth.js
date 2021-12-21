$(document).ready(function () {
    console.log('page ok')
    $('#login').on('click', function () {
        var username = $('#username').val()
        var passwd = $('#password').val()
        if (username == "" || passwd == "")
            alert('Please insert proper data')
        else {
            $.ajax({
                url: './src/api/gofish.php/login',
                method: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({
                    login: 1,
                    usernamePHP: username,
                    passwordPHP: passwd
                }),
                success: function (response) {
                    $('#response').html(response)
                    window.location = './Queue/'
                    console.log('success')
                },
                error: function () {
                    console.log('not ok')
                }
            })
        }
    })
})