<?php

require "connection.php";
session_start();

if(!empty($_SESSION["u"])){

    $amount = (int)$_GET["amount"];
    $email = $_SESSION["u"]["email"];

    if(!empty($amount)){

        $wallet_rs = Database::search("SELECT * FROM `wallet` WHERE `user_email`='".$email."'");
        $wallet_data = $wallet_rs->fetch_assoc();

        $w_rs = Database::search("SELECT * FROM `withdraw` WHERE `user_email`='".$email."' AND `w_status_id`='1'");
        $w_num = $w_rs->num_rows;

        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");

        if($amount <= (int)$wallet_data["amount"]){

            if($w_num < 1){

                Database::iud("INSERT INTO `withdraw` (`amount`, `date`, `w_status_id`, `user_email`) 
                VALUES ('".$amount."', '".$date."', '1', '".$email."')");

                echo("Success");            

            }else{
                echo("You have pending request. Delete or wait admin confirm your request....");
            }

        }else{
            echo("insufficient Wallet Balance");
        }

    }else{
        echo("Please Enter Amount");
    }

}else{
    echo("Please Signin Frist");
}

?>