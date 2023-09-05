<?php
ob_start();

$id_user = $_SESSION['auth']['ID'];
$id_course = $_SESSION['auth']['course'];
$id_enrollment = $_SESSION['auth']['enrollment'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $correct_answer = 0;
    $total_questions = 0;
    $answer_index_form = 0;
    foreach ($_POST as $name => $value) {
        if (strpos($name, "answer" . $answer_index_form) === 0) {
            $id_answer = $_POST["$name"];
            $check_answer = $mysql->query("SELECT stato FROM risposta WHERE ID = $id_answer");
            $answer_status = $check_answer->fetch_row()[0];
            if ($answer_status > 0) {
                $correct_answer = $correct_answer + 1;
            }


        }
        $answer_index_form = $answer_index_form + 1;
        $total_questions += 1;
    }

    if ($correct_answer > ($total_questions / 2)) {
        $maximum_score_query = $mysql->query("SELECT punteggio_totale FROM esercitazione WHERE ID_corso = $id_course");
        $maximum_score = $maximum_score_query->fetch_row()[0];
        $certification_score = floor(($correct_answer * $maximum_score) / $total_questions);
        require "create_pdf.php";

        $insert_notification = $mysql->query("INSERT INTO notifica(mittente, data, ora, oggetto, corpo, visto, ID_utente) VALUES 
                    ('E-LEARNING FBB COMMUNITY', curdate(), curtime(), 'Passing course of " . strtolower($course_name) . "', 
                    'Congratulations on successfully completing the \"" . $course_name . "\" e-learning course! 🎉 Your dedication and hard work have paid off, 
                     and we are thrilled to acknowledge your achievement.
                     We are pleased to inform you that your well-deserved certificate of completion is now available for download in the 
                     \"Certifications\" section of our platform. Please log in to your account and visit the \"Certifications\" area to access 
                     and download your certificate.', 0, $id_user)");
                     
        if ($insert_notification) {
            header("location: notifications.php");
        }

    } else {
        $course_name_query = $mysql->query("SELECT nome FROM corso WHERE ID = $id_course");
        $course_name = $course_name_query->fetch_row()[0];
        $insert_notification = $mysql->query("INSERT INTO notifica(mittente, data, ora, oggetto, corpo, visto, ID_utente) VALUES 
                    ('E-LEARNING FBB COMMUNITY', curdate(), curtime(), 'Failing course of " . strtolower($course_name) . "', 
                    'We regret to inform you that the results of your assessment for the \"" . $course_name . "\" e-learning course indicate that you have not met the required criteria 
                    for successful completion.', 0, $id_user)");
        if ($insert_notification) {
            header("location: notifications.php");

        }

    }
} else {
    $body = new Template("skins/revision/dtml/test/body_test.html");

    $course_name_query = $mysql->query("SELECT nome FROM corso WHERE ID = $id_course");
    $course_name = $course_name_query->fetch_row()[0];
    $body->setContent('course_name', ucfirst(strtolower($course_name)));

    $questions = $mysql->query("SELECT D.* FROM 
        domanda D INNER JOIN esercitazione E ON D.ID_esercitazione = E.ID INNER JOIN corso C ON C.ID = E.ID_corso  WHERE C.ID = $id_course ");

    //index for input form
    $answer_index_form = 0;
    while ($row_question = $questions->fetch_assoc()) {
        $id_question = $row_question['ID'];
        $body->setContent('question', $row_question['corpo']);

        $answers = $mysql->query("SELECT R.* FROM risposta R INNER JOIN domanda D ON R.ID_domanda = D.ID WHERE D.ID=$id_question");
        while ($row_answer = $answers->fetch_assoc()) {
            $body->setContent('answer', '
        <input type="radio" name="answer' . $answer_index_form . '" value="' . $row_answer['ID'] . '" />
        <label>' . $row_answer['corpo'] . '</label>');
        }
        $answer_index_form = $answer_index_form + 1;
    }

}




?>