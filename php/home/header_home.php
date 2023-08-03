<?php

#definiamo l'header della pagina
$header = new Template("skins/revision/dtml/home/header_home.html");
if(isset($_SESSION["auth"]["username"])){
    $header->setContent('welcome', 'WELCOME ' .strtoupper($_SESSION["auth"]["username"]));
}else{
    $header->setContent('welcome', "");
}

?>