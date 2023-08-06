<?php
session_start();

require "include/config.inc.php";
require "include/template2.inc.php";
require "include/dbms.inc.php";

require "php/mycourses/header_mycourses.php";
require "php/mycourses/body_mycourses.php";
require "php/navbar/navbar.php";

//only for a better security
if (!isset($_SESSION['auth']['username'])) {
    header("Location:login.html");
} else {
    #definiamo il template scheletro
    $main = new Template("skins/revision/dtml/index_v1.html");

    $main->setContent('nav_bar', $nav_bar->get());
    $main->setContent('header', $header->get());
    $main->setContent('body', $body->get());
    $main->close();

}




?>