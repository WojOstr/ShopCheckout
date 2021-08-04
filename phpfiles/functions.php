<?php 
class functions {
    public $productid = "";
    public $shippment = "";
    public $discountcode = "";
    public $payment = "";
    public $customerid = "";
    public $quantity = "";
    public $comment ="";

    public function __construct($productid, $shippment, $discountcode, $payment, $customerid, $quantity, $comment) {
        $this->productid = $productid;
        $this->shippment = $shippment;
        $this->discountcode = $discountcode;
        $this->payment = $payment;
        $this->customerid = $customerid;
        $this->quantity = $quantity;
        $this->comment = $comment;
    }

    //Liczenie ceny ostatecznej
    public function calculateprice($sql) {
        $ppresult = $sql->query("SELECT `ProductPrice` FROM `products` WHERE `IDProduct` = '".$this->productid."'");
        $spresult = $sql->query("SELECT `ShippmentPrice` FROM `shippment` WHERE `IDShippment` = '".$this->shippment."'");
        $dcresult = $sql->query("SELECT `DiscountAmount` FROM `discount` WHERE `DiscountCode` = '".$this->discountcode."' AND `DiscountIsOnline` = 1");
        
        $rowprice = $ppresult->fetch_row()[0];
        $rowship = $spresult->fetch_row()[0];
        $rowdiscount = $dcresult->fetch_row()[0] ?? $rowdiscount = 0;

        $finalprice = $rowprice * $this->quantity - (($rowdiscount/100)*$rowprice) + $rowship;
        return $finalprice;
    }

    //Tworzenie rekordu w tabelii orders
    public function placeorder($sql) {
        $finalprice = $this->calculateprice($sql);
        
        $sql->query("INSERT INTO `orders`(`OrdersIDUser`, `OrdersIDShippment`,
        `OrdersIDPayment`, `OrdersPrice`, `OrdersQuantity`, `OrdersComment`) 
        VALUES ('".$this->customerid."','".$this->shippment."',
        '".$this->payment."','$finalprice','".$this->quantity."','".$this->comment."')");
        return $sql->insert_id;
    }

    //Tabela gdzie mogłaby występować relacja wiele do wielu
    public function userorder($sql, $orderid) {
        $rc = $sql->query("INSERT INTO `productorders`(`IDOrders`, `IDProduct`) VALUES ('".$orderid."','".$this->productid."')");
        if ($rc) {
            return true;
        }


    }
}