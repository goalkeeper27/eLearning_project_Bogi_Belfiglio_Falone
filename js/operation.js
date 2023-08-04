
function submitCourseDetail(id){
    alert(id);
    document.getElementById(id).submit();
}


function seeNotifications(){
    window.location.href = "/notifications.php";
}

function openNotification(id){
    document.getElementById(id).submit();
}

