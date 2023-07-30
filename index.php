<?php

require "include/config.inc.php";
require "include/template2.inc.php";
require "include/dbms.inc.php";

#definiamo il template scheletro
$main = new Template("skins/revision/dtml/index_v1.html");

#definiamo l'header della pagina
$header = new Template("skins/revision/dtml/header/header_home.html");

#definiamo il body della pagina
$body = new Template("skins/revision/dtml/body/body_home.html");

$corsi_attuali = $mysql->query("SELECT * FROM Corso WHERE data_inizio BETWEEN CURDATE() AND CURDATE() + INTERVAL 15 DAY");
while ($row = $corsi_attuali->fetch_assoc()) {
    $body->setContent("title", $row["nome"]);
    $body->setContent("instructor", "aaa");
    $body->setContent("price", $row["prezzo"]);
}


$main->setContent('header', $header->get());
$main->setContent('body', $body->get());
$main->close();

?>