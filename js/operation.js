

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



