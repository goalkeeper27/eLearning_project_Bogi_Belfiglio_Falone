<?php

    require "include/config.inc.php";
    require "include/template2.inc.php";
    require "include/dbms.inc.php";

    $main = new Template("skins/index_v1.html");
    $header = new Template("skins/header/header_home.html");
    $body = new Template("skins/revision/dtml/body_home.html");
    
    $main->setContent('header', $header->get());
    $main->setContent('body', $body->get());
    $main->close();

?>