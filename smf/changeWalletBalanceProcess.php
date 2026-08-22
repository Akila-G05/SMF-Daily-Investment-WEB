<?php

require "connection.php";

$balance = $_POST["balance"];
$email = $_POST["email"];

$w_rs = Database::search("SELECT * FROM `wallet` WHERE `user_email`='".$email."'");
$w_num = $w_rs->num_rows;

if($w_num > 0){

    Database::iud("UPDATE `wallet` SET `amount`='".$balance."' WHERE `user_email`='".$email."'");
    echo("Success");

}

?>