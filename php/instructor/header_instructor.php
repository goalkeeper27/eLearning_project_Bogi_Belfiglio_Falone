<?php
$id_instructor = $_POST['id_instructor'];

#definiamo l'header della pagina del corso specifico
$header = new Template("skins/revision/dtml/instructor/header_instructor.html");

$info_istruttore = $mysql->query("SELECT * FROM istruttore WHERE ID=$id_instructor");
while($row = $info_istruttore->fetch_assoc()){
    $header->setContent('instructor_name',ucfirst(strtolower($row["nome"])).' '.ucfirst(strtolower($row["cognome"])));
}

?>