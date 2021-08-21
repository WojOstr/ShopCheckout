<?php
class user {

    //Tworzenie klienta
    public function registration($sql, $login, $password, $name, $surname, $country, $address, $zipcode, $city, $phone) {
        $stmt = $sql->prepare("INSERT INTO users
        (UserLogin, UserPassword, UserName, UserSurname, UserCountry, UserAddress, UserZipCode, UserCity, UserPhone) 
        VALUES 
        (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        $stmt->bind_param("ssssssssi", $login, $password, $name, $surname, $country,
        $address, $zipcode, $city, $phone);
        $result = $stmt->execute();

        if($result){ 
            return $stmt->insert_id;
            }
        else {
            return 0;
            }
        }


}
?>