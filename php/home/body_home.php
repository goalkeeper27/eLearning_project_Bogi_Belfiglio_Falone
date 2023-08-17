<?php

$body = new Template("skins/revision/dtml/home/body_home.html");

////////// IMMAGINI DEL CORPO DELLA HOMEPAGE ///////////////////////

$image = 'SELECT file FROM immagine WHERE titolo = "image_home_1"'; 
$result = $mysql->query($image);
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $image = $row['file'];
    $base64Image = base64_encode($image);
} else {
    $base64Image = ""; // Se non viene trovata un'immagine, lasciamo vuota la stringa base64.
}
$body->setContent('image_home_1', '<img src="data:image/jpeg;base64,' . $base64Image . '" alt="about us">');

$image = 'SELECT file FROM immagine WHERE titolo = "image_home_2"'; 
$result = $mysql->query($image);
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $image = $row['file'];
    $base64Image = base64_encode($image);
} else {
    $base64Image = ""; // Se non viene trovata un'immagine, lasciamo vuota la stringa base64.
}
$body->setContent('image_home_2', '<img src="data:image/jpeg;base64,' . $base64Image . '" alt="why choose us">');

////////// DATI STATISTICI HOMEPAGE ///////////////////////

$subjects_number_query = $mysql->query('SELECT count(*) as number FROM categoria');
if ($subjects_number_query && $subjects_number_query->num_rows > 0) {
    $row = $subjects_number_query->fetch_assoc();
    $subjects_number = $row['number'];
}

$body->setContent('subjects_number', $subjects_number);

$courses_number_query = $mysql->query('SELECT count(*) as number FROM corso');
if ($courses_number_query && $courses_number_query->num_rows > 0) {
    $row = $courses_number_query->fetch_assoc();
    $courses_number = $row['number'];
}

$body->setContent('courses_number', $courses_number);

$instructors_number_query = $mysql->query('SELECT count(*) as number FROM istruttore');
if ($instructors_number_query && $instructors_number_query->num_rows > 0) {
    $row = $instructors_number_query->fetch_assoc();
    $instructors_number = $row['number'];
}

$body->setContent('instructors_number', $instructors_number);

$students_number_query = $mysql->query('SELECT count(*) as number FROM utente');
if ($students_number_query && $students_number_query->num_rows > 0) {
    $row = $students_number_query->fetch_assoc();
    $students_number = $row['number'];
}

$body->setContent('students_number', $students_number);


////////// CORSI PIU' RECENTI ///////////////////////

$corsi_attuali = $mysql->query("SELECT C.*, I.titolo as alt, I.file as immagine, IST.nome as nome_istruttore, IST.cognome as cognome_istruttore FROM 
    Corso C INNER JOIN Immagine I ON C.ID_immagine = I.ID INNER JOIN Istruttore IST ON C.ID_istruttore = IST.ID 
        ORDER BY C.data_inserimento DESC LIMIT 6");

while ($row = $corsi_attuali->fetch_assoc()) {
    $body->setContent("title", $row["nome"]);
    $body->setContent("instructor", $row["nome_istruttore"]." ".$row["cognome_istruttore"]);
    $body->setContent("price", $row["prezzo"]);
    $body->setContent('course_image', '<img class="img-fluid" src="data:image/jpeg;base64,' . base64_encode($row["immagine"]) . '" alt="'. $row["alt"] .'">');
    $body->setContent('course_detail', '<form id="'. $row["ID"] .'" method="POST" action="course.php">
                                            <input type="hidden" name="id_course" value="'. $row["ID"] .'" />
                                            <a class="btn btn-primary" href="#" onclick="submitCourseDetail('. $row["ID"] .')">
                                                Course Detail
                                            </a>
                                        </form>'
    );
}

////////// ISTRUTTORI ///////////////////////

$istruttori = $mysql->query("SELECT IST.*, I.titolo as alt, I.file as immagine FROM
    Istruttore IST INNER JOIN Immagine I ON IST.ID_immagine = I.ID");

while ($row = $istruttori->fetch_assoc()) {
    $body->setContent("name", $row["nome"]." ".$row["cognome"]);
    $body->setContent("profession", $row["professione"]);
    $body->setContent("instructor_button", '<form id="instructor_'.$row["ID"].'" method="POST" action="instructor.php">
                                                <input type="hidden" name="id_instructor"  value="'.$row["ID"].'" />
                                                <a class="btn btn-primary" href="#" onclick="submitCourseDetail(\'instructor_'. $row["ID"] .'\')">
                                                    See more
                                                </a>
                                            </form>');
    $body->setContent('instructor_image', '<img class="img-fluid" src="data:image/jpeg;base64,' . base64_encode($row["immagine"]) . '" alt="'. $row["alt"] .'">');
}

$recensioni = $mysql->query("SELECT R.*, C.nome as course_name, U.nome as student_name, U.cognome as student_surname FROM recensione R INNER JOIN storico_iscrizioni_corso ST ON R.ID_iscrizione = ST.ID INNER JOIN utente U ON ST.ID_utente = U.ID INNER JOIN corso C ON ST.ID_corso = C.ID");

while($row = $recensioni->fetch_assoc()){
    if($row["voto"] == 1){
        $body->setContent("stars", '<div class="rating pl-1">
        <div class="form-group">
            <input type="radio" name="rating" id="star5" value="5" disabled>
            <label for="star5">&#9733;</label>
            <input type="radio" name="rating" id="star4" value="4" disabled>
            <label for="star4">&#9733;</label>
            <input type="radio" name="rating" id="star3" value="3" disabled>
            <label for="star3">&#9733;</label>
            <input type="radio" name="rating" id="star2" value="2" disabled>
            <label for="star2">&#9733;</label>
            <input type="radio" name="rating" id="star1" value="1" disabled checked>
            <label for="star1">&#9733;</label>
        </div>
        </div>');
    } elseif ($row["voto"] == 2) {
        $body->setContent("stars", '<div class="rating pl-1">
        <div class="form-group">
            <input type="radio" name="rating" id="star5" value="5" disabled>
            <label for="star5">&#9733;</label>
            <input type="radio" name="rating" id="star4" value="4" disabled>
            <label for="star4">&#9733;</label>
            <input type="radio" name="rating" id="star3" value="3" disabled>
            <label for="star3">&#9733;</label>
            <input type="radio" name="rating" id="star2" value="2" disabled checked>
            <label for="star2">&#9733;</label>
            <input type="radio" name="rating" id="star1" value="1" disabled>
            <label for="star1">&#9733;</label>
        </div>
        </div>');
    } elseif ($row["voto"] == 3) {
        $body->setContent("stars", '<div class="rating pl-1">
        <div class="form-group">
            <input type="radio" name="rating" id="star5" value="5" disabled>
            <label for="star5">&#9733;</label>
            <input type="radio" name="rating" id="star4" value="4" disabled>
            <label for="star4">&#9733;</label>
            <input type="radio" name="rating" id="star3" value="3" disabled checked>
            <label for="star3">&#9733;</label>
            <input type="radio" name="rating" id="star2" value="2" disabled>
            <label for="star2">&#9733;</label>
            <input type="radio" name="rating" id="star1" value="1" disabled>
            <label for="star1">&#9733;</label>
        </div>
        </div>');
    } elseif ($row["voto"] == 4) {
        $body->setContent("stars", '<div class="rating pl-1">
        <div class="form-group">
            <input type="radio" name="rating" id="star5" value="5" disabled>
            <label for="star5">&#9733;</label>
            <input type="radio" name="rating" id="star4" value="4" disabled checked>
            <label for="star4">&#9733;</label>
            <input type="radio" name="rating" id="star3" value="3" disabled>
            <label for="star3">&#9733;</label>
            <input type="radio" name="rating" id="star2" value="2" disabled>
            <label for="star2">&#9733;</label>
            <input type="radio" name="rating" id="star1" value="1" disabled>
            <label for="star1">&#9733;</label>
        </div>
        </div>');
    } elseif ($row["voto"] == 5) {
        $body->setContent("stars", '<div class="rating pl-1">
        <div class="form-group">
            <input type="radio" name="rating" id="star5" value="5" disabled checked>
            <label for="star5">&#9733;</label>
            <input type="radio" name="rating" id="star4" value="4" disabled>
            <label for="star4">&#9733;</label>
            <input type="radio" name="rating" id="star3" value="3" disabled>
            <label for="star3">&#9733;</label>
            <input type="radio" name="rating" id="star2" value="2" disabled>
            <label for="star2">&#9733;</label>
            <input type="radio" name="rating" id="star1" value="1" disabled>
            <label for="star1">&#9733;</label>
        </div>
        </div>');
    }

    $body->setContent("review_body", $row["corpo"]);
    $body->setContent("student_name", $row["student_name"].' '.$row["student_surname"]);
    $body->setContent("course_name", $row["course_name"]);
}

?>