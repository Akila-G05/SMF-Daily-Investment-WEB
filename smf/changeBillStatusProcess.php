<?php

require "connection.php";

$status = $_POST["s"];
$id = $_POST["id"];

if($status == 2){

    Database::iud("UPDATE `paybill` SET `b_status_id`='".$status."' WHERE `id`='".$id."'");

    $bill_rs = Database::search("SELECT * FROM `paybill` WHERE `id`='".$id."'");
    $bill_data = $bill_rs->fetch_assoc();

    $wallet_rs = Database::search("SELECT * FROM `wallet` WHERE `user_email`='".$bill_data["user_email"]."'");
    $wallet_data = $wallet_rs->fetch_assoc();

    $balance = $wallet_data["amount"];
    $payment = $bill_data["payment"];

    if($balance > $payment){

        $new = $balance - $payment;

        Database::iud("UPDATE `wallet` SET `amount`='".$new."' WHERE `user_email`='".$bill_data["user_email"]."'");

        echo("Success");

    }else{
        echo("insufficient Wallet Balance");
    }

}else if($status == 3){

    Database::iud("UPDATE `paybill` SET `b_status_id`='".$status."' WHERE `id`='".$id."'");

    echo("Success");

}

?>