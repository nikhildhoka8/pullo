<?php
//function to generate activation code
function generateActivationCode($length = 50) {
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $code = '';
                for ($i = 0; $i < $length; $i++) {
                    $code .= $characters[rand(0, strlen($characters) - 1)];
                }
                return $code;
}
//function to check password strength
function checkPass($password){
    if(strlen($password) < 10 || (preg_match('/[A-Za-z]/', $password))== false || (preg_match('/[0-9]/', $password)) == false){
        return false;
    }
    else{
        return true;
    }
}
//function to check activation code
function checkActivationCode($activation_code){
    if(strlen($activation_code) != 50){
        return false;
    }
    if((preg_match('/[A-Za-z]/', $activation_code))== false || (preg_match('/[0-9]/', $activation_code)) == false){
        return false;
    }
    else{
        return true;
    }
}
?>