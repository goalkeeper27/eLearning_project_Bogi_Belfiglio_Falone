<?php

$course_operations = new Template("skins/revision/dtml/lessons/course_operations.html");

$check_review = $mysql->query("SELECT * FROM recensione R INNER JOIN storico_iscrizioni_corso SIC ON R.ID_iscrizione = SIC.ID WHERE SIC.ID = $id_enrollment");
if($check_review->num_rows > 0) {
    $course_operations->setContent('review', '<a class="btn disabled btn-red" href="#" style="width:200px">Already written</a></form>');
}else{
    $course_operations->setContent('review', '<a class="btn btn-red" href="review.php" style="width:100px">Write</a></form>');
}

$course_operations->setContent('test', '<a class="btn btn-red " href="test.php" style="width:100px">Do it</a></form>');


?>