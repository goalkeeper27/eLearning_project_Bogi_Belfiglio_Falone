<?php

if(isset($_SESSION["auth"]["username"])){
    $nav_bar = new Template("skins/revision/dtml/nav_bar/nav_bar_user.html");
    $nav_bar->setContent('username', $_SESSION["auth"]["username"]);
}else{
    $nav_bar = new Template("skins/revision/dtml/nav_bar/nav_bar.html");
}
?>