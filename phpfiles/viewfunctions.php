<?php
class viewfunctions {
    

    public function viewShip($sql, $method) {
        $stmt = $sql->prepare("SELECT `ShippmentPrice` FROM `shippment` WHERE `IDShippment` = ?");
        $stmt->bind_param('s', $method);
        $stmt->execute();
        $result = $stmt->get_result();

        $resultrow = $result->fetch_row()[0];
        
        $formnum = numfmt_create( 'pl_PL', NumberFormatter::CURRENCY);
        $datavalue = numfmt_format_currency($formnum, $resultrow, 'PLN');
        
        
        return $datavalue;
    }
    public function viewProduct($sql, $productid) {
        $stmt = $sql->prepare("SELECT `ProductName`, `ProductPrice`, `ProductPhoto` FROM `products` WHERE `IDProduct` = ?");
        $stmt->bind_param('i', $productid);
        $stmt->execute();
        $result = $stmt->get_result();
        $resultrow = $result->fetch_row();
        return $resultrow;
    }


    public function checkDiscount($sql, $discountName) {
        $stmt = $sql->prepare("SELECT `DiscountAmount` FROM `discount` WHERE `DiscountCode` = ? AND `DiscountIsOnline` = 1");
        $stmt->bind_param("s", $discountName);
        if($stmt->execute()){
            $result = $stmt->get_result();
            $resultrow = $result->fetch_row()[0];
            return $resultrow;
        }
        else {
            return false;
        }
        
        
    }

    function calculateprice($sql,$productid, $shippment, $discountcode, $quantity) {
        $ppresult = $sql->query("SELECT `ProductPrice` FROM `products` WHERE `IDProduct` = '".$productid."'");
        $spresult = $sql->query("SELECT `ShippmentPrice` FROM `shippment` WHERE `IDShippment` = '".$shippment."'");
        $dcresult = $sql->query("SELECT `DiscountAmount` FROM `discount` WHERE `DiscountCode` = '".$discountcode."' AND `DiscountIsOnline` = 1");
            
        $rowprice = $ppresult->fetch_row()[0];
        $rowship = $spresult->fetch_row()[0] ?? $rowship = 0;
        $rowdiscount = $dcresult->fetch_row()[0] ?? $rowdiscount = 0;
    
        $finalprice = $rowprice * $quantity - (($rowdiscount/100)*$rowprice) + $rowship;
        return $finalprice;
    }

}