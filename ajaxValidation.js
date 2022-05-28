function validateEmail(emailField) {
    var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

    if (reg.test(emailField.value) == false) {
        $("#message").html("<li>Invalid Email Address</li>");
        document.querySelector('#registerBtn').disabled = true;
        return false;
    }
    $("#message").html("");
    document.querySelector('#registerBtn').disabled = false;

    return true;
}

function validatePassword(passwordField) {
    if (passwordField.value.length < 8) {
        $("#messagePwd").html("<li>Password must have at least 8 characters</li>");
        document.querySelector('#registerBtn').disabled = true;

        return false;
    }
    $("#messagePwd").html("");
    document.querySelector('#registerBtn').disabled = false;

    return true;
}

function validateUsername(usernameField) {
    var letterNumber = /^[0-9a-zA-Z]+$/;
    var reWhiteSpace = new RegExp("\\s+");
    if (usernameField.value.length < 3 || letterNumber.test(usernameField.value) == false || reWhiteSpace.test(usernameField.value) == true) {
        $("#messageUsrname").html("<li>Your username is not regular</li>");
        document.querySelector('#registerBtn').disabled = true;

    } else {
        $("#messageUsrname").html("");
        document.querySelector('#registerBtn').disabled = false;


    }
}

function submit() {
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    var email = document.getElementById("email").value;
    var phone = document.getElementById("phone").value;
    var formdata = 'username=' + username + '&password=' + password + '&email=' + email + '&phone=' + phone;
    console.log(formdata);

    $.ajax({
        type: "POST",
        url: "http://localhost/22-cen343-nedim-b/register",
        data: formdata,
        cache: false,
        async: true,
        success: function (response) {
            console.log("Ovo je email:" + JSON.stringify(response));

        },
        error: function (response) {
            setTimeout(function () {
                alert(JSON.stringify(response))
            }, 1000);
        }
    });

    return false;
}

function login_submit() {
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    var formdata = 'username=' + username + '&password=' + password;

    $.ajax({
        type: "POST",
        url: "http://localhost/22-cen343-nedim-b/login",
        data: formdata,
        cache: false,
        async: true,
        success: function (response) {
            window.location.href = "welcome.html";

        },
        error: function (response) {
            setTimeout(function () {
                alert(JSON.stringify(response))
            }, 1000);
        }
    });

    return false;

}