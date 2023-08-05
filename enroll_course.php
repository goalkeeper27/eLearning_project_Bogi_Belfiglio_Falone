<?php

session_start();

require "include/config.inc.php";
require "include/template2.inc.php";
require "include/dbms.inc.php";

if (isset($_SESSION["auth"]["username"])) {
    $user = $_SESSION["auth"]["username"];
    if (isset($_POST["id_course"])) {
        //course information
        $id_course = $_POST["id_course"];
        $course_info_query = $mysql->query("SELECT * FROM corso WHERE ID = $id_course");
        $result = $course_info_query->fetch_assoc();
        $course_name = $result["nome"];


        //user information
        $id_user_query = $mysql->query("SELECT ID FROM utente WHERE username = '" . $user . "'");
        $id_user_result = $id_user_query->fetch_assoc();
        $id_user = $id_user_result["ID"];
        $new_enrollment = $mysql->query("insert into storico_iscrizioni_corso(ID_utente, ID_corso, data) VALUES($id_user,$id_course, curdate());");
        if ($new_enrollment) {

            $sender = 'FBB Community';
            $object = 'Enrollment in the course "'.$course_name .'"';
            $body =  'Hi '. $user .' . \n Your enrollment in the "'. $course_name .'" course has been completed successfully. \n Enjoy the study';
            $notification = $mysql->query("insert into notifica(ID_utente, mittente, data, ora, oggetto, corpo, visto)
                                            values($id_user, '". $sender ."', curdate(), curtime(), '". $object ."', '". $body ."', 0)");
                                            
                                
        }
    
        header("location: index.php");

    }

} else {
    header("location: login.html");
}











?>