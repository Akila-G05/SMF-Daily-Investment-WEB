<?php

require "connection.php";
session_start();

if(!empty($_SESSION["u"])){

    $user = $_SESSION["u"];
    $cid = $_POST["cid"];
    $type = $_POST["type"];
    $name = $_POST["name"];
    $number = $_POST["number"];
    $payment = $_POST["amount"];
    $usd = $_POST["usd"];

    if(empty($cid)){
        echo("Please Select Bill Category");
    }else if(empty($type)){
        echo("Please Select Bill Type");
    }else if(empty($number)){
        echo("Please Input Account Number Or Mobile (Depends On Bill Category)");
    }else if(empty($name)){
        echo("Please Input Name");
    }else if(empty($payment)){
        echo("Please Input Payment");
    }else if(empty($payment)){
        echo("Please Input Payment");
    }else if($usd < 1){
        echo("Payment Should Be Morethan 1$");
    }else{

        $wallet_rs = Database::search("SELECT * FROM `wallet` WHERE `user_email`='".$user["email"]."'");
        $wallet_data = $wallet_rs->fetch_assoc();

        $w_balance = $wallet_data["amount"];

        if($usd > $w_balance){
            echo("insufficient Wallet Balance");
        }else{

            $d = new DateTime();
            $tz = new DateTimeZone("Asia/Colombo");
            $d->setTimezone($tz);
            $date = $d->format("Y-m-d H:i:s");

            Database::iud("INSERT INTO `paybill` (`name`, `ac_no`, `payment`, `date`, `b_type_id`, `b_status_id`, `user_email`) 
            VALUES('".$name."', '".$number."', '".$usd."', '".$date."', '".$type."', '1', '".$user["email"]."')");

            echo("Success");

        }

    }

}

?>