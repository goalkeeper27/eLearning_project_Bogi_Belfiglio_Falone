<?php
require "message_body.php";

$body = new Template("skins/revision/dtml/notifications/body_notifications.html");

if (isset($_POST['id_notification'])) {
    $body->setContent("message_body", $message_body->get());
}else{
    $body->setContent("message_body", "");
}

$user = $_SESSION['auth']['username'];
$notification = $mysql->query("SELECT N.* FROM notifica N INNER JOIN utente U ON U.ID = N.ID_utente WHERE U.username = '" . $user .
    "' ORDER BY N.data DESC,N.ora DESC");

if ($notification->num_rows > 0) {
    while ($row = $notification->fetch_assoc()) {
        $body->setContent('sender', $row['mittente']);
        $body->setContent('time', $row['data'] . " " . $row['ora']);
        $body->setContent('object', $row['oggetto']);
        $body->setContent('id_notification', '<form action="/notifications.php" method="POST" id="'. $row['ID'] .'" >
                                                <input type="hidden" name="id_notification" value="'. $row['ID'] .'" />
                                                <a class="btn btn-notification ml-4 mt-4" href="#" 
                                                onclick="openNotification(' . $row['ID'] . ')">Open</a></form>');

        if ($row['visto'] == '1') {
            $body->setContent('envelope', '<i class="fa fa-2x fa-envelope-open text-white" aria-hidden="true"></i>');
        } else {
            $body->setContent('envelope', '<i class="fa fa-2x fa-envelope text-white" aria-hidden="true"></i>');
        }
    }
}



?>