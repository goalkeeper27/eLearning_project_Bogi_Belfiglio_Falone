<?php

if(isset($_POST['index'])){
    $index = $_POST['index'];
}else{
    $index = 1;
}


$body = new Template("skins/revision/dtml/courses/body_courses.html");
$number_courses = $mysql->query("SELECT COUNT(*) as total_records FROM corso"); //Query che conta il numero di corsi totali che poi salverò il numero in $totalRecords

if($number_courses->num_rows > 0){
    $row = $number_courses->fetch_assoc();
    $totalRecords = $row["total_records"];
}else{
    $totalRecords = 0;
}

$indici_totali = ceil($totalRecords / 6); //approssimo per eccesso il risultato, se ad esempio ho 7 records, mi serviranno 2 indici totali

$content = '';

for($i = 1; $i<$indici_totali+1; $i++){
    //echo "alert(".$i.")";
    $content.= '<li class="page-item">
                <form id="index_'.$i.'" method="POST" action="courses.php">
                <input type="hidden" name="index" value="'.$i.'" />
                <a class="page-link" id="'.$i.'" href="#" onclick="submitCourseDetail(\'index_'.$i.'\')">'.$i.'</a>
                </form>
                </li>';
}
$body->setContent('index', $content);

$min = 6*$index-5; //Se index è 1 il min deve essere 1 e il max deve essere 6
$max = 6*$index; // Se index è 2 il min deve essere 7 e max 12 ecc... devi trovare delle espressioni con dentro index per definire il min e max
$courses = $mysql->query("SELECT * FROM corso WHERE ID BETWEEN $min AND $max LIMIT 6");
while($row = $courses->fetch_assoc()){
    $id = $row['ID'];
    $course = $mysql->query("SELECT C.*, I.titolo as alt, I.file as immagine, IST.nome as nome_istruttore, IST.cognome as cognome_istruttore FROM 
    Corso C INNER JOIN Immagine I ON C.ID_immagine = I.ID INNER JOIN Istruttore IST ON C.ID_istruttore = IST.ID 
    WHERE C.ID = $id");

    $result_course = $course->fetch_assoc();
    $body->setContent('course_image', ' <form id="'. $result_course["ID"] .'" method="POST" action="course.php">
                                        <input type="hidden" name="id_course" value="'. $result_course["ID"] .'" />
                                        <a class="courses-list-item position-relative d-block overflow-hidden mb-2" href="#" onclick="submitCourseDetail('. $result_course["ID"] .')">
                                        <img class="img-fluid" src="data:image/jpeg;base64,' . base64_encode($result_course["immagine"]) . '" alt="'. $result_course["alt"] .'">');
    $body->setContent("course_title", $result_course["nome"]);
    $body->setContent("instructor_course", $result_course["nome_istruttore"]." ".$result_course["cognome_istruttore"]);
    $body->setContent("price_course", $result_course["prezzo"]);
    $body->setContent("tag_closure", "</a></form>");
}

?>
