<?php

if (isset($_POST['rating']) && isset($_POST['message'])) {
    $id_enrollment = $_SESSION['auth']['enrollment'];
    $new_review = $mysql->query("INSERT INTO recensione(ID_iscrizione, data, ora, voto, corpo) VALUES($id_enrollment, curdate(), curtime(),'". $_POST['rating'] ."', '".$_POST['message'] ."')");
    if ($new_review) {
        header("location: index.php");
    }
} else {
    #definiamo l'header della pagina del corso specifico
    $body = new Template("skins/revision/dtml/review/body_review.html");

    $id_course = $_SESSION['auth']['course'];
    $course_title = $mysql->query("SELECT nome FROM corso WHERE ID = $id_course");
    if($row = $course_title->fetch_assoc()){
        $body->setContent('lesson_title',$row['nome']);
    }

}



?>