<?php

$body = new Template("skins/revision/dtml/lessons/body_lessons.html");
$user = $_SESSION['auth']['username'];

$id_user_query = $mysql->query("SELECT ID FROM utente WHERE username='" . $user . "'");
$row = $id_user_query->fetch_assoc();
$id_user = $row["ID"];

if(isset($_SESSION['auth']['course']) && isset($_SESSION['auth']['enrollment'])){
    $id_course = $_SESSION['auth']['course'];
    $id_enrollment = $_SESSION['auth']['enrollment'];
}else{
    $id_course = $_POST['id_course'];
    $id_enrollment = $_POST['id_enrollment'];
    $_SESSION['auth']['course'] = $id_course;
    $_SESSION['auth']['enrollment'] = $id_enrollment;
}


//total number of lessons
$number_lessons = $mysql->query("SELECT COUNT(*) as total_records FROM lezione L INNER JOIN corso C ON L.ID_corso = C.ID WHERE C.ID = '" . $id_course . "'");
$row = $number_lessons->fetch_assoc();
$total_lessons = $row["total_records"];

//total number of followed lessons
$number_followed_lessons = $mysql->query("SELECT COUNT(*) as total_records FROM 
storico_lezioni_corso SLC INNER JOIN lezione L ON L.ID = SLC.ID_lezione WHERE SLC.ID_iscrizione = $id_enrollment AND  
L.ID_corso = $id_course");

$row = $number_followed_lessons->fetch_assoc();
$total_followed_lessons = $row["total_records"];

$body->setContent("followed_lessons", $total_followed_lessons);

if($total_lessons == $total_followed_lessons){
    require "course_operations.php";
    echo "AHAHAHAHAH";
    $body->setContent("course_operations", $course_operations->get());
}


$lessons = $mysql->query("SELECT L.*, C.nome as course_name FROM Lezione L INNER JOIN Corso C ON C.ID = L.ID_corso WHERE C.ID = $id_course 
ORDER BY L.numero");

if ($lessons->num_rows > 0) {
    while ($row = $lessons->fetch_assoc()) {
        $id_lesson = $row['ID'];
        $body->setContent('course_name', strtolower($row['course_name']));
        $body->setContent('number_lesson', $row['numero']);
        $body->setContent('title_lesson', strtoupper($row['titolo']));
        $body->setContent('init_form', '<form action="/lesson.php" method="POST" id="' . $id_lesson . '" >');
        $body->setContent('inputs', '<input type="hidden" name="id_lesson" value="' . $id_lesson . '" />
                                    <input type="hidden" name="id_enrollment" value="' . $id_enrollment . '" />
                                    ');

        $is_followed = $mysql->query("SELECT * FROM storico_lezioni_corso WHERE ID_lezione = $id_lesson AND ID_iscrizione = $id_enrollment");
        if ($is_followed->num_rows > 0) {
            $body->setContent('submit', '<a class="btn btn-lesson ml-4 mt-4" href="#" style="width:100px" 
                                     onclick="openNotification(' . $id_lesson . ')">Play again</a></form>');
            $body->setContent('desk', '<i class="fa fa-2x fa-check text-white" aria-hidden="true"></i>');
        } else {
            $body->setContent('submit', '<a class="btn btn-lesson ml-4 mt-4" href="#" 
                                     onclick="openNotification(' . $id_lesson . ')">Play</a></form>');
            $body->setContent('desk', '<i class="fa fa-2x fa-desktop text-white" aria-hidden="true"></i>');
        }
        $body->setContent('end_form', '</form>');
    }
}

?>