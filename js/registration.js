function psw_control() {
    let password1 = document.getElementById("password");
    let password2 = document.getElementById("password_ripetuta");
    let message_error = document.getElementById("message_error");
    let button_registrati = document.getElementById("registrati");

    $.ajax({
        url: 'verifica_password.php',
        method: 'POST',
        data: {
            password1: password1.value,
            password2: password2.value
        },
        success: function (response) {
            if (response === 'coincide') {
                message_error.style.color = "red";
                message_error.innerText = "";
                button_registrati.disabled = false;
            } else {
                message_error.style.color = "red";
                message_error.innerText = "password non coincidenti";
                button_registrati.disabled = true;
            }
        },
        error: function () {
            message_error.innerText = "Si è verificato un errore durante la verifica delle password"
        }
    });
}