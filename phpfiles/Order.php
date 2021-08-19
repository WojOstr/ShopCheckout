<?php
session_start();
include ('user.php');
include ('connection.php');
include ('viewfunctions.php');

$_SESSION['vf'] = $vf;

$db = new database();
$errors; $login; $password; $res;

if (!empty($_POST['login'])) {
    if(empty($_POST['password'])) {
        $errors['loginerror'] = "Wprowadź pierwsze hasło";
    }
    if(empty($_POST['password2'])){
        $errors['loginerror'] = "Potwierdź hasło";
    }
    if(!empty($_POST['password']) && !empty($_POST['password2'])){
        $errors['loginerror'] = NULL;
    }
}
else if (empty($_POST['login'])) {
    if(!empty($_POST['password']) && !empty($_POST['password2'])){
        $errors['loginerror'] = "Wprowadź login";
    }
    if(!empty($_POST['password']) && empty($_POST['password2'])){
        $errors['loginerror'] = "Wprowadź login i potwierdź hasło";
    }
    if(!empty($_POST['password2']) && empty($_POST['password'])) {
        $errors['loginerror'] = "Wprowadź login i hasło";
    }
    if (empty($_POST['password']) && empty($_POST['password2']))
    {
        $errors['loginerror'] = NULL;
    }
}

if((isset($_POST['login']) && isset($_POST['password'])) && isset($_POST['password2'])) {
    if (strlen($_POST['login']) < 3 || strlen($_POST['login']) > 20) {
        $errors['loginlengtherror'] = "Login powinien zawierać od 3 do 20 znaków";
    }
    else {
        $errors['loginlengtherror'] = NULL;
    }
    if (strlen($_POST['password']) < 8 || strlen($_POST['password']) > 20) {
        $errors['passwordlengtherror'] = "Hasło powinno zawierać od 8 do 20 znaków";
    }
    else {
        $errors['passwordlengtherror'] = NULL;
    }
    if ($_POST['password'] != $_POST['password2']) {
        $errors['passworderror'] = "Hasła się nie zgadzają";
    } //sprawdzenie czy hasła są takie same
   
    else {
        $errors['passworderror'] = NULL;
        $login = $_POST['login'];
        $password = $_POST['password'];
    }
}
if(empty($_POST['password']) && empty($_POST['password2']) && empty($_POST['login'])) {
    $errors['loginerror'] = NULL;
}


if (!isset($_POST['ship'])) {
    $errors['shiperror'] = "Proszę wybrać opcję dostawy";
}
else {
    $errors['shiperror'] = NULL;
}
if (!isset($_POST['payment'])) {
    $errors['paymenterror'] = "Proszę wybrać opcję płatności";
}
else {
    $errors['paymenterror'] = NULL;
}
if (isset($_POST['recaptcha'])){
    $recaptcha_response = $_POST['recaptcha'];
    $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptcha_secret = '6LcNxggcAAAAAI6zfhULf4ElgTigGu9bxzpgH2SZ'; // secret key
    $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
    $res = json_decode($recaptcha, true);
    $errors['captchaerror'] = NULL;
}
else {
    $errors['captchaerror'] = "Proszę wypełnić Captche";
}



if ($errors['loginerror'] == NULL && $errors['passworderror'] == NULL && $errors['shiperror'] == NULL 
&& $errors['paymenterror'] == NULL && $errors['captchaerror'] == NULL && $errors['loginlengtherror'] == NULL 
&& $errors['passwordlengtherror'] == NULL) {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $country = $_POST['country'];
    $address = $_POST['address'];
    $zipcode = $_POST['zipcode'];
    $city = $_POST['city'];
    $phone = $_POST['phone'];

    $ship = $_POST['ship'];
    $payment = $_POST['payment'];
    $discount = $_POST['discountcode'];
    $comment = $_POST['comment'];


    $newuser = new user($login, $password, $name, $surname, $country, $address, $zipcode, $city, $phone);
    $userid = $newuser->registration($db->db_connection);  //tworzenie użytkownika
    
    if ($userid == false) {
        $errors['userexisterror'] = "Taki użytkownik już istnieje lub nie wprowadzono loginu";
        echo json_encode($errors);
    }
    else {
        $orderId = $vf->placeorder($db->db_connection, 1, $ship, $discount, 1, $userid, $payment, $comment);  //tworzenie zamówienia
        $_SESSION['orderId'] = $orderId;

        if ($orderId) {
            $rc = $vf->userorder($db->db_connection, $orderId, $userid);
            if ($rc) {
                echo json_encode($orderId);  //zwracanie numeru zamówienia do frontendu
            }
            else {
                $errors['unknownerror?'] = "error";
                echo json_encode($errors);
            }
        }
    }
}
else {
    echo json_encode($errors);
}


?>