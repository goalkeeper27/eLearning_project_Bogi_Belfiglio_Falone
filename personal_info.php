<?php
session_start();

require "include/config.inc.php";
require "include/template2.inc.php";
require "include/dbms.inc.php";

require "php/navbar/navbar.php";
require "php/personal_info/header_personal_info.php";
require "php/personal_info/body_personal_info.php";


#definiamo il template scheletro
$main = new Template("skins/revision/dtml/index_v1.html");



$main->setContent('nav_bar', $nav_bar->get());
$main->setContent('header', $header->get());
$main->setContent('body', $body->get());
$main->close();

?>