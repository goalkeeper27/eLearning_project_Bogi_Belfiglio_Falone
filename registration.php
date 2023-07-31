<?php
require "include/config.inc.php";
require "include/template2.inc.php";
require "include/dbms.inc.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $cognome = $_POST["cognome"];
    $data = $_POST["data"];
    $citta = $_POST["citta"];
    $codice_fiscale = $_POST["codice_fiscale"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $password_ripetuta = $_POST["password_ripetuta"];

    $dateTime = new DateTime($data);
    $dataString = $dateTime->format('Y-m-d');

    $password_hash = hash('md5', $password);

    $sql = "INSERT INTO `utente` (`nome`, `cognome`, `data`, `citta`, `codice_fiscale`, `username`, `email`, `password`) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $mysql->prepare($sql);

    $stmt->bind_param("ssssssss", $nome, $cognome, $dataString, $citta, $codice_fiscale, $username, $email, $password_hash);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    } else {
        echo "<p>errore durante la registrazione</p>";
    }

    $stmt->close();

}
?>