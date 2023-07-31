<?php
session_start();

require "include/config.inc.php";
require "include/template2.inc.php";
require "include/dbms.inc.php";

#definiamo il template scheletro
$main = new Template("skins/revision/dtml/index_v1.html");

#nav bar di un utente NON loggato
$nav_bar = new Template("skins/revision/dtml/nav_bar/nav_bar.html");

#nav bar di un utente loggato
$nav_bar_user = new Template("skins/revision/dtml/nav_bar/nav_bar_user.html");

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

if(isset($_SESSION["auth"]["user"])){
    $main->setContent('nav_bar', $nav_bar_user->get());
}else{
    $main->setContent('nav_bar', $nav_bar->get());
}
$main->setContent('header', $header->get());
$main->setContent('body', $body->get());
$main->close();

?>