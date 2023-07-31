function psw_control(){
    let password1 = document.getElementById("password").value;
    let password2 = document.getElementById("password_ripetuta").value;
    let message_error = document.getElementById("message_error");
    let button_registrati = document.getElementById("registrati");

    if(password1 !== password2){
        message_error.innerText = "Le password inserite non coincidono";
        button_registrati.disbled = true;
    }else{
        message_error.innerText = "";
        button_registrati.disbled = false;
    }
}