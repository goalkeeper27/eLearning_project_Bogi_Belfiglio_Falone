<?php
require "message_body.php";

$body = new Template("skins/revision/dtml/notifications/body_notifications.html");
$user = $_SESSION['auth']['username'];

if (isset($_POST['index'])) {
    $index = $_POST['index'];
} else {
    $index = 1;
}


$body = new Template("skins/revision/dtml/notifications/body_notifications.html");

//total number of notifications
$number_notifications = $mysql->query("SELECT COUNT(*) as total_records FROM notifica N INNER JOIN utente U ON U.ID = N.ID_utente WHERE U.username = '" . $user . "'");

$row = $number_notifications->fetch_assoc();
$total_records = $row["total_records"];


$total_index = ceil($total_records / 6); //approssimo per eccesso il risultato, se ad esempio ho 7 records, mi serviranno 2 indici totali

//index check for view
if ($total_index <= 3) {
    for ($i = 1; $i <= $total_index; $i++) {
        if ($i == $index) {
            $body->setContent('index', ' <li class="page-item active">
                                    <form id="index_' . $i . '" method="POST" action="notifications.php#anchor">
                                        <input type="hidden" name="index" value="' . $i . '" />
                                        <a class="page-link" id="' . $i . '" href="#" onclick="submitCourseDetail(\'index_' . $i . '\')">' . $i . '</a>
                                    </form>
                                    </li>');
        } else {
            $body->setContent('index', ' <li class="page-item">
                                    <form id="index_' . $i . '" method="POST" action="notifications.php#anchor">
                                        <input type="hidden" name="index" value="' . $i . '" />
                                        <a class="page-link" id="' . $i . '" href="#" onclick="submitCourseDetail(\'index_' . $i . '\')">' . $i . '</a>
                                    </form>
                                    </li>');
        }
    }

} else if ($total_index > 3 && $index <= 2) {
    for ($i = 1; $i <= 3; $i++) {
        if ($i == $index) {
            $body->setContent('index', ' <li class="page-item active">
                                    <form id="index_' . $i . '" method="POST" action="notifications.php#anchor">
                                        <input type="hidden" name="index" value="' . $i . '" />
                                        <a class="page-link" id="' . $i . '" href="#" onclick="submitCourseDetail(\'index_' . $i . '\')">' . $i . '</a>
                                    </form>
                                    </li>');
        } else {
            $body->setContent('index', ' <li class="page-item">
                                    <form id="index_' . $i . '" method="POST" action="notifications.php#anchor">
                                        <input type="hidden" name="index" value="' . $i . '" />
                                        <a class="page-link" id="' . $i . '" href="#" onclick="submitCourseDetail(\'index_' . $i . '\')">' . $i . '</a>
                                    </form>
                                    </li>');
        }
    }

    $body->setContent('index', ' <li class="page-item"> <a class="page-link href="#">...</a> </li>');
    $body->setContent('index', ' <li class="page-item">
                                    <form id="index_' . $total_index . '" method="POST" action="notifications.php#anchor">
                                        <input type="hidden" name="index" value="' . $total_index . '" />
                                        <a class="page-link" id="' . $total_index . '" href="#" onclick="submitCourseDetail(\'index_' . $total_index . '\')">' . $total_index . ' </a>
                                    </form>
                                    </li>');
} else if ($total_index > 3 && ($index > 2 && $index < ($total_index - 1))) {
    $body->setContent('index', ' <li class="page-item">
                                    <form id="index_1" method="POST" action="notifications.php#anchor">
                                        <input type="hidden" name="index" value="1" />
                                        <a class="page-link" id="1" href="#" onclick="submitCourseDetail(\'index_1\')">1</a>
                                    </form>
                                    </li>');
    $body->setContent('index', ' <li class="page-item"> <a class="page-link href="#">...</a> </li>');

    for ($i = $index - 1; $i <= $index + 1; $i++) {
        if ($i == $index) {
            $body->setContent('index', ' <li class="page-item active">
                                        <form id="index_' . $i . '" method="POST" action="notifications.php#anchor">
                                            <input type="hidden" name="index" value="' . $i . '" />
                                            <a class="page-link" id="' . $i . '" href="#" onclick="submitCourseDetail(\'index_' . $i . '\')">' . $i . '</a>
                                        </form>
                                        </li>');
        } else {
            $body->setContent('index', ' <li class="page-item">
                                        <form id="index_' . $i . '" method="POST" action="notifications.php#anchor">
                                            <input type="hidden" name="index" value="' . $i . '" />
                                            <a class="page-link" id="' . $i . '" href="#" onclick="submitCourseDetail(\'index_' . $i . '\')">' . $i . '</a>
                                        </form>
                                        </li>');
        }
    }

    $body->setContent('index', ' <li class="page-item"> <a class="page-link href="#">...</a> </li>');
    $body->setContent('index', ' <li class="page-item">
                                    <form id="index_' . $total_index . '" method="POST" action="notifications.php#anchor">
                                        <input type="hidden" name="index" value="' . $total_index . '" />
                                        <a class="page-link" id="' . $total_index . '" href="#" onclick="submitCourseDetail(\'index_' . $total_index . '\')">' . $total_index . '</a>
                                    </form>
                                    </li>');



} else {
    $body->setContent('index', ' <li class="page-item">
                                    <form id="index_1" method="POST" action="notifications.php#anchor">
                                        <input type="hidden" name="index" value="1" />
                                        <a class="page-link" id="1" href="#" onclick="submitCourseDetail(\'index_1\')">1</a>
                                    </form>
                                    </li>');
    $body->setContent('index', ' <li class="page-item"> <a class="page-link href="#">...</a> </li>');

    for ($i = $total_index - 2; $i <= $total_index; $i++) {
        if ($i == $index) {
            $body->setContent('index', ' <li class="page-item active">
                                        <form id="index_' . $i . '" method="POST" action="notifications.php#anchor">
                                            <input type="hidden" name="index" value="' . $i . '" />
                                            <a class="page-link" id="' . $i . '" href="#" onclick="submitCourseDetail(\'index_' . $i . '\')">' . $i . '</a>
                                        </form>
                                        </li>');
        } else {
            $body->setContent('index', ' <li class="page-item">
                                        <form id="index_' . $i . '" method="POST" action="notifications.php#anchor">
                                            <input type="hidden" name="index" value="' . $i . '" />
                                            <a class="page-link" id="' . $i . '" href="#" onclick="submitCourseDetail(\'index_' . $i . '\')">' . $i . '</a>
                                        </form>
                                        </li>');
        }
    }

}

$min = 6 * $index - 5; //Se index è 1 il min deve essere 1 e il max deve essere 6
$max = 6 * $index; // Se index è 2 il min deve essere 7 e max 12 ecc... devi trovare delle espressioni con dentro index per definire il min e max

if (isset($_POST['id_notification'])) {
    $body->setContent("message_body", $message_body->get());
} else {
    $body->setContent("message_body", "");
}

$notification = $mysql->query("SELECT N.* FROM notifica N INNER JOIN utente U ON U.ID = N.ID_utente WHERE U.username = '" . $user .
    "' ORDER BY N.data DESC,N.ora DESC LIMIT $min, $max");

if ($notification->num_rows > 0) {
    while ($row = $notification->fetch_assoc()) {
        $body->setContent('sender', $row['mittente']);
        $body->setContent('time', $row['data'] . " " . $row['ora']);
        $body->setContent('object', $row['oggetto']);
        $body->setContent('id_notification', '<form action="/notifications.php#anchor" method="POST" id="' . $row['ID'] . '" >
                                                <input type="hidden" name="id_notification" value="' . $row['ID'] . '" />
                                                <input type="hidden" name="index" value="' . $index . '" />
                                                <a class="btn btn-notification ml-4 mt-4" href="#" 
                                                onclick="openNotification(' . $row['ID'] . ')">Open</a></form>');

        if ($row['visto'] == '1') {
            $body->setContent('envelope', '<i class="fa fa-2x fa-envelope-open text-white" aria-hidden="true"></i>');
        } else {
            $body->setContent('envelope', '<i class="fa fa-2x fa-envelope text-white" aria-hidden="true"></i>');
        }
    }
}

$unread_messages_query = $mysql->query("SELECT count(*) as unread_messages FROM notifica N INNER JOIN utente U ON U.ID = N.ID_utente WHERE U.username = '" . $user .
    "' AND N.visto = 0");
$row = $unread_messages_query->fetch_assoc();
$unread_messages = $row["unread_messages"];
$body->setContent('unread_messages', $unread_messages);

?>