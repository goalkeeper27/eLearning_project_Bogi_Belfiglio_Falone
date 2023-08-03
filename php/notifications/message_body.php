<?php

$message_body = new Template("skins/revision/dtml/notifications/message_body.html");

if (isset($_POST['id_notification'])) {
    $id_notification = $_POST['id_notification'];
    $message = $mysql->query("SELECT * FROM notifica WHERE ID = $id_notification");
    $row = $message->fetch_assoc();
    $message_body->setContent('sender_for_body_message', $row['mittente']);
    $message_body->setContent('time_for_body_message', $row['data'] . " " . $row['ora']);
    $message_body->setContent('object_for_body_message', $row['oggetto']);
    $message_body->setContent('body_message', $row['corpo']);

    $modify_notification = $mysql->query("UPDATE `notifica` SET `visto` = '1' WHERE `notifica`.`ID` = $id_notification");
}

?>