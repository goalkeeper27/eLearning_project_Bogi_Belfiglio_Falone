<?php

$user = $_SESSION['auth']['username'];

if (isset($_POST['index'])) {
    $index = $_POST['index'];
} else {
    $index = 1;
}


$body = new Template("skins/revision/dtml/mycourses/body_mycourses.html");
$number_courses = $mysql->query("SELECT COUNT(*) as total_records FROM corso"); //Query che conta il numero di corsi totali che poi salverò il numero in $totalRecords

if ($number_courses->num_rows > 0) {
    $row = $number_courses->fetch_assoc();
    $totalRecords = $row["total_records"];
} else {
    $totalRecords = 0;
}

$indici_totali = ceil($totalRecords / 6); //approssimo per eccesso il risultato, se ad esempio ho 7 records, mi serviranno 2 indici totali

$content = '';

for ($i = 1; $i < $indici_totali + 1; $i++) {
    $content .= '<li class="page-item">
                <form id="index_' . $i . '" method="POST" action="courses.php#anchor">
                <input type="hidden" name="index" value="' . $i . '" />
                <a class="page-link" id="' . $i . '" href="#" onclick="submitCourseDetail(\'index_' . $i . '\')">' . $i . '</a>
                </form>
                </li>';
}
$body->setContent('index', $content);

if ($index == 1) {
    $min = 0;
} else {
    $min = 6 * $index - 5;
}
$max = 6 * $index;


$my_courses = $mysql->query("SELECT C.*, SIC.ID as iscrizione FROM corso C INNER JOIN storico_iscrizioni_corso SIC ON C.ID = SIC.ID_corso
    INNER JOIN utente U ON U.ID = SIC.ID_utente WHERE U.username = '" . $user . "' LIMIT $min, 8");

while ($row = $my_courses->fetch_assoc()) {
    $id_course = $row['ID'];
    $id_enrollment = $row['iscrizione'];

    echo "<script>alert(". $id_enrollment .");</script>";

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