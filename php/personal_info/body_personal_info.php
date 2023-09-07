<?php

if(isset($_POST["password"]) && isset($_POST["password_ripetuta"])){

    $username = $_SESSION['auth']['username'];
    $id_utente = $_SESSION['auth']['ID'];
    $nuova_password = $_POST["password"];
    $select_vecchia_password = $mysql->query("SELECT password FROM utente WHERE username = '$username' AND ID = $id_utente");
    if($select_vecchia_password){
        $vecchia_password = $select_vecchia_password->fetch_assoc();
    }else{
        echo "Errore nella query: ".$mysql->error;
    }
    
    $password_vecchia_inserita = $_POST['vecchia_password'];
    $password_vecchia_inserita_hash = hash('md5', $password_vecchia_inserita);

    if($vecchia_password["password"] === $password_vecchia_inserita_hash){
        $nuova_password_hash = hash('md5', $nuova_password);
        $update_password = $mysql->query("UPDATE utente SET password = '$nuova_password_hash' WHERE username = '$username'");
        $send_notific = $mysql->query("INSERT INTO notifica(ID_utente, mittente, data, ora, oggetto, corpo, visto)
        values($id_utente, 'E-LEARNING FBB COMMUNITY', curdate(), curtime(), 'Password Changed', 'Congratulations! Your password has been changed successfully', 0)");
        header("Location: notifications.php");
    }else{
        $send_notific = $mysql->query("INSERT INTO notifica(ID_utente, mittente, data, ora, oggetto, corpo, visto)
        values($id_utente, 'E-LEARNING FBB COMMUNITY', curdate(), curtime(), 'Password Not Changed', 'Oh no! Unfortunately, the password has not been changed because you entered the old password incorrectly', 0)");
        header("Location: notifications.php");
    }

}else{
    
    $body = new Template("skins/revision/dtml/personal_info/body_personal_info.html");
    $username = $_SESSION['auth']['username'];

    $info_utente = $mysql->query("SELECT * FROM utente WHERE username = '$username'");

    while($row = $info_utente->fetch_assoc()){
        $body->setContent('username', '<h1 align="center">'.$username.'</h1>');
        $body->setContent('name', ucfirst($row["nome"]));
        $body->setContent('surname', ucfirst($row["cognome"]));

        $timestamp = strtotime($row["data"]);
        $dataFormattata = date("d/m/Y", $timestamp);

        $body->setContent('date', $dataFormattata);
        $body->setContent('city', $row["citta"]);
        $body->setContent('email', $row["email"]);
    }
}



?>