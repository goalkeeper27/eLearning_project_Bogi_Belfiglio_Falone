<?php
session_start();

require "include/config.inc.php";
require "include/template2.inc.php";
require "include/dbms.inc.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
            $_SESSION['auth']['user'] = $data;
            header("Location: index.php");
            exit;
        } else {
            /*
            $web_user = get_current_user();
            $web_user = session_save_path();
            echo "Nome utente del server web: " . $web_user; */
            echo "Nome utente e/o password non validi";
        }
    } else {
        echo "<p>errore durante il login</p>";
    }
}
?>