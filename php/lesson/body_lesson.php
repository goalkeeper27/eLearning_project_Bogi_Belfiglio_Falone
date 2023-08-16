<?php

$body = new Template("skins/revision/dtml/lesson/body_lesson.html");

$lesson_information_query = $mysql->query("SELECT ID, titolo, descrizione, video FROM lezione WHERE ID = $id_lesson");
$lesson_information = $lesson_information_query->fetch_row();

$body->setContent('lesson_title', $lesson_information[1]);
$body->setContent('lesson_description', $lesson_information[2]);
$body->setContent('init_form', '<form id="'. $lesson_information[0] .'" method="POST" action="update_lesson_history.php">');
$body->setContent('inputs', '<input type="hidden" name="id_lesson" value="'.$lesson_information[0] .'" />');
$body->setContent('video', '<video  value="'. $lesson_information[0] .'" width="800" height="450" controls controlsList="nodownload" disablePictureInPicture onended="submitForm('. $lesson_information[0] .')">
                            <source src="'. $lesson_information[3] .'"
                            </video>');

?>