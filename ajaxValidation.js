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
        url: "https://nedimsssdproject.herokuapp.com/register",
        data: formdata,
        cache: false,
        async: true,
        success: function (response) {
            alert(JSON.stringify(response));

        },
        error: function (response) {
            alert(JSON.stringify(response));


        }
    });

    return false;
}

function verification_submit() {

    var username = localStorage.getItem("user_username");
    var formdata = 'username=' + username;

    $.ajax({
        type: "GET",
        url: "https://nedimsssdproject.herokuapp.com/22-cen343-nedim-b/get/" + username,
        data: formdata,
        cache: false,
        async: true,
        success: function (response) {
            if (response == 'SMS') {
                window.location.href = "https://nedimsssdproject.herokuapp.com/sms.html";
            } else if (response == 'QR') {
                window.location.href = "https://nedimsssdproject.herokuapp.com/qrcode.html";
            } else if (response == 'null') {
                window.location.href = "https://nedimsssdproject.herokuapp.com/welcome.html";

            }
        },
        error: function (response) {
            alert("Assure your login form is ok");


        }
    });

    return false;


}

function generateSMScode() {

    var username = localStorage.getItem("user_username");
    var formdata = 'username=' + username;

    $.ajax({
        type: "GET",
        url: "https://nedimsssdproject.herokuapp.com/getSMScode/" + username,
        data: formdata,
        cache: false,
        async: true,
        success: function (response) {
            alert('Message sent');
        },
        error: function (response) {
            alert("Message not sent");


        }
    });

    return false;


}

function smsCheck() {

    var username = localStorage.getItem("user_username");
    var sms = localStorage.getItem("sms");
    var formdata = 'username=' + username;

    $.ajax({
        type: "GET",
        url: "https://nedimsssdproject.herokuapp.com/getSMSvercode/" + username,
        data: formdata,
        cache: false,
        async: true,
        success: function (response) {
            window.location.href = "https://nedimsssdproject.herokuapp.com/welcome.html"
        },

        error: function (response) {
            alert(JSON.stringify(response));


        }
    });

    return false;


}

function qrCodeCheck() {

    var username = localStorage.getItem("user_username");
    var qrcode = localStorage.getItem("qrcode");
    var formdata = 'username=' + username;

    $.ajax({
        type: "GET",
        url: "https://nedimsssdproject.herokuapp.com/getQRnumber/" + username,
        data: formdata,
        cache: false,
        async: true,
        success: function (response) {
            if (response == qrcode) {
                window.location.href = "https://nedimsssdproject.herokuapp.com/welcome.html";
            }
        },

        error: function (response) {
            alert(JSON.stringify(response));


        }
    });

    return false;


}

function logout() {

    localStorage.clear();
    window.location.href = "https://nedimsssdproject.herokuapp.com/login.html";


}


function secret() {

    var username = localStorage.getItem("user_username");
    var formdata = 'username=' + username;

    $.ajax({
        type: "GET",
        url: "https://nedimsssdproject.herokuapp.com/getSecret/" + username,
        data: formdata,
        cache: false,
        async: true,
        success: function (response) {
            localStorage.setItem("imageUri", response);
        },

        error: function (response) {
            alert(JSON.stringify(response));


        }
    });

    return false;


}



function login_submit() {
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    var formdata = 'username=' + username + '&password=' + password;
    console.log(formdata);

    $.ajax({
        type: "POST",
        url: "https://nedimsssdproject.herokuapp.com/login",
        data: formdata,
        cache: false,
        async: true,
        success: function (response) {
            if (response == 'SMS') {
                window.location.href = "https://nedimsssdproject.herokuapp.com/sms.html";
            } else if (response == 'QR') {
                window.location.href = "https://nedimsssdproject.herokuapp.com/qrcode.html";
            } else if (response == 'null') {
                window.location.href = "https://nedimsssdproject.herokuapp.com/welcome.html";

            } else {
                alert('Try again, please');
            }
        },
        error: function (response) {
            var status = 'Try again please';
            alert(status);
        }
    });

    return false;

}

function emailreqFinal() {
    var token = document.getElementById("tokenField").value;
    var password = document.getElementById("newPasswordField").value;

    var formdata = 'token=' + token + '&password=' + password;
    console.log(formdata);

    $.ajax({
        type: "GET",
        url: "https://nedimsssdproject.herokuapp.com/setup/" + token + "/" + password,
        data: formdata,
        cache: false,
        async: true,
        success: function (response) {
            alert('Password successfully reseted');
            localStorage.clear();
            window.location.href = "https://nedimsssdproject.herokuapp.com/login.html";
        },
        error: function (response) {
            var status = 'Try again please';
            alert(status);
        }
    });

    return false;

}

function emailreq() {
    var email = document.getElementById("emailfield").value;
    var formdata = 'email=' + email;;
    console.log(formdata);

    $.ajax({
        type: "GET",
        url: "https://nedimsssdproject.herokuapp.com/reset/" + email,
        data: formdata,
        cache: false,
        async: true,
        success: function (response) {
            alert('Check your e-mail');
        },
        error: function (response) {
            var status = 'Try again please';
            alert(status);
        }
    });

    return false;

}

function status_submit() {
    var username = localStorage.getItem("user_username");
    var status = localStorage.getItem("value");
    var formdata = 'username=' + username + '&status=' + status;
    console.log(formdata);

    $.ajax({
        type: "GET",
        url: "https://nedimsssdproject.herokuapp.com/confirm/" + username + "/" + status,
        data: formdata,
        cache: false,
        async: true,
        success: function (response) {
            alert('Status changed successfully');
            window.location.href = "welcome.html";
            localStorage.clear();



        },
        error: function (response) {
            alert(JSON.stringify(response));


        }
    });

    return false;

}