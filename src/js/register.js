$(document).ready(function () {
    console.log('page ok')
    $('#register').on('click', function () {
        var username = $('#username').val()
        var passwd = $('#password').val()
        var email = $('#email').val()
        if (username == "" || password == "" || email == "")
            alert('Please insert proper data')
        else {
            $.ajax({
                url: '../src/api/gofish.php/register',
                method: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({
                    login: 1,
                    usernamePHP: username,
                    passwordPHP: passwd,
                    emailPHP: email
                }),
                success: function () {
                    console.log('ok')
                    window.location = '../Queue/'
                },
            })
        }
    })
})