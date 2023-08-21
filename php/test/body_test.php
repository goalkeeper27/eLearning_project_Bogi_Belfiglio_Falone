<?php

$id_course = $_SESSION['auth']['course'];
$id_enrollment = $_SESSION['auth']['enrollment'];

$body = new Template("skins/revision/dtml/test/body_test.html");

$course_name_query = $mysql->query("SELECT nome FROM corso WHERE ID = $id_course");
$course_name = $course_name_query->fetch_row()[0];
$body->setContent('course_name', ucfirst(strtolower($course_name)));

$questions = $mysql->query("SELECT D.* FROM 
        domanda D INNER JOIN esercitazione E ON D.ID_esercitazione = E.ID INNER JOIN corso C ON C.ID = E.ID_corso  WHERE C.ID = $id_course ");
while ($row_question = $questions->fetch_assoc()) {
    $id_question = $row_question['ID'];
    $body->setContent('question', $row_question['corpo']);

    $answers = $mysql->query("SELECT R.* FROM risposta R INNER JOIN domanda D ON R.ID_domanda = D.ID WHERE D.ID=$id_question");
    while($row_answer = $answers->fetch_assoc()){
        $body->setContent('answer', '
        <input type="radio" name="' . $row_question['ID'] .'" value="'. $row_answer['ID'] .'" />
        <label>'.$row_answer['corpo'].'</label>');
    }
}



?>