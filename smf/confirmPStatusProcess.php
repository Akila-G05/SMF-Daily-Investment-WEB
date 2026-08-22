<?php

require "connection.php";
session_start();

if(!empty($_SESSION["au"])){

    $id = $_POST["id"];
    $s = $_POST["s"];

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $time = $d->format("Y-m-d");

    if($s == 1){
        Database::iud("UPDATE `user_has_packages` SET `p_status_id`='".$s."' WHERE `id`='".$id."'");
        echo("0");
    }else if($s == 2){
        Database::iud("UPDATE `user_has_packages` SET `p_status_id`='".$s."', `confirm_date`='".$time."'  WHERE `id`='".$id."'");

        $uhp_rs = Database::search("SELECT * FROM `user_has_packages` WHERE `id`='".$id."'");
        $uhp_data = $uhp_rs->fetch_assoc();

        $pkg_rs = Database::search("SELECT * FROM `packages` WHERE `id`='".$uhp_data["packages_id"]."'");
        $pkg_data = $pkg_rs->fetch_assoc();

        $price = $pkg_data["price"];

        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");

        $r_rs = Database::search("SELECT * FROM `referral` WHERE `user_email`='".$uhp_data["user_email"]."'");
        $r_num = $r_rs->num_rows;

        if($r_num > 0){

            $r_data = $r_rs->fetch_assoc();

            $ru_rs = Database::search("SELECT * FROM `user` INNER JOIN `wallet` ON `user`.`email` = `wallet`.`user_email` WHERE `r_code`='".$r_data["refer_code"]."'");
            $ru_data = $ru_rs->fetch_assoc();

            $ri_rs = Database::search("SELECT * FROM `r_income` WHERE `user_email`='".$ru_data["email"]."' AND `user_has_packages_id`='".$id."'");
            $ri_num = $ri_rs->num_rows;

            if($ri_num < 1){

                $referral = $price * 7 / 100;

                $w_amount = $ru_data["amount"];
                $new = $w_amount + $referral;

                // echo($new);
        
                Database::iud("INSERT INTO `r_income` (`amount`, `date`, `from`, `user_email`, `i_type_id`, `user_has_packages_id`) 
                VALUES('".$referral."', '".$date."', '".$uhp_data["user_email"]."', '".$ru_data["email"]."', '2', '".$id."')");

                Database::iud("UPDATE `wallet` SET `amount`='".$new."' WHERE `user_email`='".$ru_data["email"]."'");

                // echo("complete");

            }

        }

        echo("1"); 

    }else if($s == 3){
        Database::iud("UPDATE `user_has_packages` SET `p_status_id`='".$s."' WHERE `id`='".$id."'");
        echo("2"); 
    }

}else{
    echo("Please Signin Frist");
}



?>