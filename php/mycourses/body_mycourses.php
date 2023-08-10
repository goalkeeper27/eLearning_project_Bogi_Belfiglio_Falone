<?php

$user = $_SESSION['auth']['username'];

if (isset($_POST['index'])) {
    $index = $_POST['index'];
} else {
    $index = 1;
}


$body = new Template("skins/revision/dtml/mycourses/body_mycourses.html");

//total number of notifications
$number_mycourses = $mysql->query("SELECT COUNT(*) as total_records FROM 
corso C INNER JOIN storico_iscrizioni_corso SIC ON C.ID = SIC.ID_corso INNER JOIN
utente U ON U.ID = SIC.ID_utente WHERE U.username = '" . $user . "'");

$row = $number_mycourses->fetch_assoc();
$total_records = $row["total_records"];


$total_index = ceil($total_records / 8); //approssimo per eccesso il risultato, se ad esempio ho 7 records, mi serviranno 2 indici totali

//index check for view
if ($total_index <= 3) {
    for ($i = 1; $i <= $total_index; $i++) {
        if ($i == $index) {
            $body->setContent('index', ' <li class="page-item active">
                                    <form id="index_' . $i . '" method="POST" action="/mycourses.php#anchor">
                                        <input type="hidden" name="index" value="' . $i . '" />
                                        <a class="page-link" id="' . $i . '" href="#" onclick="submitCourseDetail(\'index_' . $i . '\')">' . $i . '</a>
                                    </form>
                                    </li>');
        } else {
            $body->setContent('index', ' <li class="page-item">
                                    <form id="index_' . $i . '" method="POST" action="/mycourses.php#anchor">
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
                                    <form id="index_' . $i . '" method="POST" action="/mycourses.php#anchor">
                                        <input type="hidden" name="index" value="' . $i . '" />
                                        <a class="page-link" id="' . $i . '" href="#" onclick="submitCourseDetail(\'index_' . $i . '\')">' . $i . '</a>
                                    </form>
                                    </li>');
        } else {
            $body->setContent('index', ' <li class="page-item">
                                    <form id="index_' . $i . '" method="POST" action="/mycourses.php#anchor">
                                        <input type="hidden" name="index" value="' . $i . '" />
                                        <a class="page-link" id="' . $i . '" href="#" onclick="submitCourseDetail(\'index_' . $i . '\')">' . $i . '</a>
                                    </form>
                                    </li>');
        }
    }

    $body->setContent('index', ' <li class="page-item"> <a class="page-link href="#">...</a> </li>');
    $body->setContent('index', ' <li class="page-item">
                                    <form id="index_' . $total_index . '" method="POST" action="/mycourses.php#anchor">
                                        <input type="hidden" name="index" value="' . $total_index . '" />
                                        <a class="page-link" id="' . $total_index . '" href="#" onclick="submitCourseDetail(\'index_' . $total_index . '\')">' . $total_index . ' </a>
                                    </form>
                                    </li>');
} else if ($total_index > 3 && ($index > 2 && $index < ($total_index - 1))) {
    $body->setContent('index', ' <li class="page-item">
                                    <form id="index_1" method="POST" action="/mycourses.php#anchor">
                                        <input type="hidden" name="index" value="1" />
                                        <a class="page-link" id="1" href="#" onclick="submitCourseDetail(\'index_1\')">1</a>
                                    </form>
                                    </li>');
    $body->setContent('index', ' <li class="page-item"> <a class="page-link href="#">...</a> </li>');

    for ($i = $index - 1; $i <= $index + 1; $i++) {
        if ($i == $index) {
            $body->setContent('index', ' <li class="page-item active">
                                        <form id="index_' . $i . '" method="POST" action="/mycourses.php#anchor">
                                            <input type="hidden" name="index" value="' . $i . '" />
                                            <a class="page-link" id="' . $i . '" href="#" onclick="submitCourseDetail(\'index_' . $i . '\')">' . $i . '</a>
                                        </form>
                                        </li>');
        } else {
            $body->setContent('index', ' <li class="page-item">
                                        <form id="index_' . $i . '" method="POST" action="/mycourses.php#anchor">
                                            <input type="hidden" name="index" value="' . $i . '" />
                                            <a class="page-link" id="' . $i . '" href="#" onclick="submitCourseDetail(\'index_' . $i . '\')">' . $i . '</a>
                                        </form>
                                        </li>');
        }
    }

    $body->setContent('index', ' <li class="page-item"> <a class="page-link href="#">...</a> </li>');
    $body->setContent('index', ' <li class="page-item">
                                    <form id="index_' . $total_index . '" method="POST" action="/mycourses.php#anchor">
                                        <input type="hidden" name="index" value="' . $total_index . '" />
                                        <a class="page-link" id="' . $total_index . '" href="#" onclick="submitCourseDetail(\'index_' . $total_index . '\')">' . $total_index . '</a>
                                    </form>
                                    </li>');



} else {
    $body->setContent('index', ' <li class="page-item">
                                    <form id="index_1" method="POST" action="/mycourses.php#anchor">
                                        <input type="hidden" name="index" value="1" />
                                        <a class="page-link" id="1" href="#" onclick="submitCourseDetail(\'index_1\')">1</a>
                                    </form>
                                    </li>');
    $body->setContent('index', ' <li class="page-item"> <a class="page-link href="#">...</a> </li>');

    for ($i = $total_index - 2; $i <= $total_index; $i++) {
        if ($i == $index) {
            $body->setContent('index', ' <li class="page-item active">
                                        <form id="index_' . $i . '" method="POST" action="/mycourses.php#anchor">
                                            <input type="hidden" name="index" value="' . $i . '" />
                                            <a class="page-link" id="' . $i . '" href="#" onclick="submitCourseDetail(\'index_' . $i . '\')">' . $i . '</a>
                                        </form>
                                        </li>');
        } else {
            $body->setContent('index', ' <li class="page-item">
                                        <form id="index_' . $i . '" method="POST" action="/mycourses.php#anchor">
                                            <input type="hidden" name="index" value="' . $i . '" />
                                            <a class="page-link" id="' . $i . '" href="#" onclick="submitCourseDetail(\'index_' . $i . '\')">' . $i . '</a>
                                        </form>
                                        </li>');
        }
    }

}


$min = 8 * $index - 8; //Se index è 1 il min deve essere 1 e il max deve essere 6



$my_courses = $mysql->query("SELECT C.*, SIC.ID as iscrizione FROM corso C INNER JOIN storico_iscrizioni_corso SIC ON C.ID = SIC.ID_corso
    INNER JOIN utente U ON U.ID = SIC.ID_utente WHERE U.username = '" . $user . "' LIMIT $min, 2");

while ($row = $my_courses->fetch_assoc()) {
    $id_course = $row['ID'];
    $id_enrollment = $row['iscrizione'];

    $course = $mysql->query("SELECT C.*, I.titolo as alt, I.file as immagine, IST.nome as nome_istruttore, IST.cognome as cognome_istruttore FROM 
    Corso C INNER JOIN Immagine I ON C.ID_immagine = I.ID INNER JOIN Istruttore IST ON C.ID_istruttore = IST.ID 
    WHERE C.ID = $id_course");

    $total_lessons_query = $mysql->query("SELECT COUNT(*) as lezioni_totali FROM corso C INNER JOIN Lezione L ON C.ID = L.ID_corso WHERE C.ID = $id_course");
    $total_lessons_result = $total_lessons_query->fetch_assoc();
    $total_lessons = $total_lessons_result['lezioni_totali'];

    $lessons_done_query = $mysql->query("SELECT COUNT(*) as lezioni_svolte FROM Lezione L INNER JOIN storico_lezioni_corso SLC ON L.ID = SLC.ID_lezione WHERE SLC.ID_iscrizione = $id_enrollment");
    $lessons_done_result = $lessons_done_query->fetch_assoc();
    $lessons_done = $lessons_done_result['lezioni_svolte'];

    $result_course = $course->fetch_assoc();
    $body->setContent("title", $result_course["nome"]);
    $body->setContent("instructor", $result_course["nome_istruttore"] . " " . $result_course["cognome_istruttore"]);
    $body->setContent('course_image', '<img class="img-fluid" src="data:image/jpeg;base64,' . base64_encode($result_course["immagine"]) . '" alt="' . $result_course["alt"] . '">');
    $body->setContent("lessons", $lessons_done.'/'.$total_lessons);
    $body->setContent('mycourse_detail', '<form id="' . $id_enrollment . '" method="POST" action="course.php">
                                            <input type="hidden" name="id_course" value="' . $id_enrollment . '" />
                                            <a class="btn btn-primary" href="#" onclick="submitCourseDetail(' . $id_enrollment . ')">
                                                Continue
                                            </a>
                                        </form>');

}