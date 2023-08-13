<?php
$id_instructor = $_POST['id_instructor'];

$body = new Template("skins/revision/dtml/instructor/body_instructor.html");

$info_istruttore = $mysql->query("SELECT IST.*, C.nome as nome_corso, I.file as immagine, I.titolo as alt FROM istruttore IST INNER JOIN immagine I ON IST.ID_immagine = I.ID INNER JOIN Corso C ON C.ID_istruttore = IST.ID 
                                  WHERE IST.ID=$id_instructor");
while($row = $info_istruttore->fetch_assoc()){
    $body->setContent('image_instructor','<img class="img-fluid" src="data:image/jpeg;base64,' . base64_encode($row["immagine"]) . '" alt="'. $row["alt"] .'">');
    $body->setContent('name_and_surname', '<h1>'.$row["nome"].' '.$row["cognome"].'</h1>');
    $body->setContent('name_course', '<h4>Instructor of: </h4><h3>'.$row["nome_corso"].'</h3>');
    $body->setContent('description', '<p class="mt-4 description">'.$row["descrizione"].'</p>');
    $body->setContent('instructor_email', '<li>Email: '.$row["email"].'</li>');
}

?>