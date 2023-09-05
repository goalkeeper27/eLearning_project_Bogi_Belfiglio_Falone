<?php
session_start();
require "include/config.inc.php";
require "include/template2.inc.php";
require "include/dbms.inc.php";

$main = new Template("skins/revision/dtml/registration/registration.html");
echo $_POST['nome'];
echo $_POST['cognome'];
echo $_POST['citta'];
echo $_POST['codice_fiscale'];
echo $_POST['username'];
echo $_POST['email'];
echo $_POST['password'];
echo $_POST['password_ripetuta'];
echo $_POST['data'];
if (isset($_POST['nome']) && isset($_POST['cognome']) && isset($_POST['data']) && isset($_POST['citta']) 
    && isset($_POST['codice_fiscale']) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) 
        && isset($_POST['password_ripetuta'])) {
    echo "post ok";
    $nome = $_POST["nome"];
    $cognome = $_POST["cognome"];
    $data_nascita = $_POST["data"];
    $citta = $_POST["citta"];
    $codice_fiscale = $_POST["codice_fiscale"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $password_ripetuta = $_POST["password_ripetuta"];

    $dateTime = new DateTime($data_nascita);
    $dataString = $dateTime->format('Y-m-d');

    $password_hash = hash('md5', $password);

    $sql = "INSERT INTO `utente` (`nome`, `cognome`, `data`, `citta`, `codice_fiscale`, `username`, `email`, `password`) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)"; //Query di registrazione
    $sql2 = "SELECT * FROM `Utente` WHERE `username` = ? and `password` = ?"; //Per fare subito il login
    $sql3 = "SELECT * FROM `Utente` WHERE `username` = ?"; //Serve per controllare se l'username è gia esistente

    $stmt = $mysql->prepare($sql);
    $stmt3 = $mysql->prepare($sql3);

    $stmt->bind_param("ssssssss", $nome, $cognome, $dataString, $citta, $codice_fiscale, $username, $email, $password_hash);
    $stmt3->bind_param("s", $username);

    if ($stmt3->execute()) {
        $result = $stmt3->get_result();
        if ($result->num_rows === 1) {
            echo "Username già esistente!";
            exit;
        } else {
            if ($stmt->execute()) {
                $stmt2 = $mysql->prepare($sql2);

                $stmt2->bind_param("ss", $username, $password_hash);

                if ($stmt2->execute()) {
                    $result = $stmt2->get_result();
                    if ($result->num_rows === 1) {
                        $data = $result->fetch_assoc();
                        $_SESSION['auth']['ID'] = $data['ID'];
                        $_SESSION['auth']['username'] = $data['username'];
                        $_SESSION['auth']['password'] = $data['password'];
                        header("Location: index.php");
                        exit;
                    } else {
                        echo "Nome utente e/o password non validi";
                    }
                } else {
                    echo "<p>errore durante il login</p>";
                }
            } else {
                echo "<p>errore durante la registrazione</p>";
            }

        }
    }

    $stmt->close();
    $stmt2->close();
    $stmt3->close();
}
$main->close();
?>