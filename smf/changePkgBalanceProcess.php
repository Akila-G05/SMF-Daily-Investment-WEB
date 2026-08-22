<?php

require "connection.php";
session_start();

if(!empty($_SESSION["au"])){

    $newPkgBalance = $_POST["balance"];
    $id = $_POST["id"];

    $uhp_rs = Database::search("SELECT * FROM `user_has_packages` WHERE `id`='".$id."'");
    $uhp_data = $uhp_rs->fetch_assoc();

    $pkg_rs = Database::search("SELECT * FROM `packages` WHERE `id`='".$uhp_data["packages_id"]."'");
    $pkg_data = $pkg_rs->fetch_assoc();

    $pkgEarn = $pkg_data["price"] * 2;

    if($newPkgBalance <= $pkgEarn){

        $wallet_rs = Database::search("SELECT * FROM `wallet` WHERE `user_email`='".$uhp_data["user_email"]."'");

        if($wallet_rs->num_rows > 0){

            $wallet_data = $wallet_rs->fetch_assoc();

            $oldPkgBalance = $uhp_data["earning"];
            $wBalance = $wallet_data["amount"];

            $diff = $newPkgBalance - $oldPkgBalance;
            $total_earnings = $wallet_data["total_earnings"] + $diff;
            $newWBalance = $wBalance + $diff;

            Database::iud("UPDATE `wallet` SET `amount`='".$newWBalance."', `total_earnings`='".$total_earnings."' WHERE `user_email`='".$uhp_data["user_email"]."'");

        }else{
            echo("Somthing Went Wrong");
        }

        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d");

        Database::iud("UPDATE `user_has_packages` SET `earning`='".$newPkgBalance."' WHERE `id`='".$id."'");

        Database::iud("INSERT INTO `income` (`date`, `amount`, `user_has_packages_id`, `i_type_id`, `user_email`) 
        VALUES ('".$date."', '".$diff."', '".$id."', '3', '".$uhp_data["user_email"]."')");

        echo("Success");
    
    }else{
        echo("Price Should Be ".$pkgEarn." OR Minimum");
    }

}else{
    echo("You are not a Valid User");
}

?>