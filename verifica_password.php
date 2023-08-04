<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];

    if($password1 === $password2){
        echo "coincide";
    }else{
        echo "non_coincide";
    }
}
?>