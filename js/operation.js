

function submitCourseDetail(id) {
    document.getElementById(id).submit();
}

function submitForm(id){
    document.getElementById(id).submit(); 
}


function seeNotifications() {
    window.location.href = "/notifications.php";
}

function openNotification(id) {
    document.getElementById(id).submit();
}

function updateLessonHistory(id_lesson) {
    var xhr = new XMLHttpRequest();
    var url = "/update_lesson_history.php";
    var params = "id_lesson=" + id_lesson; // Definisci qui i tuoi parametri

    xhr.open("POST", url, true);

    // Imposta l'header della richiesta
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Callback quando la richiesta è completata
            window.location.href = "/lessons.php";
        }
    }

    // Invia la richiesta con i parametri
    xhr.send(params);

}

function psw_control_user() {
    let password1 = document.getElementById("password");
    let password2 = document.getElementById("password_ripetuta");
    let message_error = document.getElementById("message_error");
    let button_update = document.getElementById("update");

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
                button_update.disabled = false;
            } else {
                message_error.style.color = "red";
                message_error.innerText = "password non coincidenti";
                button_update.disabled = true;
            }
        },
        error: function () {
            message_error.innerText = "Si è verificato un errore durante la verifica delle password"
        }
    });
}

function change(){
    $("#change").hide();
    $("#change_psw").slideDown(1000);
}




