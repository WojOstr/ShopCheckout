<?php
class user {
    public $login = NULL;
    public $password = NULL;
    public $name = "";
    public $surname = "";
    public $country = "";
    public $address = "";
    public $zipcode = "";
    public $city = "";
    public $phone = "";

    public function __construct($login, $password, $name, $surname, $country, $address, $zipcode, $city, $phone) {
        $this->login = $login;
        $this->password = $password;
        $this->name = $name;
        $this->surname = $surname;
        $this->country = $country;
        $this->address = $address;
        $this->zipcode = $zipcode;
        $this->city = $city;
        $this->phone = $phone;
    }

    public function registration($sql) {
        $stmt = $sql->prepare("INSERT INTO users
        (UserLogin, UserPassword, UserName, UserSurname, UserCountry, UserAddress, UserZipCode, UserCity, UserPhone) 
        VALUES 
        (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        $stmt->bind_param("ssssssssi", $this->login, $this->password, $this->name, $this->surname, $this->country,
        $this->address, $this->zipcode, $this->city, $this->phone);

        if($stmt->execute()){
            return $sql->insert_id;
        }
    }

}
?>