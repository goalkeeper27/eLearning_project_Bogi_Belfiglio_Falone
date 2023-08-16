<?php
session_cache_limiter("private_no_expire");
session_start();

require "include/config.inc.php";
require "include/template2.inc.php";
require "include/dbms.inc.php";

require "php/navbar/navbar.php";
require "php/lessons/body_lessons.php";
require "php/lessons/header_lessons.php";


# definiamo il template scheletro
$main = new Template("skins/revision/dtml/index_v1.html");



$main->setContent('nav_bar', $nav_bar->get());
$main->setContent('header', $header->get());
$main->setContent('body', $body->get());
$main->close();

?>