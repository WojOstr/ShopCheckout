<?php
include ('user.php');
include ('connection.php');
include ('viewfunctions.php');
session_start();


$vf = $_SESSION['vf']; 

$db = new database();

$errors = array();
$login; $password; $res;

if (!empty($_POST['login'])) {
    if(empty($_POST['password'])) {
        $errors['loginerror'] = "Wprowadź pierwsze hasło";
    }
    elseif(empty($_POST['password2'])){
        $errors['loginerror'] = "Potwierdź hasło";
    }
    elseif(!empty($_POST['password']) && !empty($_POST['password2'])){
        $errors['loginerror'] = NULL;
    }
    else {
        // ?
    }
}
elseif (empty($_POST['login'])) {
    if(!empty($_POST['password']) && !empty($_POST['password2'])){
        $errors['loginerror'] = "Wprowadź login";
    }
    elseif(!empty($_POST['password']) && empty($_POST['password2'])){
        $errors['loginerror'] = "Wprowadź login i potwierdź hasło";
    }
    elseif(!empty($_POST['password2']) && empty($_POST['password'])) {
        $errors['loginerror'] = "Wprowadź login i hasło";
    }
    elseif (empty($_POST['password']) && empty($_POST['password2']))
    {
        $errors['loginerror'] = NULL;
    }
    else {
        // ?
    }
}
else {
    // ?
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
elseif(empty($_POST['password']) && empty($_POST['password2']) && empty($_POST['login'])) {
    $errors['loginerror'] = NULL;
}
else {
    // ?
}
if (preg_match('~[0-9\W]+~', $_POST['name'])) {
   $errors['nameerror'] = "Imię nie może zawierać liczb i znaków specjalnych";
}
else {
    $errors['nameerror'] = NULL;
}
if (preg_match('~[0-9\W]+~', $_POST['surname'])) {
    $errors['surnameerror'] = "Nazwisko nie może zawierać liczb i znaków specjalnych";
}
else {
    $errors['surnameerror'] = NULL;
}
if (preg_match('~[0-9\W]+~', $_POST['city'])) {
    $errors['cityerror'] = "Miasto nie może zawierać liczb i znaków specjalnych";
}
else {
    $errors['cityerror'] = NULL;
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
    && $errors['passwordlengtherror'] == NULL && $errors['nameerror'] == NULL && $errors['surnameerror'] == NULL
    && $errors['cityerror'] == NULL) {

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

    $result = $vf->checkUser($db->db_connection, $login);
    if ($result == true) {
        $errors['userexisterror'] = "Taki użytkownik już istnieje lub nie wprowadzono loginu";
    }
    else {
        $errors['userexisterror'] = NULL;
    }
    if ($errors['userexisterror'] !== NULL) {
        echo json_encode($errors);
        exit;
        }
    elseif ($errors['userexisterror'] === NULL) {
        $newuser = new user();
        $userid = $newuser->registration($db->db_connection, $login, $password, $name, $surname, $country, $address, $zipcode, $city, $phone);  //tworzenie użytkownika
        if ($userid) {
            $orderId = $vf->placeorder($db->db_connection, 1, $ship, $discount, 1, $userid, $payment, $comment);  //tworzenie zamówienia
            if ($orderId) {
                $rc = $vf->userorder($db->db_connection, $orderId, 1);
                if ($rc) {
                    echo $orderId;  //zwracanie numeru zamówienia do frontendu
                    exit;
                }
                else {

                    $errors['unknownerror'] = "error";
                    // Usuwanie użytkownika i zamówienia dodanego w takim przypadku
                    echo json_encode($errors);
                    exit;
                }
            }
            else {
                $errors['unknownerror'] = "error";
                // Usuwanie użytkownika dodanego w takim przypadku
                echo json_encode($errors);
                exit;
            }
        }
        else {
            $errors['unknownerror'] = "error";
            echo json_encode($errors);
            exit;
        }
    }   
}
else {
    echo json_encode($errors);
    exit;
}


?>