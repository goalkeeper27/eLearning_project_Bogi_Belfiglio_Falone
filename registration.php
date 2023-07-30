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


    if ($password !== $password_ripetuta) {
        echo "Errore: La password e la password ripetuta non coincidono";
        exit;
    }

    $sql = "INSERT INTO utenti (nome, cognome, data, citta, codice_fiscale, username, email, password) 
        VALUES ('$nome', '$cognome', '$data', '$citta', '$codice_fiscale', '$username', '$email', '$password')";

    if($mysql ->query($sql) == TRUE){
        echo "Registrazione avvenuta con successo";
    }else{
        echo "Errore durante la registrazione: ";
    }

}
?>