<?php

$body = new Template("skins/revision/dtml/certifications/body_certifications.html");
$id_user = $_SESSION['auth']['ID'];

if (isset($_POST['index'])) {
    $index = $_POST['index'];
} else {
    $index = 1;
}

if(isset($_POST['id_certification'])){
    $id_certification = $_POST['id_certification'];
    require "download_certification.php";
}

//total number of notifications
$number_certification_query = $mysql->query("SELECT COUNT(*) as total_records FROM attestato A INNER JOIN storico_iscrizioni_corso SIC ON A.ID_iscrizione = SIC.ID WHERE SIC.ID_utente = $id_user");

$number_certifications = $number_certification_query->fetch_row()[0];

$total_index = ceil($number_certifications / 6); //approssimo per eccesso il risultato, se ad esempio ho 7 records, mi serviranno 2 indici totali

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


$min = 6 * $index - 6; //Se index è 1 il min deve essere 1 e il max deve essere 6

$certifications = $mysql->query("SELECT A.ID, A.file, A.titolo, C.nome as corso FROM attestato A INNER JOIN storico_iscrizioni_corso SIC ON A.ID_iscrizione = SIC.ID
                                    INNER JOIN corso C ON C.ID = SIC.ID_corso WHERE SIC.ID_utente = $id_user LIMIT $min, 6");

if ($certifications->num_rows > 0) {
    while ($row = $certifications->fetch_assoc()) {
        $body->setContent('file_icon', '<i class="fa fa-file fa-2x text-white" aria-hidden="true"></i>');
        $body->setContent('file_title', $row['titolo']);
        $body->setContent('course_name', $row['corso']);
        $body->setContent('download_certification', '<form action="/certifications.php#anchor" method="POST" id="' . $row['ID'] . '" >
                                                <input type="hidden" name="id_certification" value="' . $row['ID'] . '" />
                                                <input type="hidden" name="index" value="' . $index . '" />
                                                <a class="btn btn-notification ml-4 mt-4" href="#" 
                                                onclick="openNotification(' . $row['ID'] . ')">Download</a></form>');
    }
}


?>