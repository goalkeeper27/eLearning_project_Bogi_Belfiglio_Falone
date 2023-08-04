<?php

if(isset($_SESSION["auth"]["username"])){
    $nav_bar = new Template("skins/revision/dtml/nav_bar/nav_bar_user.html");
    $nav_bar->setContent('username', $_SESSION["auth"]["username"]);
    $user = $_SESSION["auth"]["username"];
    $notification = $mysql->query("SELECT * FROM notifica N INNER JOIN utente U ON U.ID=N.ID_utente WHERE U.username = '".$user."'   AND N.visto = 0");
    if($notification->num_rows > 0){
        $nav_bar->setContent('notification', '<div class="notification-icon">
                                                <span class="notification-nav-bar" onclick="seeNotifications()">
                                                    <i class="fas fa-bell"></i>
                                                    <i class="notification-badge"></i>
                                                </span>
                                                </div>' );
    }else{
        $nav_bar->setContent('notification', '<span class="notification-nav-bar"><i class="fas fa-bell mr-2" onclick="seeNotifications()"></i></span>' );
    }
}else{
    $nav_bar = new Template("skins/revision/dtml/nav_bar/nav_bar.html");
}

?>