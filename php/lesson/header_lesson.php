<?php

#definiamo l'header della pagina del corso specifico
$header = new Template("skins/revision/dtml/lesson/header_lesson.html");

if(isset($_POST['id_lesson']) && isset($_POST['id_enrollment'])){
    $id_lesson = $_POST['id_lesson'];
    $id_enrollment = $_POST['id_enrollment'];
}

$lesson_number_query = $mysql->query("SELECT numero FROM lezione WHERE ID = $id_lesson");
$lesson_number = $lesson_number_query->fetch_row()[0];

$header->setContent('lesson_number', $lesson_number);

?>