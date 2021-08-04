<?php
session_start();
include ('user.php');
include ('connection.php');
include ('functions.php');
$db = new database();
$errors;

$recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
$recaptcha_secret = '6Le97tsbAAAAAIqT1ddGCimSaw49ce23NptMobdT'; // secret key
$recaptcha_response = $_POST['token'];
$login; $password;
$recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
$res = json_decode($recaptcha, true);
if ($res['success'] == true && $res['score'] >= 0.5) //sprawdzenie czy bot
{
    if(isset($_POST['login']) && isset($_POST['password'])) {
            $login = $_POST['login'];
            $password = $_POST['password'];
        }
    if(isset($_POST['login']) xor isset($_POST['password'])) {
        $errors['loginerror'] = "Proszę wprowadzić login i hasło";
    }  //sprawdzenie loginu i hasła
    else {
        $errors['loginerror'] = NULL;
    }
    if (isset($_POST['password']) && isset($_POST['password2']) ) {
        if ($_POST['password'] != $_POST['password2']) {
            $errors['passworderror'] = "Hasła się nie zgadzają";
        } //sprawdzenie czy hasła są takie same
        else {
            $errors['passworderror'] = NULL;
        }
        
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

    

    if ($errors['loginerror'] == NULL && $errors['passworderror'] == NULL && $errors['shiperror'] == NULL && 
    $errors['paymenterror'] == NULL) {
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
            // ?
        }
        else {
            $functions = new functions(1, $ship, $discount, $payment, $userid, 1, $comment);
            $orderId = $functions->placeorder($db->db_connection);  //tworzenie zamówienia
            $_SESSION['orderId'] = $orderId;
        }
        if ($orderId) {
            $rc = $functions->userorder($db->db_connection, $orderId);
            if ($rc) {
                echo json_encode($orderId);  //zwracanie numeru zamówienia do frontendu
            }
        }
    }
    else {
        echo json_encode($errors);
    }
}
else {
    echo json_encode('Error! The security token has expired or you are a bot.');
}

?>