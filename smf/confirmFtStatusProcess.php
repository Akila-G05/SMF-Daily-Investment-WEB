<?php

require "connection.php";
session_start();

if(!empty($_SESSION["au"])){

    $id = $_POST["id"];
    $s = $_POST["s"];

    Database::iud("UPDATE `fund_transfer` SET `ft_status_id`='".$s."' WHERE `id`='".$id."'");  
    if($s == 2){

        $ft_rs = Database::search("SELECT * FROM `fund_transfer` WHERE `id`='".$id."'");
        $ft_data = $ft_rs->fetch_assoc();

        $from_wallet_rs = Database::search("SELECT * FROM `wallet` WHERE `user_email`='".$ft_data["user_email"]."' ");
        $from_wallet_data = $from_wallet_rs->fetch_assoc();

        $to_wallet_rs = Database::search("SELECT * FROM `wallet` WHERE `user_email`='".$ft_data["to"]."' ");
        $to_wallet_data = $to_wallet_rs->fetch_assoc();

        $from = $from_wallet_data["amount"] - $ft_data["amount"];
        $to = $to_wallet_data["amount"] + $ft_data["amount"];

        Database::iud("UPDATE `wallet` SET `amount`='".$from."' WHERE `user_email`='".$from_wallet_data["user_email"]."'");
        Database::iud("UPDATE `wallet` SET `amount`='".$to."' WHERE `user_email`='".$to_wallet_data["user_email"]."'");  

        echo("Success");

    }

    echo("done");

}else{
    echo("You are not a valid User");
}

?>