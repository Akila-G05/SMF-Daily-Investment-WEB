<?php

require "connection.php";
session_start();

if(!empty($_SESSION["u"])){

    $user = $_SESSION["u"];
    $email = $_POST["e"];
    $bid = $_POST["b"];
    $amount = $_POST["a"];
    
    if(!empty($email && $bid && $amount)){

        $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='".$email."' AND `b_id`='".$bid."'");
        $user_num = $user_rs->num_rows;

            if($user_num > 0){

            $wallet_rs = Database::search("SELECT * FROM `wallet` WHERE `user_email`='".$user["email"]."'");
            $wallet_data = $wallet_rs->fetch_assoc();

            $f_rs = Database::search("SELECT * FROM `fund_transfer` WHERE `user_email`='".$user["email"]."' AND `ft_status_id`='1'");
            $f_num = $f_rs->num_rows;

            $d = new DateTime();
            $tz = new DateTimeZone("Asia/Colombo");
            $d->setTimezone($tz);
            $date = $d->format("Y-m-d H:i:s");

            if($amount <= (int)$wallet_data["amount"]){

                if($f_num < 1){

                    Database::iud("INSERT INTO `fund_transfer` (`amount`, `to`, `date`, `ft_status_id`, `user_email`) 
                    VALUES ('".$amount."', '".$email."', '".$date."', '1', '".$user["email"]."')");

                    echo("Success");            

                }else{
                    echo("You have pending request. Delete or wait admin confirm your request....");
                }

            }else{
                echo("insufficient Wallet Balance");
            }

        }else{
            echo("Not Valid User");
        }

    }else{
        echo("Input Fieds should not be empty.");
    }

}else{

    echo("Please Signin Frist");

}

?>