<?php

$course_operations = new Template("skins/revision/dtml/lessons/course_operations.html");

$course_operations->setContent('review', '<a class="btn btn-red" href="review.php" style="width:100px">Write</a></form>');
$course_operations->setContent('test', '<a class="btn btn-red " href="test.php" style="width:100px">Do it</a></form>');
echo "AHAHAHAHAHAHAH2";

?>