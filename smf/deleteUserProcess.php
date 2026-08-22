<?php

require "connection.php";

$email = $_GET["email"];

if(!empty($email)){

    $referral_rs = Database::search("SELECT * FROM `referral` WHERE `user_email` = '".$email."'");
    $referral_num = $referral_rs->num_rows;
    if($referral_num > 0){
        Database::iud("DELETE FROM `referral` WHERE `user_email` = '".$email."'");
    }

    $img_rs = Database::search("SELECT * FROM `img_path` WHERE `user_email` = '".$email."'");
    $img_num = $img_rs->num_rows;
    if($img_num > 0){
        Database::iud("DELETE FROM `img_path` WHERE `user_email` = '".$email."'");
    }

    $fund_rs = Database::search("SELECT * FROM `fund_transfer` WHERE `user_email` = '".$email."'");
    if($fund_rs->num_rows > 0){
        Database::iud("DELETE FROM `fund_transfer` WHERE `user_email` = '".$email."'");
    }

    $withdraw_rs = Database::search("SELECT * FROM `withdraw` WHERE `user_email` = '".$email."'");
    if($withdraw_rs->num_rows > 0){
        Database::iud("DELETE FROM `withdraw` WHERE `user_email` = '".$email."'");
    }

    $bill_rs = Database::search("SELECT * FROM `paybill` WHERE `user_email`='".$email."'");
    if($bill_rs->num_rows > 0){
        Database::iud("DELETE FROM `paybill` WHERE `user_email` = '".$email."'");
    }

    $uhp_rs = Database::search("SELECT * FROM `user_has_packages` WHERE `user_email` = '".$email."'");
    if($uhp_rs->num_rows > 0){

        $income_rs = Database::search("SELECT * FROM `income` WHERE `user_email` = '".$email."'");
        if($income_rs->num_rows > 0){
            Database::iud("DELETE FROM `income` WHERE `user_email` = '".$email."'");
        }

        $rincome_rs = Database::search("SELECT * FROM `r_income` WHERE `from` = '".$email."'");
        if($rincome_rs->num_rows > 0){
            Database::iud("DELETE FROM `r_income` WHERE `from` = '".$email."'");
        }

        Database::iud("DELETE FROM `user_has_packages` WHERE `user_email` = '".$email."'");
    }

    Database::iud("DELETE FROM `user_has_address` WHERE `user_email` = '".$email."'");
    Database::iud("DELETE FROM `wallet` WHERE `user_email` = '".$email."'");
    Database::iud("DELETE FROM `user` WHERE `email`='".$email."'");

    echo("Success");

}

?>