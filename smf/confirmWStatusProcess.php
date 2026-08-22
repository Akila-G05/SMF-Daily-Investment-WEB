<?php

require "connection.php";
session_start();

if(!empty($_SESSION["au"])){

    $id = $_POST["id"];
    $s = $_POST["s"];

    Database::iud("UPDATE `withdraw` SET `w_status_id`='".$s."' WHERE `id`='".$id."'");  
    if($s == 2){

        $withdraw_rs = Database::search("SELECT * FROM `withdraw` WHERE `id`='".$id."'");
        $withdraw_data = $withdraw_rs->fetch_assoc();

        $wallet_rs = Database::search("SELECT * FROM `wallet` WHERE `user_email`='".$withdraw_data["user_email"]."' ");
        $wallet_data = $wallet_rs->fetch_assoc();

        $w_amount = $wallet_data["amount"];
        $withdraw = $withdraw_data["amount"];

        $new = $w_amount - $withdraw;

        Database::iud("UPDATE `wallet` SET `amount`='".$new."' WHERE `user_email`='".$wallet_data["user_email"]."'"); 

        echo("Success");

    }

    echo("done");

}else{
    echo("You are not a valid User");
}

?>