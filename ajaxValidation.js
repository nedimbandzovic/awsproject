function validateEmail(emailField) {
    var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

    if (reg.test(emailField.value) == false) {
        $("#message").html("<li>Invalid Email Address</li>");
        return false;
    }
    $("#message").html("");
    return true;
}

function validatePassword(passwordField) {
    if (passwordField.value.length < 8) {
        $("#messagePwd").html("<li>Password must have at least 8 characters</li>");
        return false;
    }
    $("#messagePwd").html("");
    return true;
}

function validateUsername(usernameField) {
    var letterNumber = /^[0-9a-zA-Z]+$/;
    var reWhiteSpace = new RegExp("\\s+");
    if (usernameField.value.length < 3 || letterNumber.test(usernameField.value) == false || reWhiteSpace.test(usernameField.value) == true) {
        $("#messageUsrname").html("<li>Your username is not regular</li>");
    } else {
        $("#messageUsrname").html("");

    }
}

function register() {


    $("#register").click(function () {
        var username = $("#username").val().trim();
        var password = $("#password").val().trim();
        var email = $("#email").val().trim();
        var phonenumber = $("#phonennumber").val().trim();


        $.ajax({
            url: 'register.php',
            type: 'post',
            data: {
                username: username,
                password: password,
                email: email,
                phonenumber: phonenumber
            },
            success: function (response) {
                $("#message").html(response);
            }
        });
    });
}

function submit() {}