<?php
require "include/config.inc.php";
require "include/template2.inc.php";
require "include/dbms.inc.php";

session_start();
$id_user = $_SESSION['auth']['ID'];
$id_enrollment = $_SESSION['auth']['enrollment'];
$id_lesson = $_POST['id_lesson'];

$check_lesson_history = $mysql->query("SELECT * FROM storico_lezioni_corso WHERE ID_lezione = $id_lesson AND ID_iscrizione = $id_enrollment");
if ($check_lesson_history->num_rows == 0) {
    $update_lesson_history = $mysql->query("INSERT INTO storico_lezioni_corso(ID_lezione, ID_iscrizione, data) values ($id_lesson, $id_enrollment, CURDATE())");
}

header("location: lessons.php");






?>