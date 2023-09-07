<?php
session_start();

require "include/config.inc.php";
require "include/template2.inc.php";
require "include/dbms.inc.php";

$main = new Template("skins/revision/dtml/login/login.html");

//if ($_SERVER["REQUEST_METHOD"] == "POST") {
if(isset($_POST["username"]) && isset($_POST["password"])){

    
    $username = $_POST["username"];
    $password = $_POST["password"];

    $password_hash = hash('md5', $password);

    $sql = "SELECT * FROM `Utente` WHERE `username` = ? and `password` = ?";

    $stmt = $mysql->prepare($sql);

    $stmt->bind_param("ss", $username, $password_hash);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows === 1) {
            $data = $result->fetch_assoc();
            $_SESSION['auth']['ID'] = $data['ID'];
            $_SESSION['auth']['username'] = $username;
            header("Location: index.php");
            exit;
        } else {
            $main->setContent("message_error_login", "Username e/o password non validi");
        }
    } else {
        echo "errore durante il login";
    }
}

$main->close();
?>