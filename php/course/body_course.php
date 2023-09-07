<?php

$id_corso = $_POST['id_course'];
$id_user = $_SESSION['auth']['ID'];

$body = new Template("skins/revision/dtml/course/body_course.html");

#disable enroll button
$verify_enroll = $mysql->query("SELECT * FROM storico_iscrizioni_corso WHERE ID_utente = $id_user AND ID_corso = $id_corso");
if($verify_enroll->num_rows == 0){
    $body->setContent('enroll_button','<a class="btn btn-block btn-secondary py-3 px-5" href="#" onclick="submitCourseDetail(\'enroll_course\')">Enroll Now</a>');
}else{
    $body->setContent('enroll_button','<a class="btn btn-block btn-secondary py-3 px-5 disabled" href="#" onclick="submitCourseDetail(\'enroll_course\')">Enroll Now</a>');
}


# principal details of the course
$principal_details = $mysql->query("SELECT C.*, I.file as immagine, I.titolo as alt, IST.nome as nome_istruttore, IST.cognome as cognome_istruttore  
        FROM Corso C INNER JOIN Immagine I ON I.ID = C.ID_immagine INNER JOIN Istruttore IST ON IST.ID = C.ID_istruttore
        WHERE C.ID = '$id_corso'");

if ($principal_details && $principal_details->num_rows > 0) {
    $row = $principal_details->fetch_assoc();
    $body->setContent('name', $row['nome']);
    $body->setContent("description", $row['descrizione']);
    $body->setContent('image', '<img class="img-fluid rounded w-50 mb-3" src="data:image/jpeg;base64,' . base64_encode($row["immagine"]) . '" alt="'. $row["alt"] .'">');
    $body->setContent("price", $row['prezzo']. " $");
    $body->setContent("instructor", $row['nome_istruttore'] ." ".$row['cognome_istruttore']);
    $body->setContent("language", $row['lingua']);
}

# statistical details of the course 
$statistical_details = $mysql->query("SELECT COUNT(*) as recensioni, AVG(R.voto) as valutazione
FROM recensione R INNER JOIN storico_iscrizioni_corso SIC ON R.ID_iscrizione = SIC.ID INNER JOIN corso C ON C.ID = SIC.ID_corso
WHERE C.ID = $id_corso");

if ($statistical_details && $statistical_details->num_rows > 0) {
    $row = $statistical_details->fetch_assoc();
    $body->setContent('rating', $row['valutazione']);
    $body->setContent('votes', '(' .$row['recensioni']. ')');
}

$lectures = $mysql->query("SELECT COUNT(*) as lezioni FROM Lezione L INNER JOIN Corso C ON C.ID = L.ID_corso WHERE C.ID = $id_corso");
$row = $lectures->fetch_assoc();
$body->setContent('lectures', $row['lezioni']);

$popular_categories = $mysql->query("SELECT C.nome, C.ID, count(*) numero from categoria C INNER JOIN corso CS ON CS.ID_categoria = C.ID group by C.nome order by numero desc limit 5");
while ($row = $popular_categories->fetch_assoc()) {
    $body->setContent("category", '<form id="'.$row["ID"].'" method="POST" action="courses.php"><input type="hidden" name="id_category" value="'.$row["ID"].'" /><a href="#" onclick="submitCourseDetail('. $row["ID"] .')" class="text-decoration-none h6 m-0">'.$row["nome"].'</a></form>');
    $body->setContent("courses", $row["numero"]);
}

$id_category_query = $mysql->query("SELECT ID_categoria FROM corso WHERE ID = $id_corso");
$id_category_result = $id_category_query->fetch_assoc();
$id_category = $id_category_result["ID_categoria"];

$related_courses = $mysql->query("SELECT * FROM corso WHERE ID_categoria = $id_category AND ID <> $id_corso");
while ($row = $related_courses->fetch_assoc()) {
    $id = $row['ID'];
    $course = $mysql->query("SELECT C.*, I.titolo as alt, I.file as immagine, IST.nome as nome_istruttore, IST.cognome as cognome_istruttore FROM 
    Corso C INNER JOIN Immagine I ON C.ID_immagine = I.ID INNER JOIN Istruttore IST ON C.ID_istruttore = IST.ID 
    WHERE C.ID = $id");

    $result_course = $course->fetch_assoc();
    $body->setContent("title_related_course", $result_course["nome"]);
    $body->setContent("instructor_related_course", $result_course["nome_istruttore"]." ".$result_course["cognome_istruttore"]);
    $body->setContent("price_related_course", $result_course["prezzo"]);
    $body->setContent('related_course_image', '<img class="img-fluid" src="data:image/jpeg;base64,' . base64_encode($result_course["immagine"]) . '" alt="'. $result_course["alt"] .'">');
    $body->setContent('course_detail', '<form id="'. $result_course["ID"] .'" method="POST" action="course.php">
                                            <input type="hidden" name="id_course" value="'. $result_course["ID"] .'" />
                                            <a class="btn btn-primary" href="#" onclick="submitCourseDetail('. $result_course["ID"] .')">
                                                Course Detail
                                            </a>
                                        </form>'
    );
}

$body->setContent("input_id_course", '<input type="hidden" name="id_course" value="'. $id_corso .'" />');




?>